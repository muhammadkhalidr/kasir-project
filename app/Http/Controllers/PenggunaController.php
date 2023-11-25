<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(auth()->user()->getRoleNames());
        // if (auth()->user()->can('pengguna.data')) {

        //     $user = Auth::user();
        //     return view('pengguna.data');
        // }

        // return view('errors.403');

        $user = Auth::user();
        $datas = User::all()->where('level', 1);
        return view('pengguna.data', [
            'title' => 'Data Admin',
            'breadcrumb' => 'Pengguna',
            'user' => $user,
            'penggunas' => $datas,
        ]);
    }

    public function tambahPengguna()
    {
        $user = Auth::user();
        return view('pengguna.tambah', [
            'title' => 'Tambah Pengguna',
            'breadcrumb' => 'Pengguna',
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenggunaRequest $request)
    {
        $user = Auth::user();
        $validate = $request->validated();

        $penggunas = new User;
        $penggunas->name = $request->nama;
        $penggunas->email = $request->email;
        $penggunas->username = $request->username;
        $penggunas->password = $request->password;
        $penggunas->level = $request->level;
        $penggunas->save();

        return redirect('pengguna')->with('msg', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penggunas = User::findOrFail($id);

        return view('pengguna.edit', ['title' => 'Edit Pengguna', 'breadcrumb' => 'Edit Pengguna'])->with([
            'nama' => $penggunas->name,
            'email' => $penggunas->email,
            'username' => $penggunas->username,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenggunaRequest $request, $id)
    {
        $data = User::findOrFail($id);

        $data->name = $request->nama;
        $data->email = $request->txtemail;
        $data->username = $request->username;
        $data->save();

        return redirect('pengguna')->with('msg', 'Data Berhasil Di-update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $datas = User::findOrFail($id);
        $datas->delete();

        return redirect('pengguna')->with('msg', 'Data Berhasil Di-hapus!');
    }
}
