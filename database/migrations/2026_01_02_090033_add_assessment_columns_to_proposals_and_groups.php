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
        // Add assessment_status to proposals table
        Schema::table('proposals', function (Blueprint $table) {
            $table->tinyInteger('assessment_status')->default(0)->after('evaluation_status')->comment('0: belum, 1: sudah admin, 2: sudah substansi, 3: sudah keduanya');
        });

        // Add assessment_type to proposal_groups table
        Schema::table('proposal_groups', function (Blueprint $table) {
            $table->string('assessment_type')->default('-')->after('status')->comment('-, administrasi, substansi, gabungan_naive, gabungan_selected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn('assessment_status');
        });

        Schema::table('proposal_groups', function (Blueprint $table) {
            $table->dropColumn('assessment_type');
        });
    }
};
