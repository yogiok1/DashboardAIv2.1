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
        Schema::create('schemas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Schema name (e.g., "Rubrik Penilaian 2024")
            $table->text('description')->nullable(); // Schema description
            $table->json('schema_data'); // JSON data containing the schema structure
            $table->string('type')->default('rubric'); // Type: rubric, instrument, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schemas');
    }
};
