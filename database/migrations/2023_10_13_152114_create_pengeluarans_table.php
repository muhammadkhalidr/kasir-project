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
        Schema::create('pengeluarans', function (Blueprint $table) {
            $table->bigInteger('id_pengeluaran')->nullable();
            $table->string('id_generate')->nullable();
            $table->string('keterangan')->nullable();
            $table->bigInteger('jumlah')->nullable();
            $table->integer('harga')->nullable();
            $table->bigInteger('total')->nullable();
            $table->string('jenis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluarans');
    }
};
