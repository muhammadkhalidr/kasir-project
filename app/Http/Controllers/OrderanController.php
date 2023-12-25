<?php

namespace App\Http\Controllers;

use App\Models\Orderan;
use App\Http\Requests\UpdateOrderanRequest;
use App\Models\DetailOrderan;
use App\Models\KasMasuk;
use App\Models\Pelanggan;
use App\Models\PelunasanOrderan;
use App\Models\Rekening;
use App\Models\setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $dataOrderan = DetailOrderan::with('pelanggans');
        $kode_pelanggan = "";
        $dataPelanggan = Pelanggan::select('kode_pelanggan', 'nama')->get();
        $pelanggans = Pelanggan::all();
        $rekening = Rekening::all();
        $noTrx = DetailOrderan::latest('id')->first();
        $dataKasir = DetailOrderan::select('name_kasir')->where('notrx', $noTrx)->get();
        $dataPelunasan = PelunasanOrderan::all();
        $jamTransaksi = Setting::select('darijam', 'sampaijam')->first();

        $formatTgl = $dataOrderan->get()->map(function ($dataOrderan) {
            $dataOrderan->formatted_date = Carbon::parse($dataOrderan->created_at)->isoFormat('dddd, DD/MM/YYYY');
            return $dataOrderan;
        });

        // Apply date filter
        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = Carbon::parse($request->input('start_date'))->startOfDay();
            $end_date = Carbon::parse($request->input('end_date'))->endOfDay();

            $dataOrderan->whereBetween('created_at', [$start_date, $end_date]);
        }

        // Search Data
        $search = $request->input('searchdata');
        if ($search) {
            $dataOrderan->where(function ($query) use ($search) {
                $query->where('notrx', 'like', '%' . $search . '%')
                    ->orWhereHas('pelanggans', function ($subQuery) use ($search) {
                        $subQuery->where('nama', 'like', '%' . $search . '%');
                    });
            });
        }

        // Set default per page value
        $perPage = $request->input('dataOptions', 10);

        // Adjust pagination based on the user's selection
        $dataOrderan = $dataOrderan->paginate($perPage);

        if ($noTrx) {
            $idLama = $noTrx->notrx;
            $idNumber = (int)substr($idLama, 4);
            $idNumber++;
            $idBaru = 'TRX-' . str_pad($idNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $idBaru = 'TRX-001';
        }

        // AJAX
        $query = $request->get('query');
        if ($request->ajax()) {
            $data = Pelanggan::where('nama', 'LIKE', '%' . $query . '%')
                ->limit(10)
                ->get();
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item" style="cursor:pointer;" data-id="' . $row->id . '">' . $row->nama . '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'Tidak ada data dengan nama ' . $query . '' . '</li>';
            }
            return $output;
        }

        $pelanggan = Pelanggan::where('nama', 'LIKE', '%' . $query . '%')
            ->simplePaginate(10);

        return view('orderan.data', [
            'title' => env('APP_NAME') . ' | ' . 'Data Orderan',
            'breadcrumb' => 'Data Orderan',
            'user' => $user,
            'dataOrderan' => $dataOrderan,
            'dataPelanggan' => $dataPelanggan,
            'kode_pelanggan' => $kode_pelanggan,
            'pelanggans' => $pelanggans,
            'rekening' => $rekening,
            'pelanggan' => $pelanggan,
            'notrx' => $idBaru,
            'pelunasan' => $dataPelunasan,
            'dataKasir' => $dataKasir,
            'jamTransaksi' => $jamTransaksi,
            'fortmatTgl' => $formatTgl,
            'perPageOptions' => [10, 15, 25, 100],
        ]);
    }


    public function cariData(Request $request)
    {
        return $this->index($request);
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


    public function filterJumlah(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $noTrx = DetailOrderan::latest('id')->first();

        $pelanggan = Pelanggan::where('nama', $data['namapemesan'])->first();

        $idTransaksiBaru = 0;
        $idTransaksiBaru++;

        if ($idTransaksiBaru) {
            $idLama = $idTransaksiBaru;
            $idNumber = (int)substr($idLama, 4);
            $idNumber++;
            $idTransaksiBaru2 = 1 . str_pad($idNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $idTransaksiBaru2 = 0;
        }

        $processedNotrx = [];

        foreach ($data['idpelanggan'] as $key => $value) {
            $status = ($data['sisa'] == 0) ? 'Lunas' : 'Belum Lunas';

            // Buat dan simpan objek DetailOrderan
            DetailOrderan::create([
                'id_transaksi' => $idTransaksiBaru2,
                'notrx' => $data['notrx'][$key],
                'id_pelanggan' => $value,
                'namabarang' => $data['namabarang'][$key],
                'keterangan' => $data['keterangan'][$key],
                'jumlah' => $data['jumlah'][$key],
                'harga' => $data['harga'][$key],
                'total' => $data['total'][$key],
                'uangmuka' => $data['uangmuka'],
                'subtotal' => $data['subtotal'],
                'sisa' => $data['sisa'],
                'status' => $status,
                'name_kasir' => $data['namakasir']
            ]);

            // dd($data);

            // Tambahkan notrx ke dalam array processedNotrx
            $processedNotrx[] = $data['notrx'][$key];
        }

        // Buat dan simpan objek KasMasuk jika notrx belum ada dalam processedNotrx
        foreach ($processedNotrx as $notrx) {
            if (!KasMasuk::where('id_generate', $notrx)->exists()) {
                $kasMasuk = new KasMasuk;
                $kasMasuk->id_generate = $notrx;
                $kasMasuk->keterangan = "Pemasukan dari invoice# " . $notrx;
                $kasMasuk->name_kasir = $user->name;

                if ($data['sisa'] == 0) {
                    $kasMasuk->pemasukan = $data['subtotal'];
                } else {
                    $kasMasuk->pemasukan = $data['uangmuka'];
                }

                $kasMasuk->save();
            }
        }

        return redirect('orderan')->with('msg', 'Data Berhasil Ditambahkan!');
    }

    // public function search(Request $request)
    // {


    //     return view('search-results', ['results' => $results]);
    // }

    public function tambahPelanggan(Request $request)
    {

        $pelanggan =  new Pelanggan;
        $pelanggan->kode_pelanggan = $request->kode;
        $pelanggan->nama = $request->nama;
        $pelanggan->nohp = $request->nohp;
        $pelanggan->email = $request->email;
        $pelanggan->alamat = $request->alamat;

        $pelanggan->save();

        return redirect()->back()->with('success', 'Data Berhasil Ditambahkan!');
    }


    public function pelunasan(Request $request)
    {
        // Ambil data dari form
        $via = $request->input('via');
        $jumlahBayar = $request->input('jumlahBayar');
        $totalBayar = $request->input('totalBayar');
        $caraBayar = $request->input('caraBayar');
        $buktiTransfer = $request->file('buktiTransfer');

        $bank = $caraBayar === 'tunai' ? 'tunai' : $via;

        // Simpan data pelunasan ke dalam tabel pelunasan_orderans
        $pelunasan = PelunasanOrderan::create([
            'notrx' => $request->input('notrx'),
            'total_bayar' => $jumlahBayar,
            'bank' => $caraBayar,
            'via' => $via,
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

        // dd($pelunasan);

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
                'pemasukan' => $pemasukan->pemasukan + $jumlahBayar,
                'bank' => $bank
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
        $user = Auth::user();
        $orderans = DetailOrderan::where('notrx', $notrx)->select('*', 'created_at')->get()->groupBy('notrx');
        $data = DetailOrderan::all();
        $setting = setting::all();
        $via = PelunasanOrderan::select('bank', 'via')->where('notrx', $notrx)->get();
        $logo = setting::all();
        $rekening = Rekening::all();

        $formatTgl = $orderans->map(function ($orderanGroup) {
            $orderanGroup->formatted_date = Carbon::parse($orderanGroup->first()->created_at)->isoFormat('dddd, DD/MM/YYYY');
            return $orderanGroup;
        });

        return view('orderan.print_invoice', [
            'orderans' => $orderans,
            'data' => $data,
            'notrx' => $notrx,
            'settings' => $setting,
            'via' =>  $via,
            'logo' => $logo,
            'rekening' => $rekening,
            'user' => $user,
            'formatTgl' => $formatTgl
        ]);

        // dd($logo);
        // $pdf = PDF::loadView('orderan.print_invoice', [
        //     'orderans' => $orderans,
        //     'data' => $data,
        //     'notrx' => $notrx,
        //     'settings' => $setting,
        //     'via' =>  $via,
        //     'logo' => $logo
        // ]);

        // return $pdf->download($notrx . '_invoice.pdf');
    }
    public function printInvoice58($notrx)
    {
        $user = Auth::user();
        $orderans = DetailOrderan::with('pelanggans')->where('notrx', $notrx)->select('*', 'created_at')->get()->groupBy('notrx');
        $setting = setting::all();
        $via = PelunasanOrderan::select('bank', 'via')->where('notrx', $notrx)->get();
        $logo = setting::all();
        $rekening = Rekening::all();
        $dataOrderan = DetailOrderan::with('pelanggans')->select('status', 'sisa')->where('notrx', $notrx)->get();


        $formatTgl = $orderans->map(function ($orderanGroup) {
            $orderanGroup->formatted_date = Carbon::parse($orderanGroup->first()->created_at)->isoFormat('dddd, DD/MM/YYYY');
            return $orderanGroup;
        });

        // cek orderan pada tabel detail_orderan, jika status lunas dan tidak lunas maka buatkan src ke stamp lunas
        foreach ($dataOrderan as $datas) {
            if ($datas->status == 'Lunas') {
                $stamp = 'assets/images/settings/' . $setting->first()->logo_lunas;
                $alt = 'LUNAS';
            } elseif ($datas->status == 'Belum Lunas') {
                $stamp = 'assets/images/settings/' . $setting->first()->logo_blunas;
                $alt = 'BELUM LUNAS';
            }
            // dd($dataOrderan);
        }

        return view('orderan.print_invoice58', [
            'orderans' => $orderans,
            'notrx' => $notrx,
            'settings' => $setting,
            'via' =>  $via,
            'logo' => $logo,
            'rekening' => $rekening,
            'user' => $user,
            'formatTgl' => $formatTgl,
            'stamp' => $stamp,
            'alt' => $alt
        ]);
    }
}
