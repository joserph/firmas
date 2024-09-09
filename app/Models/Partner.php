<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'preferential_price',
        'user_id'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::where('name', 'like', '%'.$search.'%');
    }

    public static function typePricePreferencial($partner_id)
    {
        $type_price = Partner::where('id', $partner_id)->select('preferential_price')->first();
        if($type_price->preferential_price === 1)
        {
            $type_p = 'PREFERENCIAL';
        }else{
            $type_p = 'NORMAL';
        }
        return $type_p;
    }
}
