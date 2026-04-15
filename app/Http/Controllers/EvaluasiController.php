<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluasiController extends Controller
{
    public function index()
    {
        $produk = Produk::all();

        // Ambil seluruh data peramalan dari DB
        $dataPeramalan = DB::table('peramalan')->get();

        // Kelompokkan berdasarkan produk_id + alpha
        $kelompok = $dataPeramalan->groupBy(function ($item) {
            return $item->produk_id . '-' . $item->alpha;
        });

        $rekapPeramalan = [];

        foreach ($kelompok as $key => $items) {
            $first = $items->first();
            $produkId = $first->produk_id;
            $periode = $first->periode;
            $alpha = $first->alpha;

            $data = $items->map(function ($item) {
                return [
                    'jumlah' => $item->penjualan,
                    'forecast' => $item->ft,
                ];
            })->toArray();

            $rekapPeramalan[] = [
                'produk' => $produk->firstWhere('id', $produkId)?->nama_produk ?? '-',
                'produk_id' => $produkId,
                'periode' => $periode,
                'alpha' => $alpha,
                'mae' => $this->calculateMae($data),
                'mape' => $this->calculateMape($data),
            ];
        }

        // Kelompokkan data rekap per produk + periode untuk cari alpha terbaik per kombinasi
        $bestPeramalan = [];

        $groupedByProdukPeriode = collect($rekapPeramalan)->groupBy(function ($item) {
            return $item['produk'] . '-' . $item['periode'];
        });

        foreach ($groupedByProdukPeriode as $key => $group) {
            // Urutkan berdasar MAE terkecil, ambil yang pertama (alpha terbaik)
            $bestAlpha = $group->sortBy('mae')->first();
            $bestPeramalan[$key] = $bestAlpha;
        }

        // Ambil hanya data peramalan dari alpha terbaik
        $bestKeys = collect($bestPeramalan)->map(function ($item) {
            return $item['produk_id'] . '-' . $item['alpha'] . '-' . $item['periode'];
        });

        $dataPeramalanFiltered = $dataPeramalan->filter(function ($item) use ($bestKeys) {
            $key = $item->produk_id . '-' . $item->alpha . '-' . $item->periode;
            return $bestKeys->contains($key);
        });

        $dataPeramalanGrouped = $dataPeramalanFiltered->groupBy('produk_id');

        $stokForecast = [];
        $totalForecastStok = 0;

        foreach ($dataPeramalanGrouped as $produkId => $items) {
            $totalForecast = 0;
            $periodeCount = 0;

            foreach ($items as $item) {
                if (is_null($item->penjualan) && $item->ft > 0) {
                    $totalForecast += $item->ft;
                    $periodeCount++;
                }
            }

            if ($totalForecast > 0) {
                $namaProduk = $produk->firstWhere('id', $produkId)?->nama_produk ?? '-';
                $stokForecast[$namaProduk] = [
                    'periode' => $periodeCount,
                    'total' => round($totalForecast)
                ];
                $totalForecastStok += $totalForecast;
            }
        }

        return view('evaluasi.index', compact('rekapPeramalan', 'bestPeramalan', 'stokForecast', 'totalForecastStok'));
    }

    private function calculateMae($data)
    {
        $total = 0;
        $n = count($data);

        foreach ($data as $d) {
            $total += abs($d['jumlah'] - $d['forecast']);
        }

        return $n > 0 ? $total / $n : 0;
    }

    private function calculateMape($data)
    {
        $total = 0;
        $count = 0;

        foreach ($data as $d) {
            if ($d['jumlah'] != 0) {
                $total += abs(($d['jumlah'] - $d['forecast']) / $d['jumlah']);
                $count++;
            }
        }

        return $count > 0 ? ($total / $count) * 100 : 0;
    }
    public function delete()
    {
        DB::table('peramalan')->truncate(); // Hapus semua data di tabel peramalan
        return redirect()->route('evaluasi.index')->with('success', 'Data peramalan berhasil dihapus.');
    }

}