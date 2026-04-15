<?php

namespace App\Http\Controllers;


use App\Models\Produk;
use App\Models\Peramalan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PeramalanController extends Controller
{
    public function index(Request $request)
    {
        //variabel yang menampung data produk
        $produk = Produk::all();
        //variabel yang menampung id produk
        $idProduk = $request->produk_id;
        //variabel parameter alpha
        $alpha = $request->alpha;
        //periode mingguan atau bulanan
        $periode = $request->periode ?? 'mingguan';
        $ramalPeriode = $request->ramal_periode ?? 0;
        $totalCashFlowForecast = 0;
        $forecastPeriodsCount = 0;

        $hasil = [];
        $mae = null;
        $mape = null;
        $bestAlpha = null;

        if ($idProduk && $alpha) {
            if ($alpha == 'otomatis') {
                $minError = null;
                for ($a = 0.1; $a <= 0.9; $a += 0.1) {
                    $a = round($a, 1);
                    $testHasil = $this->hitungPeramalan($idProduk, $a, $periode, $ramalPeriode);
                    $testMae = $this->hitungMAE($testHasil);
                    $testMape = $this->hitungMAPE($testHasil);
                    $error = ($periode === 'bulanan') ? $testMape : $testMae;

                    if ($minError === null || $error < $minError) {
                        $minError = $error;
                        $bestAlpha = $a;
                        $hasil = $testHasil;
                        $mae = $testMae;
                        $mape = $testMape;
                    }
                }
                $alpha = $bestAlpha;
            } else {
                $alphaFloat = floatval($alpha);
                $hasil = $this->hitungPeramalan($idProduk, $alphaFloat, $periode, $ramalPeriode);
                $mae = $this->hitungMAE($hasil);
                $mape = $this->hitungMAPE($hasil);

                $bestAlpha = $alphaFloat;
                $minError = ($periode === 'bulanan') ? $mape : $mae;

                for ($a = 0.1; $a <= 0.9; $a += 0.1) {
                    $a = round($a, 1);
                    if ($a == $alphaFloat) continue;

                    $testHasil = $this->hitungPeramalan($idProduk, $a, $periode, $ramalPeriode);
                    $testMae = $this->hitungMAE($testHasil);
                    $testMape = $this->hitungMAPE($testHasil);
                    $error = ($periode === 'bulanan') ? $testMape : $testMae;

                    if ($error < $minError) {
                        $minError = $error;
                        $bestAlpha = $a;
                    }
                }
            }
        }

        if ($ramalPeriode > 0) {
            foreach ($hasil as $item) {
                if ($item['jumlah'] === null && isset($item['cash_flow'])) {
                    $totalCashFlowForecast += $item['cash_flow'];
                    $forecastPeriodsCount++;
                }
            }
        }

        $hasilAplha = request('alpha') === 'Otomatis' ? $bestAlpha : $alpha;

        return view('peramalan.index', compact(
            'produk', 'hasil', 'mae', 'mape', 'idProduk', 'alpha', 'periode', 'ramalPeriode', 'bestAlpha', 'totalCashFlowForecast', 'forecastPeriodsCount', 'hasilAplha'
        ));
    }

    private function hitungPeramalan($idProduk, $alpha, $periode, $ramalPeriode = 0)
    {
        //variabel yang menampung id produk
        $produk = Produk::find($idProduk);
        $hargaProduk = $produk ? $produk->harga : 0;

        if ($periode === 'bulanan') {
            //ambil data total penjualan per bulan untuk produk tertentu
            $data = DB::table('transaksi')
                ->selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan, SUM(jumlah) as jumlah')
                ->where('produk_id', $idProduk)
                ->groupByRaw('DATE_FORMAT(tanggal, "%Y-%m")')
                ->orderByRaw('DATE_FORMAT(tanggal, "%Y-%m")')
                ->get();
        } else {
            // Ambil data total penjualan per minggu untuk produk tertentu
            $data = DB::table('transaksi')
                ->selectRaw('YEARWEEK(tanggal, 1) as minggu, SUM(jumlah) as jumlah')
                ->where('produk_id', $idProduk)
                ->groupByRaw('YEARWEEK(tanggal, 1)')
                ->orderByRaw('YEARWEEK(tanggal, 1)')
                ->get();
        }

        //inisialisasi array hasil dan nilai smoothing
        $result = [];
        $s1 = $s2 = null;

        foreach ($data as $i => $row) {
            if ($periode === 'bulanan') {
                //mengubah menjadi label
                $label = Carbon::parse($row->bulan . '-01')->translatedFormat('F Y');
                $jumlah = $row->jumlah;
            } else {
                //mengambil dua digit terakhir
                $minggu = $row->minggu % 100;
                //untuk mengambil empat digit pertama
                $tahun = floor($row->minggu / 100);

                //menentukan tanggal awal dan akhir minggu
                $startOfWeek = Carbon::now()->setISODate($tahun, $minggu)->startOfWeek();
                $endOfWeek = $startOfWeek->copy()->endOfWeek();
                $label = $startOfWeek->translatedFormat('d') . ' - ' . $endOfWeek->translatedFormat('d F Y');

                $jumlah = $row->jumlah;
            }

            if ($i === 0) {
                //inisialisasi nilai smoothing untuk data pertama
                $s1 = $jumlah;
                $s2 = $jumlah;
            } else {
                //perhitungan smoothing pertama dan kedua
                $s1 = $alpha * $jumlah + (1 - $alpha) * $s1;
                $s2 = $alpha * $s1 + (1 - $alpha) * $s2;
            }

            $bt = ($alpha / (1 - $alpha)) * ($s1 - $s2);
            $at = 2 * $s1 - $s2;
            $forecast = $at + $bt;

            $mape = $jumlah != 0 ? abs(($jumlah - $forecast) / $jumlah) * 100 : null;
            $mae = abs($jumlah - $forecast);

            $cashFlow = null;
            if ($ramalPeriode > 0) {
                $cashFlow = $forecast * $hargaProduk;
            }

            $result[] = [
                'jumlah' => $jumlah,
                'periode' => $label,
                's2' => round($s2, 2),
                's1' => round($s1, 2),
                'bt' => round($bt, 2),
                'at' => round($at, 2),
                'mae' => round($mae, 2),
                'forecast' => round($forecast, 2),
                'mape' => $mape !== null ? round($mape, 2) : null,
                'cash_flow' => $cashFlow !== null ? round($cashFlow, 2) : null
            ];
        }

        //tambahan periode ramalan
        if ($ramalPeriode > 0 && count($result) > 0) {
            $lastAt = end($result)['at'];
            $lastBt = end($result)['bt'];
            $lastData = $data->last();

            for ($i = 1; $i <= $ramalPeriode; $i++) {
                $forecast = $lastAt + ($lastBt * $i);

                if ($periode === 'bulanan') {
                    $nextLabel = Carbon::parse($lastData->bulan . '-01')->addMonths($i)->translatedFormat('F Y');
                    //F Y = maret 2022
                } else {
                    $lastMinggu = $lastData->minggu;
                    $lastTahun = floor($lastMinggu / 100);
                    $lastMingguNumber = $lastMinggu % 100;

                    $mingguBaru = $lastMingguNumber + $i;
                    $tahunBaru = $lastTahun;

                    if ($mingguBaru > 52) {
                        $mingguBaru = $mingguBaru % 52;
                        if ($mingguBaru === 0) $mingguBaru = 52;
                        $tahunBaru += 1;
                    }

                    $start = Carbon::now()->setISODate($tahunBaru, $mingguBaru)->startOfWeek(1);
                    $end = $start->copy()->endOfWeek(7);

                    $nextLabel = $start->translatedFormat('d') . ' - ' . $end->translatedFormat('d F Y');
                }

                $cashFlow = $forecast * $hargaProduk;

                $result[] = [
                    'jumlah' => null,
                    'periode' => $nextLabel,
                    's2' => null,
                    's1' => null,
                    'bt' => round($lastBt, 2),
                    'at' => round($lastAt, 2),
                    'mae' => null,
                    'forecast' => round($forecast, 2),
                    'mape' => null,
                    'cash_flow' => round($cashFlow, 2)
                ];
            }
        }

        return $result;
    }


    private function hitungMAE($data)
    {
        $total = 0;
        $count = 0;

        foreach ($data as $d) {
            if ($d['jumlah'] !== null) {
                $total += abs($d['jumlah'] - $d['forecast']);
                $count++;
            }
        }

        return $count > 0 ? $total / $count : 0;
    }

    private function hitungMAPE($data)
    {
        $total = 0;
        $count = 0;

        foreach ($data as $d) {
            if ($d['jumlah'] != 0 && $d['jumlah'] !== null) {
                $total += abs(($d['jumlah'] - $d['forecast']) / $d['jumlah']);
                $count++;
            }
        }

        return $count > 0 ? ($total / $count) * 100 : 0;
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|integer',
            'periode' => 'required|string',
            'alpha' => 'required|numeric',
            'hasil' => 'required|string',
        ]);

        $produkId = $request->produk_id;
        $periode = $request->periode;
        $alpha = floatval($request->alpha);
        $hasil = json_decode($request->hasil, true);

        if (!$hasil || !is_array($hasil)) {
            return redirect()->back()->with('error', 'Data hasil peramalan tidak valid.');
        }

        Peramalan::where('produk_id', $produkId)
            ->where('periode', $periode)
            ->where('alpha', $alpha)
            ->delete();

        foreach ($hasil as $row) {
            Peramalan::create([
                'produk_id'     => $produkId,
                'periode'       => $periode,
                'label_periode' => $row['periode'],
                'penjualan'     => $row['jumlah'],
                's1'            => $row['s1'],
                's2'            => $row['s2'],
                'at'            => $row['at'],
                'bt'            => $row['bt'],
                'ft'            => $row['forecast'],
                'alpha'         => $alpha,
                'mae'           => $row['mae'],
                'mape'          => $row['mape'],
            ]);
        }

        return redirect()->route('peramalan.index')->with('success', 'Hasil peramalan berhasil disimpan.');
    }
}