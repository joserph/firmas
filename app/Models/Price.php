<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'validity',
        'amount',
        'type_price',
        'start_date',
        'final_date',
        'promo_name'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::where('validity', 'like', '%'.$search.'%')
                ->orWhere('amount', 'like', '%'.$search.'%')
                ->orWhere('type_price', 'like', '%'.$search.'%')
                ->orWhere('start_date', 'like', '%'.$search.'%')
                ->orWhere('final_date', 'like', '%'.$search.'%')
                ->orWhere('promo_name', 'like', '%'.$search.'%');
    }

    public static function getTypePrice()
    {
        return [
            'NORMAL'        => __('NORMAL'),
            'PREFERENCIAL'  => __('PREFERENCIAL'),
            'PROMO'         => __('PROMO'),
            'UANATACA'      => __('UANATACA'),
        ];
    }

    public static function getPenalty(){
        return [
            0.00        => __('0.00'),
            1.00        => __('1.00'),
            2.00        => __('2.00'),
            3.00        => __('3.00'),
            4.00        => __('4.00'),
            5.00        => __('5.00'),
        ];
    }

    public static function getPriceSignature($year, $partner)
    {
        // Search Promo
        $promo = Price::where('validity', $year)->where('type_price', 'PROMO')->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('final_date', '>=', date('Y-m-d'))->select('amount')->first();
        // Preferencial
        $partnerPreferencial = Partner::where('id', $partner)->where('preferential_price', '1')->first();
        $preferencial = null;
        if($partnerPreferencial)
        {
            $preferencial = Price::where('validity', $year)->where('type_price', 'PREFERENCIAL')->select('amount')->first();
        }
        
        if($promo)
        {
            $priceSignature = $promo;
        }elseif($preferencial){
            $priceSignature = $preferencial;
        }else{
            $priceSignature = Price::where('validity', $year)->where('type_price', 'NORMAL')->select('amount')->first();
        }
        return $priceSignature;
    }

    public static function getPriceUanataca($year)
    {
        // Search Uanataca for date
        $uanataca = Price::where('validity', $year)->where('type_price', 'UANATACA')->whereDate('start_date', '<=', date('Y-m-d'))->whereDate('final_date', '>=', date('Y-m-d'))->select('amount')->first();
        return $uanataca;
    }
}
