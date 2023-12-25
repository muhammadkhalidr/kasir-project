<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailOrderan;
use App\Models\Rekening;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PiutangController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $data = DetailOrderan::all();
        $rekening = Rekening::all();
        $keterangan = DetailOrderan::select('keterangan', 'notrx')->get();
        return view('piutang.data', [
            'title' => env('APP_NAME') . ' | ' . 'Data Piutang',
            'breadcrumb' => 'Piutang',
            'user' => $user,
            'data' => $data,
            'rekening' => $rekening,
            'ket' => $keterangan,
        ]);
    }
}
