<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aggregate_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('ml_weight');        // bobot ML
            $table->integer('ai_genera_weight'); // bobot AI Genera
            $table->boolean('status')->default(false); // 1 = aktif, 0 = nonaktif
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aggregate_settings');
    }
};
