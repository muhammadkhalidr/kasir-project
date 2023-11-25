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
        Schema::create('orderans', function (Blueprint $table) {
            $table->id('id_keuangan')->autoIncrement();
            $table->string('id_generate')->nullable();
            $table->string('nama_barang');
            $table->bigInteger('harga_barang');
            $table->bigInteger('jumlah_barang');
            $table->bigInteger('jumlah_total');
            $table->enum('keterangan', ['L', 'BL']);
            $table->string('nama_pemesan');
            $table->bigInteger('uang_muka');
            $table->bigInteger('sisa_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderans');
    }
};
