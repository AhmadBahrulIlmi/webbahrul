<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        //variabel yang menampung data produk
        $query = Produk::query();

        //mencari data produk berdasarkan nama produk
        $produk = Produk::when($request->nama_produk, function($query) use ($request) {
            $query->where('nama_produk', $request->nama_produk);
        })->paginate(4);

        //menampung data produk untuk dropdown
        $namaProdukList = Produk::pluck('nama_produk')->unique();

        return view('produk.index', compact('produk', 'namaProdukList'));
    }


    public function store(Request $request)
    {
        //validasi inputan nilai pada tambah produk
        $request->validate([
            'kode_produk' => 'required|unique:produk',
            'nama_produk' => 'required',
            'jenis' => 'required',
            'warna' => 'required',
            'ukuran' => 'required',
            'harga' => 'required|numeric',
        ]);
        //menyimpan data produk yang sudah divalidasi
        $simpan = Produk::create($request->all());

        //kondisi untuk mengecek apakah sidah tesimpan pada database
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($id)
    {
        //varibel yang menampung data produk berdasarkan id produk
        $produk = Produk::findOrFail($id);
        //menampilannya ke modal edit produk
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        //validasi inputan edit produk
        $request->validate([
            'nama_produk' => 'required',
            'jenis' => 'required',
            'warna' => 'required',
            'ukuran' => 'required',
            'harga' => 'required|numeric',
        ]);

        //mencari data produk berdasarkan id yang akan diubah
        $produk = Produk::findOrFail($id);
        $update = $produk->update($request->all());

        //kondisi untuk mengecek apakah sidah terubah pada database
        if ($update) {
            return Redirect::back()->with(['success' => 'Data produk berhasil diupdate!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data produk gagal diupdate!']);
        }
    }

    public function delete($id)
    {
        //mecari data produk berdasarkan id
        $produk = Produk::findOrFail($id);
        //variabel untuk mengahapus data produk
        $delete = $produk->delete();

        if ($delete) {
            return redirect()->route('produk.index')->with('success', 'Data produk berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data produk gagal dihapus!');
        }
    }
}