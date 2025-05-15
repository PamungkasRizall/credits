<?php

namespace App\Livewire\Master;

use App\DTOs\CategoryDTO;
use App\Enums\CategoryType;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\{Loggable, NotificationTypes};
use App\Services\CategoryService;
use App\Traits\WithNotification;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class Categories extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';

    public string $name = '';
    public string $type = '';

    public ?string $model_id = null;

    public Collection $typeList;

    private CategoryService $categoryService;
    private CategoryRequest $categoryRequest;

    protected $listeners = [
        'edit',
        'delete'
    ];

    public function boot(CategoryService $categoryService): void
    {
        $this->categoryService = $categoryService;
        $this->categoryRequest = new CategoryRequest();
    }

    public function mount()
    {
        $this->authorize('categories');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();
        $this->typeList = $this->categoryService->getTypes();
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Kategori';
    }

    public function render()
    {
        return view('livewire.master.categories')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $validateData = $this->validateAndFormatData();

        try {

            $dto = CategoryDTO::fromObject($validateData);
            $this->categoryService->storeCategory($dto);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e);
            $this->logError($e->getMessage(), 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->categoryRequest->rules($this->model_id));
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
        foreach ($this->categoryRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($closeModal) {
            $this->dispatch('close-modal');
        }
    }

    public function edit(string$id): void
    {
        try {
            $category = $this->categoryService->findOrFail($id);

            $this->fillFormData($category);
            $this->openEditModal();
        } catch (Exception $e) {
            $this->handleEditError($e);
        }
    }

    private function fillFormData(Category $category): void
    {
        $this->model_id = $category->id;
        $this->name = $category->name;
        $this->type = $category->type;
    }

    private function openEditModal(): void
    {
        $this->dispatch('open-modal', [
            'title' => 'Edit Kategori',
            'mode' => 'edit'
        ]);
    }

    private function handleEditError(Exception $e): void
    {
        $this->logError('User', 'edit', [
            'error' => $e->getMessage(),
            'model_id' => $this->model_id ?? null
        ]);

        $this->notifyError(__('Failed to load category data'));
    }

    public function delete(string $id): void
    {
        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        try{
            $this->categoryService->deleteCategory($this->model_id);
            $this->handleSuccess();
        } catch (Exception $e) {
            $this->handleError($e);
            $this->logError('Category', 'deletion', [
                'error'=> $e->getMessage(),
                'model_id' => $this->model_id
            ]);
        }
    }
}
