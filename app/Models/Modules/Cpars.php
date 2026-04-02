<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpars extends Model
{
    protected $fillable = [
        'cpar_id',
        'site',
        'date_of_issue',
        'cpar_type',
        'reason',
        'reason_if_other',
        'description_of_issue',
        'originator',
        'date_originated',
        'results_area',
        'responsible_manager',
        'manager_acceptance_date',
        'root_cause',
        'action_to_be_taken',
        'assigned_to',
        'target_completion_date',
        'date_action_was_completed',
        'effectiveness_evaluated',
        'action_taken_effective',
        'what_action_was_taken',
        'action_taken_by',
        'documents_revised',
        'date_documents_revised',
        'closed_by',
        'closure_date',
        'attachment_1',
        'attachment_2',
    ];
    use HasFactory;
}
