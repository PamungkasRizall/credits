<?php

namespace App\Livewire\Master;

use App\DTOs\ConsumerDTO;
use App\Enums\CategoryType;
use App\Enums\Gender;
use App\Http\Requests\ConsumerRequest;
use App\Services\CategoryService;
use App\Services\ConsumerService;
use App\Services\SubDistrictService;
use App\Traits\{Loggable, NotificationTypes, WithNotification};
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class Consumers extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public bool $modal = false;
    public ?string $model_id = null;

    //FORM
    public string $name = '';
    public int $nik;
    public Carbon $date_of_birth;
    public Gender $gender;
    public int $phone;
    public string $home_address = '';
    public string $business_type = '';
    public string $business_address = '';
    public string $business_status = '';
    public int $sub_district_code;
    public float $radius;

    public array $companion;

    public int $city_code;
    public int $district_code;

    public Collection $genders;
    public Collection $cities;
    public Collection $districts;
    public Collection $subDistricts;
    public Collection $relationships;

    //Service
    private ConsumerService $consumerService;
    private SubDistrictService $subDistrictService;
    private CategoryService $categoryService;

    //Request
    private ConsumerRequest $consumerRequest;

    protected $listeners = [
        'edit',
        'delete',
    ];

    public function boot(
        ConsumerService $consumerService,
        SubDistrictService $subDistrictService,
        CategoryService $categoryService,
    ): void
    {
        $this->consumerService = $consumerService;
        $this->subDistrictService = $subDistrictService;
        $this->categoryService = $categoryService;

        $this->consumerRequest = new ConsumerRequest();
    }

    public function render()
    {
        $render = $this->modal
            ? view('livewire.master.consumers.consumers-modal')
            : view('livewire.master.consumers.consumers')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);

        return $render;
    }

    public function mount()
    {
        $this->authorize('consumers-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();

        $this->date_of_birth = Carbon::now()->subYears(10);
        $this->genders = collect(Gender::values());
        $this->gender = Gender::MALE;
        $this->cities = $this->subDistrictService->getCities();
        $this->relationships = $this->categoryService->getCategories(CategoryType::REALIONSHIP->value);
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Konsumen';
    }

    public function store()
    {
        $this->authorize('consumers-create');

        $validateData = $this->validateAndFormatData();

        try {
            $dto = ConsumerDTO::fromObject($validateData);
            $this->consumerService->storeConsumer($dto);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e);
            $this->logError($e->getMessage(), 'store');
        }

    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->consumerRequest->rules($this->model_id));
    }

    private function handleSuccess(): void
    {
        $this->resetFields(false);
        $this->notifySuccess();
        $this->dispatch('refreshDatatable');
    }

    private function handleError(Exception $e): void
    {
        $this->notifyError($e->getMessage());
    }

    public function resetFields(bool $closeModal = true):void
    {
        foreach ($this->consumerRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($closeModal) {
            $this->dispatch('close-modal');
        }
    }

    public function updatedCityCode($value): void
    {
        $this->districts = $this->subDistrictService->getDistricts($value);
        $this->subDistricts = collect();
        $this->sub_district_code = 0;
    }

    public function updatedDistrictCode($value): void
    {
        $this->subDistricts = $this->subDistrictService->getSubDistricts($value);
        $this->sub_district_code = 0;
    }
}
