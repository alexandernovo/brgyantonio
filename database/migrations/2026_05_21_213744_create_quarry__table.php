<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quarry', function (Blueprint $table) {
            $table->id("quarry_id");

            // --- Hauler & Permit Information ---
            $table->string('truck_or_vessel_name')->nullable();    // laden on board the...
            $table->string('vehicle_class')->nullable();          // class coasting vessel / truck type
            $table->string('quarry_license_no')->nullable();      // License No.
            $table->string('permit_holder')->nullable();          // Licensed [_____]
            $table->string('engine_or_propulsion')->nullable();   // propelled by
            $table->string('trip_or_voyage_no')->nullable();      // voyage no.
            $table->string('driver_or_operator')->nullable();     // Whereof is [_____]
            $table->string('carrying_burden')->nullable();        // burden
            $table->string('tonnage_capacity')->nullable();       // Tons
            $table->string('crew_origin')->nullable();            // crew board from
            $table->string('destination_place')->nullable();      // for [_____] (here give port of call)

            // --- Material & Load Details ---
            $table->string('delivery_receipt_or_bl_no')->nullable(); // BL No.
            $table->integer('no_of_packages')->nullable();           // No. of Packages
            $table->decimal('weight_kg', 12, 2)->nullable();         // Weighted in Kilogram
            $table->string('consignee')->nullable();                 // Consignee (Buyer/Receiver)

            $table->string('load_marks')->nullable();                // Marks
            $table->decimal('cubic_meter', 10, 2)->nullable();       // Cubic Meter (Volume of Sand/Gravel)
            $table->string('market_value')->nullable();      // Value
            $table->text('delivery_address')->nullable();            // Address

            $table->string('load_numbers')->nullable();              // Numbers
            $table->string('material_type')->nullable();             // Kind of Parcel (e.g., Sand, Boulders)
            $table->string('quarry_operator_or_shipper')->nullable(); // Shipper

            // --- Timestamps ---
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quarry');
    }
};

// php artisan migrate:refresh --path=database/migrations/2026_05_21_213744_create_quarry__table.php
// php artisan migrate --path=database/migrations/2026_05_21_213744_create_quarry__table.php