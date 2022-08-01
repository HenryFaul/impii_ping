<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecurityDetail extends Model
{
    use HasFactory;

    protected $fillable = [

        'client_id',
        'agent_id',
        'security_type_id',
        'franchise_id',
        'client_briefing',
        'agent_feedback',
        'address',
        'city',
        'start_date',
        'planned_end_date',
        'actual_end_date',
        'deposit_reference',
        'final_reference',
        'currency',
        'payment_type',
        'hourly_rate',
        'voucher_id',
        'voucher_max',
        'deposit_received',
        'calc_total_charge',
        'calc_total_hours',
        'final_charge',
        'tip_charge',
        'final_received',
        'agent_accepted',
        'detail_started',
        'detail_ended',
        'detail_closed',
        'detail_status'

    ];

}
