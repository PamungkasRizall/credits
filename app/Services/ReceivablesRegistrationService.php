<?php

namespace App\Services;

use App\DTOs\ReceivablesRegistrationDTO;
use App\DTOs\ReceivablesRegistrationStatusDTO;
use App\Enums\ReceivablesRegistrationStatus;
use App\Models\Installment;
use App\Models\ReceivablesRegistration;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReceivablesRegistrationService
{
    public function findOrFail(string $id): ReceivablesRegistration
    {
        return ReceivablesRegistration::with(
            'product',
                'consumer.lastTransaction',
                'sales',
                'supervisor',
                'wasdit',
                'ar',
                'collector',
            )
            ->findOrFail($id);
    }

    public function storeReceivablesRegistration(ReceivablesRegistrationDTO $dto): ReceivablesRegistration
    {
        return DB::transaction(function () use ($dto) {
            return ReceivablesRegistration::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );
        });
    }

    public function storeReceivablesRegistrationStatus(ReceivablesRegistrationStatusDTO $dto, ?ReceivablesRegistration $receivablesRegistration)
    {
        return DB::transaction(function () use ($dto, $receivablesRegistration) {

            if ($dto->status == ReceivablesRegistrationStatus::IN_PROCESS->value)
            {
                $this->storeInstallment($dto);
            }

            $update = [
                'status' => $dto->status
            ];

            if ($receivablesRegistration->status == ReceivablesRegistrationStatus::PENDING)
            {
                $districtLetterCode = $receivablesRegistration->consumer->subDistrict->district_letter_code;

                if (!$districtLetterCode) {
                    throw new Exception('Kode Huruf Kecamatan Tidak Ditemukan.');
                }

                $number = ReceivablesRegistration::where('year', $receivablesRegistration->year)->max('contract_number') + 1;
                $contractNumber = 'FSBH/' . substr($districtLetterCode, 0, 6) .'/'. sprintf('%05d', $number) .'/' . $dto->date_at->format('Y') .'/' . $dto->date_at->format('m');
                $update['date_at'] = $dto->date_at;
                $update['contract_number'] = $number;
                $update['contract_code'] = $contractNumber;
            }

            return ReceivablesRegistration::where('id', $dto->model_id)
                ->update($update);
        });
    }

    private function storeInstallment(ReceivablesRegistrationStatusDTO $dto)
    {
        return DB::transaction(function () use ($dto) {

            $receivablesRegistration = ReceivablesRegistration::findOrFail($dto->model_id);
            $receivablesRegistration->status = ReceivablesRegistrationStatus::IN_PROCESS;
            $receivablesRegistration->save();

            $installments = $this->getPeriodInstallment($dto->date_at, $dto->tenor);
            foreach($dto->awd as $awd)
            {
                $index = $awd - 1;
                $installments[$index]['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');
                $installments[$index]['updated_by'] = Auth::id();
            }

            return $receivablesRegistration->installments()->createMany($installments);
        });
    }

    public function getPeriodInstallment(Carbon $date, int $tenor, bool $awd = false): array|Collection
    {
        $period = CarbonPeriod::between(Carbon::parse($date), Carbon::parse($date)->addDays($tenor + 20))
                    ->filter(fn ($date) => !$date->isSunday())
                    ->map(fn (Carbon $date) => ['date_at' => $date->format(($awd ? 'd/m/Y' : 'Y-m-d'))]);

        $installments = [];

        foreach ($period as $key => $val) {
            $val['number'] = ++$key;
            $val['updated_at'] = null;
            $installments[] = $val;
        }

        if ($awd)
            return collect($installments)->slice(0, length: 8)->pluck('date_at', 'number');

        return collect($installments)->slice(0, $tenor)->toArray();
    }

    public function deleteReceivablesRegistration(string $id): void
    {
        DB::transaction(function () use ($id) {
            $this->findOrFail($id)->delete();
        });
    }
}
