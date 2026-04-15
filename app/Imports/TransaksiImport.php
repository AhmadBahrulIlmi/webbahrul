<?php

namespace App\Imports;

use App\Models\Produk;
use App\Models\Transaksi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TransaksiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $produk = Produk::where('nama_produk', $row['produk_id'])->first();
        if ($produk) {
            $tanggalCell = $row['tanggal'];
            if (is_numeric($tanggalCell)) {
                $tanggal = Date::excelToDateTimeObject($tanggalCell)->format('Y-m-d');
            } else {
                $tanggal = Carbon::parse($tanggalCell)->format('Y-m-d');
            }
            return new Transaksi([
                'produk_id' => $produk->id,
                'jumlah' => $row['jumlah'],
                'tanggal' => $tanggal,
                'total_harga' => $produk->harga * $row['jumlah'],
            ]);
        }
        return null;
    }
}