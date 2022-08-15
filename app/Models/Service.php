<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [

        'service_name',
        'tag_line',
        'description',
        'currency',
        'hourly_rate',
        'is_available',

    ];
}
