<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proposal_group_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_group_id')->constrained('proposal_groups')->onDelete('cascade');
            $table->integer('accepted')->default(0);   // proposal diterima
            $table->integer('rejected')->default(0);   // proposal ditolak
            $table->integer('others')->default(0);     // status lain jika perlu
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposal_group_results');
    }
};
