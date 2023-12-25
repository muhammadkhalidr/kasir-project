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
        Schema::table('pelunasan_orderans', function (Blueprint $table) {
            $table->string('via')->after('bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelunasan_orderans', function (Blueprint $table) {
            $table->dropColumn('via');
        });
    }
};
