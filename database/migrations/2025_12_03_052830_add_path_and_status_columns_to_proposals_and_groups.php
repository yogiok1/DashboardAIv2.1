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
        // Add path column to proposal_groups
        Schema::table('proposal_groups', function (Blueprint $table) {
            $table->string('path', 50)->default('sekarang')->after('scheme');
        });

        // Add status column to proposals
        Schema::table('proposals', function (Blueprint $table) {
            $table->string('status', 50)->default('uploaded')->after('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposal_groups', function (Blueprint $table) {
            $table->dropColumn('path');
        });

        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
