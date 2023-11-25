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
        Schema::create('pembelians', function (Blueprint $table) {
            $table->bigInteger('id_pembelian')->nullable();
            $table->string('id_generate')->nullable();
            $table->string('bahan')->nullable();
            $table->string('jenis')->nullable();
            $table->bigInteger('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->bigInteger('total')->nullable();
            $table->bigInteger('uang_muka')->nullable();
            $table->bigInteger('sisa_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
