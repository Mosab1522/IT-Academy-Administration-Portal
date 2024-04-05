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
        Schema::create('course_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('academy_id')->constrained()->cascadeOnDelete();
            $table->foreignId('coursetype_id')->constrained('course_types')->cascadeOnDelete();
            $table->foreignId('instructor_id')->nullable()->constrained()->cascadeOnDelete();
            $table->tinyInteger('days');
            $table->tinyInteger('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_classes');
    }
};
