<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanPembelianController extends Controller
{
    public function index()
    {

        $logo = setting::all();

        return view('laporan.pembelian.cetak', [
            'title' => env('APP_NAME') . ' | ' . 'Laporan Pembelian',
            'breadcrumb' => 'Laporan',
            'logo' => $logo
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
