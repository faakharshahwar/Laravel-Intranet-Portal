<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mocr extends Model
{
    use HasFactory;

    protected $fillable = [
        'change_requested_by',
        'date_requested',
        'mocr_id',
        'proposed_qms_change',
        'purpose_of_change',
        'potential_consequence_of_change',
        'impact_on_integrity_of_qms',
        'availability_of_resources',
        'allocation_or_reallocation',
        'additional_considerations',
        'change_authorized_by',
        'date_authorized',
    ];
}
