<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'max_uses',
        'uses',
        'active',
        'currency',
        'max_amount',
        'description',
        'voucher_key'
    ];
}
