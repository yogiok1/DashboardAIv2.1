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
        Schema::create('model_ais', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Nama model AI
            $table->string('provider');                // OpenAI, Anthropic, Google, dsb
            $table->string('model_code')->unique();    // "gpt-4o-mini" atau "claude-3.5-sonnet"
            $table->text('description')->nullable();   // Deskripsi model
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_ais');
    }
};
