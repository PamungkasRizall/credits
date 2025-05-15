<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\InstallmentService;
use App\Services\ReceivablesRegistrationService;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    private $f4 = [0.0, 0.0, 595.4, 935.5];
    private $a4 = [0, 0, 595.28, 841.89];

    protected ReceivablesRegistrationService $receivablesRegistrationService;
    protected InstallmentService $installmentService;

    public function __construct(
        ReceivablesRegistrationService $receivablesRegistrationService,
        InstallmentService $installmentService,
    )
    {
        $this->middleware('auth');

        setlocale(LC_ALL, 'IND');

        $this->receivablesRegistrationService = $receivablesRegistrationService;
        $this->installmentService = $installmentService;
    }


    public function index()
    {
        return view('home');
    }

    //Autocomplete
    public function search(string $category)
    {
        if(request()->ajax())
        {
            return match ($category) {
                'user' => $this->searchUser(),
                default => [],
            };
        }

        return abort(404);
    }

    private function searchUser(?string $category = null)
    {
        return User::select('id', DB::raw('TRIM(UPPER(name)) as title'))
                ->when($category, function ($query) use($category) {
                    return $query->where('province_code', $category);
                })
                ->where('name', 'like', '%' . request('q') . '%')
                ->limit(5)
                ->get();
    }

    //PRINT PDF
    private function receivablesRegistration(string $id)
    {
        $receivablesRegistration = $this->receivablesRegistrationService->findOrFail($id);
        if (!$receivablesRegistration)
        {
            abort(404);
        }

        return $receivablesRegistration;
    }

    public function printInvoice(string $id)
    {
        $receivablesRegistration = $this->receivablesRegistration($id);

        $pdf = Pdf::loadView('livewire.receivables-registration.print-invoice', [
                        'data' => $receivablesRegistration,
                    ])
                    ->setPaper([0, 0, 595.28, 841.89 / 3])
                    ->setWarnings(false);

        return $pdf->stream("invoice-".Str::slug($receivablesRegistration->consumer->name)."-".time().".pdf");
    }

    public function printAngsuranCoupon(string $id)
    {
        $receivablesRegistration = $this->receivablesRegistration($id);

        $angsuranList = $this->installmentService->installments($id);

        $pdf = Pdf::loadView('livewire.receivables-registration.print-angsuran-coupon', [
                        'data' => $receivablesRegistration,
                        'angsuranList' => $angsuranList,
                    ])
                    ->setPaper($this->a4)
                    ->setWarnings(false);

        return $pdf->stream("angsuran-coupon-".Str::slug($receivablesRegistration->consumer->name)."-".time().".pdf");
    }

    public function printAngsuranCard(string $id)
    {
        $receivablesRegistration = $this->receivablesRegistration($id);

        $angsuranList = $this->installmentService->installments($id);

        $pdf = Pdf::loadView('livewire.receivables-registration.print-angsuran-card', [
                        'data' => $receivablesRegistration,
                        'angsuranList' => $angsuranList,
                    ])
                    ->setPaper([0, 0, 595.28, 841.89 / 2])
                    ->setWarnings(false);

        return $pdf->stream("angsuran-card-".Str::slug($receivablesRegistration->consumer->name)."-".time().".pdf");
    }
}
