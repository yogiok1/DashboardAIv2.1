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
        // Change type first, then rename
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('ml_score', 100)->nullable()->change();
        });
        
        // Rename column
        Schema::table('proposals', function (Blueprint $table) {
            $table->renameColumn('ml_score', 'ml_result');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->renameColumn('ml_result', 'ml_score');
        });
        
        Schema::table('proposals', function (Blueprint $table) {
            $table->decimal('ml_score', 5, 2)->nullable()->change();
        });
    }
};
