<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'audit_id',
        'audit_type',
        'sub_type',
        'start_date',
        'dates',
        'audit_year',
        'status',
        'audit_completion_date',
        'num_of_issues',
        'comments',
        'audit_schedule',
        'audit_checklist',
        'audit_report',
        'abs_cpar_acceptance',
        'nonconformity_note_attachment',
    ];
}
