<?php

namespace App\Http\Controllers;

use App\Imports\TransaksiImport;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        //variabel yang menampung data produk
        $produk = Produk::all();
        //variabel yang menampung data transaksi
        $query = Transaksi::with('produk');

        //kondisi untuk mencari data produk berdasarkan id produk
        if ($request->filled('produk_id')) {
            $query->where('produk_id', $request->produk_id);
        }
        //kondisi untuk mencari tanggal transaksi
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $transaksi = $query->paginate(10)->appends($request->all());

        return view('transaksi.index', compact('transaksi', 'produk'));
    }


    public function store(Request $request)
    {
        //validasi inputan data transaksi
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah'    => 'required|numeric|min:1',
            'tanggal'   => 'required|date',
        ]);

        //cari data produk berdasasrkan id produk
        $produk = Produk::findOrFail($request->produk_id);
        //hitung total harga yang diambil dari data produk dikali dengan jumlah transaksi
        $total  = $produk->harga * $request->jumlah;

        //menyimpan ke tabel transaksi
        $simpan = Transaksi::create([
            'produk_id'   => $request->produk_id,
            'jumlah'      => $request->jumlah,
            'tanggal'     => $request->tanggal,
            'total_harga' => $total,
        ]);

        //kondisi untuk mengecek apakah sidah tersimpan pada database
        if ($simpan) {
            return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil disimpan!');
        } else {
            return Redirect::back()->with('warning', 'Data transaksi gagal disimpan!');
        }
    }

    public function edit($id)
    {
        //variabel yang menampung data transaksi berdasarkan id
        $transaksi = Transaksi::findOrFail($id);
        //variabel yang menampung data produk
        $produk = Produk::all();
        return view('transaksi.edit', compact('transaksi', 'produk'));
    }

    public function update(Request $request, $id)
    {
        //validasi inputan ubah data produk
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        //mengubah data transaksi berdasarkan id
        $transaksi = Transaksi::findOrFail($id);
        $update = $transaksi->update($request->all());

        //kondisi untuk mengecek apakah sidah teredit pada database
        if ($update) {
            return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil diupdate!');
        } else {
            return Redirect::back()->with('warning', 'Data transaksi gagal diupdate!');
        }
    }

    public function delete($id)
    {
        //variabel yang menampung data transaksi berdasarkan id
        $transaksi = Transaksi::findOrFail($id);
        $delete = $transaksi->delete();

        if ($delete) {
            return redirect()->route('transaksi.index')->with('success', 'Data transaksi berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data transaksi gagal dihapus!');
        }
    }

    public function import(Request $request)
    {
        //validasi file yang harus berupa file excel
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        //fungsi import data transaksi
        Excel::import(new TransaksiImport, $request->file('file'));

        return back()->with('success', 'Data Transaksi berhasil diimport!');
    }
}