<?php

namespace App\Http\Controllers;

use App\Models\GajiKaryawan;
use App\Http\Requests\StoreGajiKaryawanRequest;
use App\Http\Requests\UpdateGajiKaryawanRequest;
use App\Models\Karyawan;
use App\Models\KasMasuk;
use Illuminate\Support\Facades\Auth;

class GajiKaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $gajikaryawans = GajiKaryawan::all();
        $karyawans = Karyawan::all();

        return view('gaji.data', [
            'title' => 'Gaji Karyawan',
            'breadcrumb' => 'Gaji Karyawan',
            'user' => $user,
            'gajikaryawans' => $gajikaryawans,
            'karyawans' => $karyawans,
        ]);
    }

    public function tambahGaji()
    {
        $user = Auth::user();
        $gajikaryawans = GajiKaryawan::all();
        $karyawans = Karyawan::all();

        return view('gaji.tambah', [
            'title' => 'Tambah Gaji Karyawan',
            'breadcrumb' => 'Gaji Karyawan',
            'user' => $user,
            'gajikaryawans' => $gajikaryawans,
            'karyawans' => $karyawans,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGajiKaryawanRequest $request)
    {
        $validated = $request->validated();

        $gajikaryawan = new GajiKaryawan;
        $kasMasuk = new KasMasuk;

        $gajikaryawan->nama_karyawan = $request->txtnama;
        $gajikaryawan->jumlah_kerja = $request->txtjumlahkerja;
        $gajikaryawan->persen_gaji = $request->txtpersen;
        $gajikaryawan->jumlah_gaji = $request->txtgaji;
        $gajikaryawan->save();

        $kasMasuk->keterangan = "Gaji untuk " . $request->txtnama;
        $kasMasuk->pengeluaran = $request->txtgaji;
        $kasMasuk->save();

        return redirect('gajikaryawan')->with('msg', 'Data Berhasil Ditambahkan!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_gaji)
    {
        $gajikaryawan = GajiKaryawan::findOrFail($id_gaji);
        $gajikaryawan->delete();

        return redirect('gajikaryawan')->with('msg', 'Data Berhasil Di-hapus!');
    }
}
