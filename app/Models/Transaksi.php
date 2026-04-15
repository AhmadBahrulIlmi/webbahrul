<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['produk_id', 'jumlah', 'tanggal', 'total_harga',];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}