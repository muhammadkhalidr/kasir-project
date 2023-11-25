<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Requests\StoreKaryawanRequest;
use App\Http\Requests\UpdateKaryawanRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $karyawans = Karyawan::all();
        return view('karyawan.main', [
            'title' => 'Data Karyawan',
            'breadcrumb' => 'Data Karyawan',
            'user' => $user,
            'karyawans' => $karyawans,
        ]);
    }

    public function tambahKaryawan()
    {
        $user = Auth::user();
        return view('karyawan.tambah', [
            'title' => 'Tambah Karyawan',
            'breadcrumb' => 'Karyawan',
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryawanRequest $request)
    {
        $validate = $request->validated();


        $karyawans = new Karyawan;
        $karyawans->id_karyawan = $request->txtid;
        $karyawans->nama_karyawan = $request->txtnama;
        $karyawans->Alamat = $request->txtalamat;
        $karyawans->email = $request->txtemail;
        $karyawans->no_hp = $request->txtphone;

        if ($request->hasFile('txtfoto')) {
            $foto_file = $request->file('txtfoto');
            $foto_name = $foto_file->hashName();
            $foto_file->move(public_path('assets/images/fotokaryawan'), $foto_name);

            $karyawans['foto'] = $foto_name;
        }
        $karyawans->save();

        return redirect('karyawan')->with('msg', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_karyawan)
    {
        $user = Auth::user();
        $karyawan = Karyawan::find($id_karyawan);

        return view('karyawan.edit', [
            'title' => 'Edit Karyawan',
            'user' => $user,
            ])->with([
            'txtid' => $id_karyawan,
            'txtnama' => $karyawan->nama_karyawan,
            'txtalamat' => $karyawan->alamat,
            'txtemail' => $karyawan->email,
            'txtphone' => $karyawan->no_hp,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKaryawanRequest $request, $id_karyawan)
    {
        $data = Karyawan::find($id_karyawan);

        if (!$data) {
            return redirect('karyawan')->with('error', 'Data not found.');
        }

        $data->id_karyawan = $request->txtid;
        $data->nama_karyawan = $request->txtnama;
        $data->alamat = $request->txtalamat;
        $data->email = $request->txtemail;
        $data->no_hp = $request->txtphone;
        $data->save();

        return redirect('karyawan')->with('msg', 'Data Berhasil Di-update!');
    }


    /** 
     * Remove the specified resource from storage.
     */
    public function destroy($id_karyawan)
    {
        $karyawan = Karyawan::findOrFail($id_karyawan);

        $foto_file = public_path('assets/images/fotokaryawan/' . $karyawan->foto);
        if (file_exists($foto_file)) {
            unlink($foto_file);
        }
        $karyawan->delete();
        return redirect('karyawan')->with('msg', 'Data Berhasil Di-hapus!');
    }
}
