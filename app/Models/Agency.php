<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_name',
        'about_summary',
        'disclosures',
        'is_available',

    ];

    public function agentdetail()
    {
        return $this->hasMany(AgentDetail::class);
    }
}
