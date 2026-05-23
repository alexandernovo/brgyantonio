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
        Schema::create('household_members', function (Blueprint $table) {

            $table->id("household_id");
            $table->unsignedBigInteger('resident_id')->nullable();

            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('extension')->nullable();

            $table->string('place_of_birth')->nullable();

            $table->date('date_of_birth')->nullable();

            $table->integer('age')->nullable();

            $table->string('sex')->nullable();

            $table->string('civil_status')->nullable();

            $table->string('citizenship')->nullable();

            $table->string('occupation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('household_members');
    }
};
// php artisan migrate:refresh --path=database/migrations/2026_05_20_192204_create_household__table.php
// php artisan migrate --path=database/migrations/2026_05_20_192204_create_household__table.php