<?php

namespace App\Http\Controllers;

use App\Models\DetailOrderan;
use App\Models\Orderan;
use App\Models\Pengeluaran;
use App\Models\KasMasuk;
use App\Models\Pembelian;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $filterDate = $request->date ?? now();

        $kasMasuks = KasMasuk::whereDate('created_at', $filterDate)
            ->where('bank', '!=', 'kaskecil')
            ->select(DB::raw('SUM(pemasukan) as total_pendapatan'), DB::raw('SUM(pengeluaran) as total_pengeluaran'))
            ->first();

        $datas = DetailOrderan::all();
        $pengeluaran = Pengeluaran::all();
        $pembelian = Pembelian::all();

        $pendapatan = KasMasuk::whereDate('created_at', $filterDate)
            ->where('bank', '!=', 'kaskecil')
            ->sum('pemasukan');

        $kasKeluar = $pengeluaran->sum('total') + $pembelian->sum('total');

        return view('layout.home', [
            'totalOrderan' => $datas->count(),
            // 'totalPendapatan' => $totalUangMuka + $totalJumlahTotalLunas,
            'totalPengeluaran' => $kasKeluar,
            'title' => 'Dashboard | Home',
            'user' => $user,
            'totalPendapatanG' => $kasMasuks->total_pendapatan ?? 0,
            'totalPengeluaranG' => $kasMasuks->total_pengeluaran ?? 0,
            'filterDate' => $filterDate,
            'totalPendapatan' => $pendapatan
        ]);
    }
}
