<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peramalan extends Model
{
    use HasFactory;
    protected $table = 'peramalan';
    protected $fillable = [
        'produk_id',
        'periode',
        'label_periode',   // misalnya "April 2024" atau "06 - 12 Mei 2024"
        'penjualan',       // data aktual penjualan
        's1',              // S' t
        's2',              // S'' t
        'at',              // at
        'bt',              // bt
        'ft',              // Ft (forecast)
        'alpha',           // nilai alpha smoothing
        'mae',             // nilai MAE error
        'mape',            // nilai MAPE error
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}