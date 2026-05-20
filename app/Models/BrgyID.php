<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrgyID extends Model
{
    protected $table = 'brgy';

    protected $primaryKey = 'brgy_id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'idnumber',
        'contact_number',
        'guidance',
        'guidance_contact',
        'dateexpired',
        'dateclaim',
        'dateexpired',
        'dateclaim',
        ];

    protected $casts = [
        'dateexpired' => 'datetime',
        'dateclaim' => 'datetime',
        'birthdate' => 'datetime',
    ];
}
