<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'site',
        'management_system',
        'location',
        'sub_location',
        'document_type',
        'title',
        'doc_id',
        'revision',
        'document_attachment',
        'internal_folder',
        'external_folder',
        'distributor_folder',
        'website_product_documents',
        'website_technical_documents',
        'document_review_date',
        'document_next_review_date',
        'results_area_1',
        'results_area_2',
        'results_area_3',
        'results_area_4',
        'results_area_5',
        'results_area_6',
        'results_area_7',
        'results_area_8',
        'results_area_9',
        'results_area_10',
        'results_area_11',
        'results_area_12',
        'master_document_attachment',
        'training_completion_days_allowed',
        'learning_time',
        'training_note_for_training_history_comments',
    ];
}
