<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snrs extends Model
{
    protected $fillable = [
        'snr_id',
        'site',
        'origination_date',
        'supplier',
        'supplier_representative',
        'our_po',
        'supplier_order',
        'product_name',
        'quantity',
        'product_description',
        'supplier_rma',
        'requisition',
        'sales_order',
        'customer',
        'other',
        'description_of_nonconformance',
        'originator',
        'root_cause',
        'action_to_be_taken',
        'assigned_to',
        'effectiveness_evaluated',
        'action_taken_effective',
        'what_action_was_taken',
        'action_taken_by',
        'target_completion_date',
        'action_that_was_taken',
        'completed_by',
        'disposition_decision',
        'date_completed',
        'cpar_required',
        'cpar_num',
        'closed_by',
        'closure_date',
        'file_attachment_1',
        'file_attachment_2',
        'file_attachment_3',
    ];
    use HasFactory;
}
