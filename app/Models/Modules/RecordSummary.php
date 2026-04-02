<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_title',
        'doc_id',
        'site',
        'location',
        'type',
        'file_manual_title',
        'maintained_by',
        'minimum_retention',
        'record_status',
        'comments',
    ];
}
