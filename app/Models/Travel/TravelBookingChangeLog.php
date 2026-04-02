<?php

namespace App\Models\Travel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class TravelBookingChangeLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_booking_id',
        'user_id',
        'status_at_time',
        'remarks',
        'changes',
        'ip',
        'user_agent',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
