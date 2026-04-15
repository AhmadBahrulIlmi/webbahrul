<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['kode_produk', 'nama_produk', 'jenis', 'warna', 'ukuran', 'harga'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'produk_id');
    }
}