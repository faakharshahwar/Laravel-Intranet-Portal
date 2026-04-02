<?php

namespace App\Models\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_date',
        'travel_type',
        'purpose_of_travel',
        'management_approval_status',
        'approver_name',
        'approved_date',
        'traveler',
        'destination',
        'client',
        'departure_date',
        'return_date',
        'mode_of_travel',
        'booking_reference_pnr',
        'passenger_last_name',
        'estimated_travel_cost',
        'actual_travel_cost',
        'visa_requirement',
        'travel_insurance_provider',
        'safety_notes',
        'risk_status',
        'additional_comments',
    ];
    public function travelerUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'traveler', 'id');
    }

    // app/Models/Travel/TravelBooking.php

    public function changeLogs()
    {
        return $this->hasMany(\App\Models\Travel\TravelBookingChangeLog::class, 'travel_booking_id')
            ->latest();
    }

}
