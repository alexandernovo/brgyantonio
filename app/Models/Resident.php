<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';

    protected $primaryKey = 'resident_id';

    protected $fillable = [
        'region',
        'province',
        'city_municipality',
        'barangay',

        'philsys_card_no',
        'last_name',
        'suffix',
        'first_name',
        'middle_name',

        'birth_date',
        'birth_place',
        'sex',
        'civil_status',
        'religion',

        'residence_address',
        'household_address', // ✅ MISSING
        'no_household_members', // ✅ MISSING

        'citizenship',
        'profession_occupation',
        'contact_number',
        'email_address',

        'highest_educational_attainment',
        'educational_status',
        'resident_type',

        'prepared_by',   // ✅ MISSING
        'certified_by',  // ✅ MISSING
        'validated_by'   // ✅ MISSING
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
    ];
}
