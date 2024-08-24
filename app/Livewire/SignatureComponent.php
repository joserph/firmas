<?php

namespace App\Livewire;

use App\Models\Signature;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class SignatureComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sortColumn = 'creacion', $sortDirection = 'DESC', $perPage = 10, $search = '', $stateSignatures;

    public function mount()
    {
        $this->stateSignatures = Signature::getStateSignature();
    }
    public function render()
    {
        return view('livewire.signature-component', [
            'signatures' => Signature::orderBy($this->sortColumn, $this->sortDirection)
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

    public function changeInputSelect($signature_id, $value, $name)
    {
        $consolidation = Signature::find($signature_id);
        $consolidation->update([
            $name => $value
        ]);
        $termino = Str::of($name)->headline();
        $this->dispatch('success', ['message' => $termino . ' actualizada con exito!']);
    }
}
