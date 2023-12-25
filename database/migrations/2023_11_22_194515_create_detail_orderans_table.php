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
        Schema::create('detail_orderans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_transaksi')->nullable();
            $table->string('notrx')->nullable();
            $table->string('namabarang', 50)->nullable();
            $table->integer('jumlah')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->bigInteger('total')->nullable();
            $table->unsignedBigInteger('uangmuka')->nullable();
            $table->unsignedBigInteger('subtotal')->nullable();
            $table->integer('sisa')->nullable();
            $table->string('status', 50)->nullable();
            $table->timestamps();
            $table->foreignId('id_pelanggan')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_orderans');
    }
};
