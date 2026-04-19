<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahProduk = Produk::count();
        $jumlahUser = User::count();
        $produk = Produk::latest()->take(5)->get();
        $produkUpdate = Produk::orderBy('updated_at', 'desc')->take(3)->get();

        return view('dashboard.dashboard', compact(
            'jumlahProduk',
            'jumlahUser',
            'produk',
            'produkUpdate'
        ));
    }
}