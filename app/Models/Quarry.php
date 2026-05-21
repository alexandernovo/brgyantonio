<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quarry extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quarry';
    protected $primaryKey = 'quarry_id';
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'truck_or_vessel_name',
        'vehicle_class',
        'quarry_license_no',
        'permit_holder',
        'engine_or_propulsion',
        'trip_or_voyage_no',
        'driver_or_operator',
        'carrying_burden',
        'tonnage_capacity',
        'crew_origin',
        'destination_place',
        'delivery_receipt_or_bl_no',
        'no_of_packages',
        'weight_kg',
        'consignee',
        'load_marks',
        'cubic_meter',
        'market_value',
        'delivery_address',
        'load_numbers',
        'material_type',
        'quarry_operator_or_shipper',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'no_of_packages' => 'integer',
        'weight_kg'      => 'decimal:2',
        'cubic_meter'    => 'decimal:2',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
    ];
}
