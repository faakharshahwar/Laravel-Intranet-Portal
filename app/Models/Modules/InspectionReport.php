<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'description',
        'report_type',
        'completion_date',
        'status',
        'next_due_date',
        'attachment_1',
        'attachment_2',
        'attachment_3',
        'remarks',
    ];
}
