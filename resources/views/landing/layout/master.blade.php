<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>RK87 Billiard</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('landing/assets/favicon.ico') }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
    <style>
        html {
            scroll-behavior: smooth;
        }

        input[readonly] {
            background-color: #f8f9fa;
            /* warna abu muda */
            border: 1px solid #ced4da;
            /* border abu standar Bootstrap */
            cursor: not-allowed;
            /* kursor jadi tidak bisa klik */
            color: #495057;
            /* warna teks */
        }
    </style>

</head>

<body>
    <!-- Responsive navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">RK87 Billiard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @if ($users && $users->level_id == '2')
                        <!-- Pelanggan (Level 2) -->
                        <li class="nav-item"><a class="nav-link active"
                                href="{{ route('dashboard.index') }}">{{ $users->name ?? '-' }}</a></li>
                        <li class="nav-item"><a class="nav-link @yield('menuBeranda')"
                                href="{{ route('dashboard.index') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link @yield('menuPaket')" href="#paket">Paket</a></li>
                        <li class="nav-item"><a class="nav-link @yield('menuRiwayat')"
                                href="{{ route('riwayat.index') }}">Riwayat</a></li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-4" href="{{ route('login.logout') }}">Keluar</a>
                        </li>
                    @else
                        <!-- Belum login atau bukan pelanggan -->
                        <li class="nav-item"><a class="nav-link @yield('menuBeranda')"
                                href="{{ route('landing.index') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link @yield('menuPaket')" href="#paket">Paket</a></li>
                        <li class="nav-item">
                            <a class="btn btn-primary ms-4" href="{{ route('login') }}">Masuk / Buat Akun</a>
                        </li>
                    @endif
                </ul>


            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; RK87 Billiard {{ date('Y') }}</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="{{ asset('landing/js/scripts.js') }}"></script>
</body>

</html>
