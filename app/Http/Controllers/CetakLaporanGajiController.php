<?php

namespace App\Http\Controllers;

use App\Models\GajiKaryawan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanGajiController extends Controller
{
    public function index()
    {

        return view('laporan.gaji.cetak', [
            'title' => 'Laporan Gaji',
            'breadcrumb' => 'Laporan',
        ]);
    }

    public function laporan_Gaji(Request $request)
    {
        if ($request->ajax()) {

            if ($request->input('start_date') && $request->input('end_date')) {

                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));

                if ($end_date->greaterThan($start_date)) {
                    $gajise = GajiKaryawan::whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $gajise = GajiKaryawan::latest()->get();
                }
            } else {
                $gajise = GajiKaryawan::latest()->get();
            }

            return response()->json([
                'gajise' => $gajise
            ]);
        } else {
            abort(403);
        }
    }
}
