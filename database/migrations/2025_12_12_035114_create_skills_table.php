<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Python Programming", "Data Analysis"
            $table->string('category')->nullable(); // "Technical", "Soft Skill", "Domain Knowledge"
            $table->text('description')->nullable();
            $table->string('level')->default('beginner'); // beginner, intermediate, advanced
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
