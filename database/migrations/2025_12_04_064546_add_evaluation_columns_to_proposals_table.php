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
        Schema::table('proposals', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('proposal_group_id')->constrained()->onDelete('set null');
            $table->string('evaluation_status', 50)->default('belum_dinilai')->after('status');
            $table->decimal('ai_score', 5, 2)->nullable()->after('evaluation_status');
            $table->decimal('ml_score', 5, 2)->nullable()->after('ai_score');
            $table->text('ai_notes')->nullable()->after('ml_score');
            $table->decimal('reviewer_score', 5, 2)->nullable()->after('ai_notes');
            $table->text('reviewer_notes')->nullable()->after('reviewer_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'user_id',
                'evaluation_status',
                'ai_score',
                'ml_score',
                'ai_notes',
                'reviewer_score',
                'reviewer_notes'
            ]);
        });
    }
};
