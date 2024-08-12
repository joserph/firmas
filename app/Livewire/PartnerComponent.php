<?php

namespace App\Livewire;

use App\Models\Partner;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PartnerComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $modal = false, $myPartner = null, $search = '', $perPage = 10;
    public $name, $preferential_price, $user_id, $users, $id, $sortDirection = 'DESC', $sortColumn = 'id';

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.partner-component', [
            'partners' => Partner::search($this->search)
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

    public function openCreateModal(Partner $partner = null)
    {
        if($partner)
        {
            $this->id = $partner->id;
            $this->name = $partner->name;
            $this->preferential_price = $partner->preferential_price;
            $this->user_id = $partner->user_id;
            $this->myPartner = $partner->id;
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

    public function clearInput()
    {
        $this->name = '';
        $this->preferential_price = '';
        $this->user_id = '';
    }

    public function savePartner()
    {
        if($this->id)
        {
            $this->validate([
                'name' => 'required|unique:partners,name,' . $this->id,
                'preferential_price' => 'nullable|boolean',
                'user_id' => 'nullable|unique:partners,user_id,' . $this->id,
            ]);
            $partner = Partner::find($this->id);
            $partner->name = Str::upper($this->name);
            $partner->preferential_price = ($this->preferential_price) ? true : false;
            $partner->user_id = ($this->user_id) ? $this->user_id : null;
            $partner->save();

            $this->closeCreateModal();
            $this->dispatch('success', ['message' => 'Partner actualizado con exito!']);
        }else{
            $this->validate([
                'name' => 'required|unique:partners,name',
                'preferential_price' => 'nullable|boolean',
                'user_id' => 'nullable|unique:partners,user_id'
            ]);
            $partner = new Partner;
            $partner->name = Str::upper($this->name);
            $partner->preferential_price = ($this->preferential_price) ? true : false;
            $partner->user_id = ($this->user_id) ? $this->user_id : null;
            $partner->save();

            $this->closeCreateModal();
            $this->dispatch('success', ['message' => 'Partner creado con exito!']);
        }
    }

    #[On('delete-partner')] 
    public function deletePartner($id)
    {
        $partner = Partner::find($id);
        $partner->delete();
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
