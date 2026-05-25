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
        Schema::create('collection', function (Blueprint $table) {
            $table->id("collection_id")->nullable();

            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('or_number')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('collection_type')->nullable();
            $table->decimal('payment_amount', 12, 2)->nullable();
            $table->datetime('payment_date')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('collection');
    }
};

// php artisan migrate:refresh --path=database/migrations/2026_05_25_213924_create_collection_table.php
// php artisan migrate --path=database/migrations/2026_05_25_213924_create_collection_table.php
