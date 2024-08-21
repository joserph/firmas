<?php

namespace App\Livewire;

use App\Models\Price;
use App\Models\Validity;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PriceComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $modal = false, $validities, $disabledStarDate = 'disabled', $disabledFinalDate = 'disabled', $myPrice = null;
    public $validity, $amount, $type_price, $start_date, $final_date, $promo_name, $id, $typePrices;
    public $search = '', $perPage = 10, $sortDirection = 'DESC', $sortColumn = 'id', $selected = [];

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

    #[On('notification-delete')]
    public function notificationDelete()
    {
        // dd('entro');
        if($this->selected === [])
        {
            $this->dispatch('no-data');
        }else{
            if(count($this->selected) > 1)
            {
                $this->dispatch('deleteSelectedConfirm', ['message' => 'Esta seguro de eliminar los precios?']);
            }else{
                $this->dispatch('deleteSelectedConfirm', ['message' => 'Esta seguro de eliminar el precio?']);
            }
        }
    }

    #[On('deleted-prices')]
    public function deletedPrices()
    {
        if(count($this->selected) > 1)
        {
            Price::destroy($this->selected);
            $this->dispatch('deleteSelected', ['message' => 'Se eliminaron los items con exito!']);
            $this->clearInput();
        }else{
            Price::destroy($this->selected);
            $this->dispatch('deleteSelected', ['message' => 'Se elimino el item con exito!']);
            $this->clearInput();
        }
    }

    public function mount()
    {
        $this->validities = Validity::getValidityAll();
        $this->typePrices = Price::getTypePrice();
    }
    public function render()
    {
        return view('livewire.price-component', [
            'prices' => Price::search($this->search)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage)
        ]);
    }

    public function openCreateModal(Price $price = null)
    {
        if($price)
        {
            $this->id = $price->id;
            $this->validity = $price->validity;
            $this->amount = $price->amount;
            $this->type_price = $price->type_price;
            $this->start_date = $price->start_date;
            $this->final_date = $price->final_date;
            $this->promo_name = $price->promo_name;
            $this->myPrice = $price->id;
            $this->disabledStarDate = (is_null($price->start_date)) ? 'disabled' : '';
            $this->disabledFinalDate = (is_null($price->final_date)) ? 'disabled' : '';
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
        $this->validity = '';
        $this->amount = '';
        $this->type_price = '';
        $this->start_date = null;
        $this->final_date = null;
        $this->promo_name = '';
        $this->selected = [];
    }

    public function updatedTypePrice($value)
    {
        if($value === 'NORMAL')
        {
            $this->disabledStarDate = 'disabled';
            $this->disabledFinalDate = 'disabled';
        }elseif($value === 'PREFERENCIAL'){
            $this->disabledStarDate = 'disabled';
            $this->disabledFinalDate = 'disabled';
        }elseif($value === 'PROMO'){
            $this->disabledStarDate = '';
            $this->disabledFinalDate = '';
        }elseif($value === 'UANATACA'){
            $this->disabledStarDate = '';
            $this->disabledFinalDate = '';
        }
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function savePrice()
    {
        if($this->id)
        {
            $this->validate([
                'validity'      => 'required',
                'amount'        => 'required|numeric',
                'type_price'    => 'required',
                'start_date'    => 'nullable|date',
                'final_date'    => 'nullable|date',
                'promo_name'    => 'nullable'
            ]);
            $price = Price::find($this->id);
            $price->validity = $this->validity;
            $price->amount = $this->amount;
            $price->type_price = $this->type_price;
            $price->start_date = $this->start_date;
            $price->final_date = $this->final_date;
            $price->promo_name = Str::upper($this->promo_name);
            $price->save();

            $this->closeCreateModal();
            $this->dispatch('success', ['message' => 'Precio actualizado con exito!']);
        }else{
            $this->validate([
                'validity'      => 'required',
                'amount'        => 'required|numeric',
                'type_price'    => 'required',
                'start_date'    => 'nullable|date',
                'final_date'    => 'nullable|date',
                'promo_name'    => 'nullable'
            ]);
            $price = new Price;
            $price->validity = $this->validity;
            $price->amount = $this->amount;
            $price->type_price = $this->type_price;
            $price->start_date = $this->start_date;
            $price->final_date = $this->final_date;
            $price->promo_name = Str::upper($this->promo_name);
            $price->save();

            $this->closeCreateModal();
            $this->dispatch('success', ['message' => 'Precio creado con exito!']);
        }
    }
    #[On('delete-price')]
    public function deletePrice($id)
    {
        $price = Price::find($id);
        $price->delete();
    }
}
