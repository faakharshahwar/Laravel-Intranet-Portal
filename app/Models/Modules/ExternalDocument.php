<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'doc_id',
        'document_type',
        'organization',
        'title',
        'effective_date',
        'verification_date',
        'verification_method',
        'verified_by',
        'next_verification_due_date',
        'primary_location_held',
        'attachment',
        'web_linked_file',
        'comments',
    ];
}
