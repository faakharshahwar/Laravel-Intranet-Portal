<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permits extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'permit_type',
        'permit_id',
        'agency_type',
        'agency_name',
        'expiration_date',
        'monthly_requirements',
        'quarterly_requirements',
        'annual_requirements',
        'comments',
        'attachment',
        'copy_of_permit',
    ];
}
