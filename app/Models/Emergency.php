<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    use HasFactory;

    protected $fillable = [

        'client_id',
        'type',
        'address',
        'emergency_details',
        'admin_comments',
        'browser_lat',
        'browser_long',
        'emergency_closed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
