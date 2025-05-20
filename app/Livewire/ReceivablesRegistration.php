<?php

namespace App\Livewire;

use App\DTOs\ReceivablesRegistrationAngsuranDTO;
use App\DTOs\ReceivablesRegistrationDTO;
use App\DTOs\ReceivablesRegistrationStatusDTO;
use App\Enums\CategoryType;
use App\Enums\ReceivablesRegistrationStatus;
use App\Http\Requests\ReceivablesRegistrationRequest;
use App\Models\ReceivablesRegistration as ModelsReceivablesRegistration;
use App\Services\CategoryService;
use App\Services\ConsumerService;
use App\Services\InstallmentService;
use App\Services\ProductService;
use App\Services\ReceivablesRegistrationService;
use App\Traits\Loggable;
use App\Traits\Modals\ShowModalConsumer;
use App\Traits\Modals\ShowModalProduct;
use App\Traits\NotificationTypes;
use App\Traits\WithNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class ReceivablesRegistration extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification, ShowModalConsumer, ShowModalProduct;

    public string $meta_title = '';
    public ?string $model_id = null;

    public int $tenor = 1;
    public string $bill_per_day = '';
    public string $total = '';
    public string $down_payment = '';
    public Carbon $date_at;
    public string $sales_id = '';
    public string $supervisor_id = '';
    public string $wasdit_id = '';
    public string $ar_id = '';
    public string $collector_id = '';

    //Form Status
    public ReceivablesRegistrationStatus $status;
    public Carbon $date_at_installment;
    public array $awd = [];

    //Form Angsuran
    public array $angsuran = [];

    public ModelsReceivablesRegistration $receivablesRegistration;

    public Collection $tenors;
    public Collection $statuses;
    public Collection $awdList;
    public Collection $angsuranList;

    private ProductService $productService;
    private CategoryService $categoryService;
    private ConsumerService $consumerService;
    private ReceivablesRegistrationService $receivablesRegistrationService;
    private InstallmentService $installmentService;

    private ReceivablesRegistrationRequest $receivablesRegistrationRequest;

    protected $listeners = [
        'selectedConsumer',
        'selectedProduct',
        'show',
        'edit',
        'delete'
    ];

    public function boot(
        ProductService $productService,
        CategoryService $categoryService,
        ConsumerService $consumerService,
        ReceivablesRegistrationService $receivablesRegistrationService,
        InstallmentService $installmentService,
    )
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->consumerService = $consumerService;
        $this->receivablesRegistrationService = $receivablesRegistrationService;
        $this->installmentService = $installmentService;

        $this->receivablesRegistrationRequest = new ReceivablesRegistrationRequest();
    }

    public function mount()
    {
        $this->authorize('receivables-registration-list');
        $this->initializeData();
    }

    private function initializeData()
    {
        $this->loadMetaData();

        $this->tenors = $this->categoryService->getCategories(CategoryType::TENOR->value);
        $this->date_at = Carbon::now();
        $this->awdList = collect([]);
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Registrasi Piutang';
    }

    public function render()
    {
        return view('livewire.receivables-registration.receivables-registration')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $this->authorize('receivables-registration-create');
        $validateData = $this->validateAndFormatData();

        if (numericOnly($this->total) < $this->item_price) {
            $this->notifyError('Total lebih kecil dari harga barang');

            return false;
        }

        try {

            $dto = ReceivablesRegistrationDTO::fromObject($validateData);
            $this->receivablesRegistrationService->storeReceivablesRegistration($dto);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e, 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->receivablesRegistrationRequest->rules($this->model_id));
    }

    public function resetFields(bool $closeModal = true):void
    {
        foreach ($this->receivablesRegistrationRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($closeModal) {
            $this->dispatch('close-modal-second');
            $this->dispatch('close-modal');
        }
    }

    public function showForm(): void
    {
        $this->model_id = null;

        $this->dispatch('open-modal-second');
    }

    public function updatedTenor($value): void
    {
        $this->grandTotal();
    }

    public function updatedBillPerDay($value): void
    {
        $this->grandTotal();
    }

    public function updatedDownPayment($value): void
    {
        $this->grandTotal();
    }

    private function grandTotal()
    {
        $tenor = $this->tenor ?: 1;
        $dp = numericOnly($this->down_payment ?: 0);
        $billPerDay = numericOnly($this->bill_per_day ?: 1);
        $total = $tenor * $billPerDay + $dp;
        $this->total = currency($total, true);
    }

    public function show(string $id)
    {
        $this->model_id = $id;
        $this->receivablesRegistration = $this->receivablesRegistrationService->findOrFail($id);
        $this->consumer = $this->receivablesRegistration->consumer;
        $this->product = $this->receivablesRegistration->product;

        if ($this->receivablesRegistration->status == ReceivablesRegistrationStatus::PENDING)
            $this->setFormStatus($this->receivablesRegistration);

        if ($this->receivablesRegistration->status == ReceivablesRegistrationStatus::IN_PROCESS)
            $this->setFormAngsuran();

        $this->dispatch('open-modal');
    }

    private function setFormStatus(ModelsReceivablesRegistration $receivablesRegistration): void
    {
        $this->statuses = collect(ReceivablesRegistrationStatus::formStatus());
        $this->status = ReceivablesRegistrationStatus::IN_PROCESS;
        $this->date_at_installment = Carbon::now();
        $this->tenor = $receivablesRegistration->tenor;

        $this->setAwdList();
    }

    public function updatedDateAtInstallment()
    {
        $this->setAwdList();
    }

    private function setAwdList(): void
    {
        $this->awd = [];
        $this->awdList = $this->receivablesRegistrationService->getPeriodInstallment($this->date_at_installment, $this->tenor, true);
    }

    public function storeStatus()
    {
        $this->authorize('receivables-registration-create');
        $validateData = $this->validateAndFormatDataStatus();

        try {
            $dto = ReceivablesRegistrationStatusDTO::fromObject($validateData);
            $this->receivablesRegistrationService->storeReceivablesRegistrationStatus( $dto, $this->receivablesRegistration);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e, 'store status');
        }
    }

    private function validateAndFormatDataStatus(): array
    {
        return $this->validate($this->receivablesRegistrationRequest->rulesStatus());
    }

    private function setFormAngsuran()
    {
        $this->angsuranList = $this->installmentService->installments($this->model_id);
    }

    public function storeAngsuran()
    {
        $this->authorize('receivables-registration-create');
        $validateData = $this->validateAndFormatDataAngsuran();

        try {
            $dto = ReceivablesRegistrationAngsuranDTO::fromObject($validateData);
            $this->installmentService->updateAngsuran($dto);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e, 'store angsuran');
        }
    }

    private function validateAndFormatDataAngsuran(): array
    {
        return $this->validate($this->receivablesRegistrationRequest->rulesAngsuran());
    }
}
