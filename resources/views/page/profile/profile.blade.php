<!-- resources/views/pakan.blade.php -->
@extends('layouts.app')

<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>@yield('pageTitle')</title>
    <style>
        .login-page {
            background-image: url('/back/vendors/images/dashboard.png');
            /* Ganti '/path/to/your/background.png' dengan path yang sesuai */
            background-size: cover;
            background-repeat: no-repeat;
        }

        .centered-image {
            display: block;
            margin: 0 auto 20px;
            /* Mengatur jarak bawah antara gambar dan elemen berikutnya */
        }

        .login-box {
            width: 350px;
            height: 520px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.7);
            /* Latar belakang kotak login dengan opacity */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            margin-right: 170px;
            /* Menggeser kotak dari sisi kanan */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            /* Menaruh konten di tengah kotak */
        }
        .login-box {
            margin-top: 60px !important; /* Menggunakan !important untuk memastikan gaya ini diutamakan */
        }

        .input-group.custom {
            margin-top: 40px; /* Sesuaikan dengan seberapa jauh Anda ingin menggeser elemen input ke bawah */
        }

        .input-group.custom {
            margin-top: 40px; /* Sesuaikan dengan seberapa jauh Anda ingin menggeser elemen input ke bawah */
        }

        .input-group.custom input.form-control {
            width: 100%; /* Mengatur lebar input ke 100% dari kotak input */
            height: 40px; /* Mengatur tinggi input */
            border: 2px solid #FFFFFF; /* Mengatur warna border input */
            border-radius: 40px; /* Mengatur border radius input */
        }

        .input-group.custom input.form-control::placeholder {
            color: #9a9a9a; /* Mengatur warna teks placeholder */
        }

        .input-group.custom .input-group-text {
            background-color: #FFFFFF; /* Mengatur warna latar belakang ikon input */
            border: 1px solid #FFFFFF; /* Mengatur border ikon input */
            border-radius: 40px; /* Mengatur border radius ikon input */
            margin-right: 10px; /* Menggeser ikon ke kiri sejauh 10px */
        }

        .input-group.custom .input-group-text i {
            color: #000000; /* Mengatur warna ikon input */
        }

        .input-group.custom + .input-group.custom {
            margin-top: 10px; /* Sesuaikan jarak antara dua kotak input di sini */
        }

        .custom-control.custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #3496cb; /* Ganti dengan warna yang Anda inginkan */
            border: 2px solid #3496cb;
        }

        .custom-control.custom-checkbox .custom-control-input:not(:checked) ~ .custom-control-label::before {
            border: 2px solid #16425C; /* Warna tepi garis ketika belum dicentang */
        }

        .centered-image {
            display: block;
            margin: 0px auto 0; /* Mengatur jarak atas antara gambar dan elemen di atasnya */
        }

        .custom-control.custom-checkbox {
            margin-top: 20px; /* Sesuaikan dengan jarak bawah yang Anda inginkan */
        }


        .forgot-password a {
            font-size: 14px; /* Ganti dengan ukuran font yang Anda inginkan */
            color: #000000; /* Ganti dengan warna yang Anda inginkan */
            /* Contoh lain:
            font-weight: bold; // Untuk membuat teks menjadi tebal
            text-decoration: underline; // Untuk menambahkan garis bawah
            */
        }

        .forgot-password {
            margin-top: 23px; /* Sesuaikan dengan jarak bawah yang Anda inginkan */
        }

        .btn.btn-primary.btn-lg.btn-block {
            background-color: #16425C; /* Ganti dengan warna latar belakang yang diinginkan */
            border: 2px solid #16425C; /* Ganti dengan warna border yang diinginkan dan ketebalan yang diinginkan */
        }






    </style>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/back/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/back/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/back/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />
    @stack('stylesheets')
</head>

<body class="login-page">
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7"></div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-grey box-shadow border-radius-10">
                        <img src="/back/vendors/images/logo.png" alt="Logo Evomo" class="centered-image">
                        <span></span>
                        <form action="{{ route('admin.login_handler') }}" method="POST">
                            @csrf
                            @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}

                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Email/Username" name="login_id" value="{{ old('login_id') }}">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            @error('login_id')
                                <div class="d-block text-danger" style="margin-top: -25px;margin-bottom:15px;">
                                    {{ $message}}
                                </div>
                            @enderror
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="**********"
                                name="password">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            @error('password')
                                <div class="d-block text-danger" style="margin-top: -25px;margin-bottom:15px;">
                                    {{ $message}}
                                </div>
                            @enderror
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        <a href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="col-6">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="/back/vendors/scripts/core.js"></script>
    <script src="/back/vendors/scripts/script.min.js"></script>
    <script src="/back/vendors/scripts/process.js"></script>
    <script src="/back/vendors/scripts/layout-settings.js"></script>
    @stack('scripts')
</body>

</html>
