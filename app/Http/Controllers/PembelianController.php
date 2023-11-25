<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Http\Requests\StorePembelianRequest;
use App\Http\Requests\UpdatePembelianRequest;
use App\Models\KasMasuk;
use Illuminate\Support\Facades\Auth;

use PDF;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $datas = Pembelian::all();
        // dd($datas);

        return view('pembelian.data', [
            'title' => 'Data Pembelian',
            'breadcrumb' => 'Pembelian',
            'user' => $user,
            'pembelians' => $datas,
        ]);
    }

    public function tambahPembelian()
    {
        $user = Auth::user();
        return view('pembelian.tambah', [
            'title' => 'Pembelian',
            'breadcrumb' => 'Pembelian',
            'user' => $user,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePembelianRequest $request)
    {
        $validate = $request->validated();

        $pembelianBaru = Pembelian::latest('id_pembelian')->first();

        if ($pembelianBaru) {
            $idLama = $pembelianBaru->id_generate;
            $idNumber = (int)substr($idLama, 2) + 1;
            $idBaru = 'P-' . str_pad($idNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $idBaru = 'P-001';
        }

        $pembelian = new Pembelian;
        $pembelian->id_pembelian = $request->txtid;
        $pembelian->id_generate = $idBaru;
        $pembelian->bahan = $request->txtbahan;
        $pembelian->jenis = $request->txtjenis;
        $pembelian->jumlah = $request->txtjumlah;
        $pembelian->satuan = $request->txtsatuan;
        $pembelian->total = $request->txttotal;
        $pembelian->uang_muka = $request->txtdp;
        $pembelian->sisa_pembayaran = $request->txtsisa;

        // Cek saldo kas masuk
        $saldoKasMasuk = KasMasuk::sum('pemasukan');
        if ($saldoKasMasuk && $saldoKasMasuk < $pembelian->total) {
            return redirect()->back()->with('error', 'Saldo tidak cukup!');
        }

        $pembelian->save();

        $kasMasuk = new KasMasuk;
        $kasMasuk->id_generate = $idBaru;
        $kasMasuk->keterangan = $request->txtbahan;
        $kasMasuk->pengeluaran = $request->txttotal;
        $kasMasuk->save();

        return redirect('pembelian')->with('msg', 'Data Berhasil Ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show($id_pembelian)
    {
        $user = Auth::user();
        $pembelian = Pembelian::findOrFail($id_pembelian);

        return view('pembelian.edit', [
            'title' => 'Edit Pembelian',
            'breadcrumb' => 'Pembelian',
            'user' => $user,
        ])->with([
            'txtid' => $id_pembelian,
            'txtbahan' => $pembelian->bahan,
            'txtjenis' => $pembelian->jenis,
            'txtsatuan' => $pembelian->satuan,
            'txtjumlah' => $pembelian->jumlah,
            'txttotal' => $pembelian->total,
            'txtdp' => $pembelian->uang_muka,
            'txtsisa' => $pembelian->sisa_pembayaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePembelianRequest $request, $id_pembelian)
    {
        $data = Pembelian::findOrFail($id_pembelian);
        $data->id_pembelian = $request->txtid;
        $data->bahan = $request->txtbahan;
        $data->jenis = $request->txtjenis;
        $data->jumlah = $request->txtjumlah;
        $data->satuan = $request->txtsatuan;
        $data->total = $request->txttotal;
        $data->uang_muka = $request->txtdp;
        $data->sisa_pembayaran = $request->txtsisa;
        $data->save();

        $kasMasuk = KasMasuk::where('id_generate', $data->id_generate)->first();
        if ($kasMasuk) {
            $kasMasuk->update([
                'pengeluaran' => $data->total,
                'keterangan' => $data->bahan,
            ]);
        }

        return redirect('pembelian')->with('msg', 'Data Berhasil Di-update!');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_generate)
    {
        $datas = Pembelian::findOrFail($id_generate);
        $kasMasuk = KasMasuk::where('id_generate', $datas->id_generate)->get();
        $datas->delete();

        foreach ($kasMasuk as $kas) {
            $kas->delete();
        }
        return redirect('pembelian')->with('msg', 'Data Berhasil Di-hapus!');
    }


    public function printFaktur($id_pembelian)
    {
        $pembelian = Pembelian::findOrFail($id_pembelian);

        // $print = PDF::loadView('pembelian.print_faktur');
        $print = PDF::loadView('pembelian.print_faktur', compact('pembelian'));

        return $print->download($pembelian->id_pembelian . '' . 'faktur-pembelian.pdf');
    }
}
