<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hse extends Model
{
    use HasFactory;
    protected $fillable = [
        'for_month_starting',
        'site',
        'num_of_first_aids',
        'num_of_near_misses',
        'num_of_safety_violations',
        'num_of_medical_cases',
        'num_of_restricted_cases',
        'num_of_lost_time_cases',
        'num_of_recordable_cases',
        'num_of_environmental_issues',
        'comments',
    ];
}
