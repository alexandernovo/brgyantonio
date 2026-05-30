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
        Schema::create('kagawad_record', function (Blueprint $table) {
            $table->id("record_id");
            $table->string('code')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('respondent_last_name')->nullable();
            $table->string('respondent_first_name')->nullable();
            $table->string('respondent_middle_name')->nullable();
            $table->string('nature_case')->nullable();
            $table->string('borrowed_equipment')->nullable();
            $table->date('date_of_complaints')->nullable();
            $table->date('date_of_resolve')->nullable();
            $table->date('date_of_borrowed')->nullable();
            $table->date('date_of_return')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('record_type')->nullable();
            $table->string('status')->nullable(); // Resolve & Unresolve
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kagawad_record');
    }
};

// php artisan migrate:refresh --path=database/migrations/2026_05_28_220119_create_kagawad_record.php
// php artisan migrate --path=database/migrations/2026_05_28_220119_create_kagawad_record.php