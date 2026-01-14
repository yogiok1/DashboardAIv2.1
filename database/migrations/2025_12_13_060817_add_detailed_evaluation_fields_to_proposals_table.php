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
            // Evaluation metadata
            $table->string('evaluation_id')->nullable()->after('id'); // ID dari external system
            $table->string('evaluator_username')->nullable()->after('user_id'); // Username evaluator
            $table->timestamp('evaluation_start_time')->nullable()->after('updated_at'); // Waktu mulai Penilaian
            $table->string('processing_time')->nullable()->after('evaluation_start_time'); // Waktu proses
            
            // Administration evaluation
            $table->integer('admin_score')->nullable()->after('ml_score'); // Score administrasi (total)
            $table->string('admin_status')->nullable()->after('admin_score'); // Status administrasi (LOLOS/TIDAK)
            
            // Substansi evaluation details
            $table->decimal('substansi_score', 5, 2)->nullable()->after('admin_status'); // Same as ai_score but more clear
            $table->integer('substansi_max_score')->nullable()->after('substansi_score'); // Max item score
            $table->integer('substansi_min_score')->nullable()->after('substansi_max_score'); // Min item score
            $table->text('substansi_summary')->nullable()->after('substansi_min_score'); // Detailed summary
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropColumn([
                'evaluation_id',
                'evaluator_username',
                'evaluation_start_time',
                'processing_time',
                'admin_score',
                'admin_status',
                'substansi_score',
                'substansi_max_score',
                'substansi_min_score',
                'substansi_summary',
            ]);
        });
    }
};
