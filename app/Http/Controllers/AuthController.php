<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    function index()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        //menyimpan username yang diinput user ke session sementara agar tetap muncul jika login gagal
        Session::flash('username', $request->username);

        //validasi Inputan Login
        $request->validate([
            'username' => 'required|string',
            'password' => 'required'
        ]);

        //mencari data user pada database
        $user = User::where('username', $request->username)->first();

        if (!$user) {
            //jika username tidak ditemukan pada database maka fokus ke field username
            return back()->withErrors([
                'username' => 'Username tidak ditemukan!',
            ])->onlyInput('username');
        }

        if (!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            //jika password tidak ditemukan pada database maka fokus ke field username
            return back()->withErrors([
                'password' => 'Password salah!',
            ])->onlyInput('username');
        }

        $request->session()->regenerate();
        //jika validasi berhasil maka ke menu dashboard
        return redirect()->intended('/dashboard');
    }
    function logout(){
        Auth::logout();
        return redirect()->route('auth.index')->with('success', 'Logout Berhasil');
    }
}