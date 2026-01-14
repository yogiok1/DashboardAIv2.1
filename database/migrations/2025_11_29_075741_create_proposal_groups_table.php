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
        Schema::create('proposal_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_code')->unique();
            $table->string('group_name');
            $table->string('scheme')->nullable();
            $table->enum('type', ['current', 'history'])->default('current');
            $table->unsignedInteger('total_files')->default(0);
            $table->timestamp('uploaded_at')->nullable();
            $table->enum('status', ['uploaded', 'on_progress', 'finish'])->default('uploaded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_groups');
    }
};
