<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Http\Requests\StoreHutangRequest;
use App\Http\Requests\UpdateHutangRequest;
use App\Models\KasMasuk;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = Hutang::all();

        return view('hutang.index', [
            'title' => env('APP_NAME') . ' | ' . 'Hutang',
            'breadcrumb' => 'Hutang',
            'hutangs' => $data,
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHutangRequest $request)
    {
        $validated = $request->validated();

        $hutangBaru = Hutang::latest('id_hutang')->first();

        if ($hutangBaru) {
            $idLama = $hutangBaru->id_generate;
            $idNumber = (int)substr($idLama, 2) + 1;
            $idBaru = 'H-' . str_pad($idNumber, 3, '0', STR_PAD_LEFT);
        } else {
            $idBaru = 'H-001';
        }

        $hutang = new Hutang;

        $hutang->id_generate = $idBaru;
        $hutang->nama = $request->nama;
        $hutang->jumlah = $request->jumlah;
        $hutang->total = $request->total;

        try {
            // Cek saldo kas masuk
            $saldoKasMasuk = KasMasuk::sum('pemasukan');
            if ($saldoKasMasuk && $saldoKasMasuk < $hutang->total) {
                return redirect('hutang')->with('error', 'Saldo tidak cukup!');
            }

            $hutang->save();

            $kasMasuk = new KasMasuk;
            $kasMasuk->id_generate = $idBaru;
            $kasMasuk->keterangan = "Hutang " . $request->nama;
            $kasMasuk->pengeluaran = $request->total;
            $kasMasuk->save();
        } catch (Exception $e) {
            return redirect('hutang')->with('error', $e->getMessage());
        }

        return redirect('hutang')->with('msg', 'Data Berhasil Ditambahkan!');
    }



    /**
     * Display the specified resource.
     */
    public function show()
    {
    }

    public function bayarHutang(Request $request)
    {
        $request->validate([
            'id_hutang' => 'required|exists:hutangs,id_hutang',
            'jml_bayar' => 'required|numeric|min:0',
        ]);

        $id_hutang = $request->id_hutang;
        $jml_bayar = $request->jml_bayar;

        $hutang = Hutang::findOrFail($id_hutang);

        $total_hutang_sebelumnya = $hutang->total;

        if ($jml_bayar > $total_hutang_sebelumnya) {
            return redirect('hutang')->with('error', 'Jumlah pembayaran melebihi total hutang!');
        }

        DB::beginTransaction();

        try {
            $hutang->total = $total_hutang_sebelumnya - $jml_bayar;
            $hutang->save();

            $kasMasuk = KasMasuk::where('keterangan', 'Hutang ' . $hutang->nama)->first();

            if ($kasMasuk) {
                $kasMasuk->pemasukan += $jml_bayar;
                $kasMasuk->save();
            } else {
                $newKasMasuk = new KasMasuk();
                $newKasMasuk->keterangan = 'Hutang ' . $hutang->nama;
                $newKasMasuk->pemasukan = $jml_bayar;
                $newKasMasuk->save();
            }

            DB::commit();

            return redirect('hutang')->with('msg', 'Pembayaran hutang berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('hutang')->with('error', 'Terjadi kesalahan, pembayaran dibatalkan!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHutangRequest $request, $id_hutang)
    {
        $hutang = Hutang::findOrFail($id_hutang);

        $hutang->nama = $request->nama;
        $hutang->jumlah = $request->jumlah;
        $hutang->total = $request->total;
        $hutang->save();

        return redirect('hutang')->with('msg', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_generate)
    {
        $hutang = Hutang::findOrFail($id_generate);
        $kasMasuk = KasMasuk::where('id_generate', $hutang->id_generate)->first();

        $hutang->delete();
        $kasMasuk->delete();

        return redirect('hutang')->with('msg', 'Data Berhasil Dihapus!');
    }
}
