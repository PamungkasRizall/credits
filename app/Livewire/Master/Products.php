<?php

namespace App\Livewire\Master;

use App\DTOs\ProductDTO;
use App\Enums\CategoryType;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Traits\{Loggable, NotificationTypes};
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Traits\WithNotification;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class Products extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';

    public string $name = '';
    public string $type = '';
    public string $price = '0';
    public ?string $notes = '';
    public int $merk_id;
    public int $unit_id;

    public ?string $model_id = null;

    public Collection $merkList;
    public Collection $unitList;

    private ProductService $productService;
    private CategoryService $categoryService;
    private ProductRequest $productRequest;

    protected $listeners = [
        'edit',
        'delete'
    ];

    public function boot(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->productRequest = new ProductRequest();
    }

    public function mount()
    {
        $this->authorize('products-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();
        $this->merkList = $this->categoryService->getCategories(CategoryType::MERK->value);
        $this->unitList = $this->categoryService->getCategories(CategoryType::UNIT->value);
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Produk';
    }

    public function render()
    {
        return view('livewire.master.products.products')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $this->authorize('products-create');
        $validateData = $this->validateAndFormatData();

        try {

            $dto = ProductDTO::fromObject($validateData);
            $this->productService->storeProduct($dto);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e);
            $this->logError($e->getMessage(), 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->productRequest->rules($this->model_id));
    }

    private function handleSuccess(): void
    {
        $this->resetFields();
        $this->notifySuccess();
        $this->dispatch('refreshDatatable');
    }

    private function handleError(Exception $e): void
    {
        $this->notifyError($e->getMessage());
    }

    public function resetFields(bool $closeModal = true):void
    {
        foreach ($this->productRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($closeModal) {
            $this->dispatch('close-modal');
        }
    }

    public function edit(string $id): void
    {
        $this->authorize('products-edit');

        try {
            $product = $this->productService->findOrFail($id);

            $this->fillFormData($product);
            $this->openEditModal();
        } catch (Exception $e) {
            $this->handleEditError($e);
        }
    }

    private function fillFormData(Product $product): void
    {
        $this->model_id = $product->id;
        $this->name = $product->name;
        $this->notes = $product->notes;
        $this->merk_id = $product->merk_id;
        $this->type = $product->type;
        $this->unit_id = $product->unit_id;
        $this->price = $product->price;
    }

    private function openEditModal(): void
    {
        $this->dispatch('open-modal', [
            'title' => 'Edit ' . $this->meta_title,
            'mode' => 'edit'
        ]);
    }

    private function handleEditError(Exception $e): void
    {
        $this->logError($this->meta_title, 'edit', [
            'error' => $e->getMessage(),
            'model_id' => $this->model_id ?? null
        ]);

        $this->notifyError(__('Failed to load '. $this->meta_title .' data'));
    }

    public function delete(string $id): void
    {
        $this->authorize('products-delete');

        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        $this->authorize('products-delete');

        try{
            $this->productService->deleteProduct($this->model_id);
            $this->handleSuccess();
        } catch (Exception $e) {
            $this->handleError($e);
            $this->logError($this->meta_title, 'deletion', [
                'error'=> $e->getMessage(),
                'model_id' => $this->model_id
            ]);
        }
    }
}
