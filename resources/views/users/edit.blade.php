@extends('layouts.template')

@section('content')
    <div class="page-wrapper">
        <div class="container-xl">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" name="username" id="username" class="form-control"
                                value="{{ $user->username }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <span class="input-group-text show-password" style="cursor: pointer;"
                                    onclick="togglePassword()">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                        <path
                                            d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9-6c1.272-2.12 2.712-3.678 4.32-4.674m2.86-1.146a9.055 9.055 0 0 1 1.82-.18c3.6 0 6.6 2 9 6c-.666 1.11-1.379 2.067-2.138 2.87" />
                                        <path d="M3 3l18 18" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <div class="form-selectgroup form-selectgroup-pills">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="role" value="admin" class="form-selectgroup-input"
                                        {{ $user->role == 'admin' ? 'checked' : '' }}>
                                    <span class="form-selectgroup-label">Admin</span>
                                </label>
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="role" value="user" class="form-selectgroup-input"
                                        {{ $user->role == 'user' ? 'checked' : '' }}>
                                    <span class="form-selectgroup-label">User</span>
                                </label>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Edit User</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary ms-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }
    </script>
@endsection
