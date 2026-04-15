@extends('layouts.template')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-12 align-items-center">
                <div class="col">
                    <div class="alert alert-info mb-0" role="alert"
                        style="background-color: #e7f3fe; border-left: 6px solid #2196F3; padding: 15px; color: #31708f;">
                        <strong>Informasi:</strong> Pastikan menambah, mengedit, dan menghapus data user dengan benar.
                        Jika ingin menambah data user klik button tambah kemudian isi di setiap form yang ada, jika sudah
                        mengisi maka klik simpan. untuk mengubah dan menghapus klik button ubah dan hapus.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="card p-3">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">Data User</h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="d-flex">
                                <a href="{{ route('users.create') }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Tambah
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="page-body">
                        <div class="container-xl">
                            <div class="row row-cards">
                                @foreach ($users as $user)
                                    <div class="col-md-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-body p-4 text-center">
                                                <span class="avatar avatar-xl mb-3 rounded"
                                                    style="background-image: url({{ asset('tabler/static/Z2.png') }})"></span>
                                                <h3 class="m-0 mb-1"><a href="#">{{ $user->name }}</a></h3>
                                                <div class="text-muted">{{ $user->email }}</div>
                                                <div class="mt-3">
                                                    <span class="badge bg-purple-lt">Admin</span>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('users.edit', $user->id) }}" class="card-btn"
                                                    style="border: none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path
                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                    Ubah
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="card-btn delete-confirm"
                                                        style="background: none; border: none; cursor: pointer; padding-right: 1cm;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
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

        <!-- Page body -->

    </div>
@endsection
@push('myscript')
    <script>
        $(".delete-confirm").click(function(e) {
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
                title: "Apakah Yakin?",
                text: "Ingin Menghapus Data User Ini",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Data Sudah Dihapus.",
                        icon: "success"
                    });
                }
            });
        });
    </script>
@endpush
