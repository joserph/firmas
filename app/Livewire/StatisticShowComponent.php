<?php

namespace App\Livewire;

use App\Models\DateMonth;
use App\Models\Partner;
use App\Models\PaymentStatus;
use App\Models\Price;
use App\Models\Signature;
use App\Models\Validity;
use Livewire\Attributes\Url;
use Livewire\Component;

class StatisticShowComponent extends Component
{
    public $years, $perYear, $months, $perMonth, $partner, $paymentStatus, $payment_status;
    #[Url]
    public $id, $month, $year;

    public function mount()
    {
        // dd($this->year);
        $this->years = DateMonth::getYear();
        $this->perYear = $this->year;
        $this->months = DateMonth::getMonth();
        $this->perMonth = $this->month;
        $this->partner = Partner::select('id', 'name')->find($this->id);
        $this->paymentStatus = 'PENDIENTE';
        $this->payment_status = PaymentStatus::getPaymentStatus();
        
    }
    public function render()
    {
        $totals = Signature::whereHas('consolidations', function($query){
            return $query->where('partner_id', $this->partner->id);
        })->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $counts = array();
        $earnings = array();
        $sum = 0;
        $validities = Validity::getValidityAll();
        $allSignatures = Signature::allSignaturesFor($this->perMonth, $this->perYear, $this->partner->id, $this->paymentStatus);
        foreach($validities as $key => $validity)
        {
            $counts[$key] = Signature::whereHas('consolidations', function($query)
            {
                return $query->where('partner_id', $this->partner->id);
            })->where('vigenciafirma', $validity)->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
            foreach($allSignatures as $totalsEarning)
            {
                // Select Partner with preferencial price
                $type_p = Partner::typePricePreferencial($this->partner->id);
                // Select price
                $price = Price::select('amount', 'validity')->where('type_price', $type_p)->where('validity', $totalsEarning->vigenciafirma)->first();
                if($price->validity === $validity)
                {
                    $sum += floatval($price->amount);
                    $earnings[$key] = $sum;
                }else{
                    $earnings[$key] = $sum;
                }
            }
            $sum = 0;
        }
        $debtsTotal = 0;
        foreach($allSignatures as $totalsEarning)
        {
            // Select Partner with preferencial price
            $type_p = Partner::typePricePreferencial($this->partner->id);
            // Select price
            $price = Price::select('amount')->where('type_price', $type_p)->where('validity', $totalsEarning->vigenciafirma)->first();
            $debtsTotal += floatval($price->amount);
        }
        // dd($allSignatures);
        return view('livewire.statistic-show-component', [
            'totals' => $totals, // Total Signatures for Partner
            'counts' => $counts, // Signatures for type
            'debtsTotal' => $debtsTotal, // Total value signature for partner
            'earnings' => $earnings,
            'allSignatures' => $allSignatures
        ]);
    }
}
