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
        Schema::create('simple_cruds', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(0);
            $table->string('key')->nullable();
            $table->string('name');
            $table->string('img')->nullable();
            $table->text('details')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('need_auth_code')->default(false);
            $table->boolean('need_reference_id')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simple_cruds');
    }
};
