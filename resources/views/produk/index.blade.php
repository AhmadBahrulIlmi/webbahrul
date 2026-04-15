@extends('layouts.template')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Data Produk
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
                        <strong>Informasi:</strong> Pastikan menambah, mengedit, dan menghapus data produk dengan benar.
                        Jika ingin menambah data produk klik button tambah kemudian isi di setiap form yang ada, jika sudah
                        mengisi maka klik simpan. untuk mengubah dan menghapus klik button ubah dan hapus pada tabel. Jika
                        ingin mencari produk pilih produk kemudian klik button cari.
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
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="d-flex justify-content-between align-items-end flex-wrap">
                                    <div class="mb-2">
                                        <a href="#" class="btn btn-primary w-100 w-sm-auto" id="btnTambahProduk">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg>
                                            Tambah
                                        </a>
                                    </div>
                                    <form action="/produk" method="GET" class="d-flex flex-column flex-sm-row mb-2"
                                        style="gap: 10px;">
                                        <select name="nama_produk" class="form-select" style="min-width: 200px;">
                                            <option value="" {{ Request('nama_produk') == '' ? 'selected' : '' }}>
                                                Semua Produk</option>
                                            @foreach ($namaProdukList as $nama)
                                                <option {{ Request('nama_produk') == $nama ? 'selected' : '' }}
                                                    value="{{ $nama }}">
                                                    {{ $nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-secondary w-100 w-sm-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-search" width="20" height="20"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                <path d="M21 21l-6 -6" />
                                            </svg>
                                            Cari
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Jenis</th>
                                                    <th>Warna</th>
                                                    <th>Ukuran</th>
                                                    <th>Harga</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produk as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->kode_produk }}</td>
                                                        <td>{{ $data->nama_produk }}</td>
                                                        <td>{{ $data->jenis }}</td>
                                                        <td>{{ $data->warna }}</td>
                                                        <td>{{ $data->ukuran }}</td>
                                                        <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                                                        <td>
                                                            <div style="display: flex; gap: 5px;">
                                                                <a class="btn btn-sm btn-info editProdukBtn"
                                                                    data-id="{{ $data->id }}">Ubah</a>
                                                                <form action="{{ route('produk.delete', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger btn-sm delete-confirm">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                {{ $produk->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Produk -->
    <div class="modal modal-blur fade" id="modal-inputproduk" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produk.store') }}" method="POST" id="frmProduk"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-qrcode">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path d="M7 17l0 .01" />
                                        <path
                                            d="M14 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path d="M7 7l0 .01" />
                                        <path
                                            d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path d="M17 7l0 .01" />
                                        <path d="M14 14l3 0" />
                                        <path d="M20 14l0 .01" />
                                        <path d="M14 14l0 3" />
                                        <path d="M14 20l3 0" />
                                        <path d="M17 17l3 0" />
                                        <path d="M20 17l0 3" />
                                    </svg>
                                </span>
                                <input type="text" name="kode_produk" id="kode_produk" value=""
                                    class="form-control" placeholder="Kode Produk">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-tag">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path
                                            d="M3 6v5.172a2 2 0 0 0 .586 1.414l7.71 7.71a2.41 2.41 0 0 0 3.408 0l5.592 -5.592a2.41 2.41 0 0 0 0 -3.408l-7.71 -7.71a2 2 0 0 0 -1.414 -.586h-5.172a3 3 0 0 0 -3 3z" />
                                    </svg>
                                </span>
                                <input type="text" name="nama_produk" id="nama_produk" value=""
                                    class="form-control" placeholder="Nama Produk">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-shirt-sport">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M15 4l6 2v5h-3v8a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1v-8h-3v-5l6 -2a3 3 0 0 0 6 0" />
                                        <path d="M10.5 11h2.5l-1.5 5" />
                                    </svg>
                                </span>
                                <input type="text" name="jenis" id="jenis" value="" class="form-control"
                                    placeholder="Jenis">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-palette">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" />
                                        <path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                        <path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                    </svg>
                                </span>
                                <input type="text" name="warna" id="warna" value="" class="form-control"
                                    placeholder="Warna">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-dimensions">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M3 5h11" />
                                        <path d="M12 7l2 -2l-2 -2" />
                                        <path d="M5 3l-2 2l2 2" />
                                        <path d="M19 10v11" />
                                        <path d="M17 19l2 2l2 -2" />
                                        <path d="M21 12l-2 -2l-2 2" />
                                        <path
                                            d="M3 10m0 2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v7a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2z" />
                                    </svg>
                                </span>
                                <input type="text" name="ukuran" id="ukuran" value="" class="form-control"
                                    placeholder="Ukuran">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-receipt-2">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                        <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
                                    </svg>
                                </span>
                                <input type="number" name="harga" id="harga" value="" class="form-control"
                                    placeholder="Harga">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form form-group">
                                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Data Produk -->
    <div class="modal modal-blur fade" id="modal-editproduk" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        $(function() {
            $("#btnTambahProduk").click(function() {
                $("#modal-inputproduk").modal("show");
            });
            $(".editProdukBtn").click(function() {
                let id = $(this).data('id');
                $.get('/produk/' + id + '/edit', function(data) {
                    $('#loadeditform').html(data);
                    $('#modal-editproduk').modal('show');
                });
            });
            $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Yakin?",
                    text: "Ingin Menghapus Data Produk Ini",
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
                            form.submit();
                        });
                    }
                });
            });
            $("#frmProduk").submit(function() {
                var kode_produk = $("#kode_produk").val();
                var nama_produk = $("#nama_produk").val();
                var jenis = $("#jenis").val();
                var warna = $("#warna").val();
                var ukuran = $("#ukuran").val();
                var harga = $("#harga").val();

                if (kode_produk == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Kode Produk Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        didClose: () => {
                            $("#kode_produk").focus();
                        }
                    });
                    return false;
                } else if (nama_produk == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Produk Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        didClose: () => {
                            $("#nama_produk").focus();
                        }
                    });
                    return false;
                } else if (jenis == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Jenis Produk Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        didClose: () => {
                            $("#jenis").focus();
                        }
                    });
                    return false;
                } else if (warna == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Warna Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        didClose: () => {
                            $("#warna").focus();
                        }
                    });
                    return false;
                } else if (ukuran == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Ukuran Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        didClose: () => {
                            $("#ukuran").focus();
                        }
                    });
                    return false;
                } else if (harga == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Harga Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        didClose: () => {
                            $("#harga").focus();
                        }
                    });
                    return false;
                }
            });
            setTimeout(() => {
                const toastEl = document.querySelector('.toast');
                if (toastEl) {
                    new bootstrap.Toast(toastEl).hide();
                }
            }, 5000);
        });
    </script>
@endpush
