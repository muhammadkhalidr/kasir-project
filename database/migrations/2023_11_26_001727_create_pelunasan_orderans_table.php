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
        Schema::create('pelunasan_orderans', function (Blueprint $table) {
            $table->id();
            $table->string('id_orderan');
            $table->string('notrx');
            $table->string('total_bayar');
            $table->timestamps();

            $table->string('bank')->nullable();
            $table->string('bukti_transfer')->nullable();

            // Menggunakan unsignedBigInteger untuk foreign key
            $table->unsignedBigInteger('id_bayar')->nullable();
            $table->foreign('id_bayar')
                ->references('id_transaksi')
                ->on('detail_orderans')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pelunasan_orderans', function (Blueprint $table) {
            $table->dropForeign(['id_bayar']);
        });

        Schema::dropIfExists('pelunasan_orderans');
    }
};
