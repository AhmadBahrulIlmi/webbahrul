<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Administrator</title>
    <link rel="icon" type="image/png" href="{{ asset('tabler/static/Z2.png') }}" sizes="32x32">
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
    <link href="{{ asset('tabler/dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- CSS files -->
    <link href="{{ asset('tabler/dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
    <!-- ... (file CSS lainnya) ... -->
    <!-- Libs JS -->
    <!-- jQuery (perlu dimuat sebelum Tabler Core) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Tabler Core -->
    <script src="{{ asset('tabler/dist/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('tabler/dist/js/demo.min.js?1684106062') }}" defer></script>

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .forgot-password-link {
            color: #808080;
            text-decoration: none;
        }

        .forgot-password-link:hover {
            color: #000000;
            /* Warna hitam saat tautan dihover */
        }
    </style>
</head>

<body class=" d-flex flex-column">
    <script src="{{ asset('tabler/dist/js/demo-theme.min.js?1684106062') }}"></script>
    <div class="page page-center">
        <div class="container container-normal py-4">
            <div class="row align-items-center g-4">
                <div class="col-lg">
                    <div class="container-tight">
                        <div class="text-center mb-4">
                            <a>
                                <img src="{{ asset('tabler/static/logo-login.png') }}" height="45" alt="">
                            </a>
                        </div>
                        <div class="card card-md">
                            <div class="card-body">
                                <h2 class="h2 text-center mb-4" style="color: rgb(20, 20, 131)">Login to access the
                                    website</h2>
                                <form action="{{ route('auth.login') }}" method="POST" autocomplete="off" novalidate>
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" style="color: rgb(19, 19, 114)">Email</label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="form-control @error('email') is-invalid animate-error @enderror"
                                            placeholder="your@email.com" autocomplete="off">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label" style="color: rgb(19, 19, 114)">Password</label>

                                        <div class="input-group input-group-flat">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid animate-error @enderror no-clear"
                                                placeholder="Your password" autocomplete="off">

                                            <span class="input-group-text show-password" style="cursor: pointer;">
                                                <!-- icon mata -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                                                    <path
                                                        d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86-1.146a9.055 9.055 0 0 1 1.82-.18c3.6 0 6.6 2 9 6c-.666 1.11-1.379 2.067-2.138 2.87" />
                                                    <path d="M3 3l18 18" />
                                                </svg>
                                            </span>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-dark w-100">Sign in</button>
                                    </div>
                                </form>
                                @if ($errors->has('email'))
                                    <script>
                                        $(document).ready(function() {
                                            $('input[name="email"]').focus();
                                        });
                                    </script>
                                @endif

                                @if ($errors->has('password'))
                                    <script>
                                        $(document).ready(function() {
                                            $('input[name="password"]').focus();
                                        });
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg d-none d-lg-block">
                    <img src="{{ asset('tabler/static/ilustrator-login.png') }}" height="400" class="d-block mx-auto"
                        alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{ asset('tabler/dist/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('tabler/dist/js/demo.min.js?1684106062') }}" defer></script>
</body>

</html>
<script>
    $(document).ready(function() {
        $('.show-password').click(function() {
            var passwordInput = $(this).closest('.input-group').find('input');
            var passwordType = passwordInput.attr('type');

            if (passwordType === 'password') {
                passwordInput.attr('type', 'text');
                $(this).html(`
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                `);
            } else {
                passwordInput.attr('type', 'password');
                $(this).html(`
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                        <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                        <path d="M3 3l18 18" />
                    </svg>
                `);
            }
        });
    });
</script>
<style>
    input.form-control.is-invalid {
        /* warna merah bootstrap */
        padding-right: 0.75rem;
        /* sesuaikan padding */
        background-image: none;
        /* hilangkan icon bawaan browser */
    }

    /* Hilangkan icon X clear pada input di browser (Chrome, Edge) */
    input.no-clear::-ms-clear,
    input.no-clear::-ms-reveal,
    input.no-clear::-webkit-search-decoration,
    input.no-clear::-webkit-search-cancel-button,
    input.no-clear::-webkit-search-results-button,
    input.no-clear::-webkit-search-results-decoration {
        display: none;
        width: 0;
        height: 0;
    }

    input[name="password"].is-invalid {
        border-color: #d0d7de;
        /* warna border normal, Bootstrap grey */
        background-color: #fff;
        /* pastikan background tetap putih */
    }

    .animate-error {
        animation: shake 0.3s;
        animation-iteration-count: 1;
    }

    @keyframes shake {
        0% {
            transform: translateX(0px);
        }

        25% {
            transform: translateX(-5px);
        }

        50% {
            transform: translateX(5px);
        }

        75% {
            transform: translateX(-5px);
        }

        100% {
            transform: translateX(0px);
        }
    }
</style>
