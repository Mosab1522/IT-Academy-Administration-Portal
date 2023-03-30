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
        Schema::create('prihlaskies', function (Blueprint $table) {
            $table->id();
            $table->string('meno');
            $table->string('priezvisko');
            $table->string('email')->unique();
            $table->integer('akademia_id');
            $table->integer('typkurzu_id');
            $table->integer('dni');
            $table->integer('cas');
            $table->timestamps();
            $table->boolean('verified')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prihlaskies');
    }
};
