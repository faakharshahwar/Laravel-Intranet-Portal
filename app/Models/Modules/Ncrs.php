<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ncrs extends Model
{
    protected $fillable = [
        'ncr_id',
        'originating_site',
        'date_of_issue',
        'results_area',
        'responsible_site',
        'quantity',
        'process_description',
        'order_num',
        'nonconformance_type',
        'customer_if_applicable',
        'description_of_nonconformance',
        'originator',
        'date_originated',
        'ncr_category',
        'system_type',
        'disposition_decision',
        'disposition_if_other',
        'root_cause',
        'action_to_be_taken',
        'assigned_to',
        'target_date',
        'comments_if_any',
        'authorized_by',
        'authorization_date',
        'action_taken',
        'effectiveness_evaluated',
        'action_taken_effective',
        'what_action_was_taken',
        'action_taken_by',
        'completed_by',
        'date_completed',
        'cpar_required',
        'cpar_num',
        'closed_by',
        'closure_date',
        ];
    use HasFactory;
}
