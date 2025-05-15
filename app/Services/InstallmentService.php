<?php

namespace App\Services;

use App\DTOs\ReceivablesRegistrationAngsuranDTO;
use App\Models\Installment;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class InstallmentService
{
    public function findOrFail(int $id): Installment
    {
        return Installment::findOrFail($id);
    }

    public function installments(string $receivablesRegistrationId): Collection
    {
        return Installment::where('receivables_registration_id', $receivablesRegistrationId)->get();
    }

    public function updateAngsuran(ReceivablesRegistrationAngsuranDTO $dto)
    {
        return Installment::where('receivables_registration_id', $dto->model_id)
            ->whereIn('number', array_keys($dto->angsuran))
            ->update(
                [
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_by' => Auth::id(),
                ]
            );
    }
}
