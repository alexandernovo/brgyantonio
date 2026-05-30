<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KagawadRecord extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kagawad_record';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'record_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'last_name',
        'first_name',
        'middle_name',
        'respondent_last_name',
        'respondent_first_name',
        'respondent_middle_name',
        'nature_case',
        'date_of_complaints',
        'date_of_resolve',
        'status',
        'record_type',
        'date_of_borrowed',
        'date_of_return',
        'quantity',
        'borrowed_equipment',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_complaints' => 'date',
        'date_of_resolve' => 'date',
    ];
}
