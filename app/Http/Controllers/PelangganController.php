<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $datas = Pelanggan::all();

        return view('pelanggan.data', [
            'user' => $user,
            'title' => env('APP_NAME') . ' | ' . 'Pelanggan',
            'breadcrumb' => 'Pelanggan',
            'data' => $datas,

        ]);
    }

    public function tambahPelanggan()
    {
        $user = Auth::user();

        return view('pelanggan.tambah', [
            'user' => $user,
            'title' => 'Pelanggan',
            'breadcrumb' => 'Pelanggan',
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
    public function store(StorePelangganRequest $request)
    {
        $user = Auth::user();

        $pelanggan = new Pelanggan;

        $pelanggan->kode_pelanggan = $request->kodepelanggan;
        $pelanggan->nama = $request->namapelanggan;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->nohp = $request->nohp;
        $pelanggan->email = $request->email;
        $pelanggan->save();

        // dd($pelanggan);

        return redirect('pelanggan')->with('msg', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        $pelanggan = Pelanggan::find($id);

        return view('pelanggan.edit', [
            'title' => 'Edit Pelanggan',
            'user' => $user,
        ])->with([
            'id' => $id,
            'nama' => $pelanggan->nama,
            'alamat' => $pelanggan->alamat,
            'email' => $pelanggan->email,
            'nohp' => $pelanggan->nohp,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, $id)
    {
        $data = Pelanggan::find($id);

        if (!$data) {
            return redirect('karyawan')->with('error', 'Data not found.');
        }

        // $data->id = $request->txtid;
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->email = $request->email;
        $data->nohp = $request->nohp;
        $data->save();

        return redirect('pelanggan')->with('msg', 'Data Berhasil Di-update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();

        return redirect('pelanggan')->with('msg', 'Data Berhasil Di-hapus!');
    }
}
