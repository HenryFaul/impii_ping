<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tag_line',
        'accreditations',
        'about_summary',
        'is_available',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
