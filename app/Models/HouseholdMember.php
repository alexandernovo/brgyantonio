<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseholdMember extends Model
{
    protected $fillable = [
        'resident_id',
        'last_name',
        'first_name',
        'middle_name',
        'extension',
        'place_of_birth',
        'date_of_birth',
        'age',
        'sex',
        'civil_status',
        'citizenship',
        'occupation',
    ];
}
