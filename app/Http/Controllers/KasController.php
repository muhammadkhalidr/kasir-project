<?php

namespace App\Http\Controllers;

use App\Models\DetailOrderan;
use App\Models\KasMasuk;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class KasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $kasKecils = KasMasuk::where('bank', 'kaskecil')->get();
        $rekenings = Rekening::pluck('bank')->toArray();
        $pemasukanTunai = KasMasuk::where('bank', 'tunai')->sum('pemasukan') - KasMasuk::where('bank', 'tunai')->sum('pengeluaran');

        $pemasukanBank = 0;
        foreach ($rekenings as $bank) {
            $pemasukanBank += KasMasuk::where('bank', $bank)->sum('pemasukan') - KasMasuk::where('bank', $bank)->sum('pengeluaran');
        }

        // Retrieve distinct bank names
        $dataBank = Rekening::pluck('bank')->unique()->toArray();

        // Initialize an array to store bank details
        $bankDetails = [];

        // Loop through each bank and calculate the sum of pemasukan
        foreach ($dataBank as $bank) {
            $saldo = KasMasuk::where('bank', $bank)->sum('pemasukan') - KasMasuk::where('bank', $bank)->sum('pengeluaran');
            $bankDetails[] = [
                'bank' => $bank,
                'saldo' => $saldo,
            ];
        }

        $kasKecil = KasMasuk::where('bank', 'kaskecil')->sum('pemasukan') - KasMasuk::where('bank', 'kaskecil')->sum('pengeluaran');

        return view('kas.data', [
            'title' => env('APP_NAME') . ' | ' . 'Kas',
            'user' => $user,
            'tunai' => $pemasukanTunai,
            'bank' => $pemasukanBank,
            'bankDetails' => $bankDetails,
            'kasKecil' => $kasKecil,
            'kasKecils' => $kasKecils
        ]);
    }

    public function tambahKas(Request $request)
    {
        $data = $request->all();

        // Get the latest id_generate value from the database
        $idBaru = KasMasuk::max('id_generate');

        // Extract the numeric part from the latest id_generate value
        $nomorKas = intval(substr($idBaru, strlen('KasKecil-')));

        // Increment the numeric part by 1
        $noBaru = $nomorKas + 1;

        // Generate the new id_generate value
        $idGenerateKasKecil = 'KasKecil-' . $noBaru;

        $kasKecil = new KasMasuk;

        $kasKecil->id_generate = $idGenerateKasKecil;
        $kasKecil->no_reff = $data['noreff'];
        $kasKecil->bank = $data['kaskecil'];
        $kasKecil->pemasukan = $data['nominal'];
        $kasKecil->keterangan = 'Kas Kecil ' . $data['keterangan'];
        $kasKecil->name_kasir = $data['kasir'];
        $kasKecil->save();

        return redirect()->back()->with('success', 'Kas kecil ditambahkan');
    }

    public function hapusKasKecil($no_reff)
    {
        KasMasuk::where('no_reff', $no_reff)->delete();
        return redirect()->back()->with('success', 'Kas kecil dihapus');
    }
}
