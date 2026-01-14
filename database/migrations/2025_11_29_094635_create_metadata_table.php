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
        Schema::create('metadata', function (Blueprint $table) {
            $table->id();

            // Basic research information
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('abstract')->nullable();
            $table->string('category')->nullable();       // example: research, community_service
            $table->string('field_of_study')->nullable(); // example: Informatics, Education
            $table->string('keywords')->nullable();       // comma separated

            // Researcher information
            $table->unsignedBigInteger('researcher_id')->nullable();
            $table->string('researcher_name')->nullable();
            $table->string('study_program')->nullable();
            $table->string('institution')->default('Indonesia University of Education');

            // Year & period
            $table->year('year')->nullable();
            $table->string('semester')->nullable();       // odd/even

            // Upload relation
            $table->string('upload_code')->nullable();
            $table->json('file_paths')->nullable();       // store multiple files

            // BIMA-style additional fields
            $table->string('output_type')->nullable();    // article, proceeding, prototype
            $table->string('status')->default('draft');   // draft, reviewed, published

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metadata');
    }
};
