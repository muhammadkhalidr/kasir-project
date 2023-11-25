<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = User::where('id', $user->id)->get();
        return view('profile.index', [
            'title' => 'Profile',
            'breadcrumb' => 'Profile',
            'user' => $user,
            'data' => $data,
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
    public function store(StoreProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->has('passwordLama')) {
            // Logika untuk mengubah password
            $validatedData = $request->validate([
                'passwordLama' => 'required',
                'passwordBaru' => 'required|min:4',
                'konfirmasiPassword' => 'required|same:passwordBaru',
            ]);

            if (!Hash::check($request->passwordLama, $user->password)) {
                return back()->with('error', 'Password Lama Salah');
            }

            $user->password = Hash::make($request->passwordBaru);
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Password berhasil diubah');
        } elseif ($request->hasFile('foto')) {
            // Logika untuk mengubah foto
            $validatedData = $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan kebutuhan Anda
            ]);

            $foto_file = $request->file('foto');
            $foto_name = $foto_file->hashName();
            $foto_file->move(public_path('assets/images/avatar'), $foto_name);

            $user->foto = $foto_name;
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Foto berhasil diubah');
        } elseif ($request->has('nama') || $request->has('username') || $request->has('email')) {
            $validatedData = $request->validate([
                'nama' => 'required',
                'username' => 'required|unique:users,username,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
            ]);

            $user->name = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Data berhasil diperbarui');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
