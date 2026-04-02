<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efr extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'type',
        'interested_party',
        'ip_location',
        'ip_contact',
        'ip_contact_telephone',
        'feedback',
        'originator',
        'date_originated',
        'action_taken',
        'completed_by',
        'feedback_to_ip',
        'feedback_to_ip_by',
        'date_of_feedback',
        'closed_by',
        'closure_date',
    ];
}
