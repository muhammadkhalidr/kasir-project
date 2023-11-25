<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\setting;

class LoginController extends Controller
{
    public function index()
    {
        $logo = setting::all();

        return view('pages.login', [
            'logo' => $logo,
        ]);
    }

    public function proses(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username tidak boleh kosong',
                'password.required' => 'Password Tidak Boleh Kosong',
            ]
        );

        $kredensial = $request->only('username', 'password');
        if (Auth::attempt($kredensial)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->to('home');
            } elseif ($user->hasRole('owner')) {
                return redirect()->to('home');
            }

            return redirect()->intended('/');
        }

        return back()->with(['msg' => 'Username atau password salah!'])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
