<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFeedbackRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'cfr_id',
        'site',
        'type',
        'customer',
        'customer_location',
        'customer_contact',
        'customer_phone',
        'customer_email',
        'description',
        'cfr_category',
        'originator',
        'date_originated',
        'root_cause',
        'action_to_be_taken',
        'assigned_to',
        'target_completion_date',
        'completed_by', 'date_completed',
        'feedback_to_customer',
        'feedback_by',
        'effectiveness_evaluated',
        'action_taken_effective',
        'what_action_was_taken',
        'action_taken_by',
        'date_of_feedback',
        'cpar_required',
        'if_yes_cpar',
        'attachment_field',
        'photo_field',
        'closed_by',
        'closure_date',
    ];
}
