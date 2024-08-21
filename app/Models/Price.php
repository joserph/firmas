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
}
