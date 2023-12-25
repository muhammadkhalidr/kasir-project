<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanController extends Controller
{
    public function index()
    {
        return view('laporan.cetak', [
            'title' => env('APP_NAME') . ' | ' . 'Laporan',
            'breadcrumb' => 'Laporan',
        ]);
    }

    public function records(Request $request)
    {
        if ($request->ajax()) {

            if ($request->input('start_date') && $request->input('end_date')) {

                $start_date = Carbon::parse($request->input('start_date'));
                $end_date = Carbon::parse($request->input('end_date'));

                if ($end_date->greaterThan($start_date)) {
                    $laporans = Pengeluaran::whereBetween('created_at', [$start_date, $end_date])->get();
                } else {
                    $laporans = Pengeluaran::latest()->get();
                }
            } else {
                $laporans = Pengeluaran::latest()->get();
            }

            return response()->json([
                'laporans' => $laporans
            ]);
        } else {
            abort(403);
        }
    }
}
