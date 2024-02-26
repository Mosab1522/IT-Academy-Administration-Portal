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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academy_id')->constrained()->cascadeOnDelete();
            $table->foreignId('coursetype_id')->constrained('course_types')->cascadeOnDelete();
            $table->tinyInteger('days');
            $table->tinyInteger('time');
            $table->timestamps();
            $table->boolean('verified')->default(false);
            $table->string('verification_token', 60)->nullable()->unique();
            $table->timestamp('verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
