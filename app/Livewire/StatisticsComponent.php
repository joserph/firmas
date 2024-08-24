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
    public $years, $months, $perYear, $perMonth;

    public function mount()
    {
        $this->years = DateMonth::getYear();
        $this->months = DateMonth::getMonth();
        $this->perMonth = date('n');
        $this->perYear = date('Y');
        
        // dd($this->partnersDebts);
    }

    public function render()
    {
        $totals = Signature::with('consolidations')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $sevenDays = Signature::with('consolidations')->where('vigenciafirma', '7 días')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $thirtyDays = Signature::with('consolidations')->where('vigenciafirma', '30 días')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $oneYears = Signature::with('consolidations')->where('vigenciafirma', '1 año')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $twoYears = Signature::with('consolidations')->where('vigenciafirma', '2 años')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $threeYears = Signature::with('consolidations')->where('vigenciafirma', '3 años')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $fourYears = Signature::with('consolidations')->where('vigenciafirma', '4 años')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        $fiveYears = Signature::with('consolidations')->where('vigenciafirma', '5 años')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->count();
        // $signaturesTotals = Signature::with('consolidations')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $totalsEarnings = Signature::withSum('consolidations', 'ganancia')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $sevenDaysEarnings = Signature::withSum('consolidations', 'ganancia')->where('vigenciafirma', '7 días')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $thirtyDaysEarnings = Signature::withSum('consolidations', 'ganancia')->where('vigenciafirma', '30 días')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $oneYearsEarnings = Signature::withSum('consolidations', 'ganancia')->where('vigenciafirma', '1 año')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $twoYearsEarnings = Signature::withSum('consolidations', 'ganancia')->where('vigenciafirma', '2 años')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $threeYearsEarnings = Signature::withSum('consolidations', 'ganancia')->where('vigenciafirma', '3 años')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $fourYearsEarnings = Signature::withSum('consolidations', 'ganancia')->where('vigenciafirma', '4 años')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        $fiveYearsEarnings = Signature::withSum('consolidations', 'ganancia')->where('vigenciafirma', '5 años')->whereMonth('creacion', $this->perMonth)->whereYear('creacion', $this->perYear)->get();
        // $signaturesTotals->loadSum('consolidations', 'ganancia');
        // dd($signaturesTotals->sum('consolidations_sum_ganancia'));
        // dd($signaturesTotals);
        $partnersDebts = Signature::whereMonth('creacion', $this->perMonth)
            ->whereYear('creacion', $this->perYear)
            ->join('consolidations', 'consolidations.signature_id', '=', 'signatures.id')
            ->select('consolidations.partner_id')
            ->get();
        $partnerUniques = array_unique($partnersDebts->toArray(), SORT_REGULAR);
        $partnersDebts = Signature::whereMonth('creacion', $this->perMonth)
            ->whereYear('creacion', $this->perYear)
            ->join('consolidations', 'consolidations.signature_id', '=', 'signatures.id')
            ->select('consolidations.partner_id', 'consolidations.monto_pagado', 'signatures.vigenciafirma')
            ->get();
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
        // dd($earnings);
        foreach($partnerUniques as $partneru)
        {
            foreach($partnersDebts as $key => $partnersDebt)
            {
                if($partnersDebt->partner_id === $partneru['partner_id'])
                {
                    if($partnersDebt->monto_pagado < 1)
                    {
                        // Select Partner with preferencial price
                        $type_price = Partner::where('id', $partneru['partner_id'])->select('preferential_price')->first();
                        if($type_price->preferential_price === 1)
                        {
                            $type_p = 'PREFERENCIAL';
                        }else{
                            $type_p = 'NORMAL';
                        }
                        // Select price
                        $price = Price::select('amount')->where('type_price', $type_p)->where('validity', $partnersDebt->vigenciafirma)->first();
                        $sum += floatval($price->amount);
                        $debts[$partneru['partner_id']] = $sum;
                    }else{
                        $debts[$partneru['partner_id']] = $sum;
                    }
                }
            }
            $sum = 0;
        }
        // dd($debts);
        return view('livewire.statistics-component', [
            'totals' => $totals,
            // 'sevenDays' => $sevenDays,
            // 'thirtyDays' => $thirtyDays,
            // 'oneYears' => $oneYears,
            // 'twoYears' => $twoYears,
            // 'threeYears' => $threeYears,
            // 'fourYears' => $fourYears,
            // 'fiveYears' => $fiveYears,
            'totalsEarnings' => $totalsEarnings,
            // 'sevenDaysEarnings' => $sevenDaysEarnings,
            // 'thirtyDaysEarnings' => $thirtyDaysEarnings,
            // 'oneYearsEarnings' => $oneYearsEarnings,
            // 'twoYearsEarnings' => $twoYearsEarnings,
            // 'threeYearsEarnings' => $threeYearsEarnings,
            // 'fourYearsEarnings' => $fourYearsEarnings,
            // 'fiveYearsEarnings' => $fiveYearsEarnings,
            // 'partnersDebts' => $partnersDebts,
            // 'partnerUniques' => $partnerUniques,
            'partners' => $partners,
            'debts' => $debts,
            'counts' => $counts,
            'earnings' => $earnings
        ]);
    }
}
