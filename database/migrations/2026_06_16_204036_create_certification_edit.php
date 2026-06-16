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
        Schema::create('certification_edit', function (Blueprint $table) {
            $table->id("certification_id");
            $table->bigInteger("record_id");
            $table->text('description')->nullable();
            $table->text('signatory')->nullable();
            $table->text('ornodescription')->nullable();
            $table->text('approved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certification_edit');
    }
};
// php artisan migrate:refresh --path=database/migrations/2026_06_16_204036_create_certification_edit.php
