<?php

namespace App\Livewire\Master;

use App\DTOs\UserDTO;
use App\Enums\CategoryType;
use App\Http\Requests\UserRequest;
use App\Models\{User};
use App\Traits\{Loggable, NotificationTypes};
use App\Services\{CategoryService, UserService, RoleService};
use App\Traits\WithNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Exception;
use Illuminate\Support\Collection;

class Users extends Component
{
    use AuthorizesRequests, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';

    public string $name = '';
    public string $username = '';
    public string $phone = '';
    public int $category_id;
    public ?string $password = '';
    public ?string $password_confirmation = '';
    public array $roles = [];

    public ?string $model_id = null;

    public Collection $roleList;
    public Collection $categories;

    private UserService $userService;
    private RoleService $roleService;
    private CategoryService $categoryService;

    private UserRequest $userRequest;

    protected $listeners = [
        'edit',
        'delete'
    ];

    public function boot(
        UserService $userService,
        RoleService $roleService,
        CategoryService $categoryService,
    )
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->categoryService = $categoryService;

        $this->userRequest = new UserRequest();
    }

    public function mount()
    {
        $this->authorize('users-list');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->loadMetaData();
        $this->roleList = $this->roleService->all();
        $this->categories = $this->categoryService->getCategories(CategoryType::USER_CATEGORY->value);
    }

    private function loadMetaData(): void
    {
        $this->meta_title = 'Users';
    }

    public function render()
    {
        return view('livewire.master.users')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $this->authorize('users-create');
        $validateData = $this->validateAndFormatData();

        try {

            $dto = UserDTO::fromObject($validateData);
            $this->userService->storeUser($dto);

            $this->handleSuccess();

        } catch(Exception $e) {
            $this->handleError($e);
            $this->logError($e->getMessage(), 'store');
        }
    }

    private function validateAndFormatData(): array
    {
        return $this->validate($this->userRequest->rules($this->model_id));
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
        foreach ($this->userRequest::DEFAULT_VALUES as $property => $value) {
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
        $this->authorize('users-edit');

        try {
            $user = $this->userService->findOrFail($id);

            $this->fillFormData($user);
            $this->openEditModal();
        } catch (Exception $e) {
            $this->handleEditError($e);
        }
    }

    private function fillFormData(User $user): void
    {
        $this->model_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->category_id = $user->category_id;
        $this->phone = $user->phone;
        $this->roles = $user->roles->pluck('id')->toArray();
    }

    private function openEditModal(): void
    {
        $this->dispatch('open-modal', [
            'title' => 'Edit User',
            'mode' => 'edit'
        ]);
    }

    private function handleEditError(Exception $e): void
    {
        $this->logError('User', 'edit', [
            'error' => $e->getMessage(),
            'model_id' => $this->model_id ?? null
        ]);

        $this->notifyError(__('Failed to load user data'));
    }

    public function delete(string $id): void
    {
        $this->authorize('users-delete');

        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        $this->authorize('users-delete');

        try{
            $this->userService->deleteUser($this->model_id);
            $this->handleSuccess();
        } catch (Exception $e) {
            $this->handleError($e);
            $this->logError('User', 'deletion', [
                'error'=> $e->getMessage(),
                'model_id' => $this->model_id
            ]);
        }
    }
}
