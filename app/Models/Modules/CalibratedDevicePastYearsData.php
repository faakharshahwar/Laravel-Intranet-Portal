<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalibratedDevicePastYearsData extends Model
{
    use HasFactory;

    protected $fillable = [
        'calibrated_device_id',
        'past_year',
        'past_attachment_1',
        'past_attachment_2',
    ];
}
