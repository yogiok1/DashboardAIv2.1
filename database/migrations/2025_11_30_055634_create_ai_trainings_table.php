<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_trainings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('model_ai_id')->constrained('model_ais')->onDelete('cascade');

            $table->integer('ai_admin_score')->nullable();
            $table->integer('ai_substantive_score')->nullable();

            $table->text('ai_recommendation')->nullable();

            $table->text('user_review')->nullable();
            $table->integer('user_admin_score')->nullable();
            $table->integer('user_substantive_score')->nullable();

            // status apakah sudah dijadikan training data
            $table->boolean('is_trained')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_trainings');
    }
};
