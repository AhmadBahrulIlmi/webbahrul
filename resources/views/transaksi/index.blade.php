@extends('layouts.template')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Data Transaksi
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
                        <strong>Informasi:</strong> Pastikan menambah, mengedit, dan menghapus data transaksi dengan benar.
                        Jika ingin menambah data transaksi klik button tambah kemudian isi di setiap form yang ada, jika
                        sudah
                        mengisi maka klik simpan. Dan untuk fitur Import data pastika download template yang sudah
                        disediakan dan isi menggunakan excel, jika sudah maka import menggunakan excel yang sudah dibuat.
                        untuk mengubah dan menghapus klik button ubah dan hapus pada tabel. Jika
                        ingin mencari data transaksi bisa mecari berdasarkan tanggal transaksi atau transaksi produk
                        kemudian klik button cari.
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
                                <div class="mb-2">
                                    <a href="#" class="btn btn-primary" id="btnTambahTransaksi">
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
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalImport">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-xls">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                            <path d="M4 15l4 6" />
                                            <path d="M4 21l4 -6" />
                                            <path
                                                d="M17 20.25c0 .414 .336 .75 .75 .75h1.25a1 1 0 0 0 1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 1 1 -1h1.25a.75 .75 0 0 1 .75 .75" />
                                            <path d="M11 15v6h3" />
                                        </svg>
                                        Import Data
                                    </button>
                                    {{-- <button type="button" class="btn btn-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                            <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                            <path d="M17 18h2" />
                                            <path d="M20 15h-3v6" />
                                            <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                                        </svg>
                                        Export Data
                                    </button> --}}
                                </div>
                                <form action="{{ route('transaksi.index') }}" method="GET"
                                    class="d-flex flex-column flex-md-row ms-auto mb-2" style="gap: 10px;">

                                    <input type="date" name="tanggal" class="form-control"
                                        value="{{ request('tanggal') }}" placeholder="Tanggal Transaksi">

                                    <select name="produk_id" id="filter_produk_id" class="form-select"
                                        style="min-width: 200px;">
                                        <option value="">Semua Produk</option>
                                        @foreach ($produk as $d)
                                            <option value="{{ $d->id }}"
                                                {{ Request('produk_id') == $d->id ? 'selected' : '' }}>
                                                {{ $d->nama_produk }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search"
                                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                        Cari
                                    </button>
                                </form>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Jumlah</th>
                                                    <th>Tanggal</th>
                                                    <th>Total Transaksi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksi as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $data->produk->nama_produk ?? '-' }}</td>
                                                        <td>{{ $data->jumlah }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}
                                                        </td>
                                                        <td>Rp {{ number_format($data->total_harga, 0, ',', '.') }}</td>
                                                        <td>
                                                            <div style="display: flex; gap: 5px;">
                                                                <a class="btn btn-sm btn-info editTransaksiBtn"
                                                                    data-id="{{ $data->id }}">
                                                                    Ubah
                                                                </a>
                                                                <form action="{{ route('transaksi.delete', $data->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a class="btn btn-danger btn-sm delete-confirm">
                                                                        Hapus
                                                                    </a>
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
                                {{ $transaksi->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambah Data Transaksi -->
    <div class="modal modal-blur fade" id="modal-inputtransaksi" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('transaksi.store') }}" method="POST" id="frmTransaksi">
                        @csrf
                        <div class="mb-3">
                            <select name="produk_id" id="produk_id" class="form-select" required>
                                <option value="">Pilih Produk</option>
                                @foreach ($produk as $d)
                                    <option value="{{ $d->id }}">{{ $d->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" />
                                    </svg>
                                </span>
                                <input type="number" name="jumlah" id="jumlah" value="" class="form-control"
                                    placeholder="Jumlah">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" />
                                        <path d="M16 3v4" />
                                        <path d="M8 3v4" />
                                        <path d="M4 11h16" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                    </svg>
                                </span>
                                <input type="date" name="tanggal" id="tanggal" value="" class="form-control"
                                    placeholder="Tanggal">
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
    <!-- Ubah Data Transaksi -->
    <div class="modal modal-blur fade" id="modal-edittransaksi" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Import Data Transaksi -->
    <div class="modal fade" id="modalImport" tabindex="-1" aria-labelledby="ModalImportLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalImportLabel">Import Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('transaksi.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="form-group">
                                    <label class="mb-2">Pilih File Excel</label>
                                    <input type="file" class="form-control" name="file"
                                        style="border: 1px solid #d2d6da !important;" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('transaksi.download-template') }}" class="btn btn-success">
                            Download Template
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('myscript')
    <script>
        $(function() {
            $("#btnTambahTransaksi").click(function() {
                $("#modal-inputtransaksi").modal("show");
            });
        });
        $(function() {
            $("#btnImportTransaksi").click(function() {
                $("#modal-importtransaksi").modal("show");
            });
        });

        $(".editTransaksiBtn").click(function() {
            let id = $(this).data('id');
            $.get('/transaksi/' + id + '/edit', function(data) {
                $('#loadeditform').html(data);
                $('#modal-edittransaksi').modal('show');
            });
        });

        $(".delete-confirm").click(function(e) {
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
                title: "Apakah Yakin?",
                text: "Ingin Menghapus Data Transaksi Ini",
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
        $("#frmTransaksi").submit(function() {
            var produk_id = $("#produk_id").val();
            var jumlah = $("#jumlah").val();
            var tanggal = $("#tanggal").val();

            if (produk_id == "" || produk_id == null) {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Produk harus dipilih!',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    didClose: () => {
                        $("#produk_id").focus();
                    }
                });
                return false;
            } else if (jumlah == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jumlah Transaksi Harus Diisi!',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    didClose: () => {
                        $("#jumlah").focus();
                    }
                });
                return false;
            } else if (tanggal == "") {
                Swal.fire({
                    title: 'Warning!',
                    text: 'Tanggal transaksi harus diisi!',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    didClose: () => {
                        $("#tanggal").focus();
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
    </script>
@endpush
