<?php

namespace App\Http\Controllers;

use App\Models\Orderan;
use App\Http\Requests\StoreOrderanRequest;
use App\Http\Requests\UpdateOrderanRequest;
use App\Models\DetailOrderan;
use App\Models\KasMasuk;
use App\Models\PelunasanOrderan;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PDF;
use PHPUnit\Framework\Constraint\LessThan;
use Sabberworm\CSS\Settings;

class OrderanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $datas = Orderan::all();
        $dataOrderan = DetailOrderan::all();

        return view('orderan.data', [
            'title' => 'Data Orderan',
            'breadcrumb' => 'Data Orderan',
            'user' => $user,
            'orderans' => $datas,
            'total' => $datas->sum('jumlah_total'),
            'totaldp' => $datas->sum('uang_muka'),
            'totalsisa' => $datas->sum('sisa_pembayaran'),
            'dataOrderan' => $dataOrderan,
        ]);
    }


    public function tambahOrderan()
    {
        $user = Auth::user();
        return view('orderan.tambah', [
            'title' => 'Tambah Orderan',
            'breadcrumb' => 'Orderan',
            'user' => $user,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $noTrx = DetailOrderan::latest('id_orderan')->first();

        if ($noTrx) {
            $idLama = $noTrx->notrx;
            $idNumber = (int)substr($idLama, 4);
            $idNumber++;
            $idBaru = env('TRX_CODE') . str_pad($idNumber, 3, '0', STR_PAD_LEFT);
            $idTransaksiBaru = '1' . str_pad($idNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $idBaru = 'TRX-000';
            $idTransaksiBaru = '0';
        }

        foreach ($data['namapemesan'] as $key => $value) {
            $status = ($data['sisa'] == 0) ? 'Lunas' : 'Belum Lunas';

            DetailOrderan::create([
                'id_transaksi' => $idTransaksiBaru,
                'notrx' => $idBaru,
                'namapemesan' => $value,
                'namabarang' => $data['namabarang'][$key],
                'jumlah' => $data['jumlah'][$key],
                'harga' => $data['harga'][$key],
                'total' => $data['total'][$key],
                'uangmuka' => $data['uangmuka'],
                'subtotal' => $data['subtotal'],
                'sisa' => $data['sisa'],
                'status' => $status,
            ]);

            $kasMasuk = new KasMasuk;
            $kasMasuk->id_generate = $idBaru;
            $kasMasuk->keterangan = "Pemasukan dari invoice# " . $idBaru;

            if ($data['sisa'] == 0) {
                $kasMasuk->pemasukan = $data['subtotal'];
            } else {
                $kasMasuk->pemasukan = $data['uangmuka'];
            }

            $kasMasuk->save();
        }

        return redirect('orderan')->with('msg', 'Data Berhasil Ditambahkan!');
    }


    public function pelunasan(Request $request)
    {
        // Validasi form input
        // $request->validate([
        //     'caraBayar' => 'required|in:tunai,transfer',
        //     'jumlahBayar' => 'required|numeric|min:0',
        //     'totalBayar' => 'required|numeric|min:0',
        //     'bank' => 'required_if:caraBayar,transfer|in:bca,bri',
        //     'buktiTransfer' => 'required_if:caraBayar,transfer|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // Ambil data dari form
        $jumlahBayar = $request->input('jumlahBayar');
        $totalBayar = $request->input('totalBayar');
        $caraBayar = $request->input('caraBayar');
        $buktiTransfer = $request->file('buktiTransfer');

        // Simpan data pelunasan ke dalam tabel pelunasan_orderans
        $pelunasan = PelunasanOrderan::create([
            'id_orderan' => $request->input('id_orderan'),
            'notrx' => $request->input('notrx'),
            'total_bayar' => $totalBayar,
            'bank' => $caraBayar,
            'id_bayar' => auth()->user()->id,
        ]);

        $buktiTransfer = $request->file('buktiTransfer');

        if ($buktiTransfer && $buktiTransfer->isValid()) {
            $buktiFile = $request->file('buktiTransfer');
            $buktiName = $buktiFile->hashName();
            $buktiFile->move(public_path('assets/images/bukti_tf'), $buktiName);

            $pelunasan->bukti_transfer = $buktiName;
            $pelunasan->save();
        }

        // Update data di tabel detail_orderans
        DetailOrderan::where('notrx', $request->input('notrx'))
            ->update([
                'sisa' => max(0, $totalBayar - $jumlahBayar),
                'status' => $totalBayar == $jumlahBayar ? 'Lunas' : 'Belum Lunas',
            ]);

        $pemasukan = KasMasuk::where('id_generate', $request->input('notrx'))
            ->select('pemasukan')
            ->first();

        KasMasuk::where('id_generate', $request->input('notrx'))
            ->update([
                'pemasukan' => $pemasukan->pemasukan + $totalBayar
            ]);

        return redirect()->back()->with('success', 'Pelunasan berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_keuangan)
    {
        $user = Auth::user();
        $orderan = Orderan::findOrFail($id_keuangan);

        return view('orderan.edit', data: [
            'title' => 'Edit Orderan',
            'breadcrumb' => 'Data Orderan',
            'user' => $user,
        ])->with([
            'txtid' => $id_keuangan,
            'txtnama' => $orderan->nama_pemesan,
            'txtbarang' => $orderan->nama_barang,
            'txtharga' => $orderan->harga_barang,
            'txtjumlah' => $orderan->jumlah_barang,
            'txttotal' => $orderan->jumlah_total,
            'txtket' => $orderan->keterangan,
            'txtdp' => $orderan->uang_muka,
            'txtsisa' => $orderan->sisa_pembayaran,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderanRequest $request, $id_keuangan)
    {
        $data = Orderan::findOrFail($id_keuangan);

        $data->nama_pemesan = $request->txtnama;
        $data->nama_barang = $request->txtbarang;
        $data->harga_barang = $request->txtharga;
        $data->jumlah_barang = $request->txtjumlah;
        $data->jumlah_total = $request->txttotal;
        $data->keterangan = $request->txtket;
        $data->uang_muka = $request->txtdp;
        $data->sisa_pembayaran = $request->txtsisa;
        $data->save();

        $kasMasuk = KasMasuk::where('keterangan', $data->nama_barang)->first();

        if ($kasMasuk) {
            if ($data->keterangan === 'BL') {
                $kasMasuk->pemasukan = $request->txtdp;
            } elseif ($data->keterangan === 'L') {
                $kasMasuk->pemasukan = $request->txttotal;
            }
            $kasMasuk->save();
        }

        return redirect('orderan')->with('msg', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($notrx)
    {
        $orderan = DetailOrderan::where('notrx', $notrx);
        $orderan->delete();

        // Delete data from KasMasuk table
        $kasMasuk = KasMasuk::where('id_generate', $notrx);
        $kasMasuk->delete();

        $pelunasan = PelunasanOrderan::where('notrx', $notrx);
        $pelunasan->delete();

        return redirect('orderan')->with('msg', 'Data Berhasil Di-hapus!');
    }

    public function printInvoice($notrx)
    {
        $orderans = DetailOrderan::where('notrx', $notrx)->get()->groupBy('notrx');
        $data = DetailOrderan::all();
        $setting = setting::all();
        // $pdf = PDF::loadView('orderan.print_invoice', [
        //     'orderans' => $orderans,
        //     'data' => $data,
        //     'notrx' => $notrx
        // ]);

        // return $pdf->download($notrx . '_invoice.pdf');

        return view('orderan.print_invoice', [
            'orderans' => $orderans,
            'data' => $data,
            'notrx' => $notrx,
            'settings' => $setting,
        ]);
    }
}
