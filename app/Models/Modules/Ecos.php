<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ecos extends Model
{
    use HasFactory;

    protected $fillable = [
        'eco_id',
        'site',
        'originator',
        'date_originated',
        'attachment_1',
        'attachment_2',
        'attachment_3',
        'attachment_4',
        'attachment_5',
        'details_for_request',
        'message_to_initiator',
        'importance',
        'eco_part_type',
        'reviewed_by',
        'date_reviewed',
        'submitted_by',
    ];
}
