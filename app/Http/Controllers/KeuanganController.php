<?php

namespace App\Http\Controllers;

use App\Models\GajiKaryawan;
use App\Models\KasMasuk;
use App\Models\Orderan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pengeluaran = Pengeluaran::all();
        $pemasukan = Orderan::all();
        $gajiKaryawan = GajiKaryawan::all();
        $kas = KasMasuk::all();

        // Hitung kas masuk
        $kasMasuk = $kas->where('bank', '!=', 'kaskecil')->sum('pemasukan') - $kas->sum('pengeluaran');

        return view('keuangan.data', [
            'title' => env('APP_NAME') . ' | ' . 'Data Keuangan',
            'breadcrumb' => 'Data Keuangan',
            'user' => $user,
            'pengeluarans' => $pengeluaran->sum('jumlah'),
            'pemasukans' => $pemasukan->sum('jumlah_total'),
            'gajiKaryawans' => $gajiKaryawan->sum('jumlah_gaji'),
            'kasmasuk' => $kasMasuk,
            'kaskeluar' => $kas->sum('pengeluaran'),
        ]);
    }
}
