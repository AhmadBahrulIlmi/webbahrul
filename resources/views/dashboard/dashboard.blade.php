@extends('layouts.template')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-12 align-items-center">
                <div class="col">
                    <div class="alert alert-info mb-0" role="alert"
                        style="background-color: #e7f3fe; border-left: 6px solid #2196F3; padding: 15px; color: #31708f;">
                        <strong>Informasi:</strong> Sistem ini merupakan aplikasi berbasis website yang dibuat sebagai
                        bagian dari tugas akhir dengan judul <em>"Peramalan Penjualan Berbagai Jenis Baju Berbasis Website
                            Menggunakan Metode Double Exponential Smoothing Berbasis Website"</em>. Aplikasi ini dirancang
                        untuk membantu pemilik
                        usaha dalam menganalisis dan memprediksi jumlah penjualan dari berbagai jenis produk seperti Baju
                        pada perusahaan Zavision Konveksi Mojokerto.
                        <br><br>
                        Fitur utama sistem ini meliputi pengelolaan data produk dan transaksi, visualisasi data penjualan,
                        serta peramalan penjualan dengan metode Double Exponential Smoothing berdasarkan data penjualan
                        mingguan.
                        Diharapkan sistem ini dapat memberikan wawasan yang lebih akurat dalam pengambilan keputusan bisnis
                        pada perusahaan Zavision Konveksi Mojokerto.
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="page-body">
        <div class="continer-xl">
            <div class="row">
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row">
                            <div class="col-md-6 col-xl-3 mb-2">
                                <div class="card card-sm h-100">
                                    <div class="card-body d-flex align-items-center h-100">
                                        <div class="row align-items-center w-100">
                                            <div class="col-auto">
                                                <span class="bg-blue text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path
                                                            d="M15 4l6 2v5h-3v8a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1v-8h-3v-5l6 -2a3 3 0 0 0 6 0" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium fs-2">
                                                    {{ $jumlahProduk }}
                                                </div>
                                                <div class="text-muted">
                                                    Jumlah Produk
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-3 mb-2">
                                <div class="card card-sm h-100">
                                    <div class="card-body d-flex align-items-center h-100">
                                        <div class="row align-items-center w-100">
                                            <div class="col-auto">
                                                <span class="bg-blue text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path
                                                            d="M15 4l6 2v5h-3v8a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1v-8h-3v-5l6 -2a3 3 0 0 0 6 0" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="font-weight-medium fs-2">
                                                    {{ $jumlahUser }}
                                                </div>
                                                <div class="text-muted">
                                                    Jumlah User
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card card-sm">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Artikel Baru</h3>
                                        </div>
                                        <div class="card-body card-body-scrollable card-body-scrollable-shadow"
                                            style="max-height: 400px;">
                                            <div class="divide-y">
                                                @foreach ($produk as $item)
                                                    <div>
                                                        <a href="{{ route('produk.index', ['kode_produk' => $item->kode_produk]) }}"
                                                            class="text-decoration-none text-dark">
                                                            <div class="row align-items-center py-2 hover-shadow">
                                                                <div class="col-auto">
                                                                    <span class="avatar avatar-1"
                                                                        style="background-image: url('{{ asset('foto/' . $item->foto_produk) }}')">
                                                                    </span>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="text-truncate">
                                                                        <strong>{{ $item->kode_produk }}</strong>
                                                                    </div>
                                                                    <div class="text-secondary">
                                                                        {{ $item->created_at->diffForHumans() }}
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto align-self-center">
                                                                    @if ($item->keterangan == 'aktif')
                                                                        <span class="badge bg-success"></span>
                                                                    @else
                                                                        <span class="badge bg-danger"></span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Artikel Terakhir Diupdate</h3>
                                    </div>
                                    <div class="card-body card-body-scrollable card-body-scrollable-shadow"
                                        style="max-height: 400px;">
                                        <div class="divide-y">
                                            @foreach ($produkUpdate as $item)
                                                <div>
                                                    <div class="row align-items-center py-2">
                                                        <div class="col-auto">
                                                            <span class="avatar avatar-1"
                                                                style="background-image: url('{{ asset('foto/' . $item->foto_produk) }}')">
                                                            </span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="text-truncate">
                                                                <strong>{{ $item->kode_produk }}</strong>
                                                            </div>
                                                            <div class="text-secondary">
                                                                Diupdate {{ $item->updated_at->diffForHumans() }}
                                                            </div>
                                                        </div>
                                                        <div class="col-auto align-self-center">
                                                            @if ($item->keterangan == 'aktif')
                                                                <span class="badge bg-success"></span>
                                                            @else
                                                                <span class="badge bg-danger"></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script></script>
@endpush
