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

                                        <input type="text" name="kode_produk"
                                            class="form-control"value="{{ Request('kode_produk') }}">
                                        <button type="submit" class="btn btn-secondary w-100 w-sm-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-search" width="20" height="20"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none">
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
                                    <div class="table">
                                        <table class="table table-vcenter card-table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Produk</th>
                                                    <th>Foto</th>
                                                    <th>Spik</th>
                                                    <th>Keterangan</th>
                                                    <th class="w-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produk as $data)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <div class="flex-fill">
                                                                <div class="font-weight-medium">{{ $data->kode_produk }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex py-1 align-items-center">
                                                                <span class="avatar avatar-sm preview-img"
                                                                    data-img="{{ asset('foto/' . $data->foto_produk) }}"
                                                                    data-type="foto"
                                                                    style="background-image: url('{{ asset('foto/' . $data->foto_produk) }}'); cursor:pointer">
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <!-- SPIK -->
                                                        <td>
                                                            <span class="avatar avatar-sm preview-img"
                                                                data-img="{{ asset('foto/' . $data->spik_produk) }}"
                                                                data-type="spik"
                                                                style="background-image: url('{{ asset('foto/' . $data->spik_produk) }}'); cursor:pointer">
                                                            </span>
                                                        </td>

                                                        <!-- KETERANGAN -->
                                                        <td>
                                                            @if ($data->keterangan == 'aktif')
                                                                <span class="badge bg-success">Aktif</span>
                                                            @else
                                                                <span class="badge bg-danger">Tidak Aktif</span>
                                                            @endif
                                                        </td>

                                                        <!-- ACTION DROPDOWN -->
                                                        <td class="text-end">
                                                            <div class="btn-list flex-nowrap">
                                                                <!-- dropdown -->
                                                                <div class="dropdown">
                                                                    <button
                                                                        class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                        data-bs-toggle="dropdown">
                                                                        Aksi
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item editProdukBtn"
                                                                            data-id="{{ $data->id }}">
                                                                            Edit
                                                                        </a>
                                                                        <form
                                                                            action="{{ route('produk.delete', $data->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button
                                                                                class="dropdown-item text-danger delete-confirm">
                                                                                Hapus
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
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
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-shirt-sport">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M15 4l6 2v5h-3v8a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1v-8h-3v-5l6 -2a3 3 0 0 0 6 0" />
                                        <path d="M10.5 11h2.5l-1.5 5" />
                                    </svg>
                                </span>
                                <input type="file" name="foto_produk" id="foto_produk" class="form-control">
                                <img id="preview_foto" src="#" width="100"
                                    style="display:none; margin-top:10px;">
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
                                <input type="file" name="spik_produk" id="spik_produk" class="form-control">
                                <img id="preview_spik" src="#" width="100"
                                    style="display:none; margin-top:10px;">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <div class="form-selectgroup form-selectgroup-pills">

                                <label class="form-selectgroup-item">
                                    <input type="radio" name="keterangan" value="aktif"
                                        class="form-selectgroup-input">
                                    <span class="form-selectgroup-label">Aktif</span>
                                </label>

                                <label class="form-selectgroup-item">
                                    <input type="radio" name="keterangan" value="tidak_aktif"
                                        class="form-selectgroup-input">
                                    <span class="form-selectgroup-label">Tidak Aktif</span>
                                </label>

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
    <div class="modal fade" id="modalPreview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-transparent border-0 shadow-none">
                <div class="modal-body text-center p-0">

                    <!-- GAMBAR -->
                    <img id="imgPreviewModal" class="img-preview-custom">

                    <!-- LINK DETAIL -->
                    <div class="mt-2">
                        <a id="detailLink" href="#" target="_blank" class="text-primary small">
                            Lihat Detail
                        </a>
                    </div>

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

            // edit
            $(".editProdukBtn").click(function() {
                let id = $(this).data('id');
                $.get('/produk/' + id + '/edit', function(data) {
                    $('#loadeditform').html(data);
                    $('#modal-editproduk').modal('show');
                });
            });

            // delete
            $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();

                Swal.fire({
                    title: "Apakah Yakin?",
                    text: "Ingin Menghapus Data Produk Ini",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // validasi form
            $("#frmProduk").submit(function() {
                var kode_produk = $("#kode_produk").val();
                var keterangan = $("input[name='keterangan']:checked").val();

                if (kode_produk == "") {
                    Swal.fire('Warning!', 'Kode Produk Harus Diisi!', 'warning');
                    return false;
                }
                if (!keterangan) {
                    Swal.fire('Warning!', 'Keterangan Harus Dipilih!', 'warning');
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
        // preview sebelum upload
        $("#foto_produk").change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#preview_foto").attr("src", e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $("#spik_produk").change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $("#preview_spik").attr("src", e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        // preview klik gambar di tabel
        $(document).on('click', '.preview-img', function() {
            let src = $(this).data('img');
            let nama = $(this).closest('tr').find('.font-weight-medium').text();
            let type = $(this).data('type');

            $("#imgPreviewModal").attr('src', src);

            $("#detailLink").attr(
                'href',
                '/viewer?img=' + encodeURIComponent(src) +
                '&nama=' + encodeURIComponent(nama) +
                '&type=' + encodeURIComponent(type)
            );

            $("#modalPreview").modal('show');
        });
    </script>
@endpush
