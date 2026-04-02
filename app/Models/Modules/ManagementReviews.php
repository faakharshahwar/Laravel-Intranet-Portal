<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagementReviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_of_management_review',
        'site',
        'status',
        'agenda',
        'minutes_attachment',
        'attachment_1',
        'attachment_2',
        'attachment_3',
        'comments',
    ];
}
