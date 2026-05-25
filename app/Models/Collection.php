<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $table = 'collection';

    protected $primaryKey = 'collection_id';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'or_number',
        'payment_status',
        'collection_type',
        'payment_amount',
        'payment_date',
    ];

    protected $casts = [
        'payment_date' => 'datetime',
    ];
}
