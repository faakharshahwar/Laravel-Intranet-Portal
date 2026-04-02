<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dcrs extends Model
{
    use HasFactory;

    protected $fillable = [
        'doc_id',
        'title',
        'rev',
        'dcr_num',
        'source_document',
        'new_source_document',
        'document_for_approval',
        'effective_date',
        'approver_1',
        'approver_2',
        'approved_by_1',
        'approved_by_2',
        'approval_review_comments',
        'date_approved',
        'training_assessed',
    ];
}
