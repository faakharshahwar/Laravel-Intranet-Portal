<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingHistory extends Model
{
    use HasFactory;

    protected $table = 'training_history';

    protected $fillable = [
        'trr_id',
        'employee_name',
        'assessment_date',
        'must_be_completed_by',
        'learning_session_title',
        'training_type',
        'instructor',
        'learning_time',
        'learning_session_completion_date',
        'link_to_learning_module',
        'comments',
        'attachment_1',
        'attachment_2',
        'attachment_3',
        'training_expiry_date',
    ];
}
