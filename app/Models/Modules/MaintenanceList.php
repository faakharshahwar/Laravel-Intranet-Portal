<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceList extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'site',
        'serial_num',
        'equipment_description',
        'manufacturer',
        'model',
        'location',
        'frequency',
        'last_maintenance_performed',
        'next_maintenance_performed',
        'maintenance_by',
        'comments',
        'equipment_status',
        'action_required',
        'attachment',
    ];
}
