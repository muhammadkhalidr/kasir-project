<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogTranasksiController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $Log = KasMasuk::all();

        $pemasukan = KasMasuk::sum('pemasukan');
        $pengeluaran = KasMasuk::sum('pengeluaran');

        return view('logtransaksi.data', data: [
            'title' => env('APP_NAME') . ' | ' . 'Log Transaksi',
            'user' => $user,
            'log' => $Log,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
        ]);
    }
}
