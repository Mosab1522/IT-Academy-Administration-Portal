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
        Schema::create('coursetype_instructor', function (Blueprint $table) {
            $table->foreignId('instructor_id')->constrained()->cascadeOnDelete();
            $table->foreignId('coursetype_id')->constrained('course_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coursetype_instructor');
    }
};
