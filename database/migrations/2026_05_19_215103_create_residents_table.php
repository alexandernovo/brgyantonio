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
        Schema::create('residents', function (Blueprint $table) {
            $table->id("resident_id");

            // Header Location Info
            $table->string('region')->nullable();
            $table->string('province')->nullable();
            $table->string('city_municipality')->nullable();
            $table->string('barangay')->nullable();

            // Personal Information
            $table->string('philsys_card_no')->unique()->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix')->nullable(); // e.g., Jr, I, II, III
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();

            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('sex', 10)->nullable(); // Male, Female
            $table->string('civil_status')->nullable(); // Single, Married, etc.
            $table->string('religion')->nullable();

            $table->text('residence_address')->nullable();
            $table->text('household_address')->nullable();
            $table->string('citizenship')->default('Filipino');

            $table->string('profession_occupation')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email_address')->nullable();

            // Highest Educational Attainment
            // Storing as string to match the selected option (ELEMENTARY, HIGH SCHOOL, etc.)
            $table->string('highest_educational_attainment')->nullable();

            // Educational Status (Graduate / Undergraduate)
            $table->string('educational_status')->nullable();
            $table->string('resident_type')->nullable();
            $table->integer('no_household_members')->nullable();

            // RBI signature fields
            $table->string('prepared_by')->nullable();
            $table->string('certified_by')->nullable();
            $table->string('validated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};

// php artisan migrate:refresh --path=database/migrations/2026_05_19_215103_create_residents_table.php
// php artisan migrate --path=database/migrations/2026_05_19_215103_create_residents_table.php