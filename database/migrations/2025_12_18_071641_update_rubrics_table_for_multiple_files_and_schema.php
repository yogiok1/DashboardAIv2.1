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
        Schema::table('rubrics', function (Blueprint $table) {
            // Add second file path for additional document
            $table->string('file_path_2')->nullable()->after('file_path');

            // Add schema reference
            $table->foreignId('schema_id')->nullable()->after('file_path_2')->constrained('schemas')->onDelete('set null');

            // Add description field
            $table->text('description')->nullable()->after('rubric_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rubrics', function (Blueprint $table) {
            $table->dropForeign(['schema_id']);
            $table->dropColumn(['file_path_2', 'schema_id', 'description']);
        });
    }
};
