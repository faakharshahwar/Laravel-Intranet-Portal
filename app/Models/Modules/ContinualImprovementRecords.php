<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContinualImprovementRecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'cir_id', 'site', 'cir_concise_description', 'improvement_opportunity', 'originator', 'date_originated',
        'cir_type', 'department', 'responsible_manager', 'responsible_mgr_approval_date',
        'action_to_be_taken', 'file_attachment_1', 'file_attachment_2', 'assigned_to', 'target_completion_date', 'action_that_was_taken',
        'action_completed_by', 'date_action_was_completed', 'closed_by', 'closure_date',
    ];
}
