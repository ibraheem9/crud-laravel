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
        Schema::create('advanced_cruds', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('customer');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->string('civil_id')->nullable();
            $table->string('img')->nullable();
            $table->string('civil_id_img')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->date('dob')->nullable();
            $table->string('password');
            $table->string('color')->nullable();
            $table->timestamp('banned_at')->nullable();
            $table->string('passport_no')->nullable();
            $table->string('address')->nullable();
            $table->string('profession')->nullable();
            $table->boolean('is_vip')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advanced_cruds');
    }
};
