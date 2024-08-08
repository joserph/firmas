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
        // 'bank',
        // 'account_number',
        'preferential_price',
        'user_id'
    ];

    // protected $casts = [
    //     'bank' => 'array',
    //     'account_number' => 'array',
    // ];
}
