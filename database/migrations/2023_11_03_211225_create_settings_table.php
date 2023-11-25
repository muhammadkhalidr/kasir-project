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
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id_setting')->nullable()->autoIncrements();
            $table->string('perusahaan', 50)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('phone', 14)->nullable();
            $table->string('instagram', 50)->nullable();
            $table->string('logo', 255)->nullable();
            $table->string('favicon', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
