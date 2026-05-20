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
        Schema::create('brgy', function (Blueprint $table) {
            $table->id("brgy_id");

            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('idnumber')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('guidance')->nullable();
            $table->string('guidance_contact')->nullable();
            $table->datetime('dateexpired')->nullable();
            $table->datetime('dateclaim')->nullable();
            $table->datetime('birthdate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brgy');
    }
};
// php artisan migrate:refresh --path=database/migrations/2026_05_19_195605_create_brgyid_table.php
// php artisan migrate --path=database/migrations/2026_05_19_195605_create_brgyid_table.php
