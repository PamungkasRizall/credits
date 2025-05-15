<?php

namespace App\Livewire\Master;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Roles extends Component
{
    use AuthorizesRequests;

    public $meta_title = 'Roles';
    protected $listeners = [
        'edit',
        'delete'
    ];

    public $name;
    public $permissions = [];

    public $permissionList = [];
    public $model_id;

    public function mount()
    {
        $this->permissionList = Permission::all()->pluck('name', 'id');
    }

    public function render()
    {
        $this->authorize('roles-list');

        return view('livewire.master.roles')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function rules()
    {
        return [
            'name'       => 'required|min:3|unique:roles,name,'.$this->model_id,
            'permissions' => 'required|array'
        ];
    }

    public function store()
    {
        $this->authorize('roles-create');
        $requestAll = $this->validate();

        try {
            DB::beginTransaction();

            $role = Role::updateOrCreate(['id' => $this->model_id], $requestAll);
            $role->permissions()->sync($requestAll['permissions']);

            $this->resetFields();

            $this->dispatch('notify', type: 'success',  message: __('Successfully'));
            $this->dispatch('refreshDatatable');

            DB::commit();

        } catch(Exception $e) {
            DB::rollBack();

            $this->dispatch('notify', type: 'error',  message: $e->getMessage());
        }
    }

    public function resetFields()
    {
        $this->name = '';
        $this->permissions = [];
        $this->model_id = '';

        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $this->authorize('roles-edit');

        $role = Role::with('permissions')->findOrFail($id);

        $this->model_id = $role->id;
        $this->name = $role->name;
        $this->permissions = $role->permissions->pluck('id');

        $this->dispatch('open-modal');
    }

    public function delete($id)
    {
        $this->authorize('roles-delete');

        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        $this->authorize('roles-delete');

        try{
            Role::findOrFail($this->model_id)->delete();

            $this->resetFields();

            $this->dispatch('notify', type: 'success',  message: __('Successfully'));
            $this->dispatch('refreshDatatable');

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();

            $this->dispatch('notify', type: 'error',  message: $e->getMessage());
        }
    }
}
