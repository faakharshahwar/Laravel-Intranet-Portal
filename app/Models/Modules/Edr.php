<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edr extends Model
{
    use HasFactory;

    protected $fillable = [
        'edr_id',
        'date_and_time_drill',
        'site',
        'type_of_emergency_simulated',
        'person_conducting_the_drill',
        'notification_used',
        'staff_on_duty',
        'attachment_staff_participating',
        'number_evacuated',
        'weather_conditions',
        'time_required',
        'problems_encountered',
        'cpars',
        'comments',
        'photo_1_description',
        'photo_1',
        'photo_2_description',
        'photo_2',
    ];
}
