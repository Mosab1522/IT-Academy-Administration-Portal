<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('instructors', 'id')->cascadeOnDelete();
            $table->string('nickname')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            'nickname' => 'adminuser',
            'password' => '$argon2id$v=19$m=2048,t=4,p=3$LnlXcVdqSkxyVVdBTFJKdA$pa04wRUIyDVS1Vk4eT6sHffvcnBTE0IbBWqo0YWr/28',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
