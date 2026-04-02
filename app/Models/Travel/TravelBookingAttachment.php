<?php

namespace App\Models\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelBookingAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_booking_id',
        'attachment_type',
        'attachment_1',
        'attachment_2',
    ];
}
