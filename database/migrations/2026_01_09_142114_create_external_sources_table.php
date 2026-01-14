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
        Schema::create('external_sources', function (Blueprint $table) {
            $table->id();
            $table->string('source_name'); // Auto-generated from filename
            $table->string('file_path'); // Path to PDF file
            $table->string('original_filename')->nullable(); // Original file name
            $table->unsignedBigInteger('file_size')->nullable(); // File size in bytes
            $table->string('type')->default('book'); // book, journal, etc
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_sources');
    }
};
