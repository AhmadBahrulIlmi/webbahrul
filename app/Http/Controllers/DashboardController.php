<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //variabel yang menyimpan hasil penjumlahan data produk pada database
        $jumlahProduk = Produk::count();
        //variabel yang menyimpan hasil penjumalahan data transaksi pada database
        $jumlahTransaksi = Transaksi::count();
        //varibel yang menyimpan hasil penjumlahan data user pada database
        $jumlahUser = User::count();
        //variabel penjumlahan dari total jumlah transaksi
        $totalPenjualan = Transaksi::sum('jumlah');

        //variabel data untuk grafik penjualan bulanan
        $penjualanBulanan = Transaksi::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('SUM(jumlah) as total')
            )
            //diurutkan berdasarkan bulan
            ->groupBy('bulan')
            ->orderBy('bulan')
            //array untuk menampilkan ke grafik
            ->pluck('total', 'bulan');

        //variabel data penjualan produk untuk grafik
        $produkTerlaris = Transaksi::select('produk_id', DB::raw('SUM(jumlah) as jumlah_terjual'))
        //ambil data produk pada tabel produk
        ->with('produk')
        ->groupBy('produk_id')
        ->orderByDesc('jumlah_terjual')
        ->get();



        //urutkan dari yang terbaru (latest() = order by created_at desc)
        $transaksiTerbaru = Transaksi::latest()->take(5)->with('produk')->get();

        //mengirim semua data ke dashboard
        return view('dashboard.dashboard', compact(
            'jumlahProduk',
            'jumlahTransaksi',
            'jumlahUser',
            'totalPenjualan',
            'penjualanBulanan',
            'produkTerlaris',
            'transaksiTerbaru'
        ));








//         $penjualanMingguan = Transaksi::select(
//     DB::raw('WEEK(tanggal, 1) as minggu'), // 1 = minggu dimulai dari Senin
//     DB::raw('SUM(jumlah) as total')
// )
// ->groupBy('minggu')
// ->orderBy('minggu')
// ->pluck('total', 'minggu');
    }
}