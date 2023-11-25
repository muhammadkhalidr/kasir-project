<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use App\Models\DetailPengeluaran;
use App\Models\KasMasuk;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;


class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        $pengeluarans = Pengeluaran::join('kas_masuks', 'pengeluarans.total', '=', 'kas_masuks.pengeluaran')
            ->select('pengeluarans.id_pengeluaran', 'pengeluarans.keterangan', 'pengeluarans.jumlah', 'pengeluarans.harga', 'kas_masuks.pengeluaran', 'kas_masuks.id', 'kas_masuks.created_at',)
            ->get();

        $groupedPengeluarans = $pengeluarans->groupBy('id_pengeluaran');

        $totals = $groupedPengeluarans->map(function ($group) {
            return $group->sum('pengeluaran');
        });

        $formattedPengeluarans = $pengeluarans->map(function ($pengeluaran) {
            $pengeluaran->formatted_date = Carbon::parse($pengeluaran->created_at)->isoFormat('dddd, DD/MM/YYYY');
            return $pengeluaran;
        });

        return view('pengeluaran.data', [
            'title' => 'Data Pengeluaran',
            'breadcrumb' => 'Pengeluaran',
            'user' => $user,
            'groupedPengeluarans' => $groupedPengeluarans,
            'totals' => $totals,
            'formattedPengeluarans' => $formattedPengeluarans,
        ]);
    }




    public function tambahPengeluaran()
    {
        $user = Auth::user();
        $idSebelumnya = DB::table('pengeluarans')->max('id_pengeluaran');
        $nomorSelanjutnya = $idSebelumnya + 1;
        return view('pengeluaran.tambah', [
            'title' => 'Pengeluaran',
            'breadcrumb' => 'Pengeluaran',
            'user' => $user,
            'nomorSelanjutnya' => $nomorSelanjutnya,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengeluaranRequest $request)
    {
        $validate = $request->validated();

        $pengeluaranTerakhir = Pengeluaran::where('id_pengeluaran', $request->txtid)->latest('id_pengeluaran')->first();

        if ($pengeluaranTerakhir) {
            $idBaru = $pengeluaranTerakhir->id_generate;
        } else {
            $lastIdGenerate = Pengeluaran::latest('id_generate')->first();

            if ($lastIdGenerate) {
                $lastIdNumber = substr($lastIdGenerate->id_generate, 2);
                $newIdNumber = str_pad((int)$lastIdNumber + 1, 3, '0', STR_PAD_LEFT);
                $idBaru = 'K-' . $newIdNumber;
            } else {
                $idBaru = 'K-001';
            }
        }

        $pengeluaran = new Pengeluaran;
        $kasMasuk = new KasMasuk;
        $detailPengeluaran = new DetailPengeluaran;
        $pengeluaran->id_pengeluaran = $request->txtid;
        $pengeluaran->id_generate = $idBaru;
        $pengeluaran->keterangan = $request->txtket;
        $pengeluaran->jumlah = $request->txtjumlah;
        $pengeluaran->harga = $request->txtharga;
        $pengeluaran->total = $request->txttotal;

        // Cek saldo kas masuk
        $saldoKasMasuk = KasMasuk::sum('pemasukan');
        if ($saldoKasMasuk && $saldoKasMasuk < $pengeluaran->total) {
            return redirect()->back()->with('error', 'Saldo tidak cukup!');
        }

        $pengeluaran->save();

        $kasMasuk->id_generate = $idBaru;
        $kasMasuk->keterangan = "Pengeluaran - " . $request->txtket;
        $kasMasuk->pengeluaran = $pengeluaran->total;
        $kasMasuk->save();

        return redirect('pengeluaran')->with('msg', 'Data Berhasil Ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_generate)
    {
        $pengeluaran = Pengeluaran::findOrFail($id_generate);
        $kasMasuk = KasMasuk::where('id_generate', $pengeluaran->id_generate)->get();
        $pengeluaran->delete();

        foreach ($kasMasuk as $kas) {
            $kas->delete();
        }

        return redirect('pengeluaran')->with('msg', 'Data Berhasil Dihapus!');
    }

    public function printInvoice($id_pengeluaran)
    {
        $cetaks = Pengeluaran::find($id_pengeluaran);

        if (!$cetaks) {
            return response()->json(['error' => 'Record not found.'], 404);
        }

        $pengeluarans = Pengeluaran::join('kas_masuks', 'pengeluarans.total', '=', 'kas_masuks.pengeluaran')
            ->select('pengeluarans.id_pengeluaran', 'pengeluarans.keterangan', 'pengeluarans.jumlah', 'pengeluarans.harga', 'kas_masuks.pengeluaran', 'kas_masuks.id', 'kas_masuks.created_at',)
            ->where('pengeluarans.id_pengeluaran', $id_pengeluaran)
            ->get();

        $groupedPengeluarans = $pengeluarans->groupBy('id_pengeluaran');

        $totals = $groupedPengeluarans->map(function ($group) {
            return $group->sum('pengeluaran');
        });

        $pdf = PDF::loadView('pengeluaran.cetak', [
            'cetaks' => $cetaks,
            'groupedPengeluarans' => $groupedPengeluarans,
            'totals' => $totals,
        ]);

        // return view('pengeluaran.cetak', [
        //     'cetaks' => $cetaks,
        //     'groupedPengeluarans' => $groupedPengeluarans,
        //     'totals' => $totals,
        // ]);

        return $pdf->download($cetaks->id_pengeluaran . ' laporanPengeluaran.pdf');
    }
}
