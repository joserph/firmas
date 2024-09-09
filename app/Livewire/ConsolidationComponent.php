<?php

namespace App\Livewire;

use App\Models\Bank;
use App\Models\ConsolidatedWithBank;
use App\Models\Consolidation;
use App\Models\DateMonth;
use App\Models\Partner;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Price;
use App\Models\Signature;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class ConsolidationComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '', $sortColumn = 'signature_id', $sortDirection = 'DESC', $partners, $banks, $consolidated_banks, $payment_status;
    public $payment_methods, $penalties, $perYear, $perMonth, $years, $months, $perPage = 10;
    public function mount()
    {
        $this->partners = Partner::all();
        $this->banks = Bank::getMyBack();
        $this->consolidated_banks = ConsolidatedWithBank::getConsolidatedWithBank();
        $this->payment_status = PaymentStatus::getPaymentStatus();
        $this->payment_methods = PaymentMethod::getPaymentMethod();
        $this->penalties = Price::getPenalty();
        $this->perMonth = date('n');
        $this->perYear = date('Y');
        $this->years = DateMonth::getYear();
        $this->months = DateMonth::getMonth();
        // dd($this->perMonth);
    }

    
    public function render()
    {
        $algo = Consolidation::whereMonth('creacion_signature', $this->perMonth)
            ->whereYear('creacion_signature', $this->perYear)
            ->join('signatures', 'signatures.id', '=', 'consolidations.signature_id')
            ->select('consolidations.*')
            ->orderBy('creacion_signature', 'DESC')
            ->paginate($this->perPage);
        // dd($algo);
        return view('livewire.consolidation-component', [
            'consolidations' => Consolidation::whereMonth('creacion_signature', $this->perMonth)
                ->whereYear('creacion_signature', $this->perYear)
                // ->join('signatures', 'signatures.id', '=', 'consolidations.signature_id')
                // ->select('consolidations.*')
                ->orderBy('creacion_signature', 'DESC')
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

    public function changePartner($consolidation_id, $partner_id)
    {
        // dd($consolidation_id);
        $consolidation = Consolidation::find($consolidation_id);
        $consolidation->update([
            'partner_id' => $partner_id
        ]);
        $this->dispatch('success', ['message' => 'Partner actualizado con exito!']);
    }

    public function changeInputCheckbox($consolidation_id, $value, $name)
    {
        // dd($value);
        if($value === '0' || $value === 0)
        {
            $check = 1;
        }else{
            $check = 0;
        }
        $consolidation = Consolidation::find($consolidation_id);
        $consolidation->update([
            $name => $check
        ]);
        $termino = Str::of($name)->headline();
        $this->dispatch('success', ['message' => $termino . ' actualizada con exito!']);
    }

    public function changeInput($consolidation_id, $value, $name)
    {
        $consolidation = Consolidation::find($consolidation_id);
        $consolidation->update([
            $name => $value
        ]);
        $termino = Str::of($name)->headline();
        $this->dispatch('success', ['message' => $termino . ' actualizada con exito!']);
    }

    public function changeInputSelect($consolidation_id, $value, $name)
    {
        $consolidation = Consolidation::find($consolidation_id);
        $consolidation->update([
            $name => $value
        ]);
        $termino = Str::of($name)->headline();
        $this->dispatch('success', ['message' => $termino . ' actualizada con exito!']);
    }
}
