<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $produk = Produk::when($request->kode_produk, function($query) use ($request) {
            $query->where('kode_produk', 'like', '%' . $request->kode_produk . '%');
        })->paginate(4);

        return view('produk.index', compact('produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produk',
            'foto_produk' => 'required|image',
            'spik_produk' => 'required|image',
            'keterangan' => 'required',
        ]);

        $data = $request->all();

        // upload foto produk
        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $namaFile = time().'_foto.'.$file->getClientOriginalExtension();
            $file->move(public_path('foto'), $namaFile);
            $data['foto_produk'] = $namaFile;
        }

        // upload spik produk (gambar)
        if ($request->hasFile('spik_produk')) {
            $file = $request->file('spik_produk');
            $namaFile = time().'_spik.'.$file->getClientOriginalExtension();
            $file->move(public_path('foto'), $namaFile);
            $data['spik_produk'] = $namaFile;
        }

        $simpan = Produk::create($data);

        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk && File::exists(public_path('foto/' . $produk->foto_produk))) {
                File::delete(public_path('foto/' . $produk->foto_produk));
            }
            $file = $request->file('foto_produk');
            $namaFile = time().'_foto.'.$file->getClientOriginalExtension();
            $file->move(public_path('foto'), $namaFile);

            $data['foto_produk'] = $namaFile;
        }
        if ($request->hasFile('spik_produk')) {
            if ($produk->spik_produk && File::exists(public_path('foto/' . $produk->spik_produk))) {
                File::delete(public_path('foto/' . $produk->spik_produk));
            }
            $file = $request->file('spik_produk');
            $namaFile = time().'_spik.'.$file->getClientOriginalExtension();
            $file->move(public_path('foto'), $namaFile);

            $data['spik_produk'] = $namaFile;
        }

        $update = $produk->update($data);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data berhasil diupdate!']);
        } else {
            return Redirect::back()->with(['warning' => 'Data gagal diupdate!']);
        }
    }

    public function delete($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->foto_produk && File::exists(public_path('foto/' . $produk->foto_produk))) {
            File::delete(public_path('foto/' . $produk->foto_produk));
        }
        if ($produk->spik_produk && File::exists(public_path('foto/' . $produk->spik_produk))) {
            File::delete(public_path('foto/' . $produk->spik_produk));
        }
        $produk->delete();

        if ($produk) {
            return redirect()->route('produk.index')->with('success', 'Data berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data gagal dihapus!');
        }
    }
}