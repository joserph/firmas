<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Livewire\Attributes\On;

class PermissionComponent extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $id;
    public $guard_name;
    // public $permission;
    public $modal = false;
    public $myPermission = null;
    // public function mount()
    // {
    //     $this->permissions = Permission::get();
    // }

    public function render()
    {
        $permissions = Permission::orderBy('id', 'desc')->paginate(10);
        return view('livewire.permission-component', [
            'permissions' => $permissions
        ]);
    }
    
    public function savePermission()
    {
        if($this->id)
        {
            $this->validate([
                'name' => 'required|unique:permissions,name,' . $this->id,
            ]);
            $permission = Permission::find($this->id);
            $permission->name = $this->name;
            $permission->save();

            $this->closeCreateModal();
            $this->dispatch('success', ['message' => 'Permiso Editado con exito!']);
        }else{
            $this->validate([
                'name' => 'required|unique:permissions,name',
            ]);
            $permission = new Permission;
            $permission->name = $this->name;
            $permission->guard_name = 'web';
            $permission->save();

            $this->closeCreateModal();
            $this->dispatch('success', ['message' => 'Permiso creado con exito!']);
        }
    }

    public function clearInput()
    {
        $this->name = '';
    }

    public function openCreateModal(Permission $permission = null)
    {
        if($permission)
        {
            $this->id = $permission->id;
            $this->name = $permission->name;
            $this->myPermission = $permission->id;
        }else{
            $this->clearInput();
        }
        $this->modal = true;
    }
    public function closeCreateModal()
    {
        $this->clearInput();
        $this->modal = false;
    }

    #[On('delete-permission')] 
    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
    }

}
