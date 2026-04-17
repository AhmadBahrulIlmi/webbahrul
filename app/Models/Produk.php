<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['kode_produk',  'foto_produk', 'spik_produk', 'keterangan'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'produk_id');
    }
}