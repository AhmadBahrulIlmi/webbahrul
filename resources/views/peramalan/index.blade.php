@extends('layouts.template')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Peramalan
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-12 align-items-center">
                <div class="col">
                    <div class="alert alert-info mb-0" role="alert"
                        style="background-color: #e7f3fe; border-left: 6px solid #2196F3; padding: 15px; color: #31708f;">
                        <strong>Informasi:</strong> Pastikan jika ingin meramal penjualan maka pilih produk yang akan
                        diramal,
                        kemudian pilih meramal berdasarkan mingguan atau bulanan dan juga pilih alpha yang akan digunakan
                        untuk menghitung peramalannya, terdapat juga periode ke untuk meramal penjualan berdasarkan periode
                        kedepan. Jika sudah diisi semua silahkan klik button Hitung. Maka akan muncul tabel perhitungan dan
                        juga hasil error prediksi dari perhitungan tersebut. Jika sudah mengitung anda bisa simpan hasil
                        peramalan yang nantinya akan dievaluasi dimenu evaluasi hasil.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body mb-lg-0">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
                                            <div class="toast align-items-center text-bg-success border-0 show"
                                                role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        {{ Session::get('success') }}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                        data-bs-dismiss="toast"></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (Session::get('warning'))
                                        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
                                            <div class="toast align-items-center text-bg-success border-0 show"
                                                role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="d-flex">
                                                    <div class="toast-body">
                                                        {{ Session::get('warning') }}
                                                    </div>
                                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                        data-bs-dismiss="toast"></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <form action="{{ route('peramalan.index') }}" method="POST">
                                        @csrf
                                        <div class="row g-3 align-items-center">
                                            <div class="col-12 col-md-4">
                                                <select name="produk_id" id="produk_id" class="form-select">
                                                    <option value="" disabled selected>Pilih Produk</option>
                                                    @foreach ($produk as $p)
                                                        <option {{ request('produk_id') == $p->id ? 'selected' : '' }}
                                                            value="{{ $p->id }}">
                                                            {{ $p->nama_produk }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-6 col-md-2">
                                                <select name="periode" class="form-select">
                                                    <option value="mingguan" {{ $periode == 'mingguan' ? 'selected' : '' }}>
                                                        Mingguan</option>
                                                    <option value="bulanan" {{ $periode == 'bulanan' ? 'selected' : '' }}>
                                                        Bulanan</option>
                                                </select>
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <select name="alpha" id="alpha" class="form-select">
                                                    <option value="otomatis"
                                                        {{ request('alpha') == 'otomatis' ? 'selected' : '' }}>Otomatis
                                                    </option>
                                                    @foreach ([0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9] as $a)
                                                        <option value="{{ $a }}"
                                                            {{ request('alpha') == $a ? 'selected' : '' }}>
                                                            {{ $a }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <input type="number" name="ramal_periode" class="form-control"
                                                    placeholder="Periode Ke-" value="{{ request('ramal_periode') }}"
                                                    min="1">
                                            </div>
                                            <div class="col-6 col-md-2">
                                                <button type="submit" class="btn btn-secondary w-100">Hitung</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if (!empty($hasil))
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                            <table class="table table-bordered table-striped text-nowrap">
                                                <thead class="bg-dark text-white" style="position: sticky; top: 0;">
                                                    <tr>
                                                        <th>Periode</th>
                                                        <th>Terjual</th>
                                                        <th>S't</th>
                                                        <th>S''t</th>
                                                        <th>at</th>
                                                        <th>bt</th>
                                                        <th>Ft</th>
                                                        <th>MAE</th>
                                                        <th>MAPE</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($hasil as $h)
                                                        <tr>
                                                            <td>{{ $h['periode'] }}</td>
                                                            <td>{{ $h['jumlah'] ?? '-' }}</td>
                                                            <td>{{ number_format($h['s1'], 2) }}</td>
                                                            <td>{{ number_format($h['s2'], 2) }}</td>
                                                            <td>{{ number_format($h['at'], 2) }}</td>
                                                            <td>{{ number_format($h['bt'], 2) }}</td>
                                                            <td
                                                                class="{{ $h['jumlah'] === null ? 'text-danger fw-bold' : '' }}">
                                                                {{ number_format($h['forecast'], 2) }}
                                                            </td>
                                                            <td>{{ number_format($h['mae'], 2) }}</td>
                                                            <td>{{ number_format($h['mape'], 2) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3">
                                            @if (!empty($hasil))
                                                <form action="{{ route('peramalan.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="produk_id" value="{{ $idProduk }}">
                                                    <input type="hidden" name="periode" value="{{ $periode }}">
                                                    <input type="hidden" name="alpha" value="{{ $alpha }}">
                                                    <input type="hidden" name="hasil" value="{{ json_encode($hasil) }}">
                                                    <button type="submit" class="btn btn-success mt-2">
                                                        Simpan Hasil Peramalan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Kesimpulan Peramalan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    @if (isset($mae) && isset($mape))
                                        <tr>
                                            <th>Alpha</th>
                                            <td>{{ $hasilAplha }}</td>
                                        </tr>
                                        <tr>
                                            <th>MAE</th>
                                            <td>{{ number_format($mae, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>MAPE</th>
                                            <td>{{ number_format($mape, 2) }}%</td>
                                        </tr>
                                        <tr>
                                            <th>Akurasi</th>
                                            <td>
                                                @if ($mape < 10)
                                                    <span class="text-success">Sangat Baik (MAPE &lt; 10%)</span>
                                                @elseif ($mape < 20)
                                                    <span class="text-primary">Baik (MAPE 10% - 20%)</span>
                                                @elseif ($mape < 50)
                                                    <span class="text-warning">Cukup (MAPE 20% - 50%)</span>
                                                @else
                                                    <span class="text-danger">Buruk (MAPE &gt; 50%)</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif

                                    @if ($forecastPeriodsCount > 0)
                                        <tr>
                                            <th>Total Periode Ke yang Diramal</th>
                                            <td>{{ $forecastPeriodsCount }} periode</td>
                                        </tr>
                                        <tr>
                                            <th>Total Cash Flow Ramalan</th>
                                            <td>Rp {{ number_format($totalCashFlowForecast, 0, ',', '.') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Grafik Peramalan</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart-wrapper" style="position: relative; height: 300px;">
                                <canvas id="chartTransaksi" style="width: 100%; height: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        const ctx = document.getElementById('chartTransaksi').getContext('2d');
        const labels = @json(array_column($hasil, 'periode'));
        const dataAktual = @json(array_column($hasil, 'jumlah'));
        const dataRamalan = @json(array_column($hasil, 'forecast'));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Data Aktual',
                        data: dataAktual,
                        borderColor: 'rgb(0, 51, 153)',
                        tension: 0.3,
                        pointRadius: 2
                    },
                    {
                        label: 'Data Peramalan',
                        data: dataRamalan,
                        borderColor: 'rgb(255, 102, 0)',
                        tension: 0.3,
                        pointRadius: 2
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        @if (isset($alpha) && isset($bestAlpha))
            document.addEventListener('DOMContentLoaded', function() {
                const periode = "{{ $periode }}";
                const metric = periode === 'bulanan' ? 'MAPE' : 'MAE';
                const alpha = parseFloat("{{ $alpha }}");
                const bestAlpha = parseFloat("{{ $bestAlpha }}");
                if (alpha === bestAlpha) {
                    Swal.fire({
                        icon: 'success',
                        title: `Alpha ${alpha} adalah yang terbaik!`,
                        text: `Nilai alpha ini menghasilkan ${metric} terkecil dibanding alpha lainnya.`
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: `Alpha ${alpha} kurang optimal`,
                        text: `Coba gunakan alpha yang lain untuk hasil lebih akurat.`
                    });
                }
            });
        @endif

        setTimeout(() => {
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                new bootstrap.Toast(toastEl).hide();
            }
        }, 5000);
    </script>
@endpush
