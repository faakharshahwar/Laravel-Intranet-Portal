<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rars extends Model
{
    protected $fillable = [
        'rar_id',
        'site',
        'date_identified',
        'department',
        'risk_type',
        'risk_title',
        'risk_description',
        'risk_source',
        'risk_category',
        'risk_probability',
        'risk_impact',
        'mitigation',
        'risk_priority',
        'management_system',
        'responsible_person',
        'next_risk_review_date',
        'effectiveness_evaluated',
        'action_taken_effective',
        'what_action_was_taken',
        'action_taken_by',
        'cpar_num',
        'status',
        'comments',
        'closed_date',
    ];
    use HasFactory;
}
