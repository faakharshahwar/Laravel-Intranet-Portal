<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EcosItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'eco_id',
        'current_part_number',
        'drawing',
        'revision',
    ];
}
