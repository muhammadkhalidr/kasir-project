<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rekenings')->insert([
            'no_rekening' => '1222323232',
            'atas_nama' => 'Khalid R',
            'bank' => 'BSI',
            'no_refferensi' => '004'
        ]);
    }
}
