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
        //menyimpan email yang diinput user ke session sementara agar tetap muncul jika login gagal
        Session::flash('email', $request->email);

        //validasi Inputan Login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //mencari data user pada database
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            //jika email tidak ditemukan pada database maka fokus ke field email
            return back()->withErrors([
                'email' => 'Email tidak ditemukan!',
            ])->onlyInput('email');
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //jika password tidak ditemukan pada database maka fokus ke field email
            return back()->withErrors([
                'password' => 'Password salah!',
            ])->onlyInput('email');
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