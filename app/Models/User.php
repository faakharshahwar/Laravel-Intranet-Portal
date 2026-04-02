<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'person_to_notify',
        'site',
        'current_job_title',
        'department',
        'work_phone',
        'personal_phone',
        'date_of_birth',
        'home_airport',
        'home_airport_text',
        'nationality',
        'residency',
        'work_permits',
        'current_visas',
        'valid_us_visa',
        'passport_number',
        'passport_issuing_country',
        'passport_expiry_date',
        'twic_card',
        'safety_training_list',
        'emergency_contact_name',
        'emergency_contact_phone',
        'restricted_countries',
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
        'dev_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation: Known Traveler Numbers
     */
    public function travelerNumbers()
    {
        return $this->hasMany(UserTravelerNumber::class);
    }

    /**
     * Relation: Flight Loyalty Numbers
     */
    public function loyaltyNumbers()
    {
        return $this->hasMany(UserLoyaltyNumber::class);
    }
}
