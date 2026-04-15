@extends('layouts.template')
@section('content')
    <div class="page-body mb-lg-0">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <section class="py-5">
                                <div class="container text-center">
                                    <h1 class="display-4 fw-bold mb-4">Zavision Konveksi</h1>
                                    <p class="lead text-muted mb-5">
                                        Zavision adalah perusahaan konveksi yang fokus pada kualitas dan ketepatan waktu
                                        produksi. Kami melayani pembuatan berbagai jenis pakaian sesuai kebutuhan pelanggan,
                                        mulai dari seragam kerja hingga pakaian kasual.
                                    </p>
                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <img src="{{ asset('tabler/static/about-us.jpg') }}" alt="Our Team"
                                                class="img-fluid rounded-4 shadow mb-4"
                                                style="max-height: 400px; object-fit: cover;">
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-md-4 mb-4">
                                            <h3 class="fw-semibold">Visi</h3>
                                            <p class="text-muted">
                                                Menjadi konveksi terpercaya di Indonesia dengan produk berkualitas dan
                                                pelayanan terbaik.
                                            </p>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <h3 class="fw-semibold">Misi</h3>
                                            <p class="text-muted">
                                                Mengutamakan kepuasan pelanggan, menjaga kualitas bahan dan jahitan, serta
                                                terus berinovasi dalam desain dan teknologi produksi.
                                            </p>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <h3 class="fw-semibold">Nilai Kami</h3>
                                            <p class="text-muted">
                                                Profesional, terpercaya, tepat waktu, dan berorientasi pada kualitas.
                                            </p>
                                        </div>
                                    </div>

                                    {{-- <div class="mt-5">
                                    <h2 class="fw-bold mb-3">Hubungi Kami</h2>
                                    <p class="text-muted">
                                        Ingin tahu lebih banyak? Hubungi kami!
                                    </p>
                                    <p class="fw-semibold">
                                        📧 Email: support@startupmu.com<br>
                                        📱 WhatsApp: +62 812-3456-7890
                                    </p>
                                </div> --}}
                                </div>
                            </section>
                            {{-- {{ $dataKaryawan->links('vendor.pagination.bootstrap-5') }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
