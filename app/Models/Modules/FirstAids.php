<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstAids extends Model
{
    use HasFactory;
    protected $fillable = [
        'site',
        'item_name',
        'description',
        'production_date',
        'expiry_date',
        'required_quantity',
        'available_quantity',
    ];
}
