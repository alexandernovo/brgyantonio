<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $table = 'certifications';
    protected $primaryKey = 'certification_id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'barangay',
        'municipality',
        'province',
        'sex',
        'date_of_birth',
        'place_of_birth',
        'nationality',
        'certification_type',
        'image_path',
        'date_issued',
        'name_of_tree',
        'or_number',
        'no_of_tree',
        'civil_status',
        'age',
        'purok',
        'familyincome',
        'namelivestock',
        'nolivestock',
        'ageclasses',
        'color',
        'sexlivestock',
        'livestockowner',
        'monthlysalary',
        'businesslocation',
        'businesstradename',
    ];
}
