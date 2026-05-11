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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id("certification_id")->nullable();

            // Requester Information (Matches the 3 input boxes)
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();

            // Address Fields (Matches the dropdown and readonly fields)
            $table->string('purok')->nullable();
            $table->string('age')->nullable();
            $table->string('barangay')->nullable();
            $table->string('municipality')->default('Barbaza');
            $table->string('province')->default('Antique');

            // Personal Details (Changed enum to string as requested)
            $table->string('sex')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('nationality')->default('Filipino');
            $table->string('name_of_tree')->nullable();
            $table->string('or_number')->nullable();
            $table->string('no_of_tree')->nullable();
            $table->string('civil_status')->nullable();

            // Certification Metadata
            $table->string('certification_type')->nullable();
            $table->string('image_path')->nullable();
            $table->date('date_issued')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};
// php artisan migrate:refresh --path=database/migrations/2026_05_10_154204_create_certifications_table.php