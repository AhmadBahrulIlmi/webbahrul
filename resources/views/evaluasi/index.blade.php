@extends('layouts.template')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <h2 class="page-title">Evaluasi Hasil Peramalan</h2>
        </div>
    </div>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-12 align-items-center">
                <div class="col">
                    <div class="alert alert-info mb-0" role="alert"
                        style="background-color: #e7f3fe; border-left: 6px solid #2196F3; padding: 15px; color: #31708f;">
                        <strong>Informasi:</strong> Pada menu ini anda bisa melakukan evaluasi hasil peramalan yang sudah
                        anda simpan. Jika dikira sudah melakukan evaluasi hasil peramalan anda bisa menghapus dengan klik
                        button hapus peramalan.
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
                            @if (Session::get('success'))
                                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
                                    <div class="toast align-items-center text-bg-success border-0 show" role="alert"
                                        aria-live="assertive" aria-atomic="true">
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
                            <form id="hapusForm" action="{{ route('evaluasi.delete') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" id="rekapCount" value="{{ count($rekapPeramalan) }}">
                                <button type="submit" class="btn btn-danger mb-3 delete-confirm">Hapus Peramalan</button>
                            </form>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Periode</th>
                                        <th>Alpha</th>
                                        <th>MAE</th>
                                        <th>MAPE (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekapPeramalan as $row)
                                        <tr>
                                            <td>{{ $row['produk'] }}</td>
                                            <td>{{ $row['periode'] }}</td>
                                            <td>{{ $row['alpha'] }}</td>
                                            <td>{{ number_format($row['mae'], 2) }}</td>
                                            <td>{{ number_format($row['mape'] ?? 0, 2) }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Kesimpulan Alpha Terbaik --}}
                            <div class="mt-4 p-3 border rounded bg-light">
                                <h5>Kesimpulan Hasil Peramalan</h5>
                                @if (!empty($bestPeramalan))
                                    @foreach ($bestPeramalan as $key => $best)
                                        @php
                                            [$produk, $periode] = explode('-', $key);
                                        @endphp
                                        <p>
                                            Berdasarkan evaluasi perhitungan metode <strong>Double Exponential
                                                Smoothing</strong>
                                            pada produk
                                            <strong>{{ $produk }}</strong> pada periode
                                            <strong>{{ $periode }}</strong>,
                                            didapatkan nilai alpha terbaik sebesar <strong>{{ $best['alpha'] }}</strong>.
                                            Alpha ini menghasilkan nilai <strong>Mean Absolute Error (MAE)</strong> sebesar
                                            <strong>{{ number_format($best['mae'], 2) }}</strong>, yang menunjukkan bahwa
                                            hasil peramalan cukup <strong>akurat dan stabil</strong> untuk memprediksi
                                            penjualan produk tersebut.
                                        </p>
                                    @endforeach
                                    <p class="mt-3">
                                        Dengan demikian, pemilihan nilai alpha yang tepat mampu <strong>meminimalkan
                                            kesalahan</strong> dalam peramalan,
                                        sehingga dapat digunakan sebagai acuan dalam pengambilan keputusan strategis terkait
                                        stok dan penjualan produk.
                                    </p>
                                @else
                                    <p>Data evaluasi belum tersedia. Silakan lakukan proses peramalan terlebih dahulu.</p>
                                @endif
                            </div>

                            <div class="mt-4 p-3 border rounded bg-light">
                                @if ($totalForecastStok ?? 0 > 0)
                                    <div class="mt-2">
                                        <table class="table table-bordered">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Produk</th>
                                                    <th>Jumlah Periode Diramal</th>
                                                    <th>Perkiraan Total Stok Dibutuhkan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stokForecast as $produk => $data)
                                                    <tr>
                                                        <td>{{ $produk }}</td>
                                                        <td>{{ $data['periode'] }}
                                                            {{ $periode === 'bulanan' ? 'Bulan' : 'Minggu' }}</td>
                                                        <td>{{ round($data['total']) }} item</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <p class="text-muted">
                                            Jumlah stok di atas merupakan hasil estimasi berdasarkan data peramalan
                                            periode mendatang dan dapat dijadikan acuan penyediaan stok.
                                        </p>
                                    </div>
                                @endif
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
        $(".delete-confirm").click(function(e) {
            e.preventDefault();
            let count = parseInt($('#rekapCount').val());

            if (count === 0) {
                Swal.fire({
                    icon: "info",
                    title: "Tidak ada data!",
                    text: "Tidak ada data peramalan yang bisa dihapus."
                });
            } else {
                Swal.fire({
                    title: "Sudah Melakukan Evaluasi?",
                    text: "Dan ingin menghapus data peramalan ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Dihapus!",
                            text: "Data sudah dihapus.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            $('#hapusForm').submit();
                        });
                    }
                });
            }
        });

        setTimeout(() => {
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                new bootstrap.Toast(toastEl).hide();
            }
        }, 5000);
    </script>
@endpush
