<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualifiedAuditorsLists extends Model
{
    use HasFactory;

    protected $fillable = [
        'auditor_name',
        'site',
        'auditor_status',
        'qualification_basis_1',
        'qualification_basis_2',
        'qualification_basis_3',
        'comments',
        'file_attachment_1',
        'file_attachment_2',
        'web_link_1',
        'web_link_2',
    ];
}
