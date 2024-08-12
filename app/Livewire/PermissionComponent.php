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
    public $name, $id, $guard_name, $modal = false, $myPermission = null, $search = '', $perPage = 10;
    public $sortDirection = 'DESC', $sortColumn = 'id';

    public function render()
    {
        return view('livewire.permission-component', [
            'permissions' => Permission::search($this->search)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }

    public function doSort($column)
    {
        if($this->sortColumn === $column)
        {
            $this->sortDirection = ($this->sortDirection == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortColumn = $column;
        $this->sortDirection = 'ASC';
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
            $this->dispatch('success', ['message' => 'Permiso actualizado con exito!']);
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

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

}
