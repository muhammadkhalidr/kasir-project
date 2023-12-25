<?php

namespace App\Http\Controllers;

use App\Models\GajiKaryawan;
use App\Models\Orderan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)

    {

        $user = Auth::user();
        $pengeluarans = [];
        $orderans = [];
        $gajiKaryawans = [];

        if ($request->has('txtjenis') && $request->has('tgl_dari') && $request->has('tgl_sampai')) {

            $jenis = $request->input('txtjenis');
            $tgl_dari = $request->input('tgl_dari');
            $tgl_sampai = $request->input('tgl_sampai');

            if ($jenis == '111') {
                $pengeluarans = Pengeluaran::where('created_at', '>=', $tgl_dari)
                    ->where('created_at', '<=', $tgl_sampai)
                    ->get();
            } elseif ($jenis == '222') {
                $orderans = Orderan::where('created_at', '>=', $tgl_dari)
                    ->where('created_at', '<=', $tgl_sampai)
                    ->get();
            } elseif ($jenis == '333') {
                $gajiKaryawans = GajiKaryawan::where('created_at', '>=', $tgl_dari)
                    ->where('created_at', '<=', $tgl_sampai)
                    ->get();
            }
        }
        return view('laporan.data', [
            'title' => env('APP_NAME') . ' | ' . 'Laporan',
            'pengeluarans' => $pengeluarans,
            'orderans' => $orderans,
            'gajikaryawans' => $gajiKaryawans,
            'request' => $request,
            'user' => $user,

        ]);
    }

    public function cetakLaporan()
    {
        // Filter data laporan berdasarkan request
        $pengeluarans = Pengeluaran::all();
        $orderans = Orderan::all();
        $gajiKaryawans = GajiKaryawan::all();

        try {
            // Generate PDF from view
            $pdf = PDF::loadView('laporan.cetak-laporan', [
                'pengeluarans' => $pengeluarans,
                'orderans' => $orderans,
                'gajiKaryawans' => $gajiKaryawans,
            ]);

            // Download PDF
            return $pdf->download('laporan.pdf');
        } catch (\Exception $e) {
            // Handle any exceptions that may occur (e.g., view not found)
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
