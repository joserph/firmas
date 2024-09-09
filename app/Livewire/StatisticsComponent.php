<?php

namespace App\Livewire;

use App\Models\DateMonth;
use App\Models\Partner;
use App\Models\Price;
use App\Models\Signature;
use App\Models\Validity;
use Livewire\Component;

class StatisticsComponent extends Component
{
    // public $anio = date('Y');
    public $years, $months, $perYear, $perMonth, $signatureEarnings = array();

    public function mount()
    {
        $this->years = DateMonth::getYear();
        $this->months = DateMonth::getMonth();
        $this->perMonth = date('n');
        $this->perYear = date('Y');
        // $this->perMonth = 5;
        // $this->perYear = 2023;
    }

    public function render()
    {
        $totals = Signature::with('consolidations')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $totalsEarnings = Signature::withSum('consolidations', 'ganancia')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $partnersDebts = Signature::whereMonth('creacion', $this->perMonth)
            ->whereYear('creacion', $this->perYear)
            ->join('consolidations', 'consolidations.signature_id', '=', 'signatures.id')
            ->select('consolidations.partner_id', 'consolidations.monto_pagado', 'signatures.vigenciafirma', 'consolidations.estado_pago')
            ->get();
        $partnerUniques = array_unique($partnersDebts->toArray(), SORT_REGULAR);
        $partners = Partner::select('id', 'name')->orderBy('name', 'ASC')->get();
        // Counts and Earnings
        $counts = array();
        $earnings = array();
        $validities = Validity::getValidityAll();
        foreach($validities as $key => $validity)
        {
            $counts[$key] = Signature::with('consolidations')->where('vigenciafirma', $validity)->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
            $earnings[$key] = Signature::withSum('consolidations', 'ganancia')->where('vigenciafirma', $validity)->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        }
        // Ejemplo para deudas
        $debts = array();
        $sum = 0;
        foreach($partnerUniques as $partneru)
        {
            foreach($partnersDebts as $key => $partnersDebt)
            {
                if($partnersDebt->partner_id === $partneru['partner_id'])
                {
                    // Select Partner with preferencial price
                    $type_price = Partner::where('id', $partneru['partner_id'])->select('preferential_price')->first();
                    if($type_price)
                    {
                        if($type_price->preferential_price === 1)
                        {
                            $type_p = 'PREFERENCIAL';
                        }else{
                            $type_p = 'NORMAL';
                        }
                    }else{
                        $type_p = 'NORMAL';
                    }
                    // Select price
                    $price = Price::select('amount')->where('type_price', $type_p)->where('validity', $partnersDebt->vigenciafirma)->first();
                    if($partnersDebt->estado_pago === 'PENDIENTE')
                    {
                        $sum += floatval($price->amount);
                        $debts[$partneru['partner_id']] = $sum;
                    }else{
                        $debts[$partneru['partner_id']] = $sum;
                    }
                }
            }
            $sum = 0;
        }
        foreach($earnings as $key => $item)
        {
            $this->signatureEarnings[$key] = floatval(number_format($item->sum('consolidations_sum_ganancia'), 2, '.', ''));
        }
        // dd($signatureEarnings);
        $this->dispatch('data', ['message' => $this->signatureEarnings]);
        return view('livewire.statistics-component', [
            'totals' => $totals,
            'totalsEarnings' => $totalsEarnings,
            'partners' => $partners,
            'debts' => $debts,
            'counts' => $counts,
            'earnings' => $earnings,
            'signatureEarnings' => $this->signatureEarnings
        ]);
    }

}
