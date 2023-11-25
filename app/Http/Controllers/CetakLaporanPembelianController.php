<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanPembelianController extends Controller
{
    public function index()
    {

        return view('laporan.pembelian.cetak', [
            'title' => 'Laporan Pembelian',
            'breadcrumb' => 'Laporan',
        ]);
    }

    public function records_pembelian(Request $request)
    {
        if ($request->ajax()) {

            if ($request->input('start_date') && $request->input('end_date')) {

                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));

                if ($end_date->greaterThan($start_date)) {
                    $pembelians = Pembelian::whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $pembelians = Pembelian::latest()->get();
                }
            } else {
                $pembelians = Pembelian::latest()->get();
            }

            return response()->json([
                'pembelians' => $pembelians
            ]);
        } else {
            abort(403);
        }
    }
}
