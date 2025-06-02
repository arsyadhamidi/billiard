@extends('landing.layout.master')

@section('menuBeranda', 'active')

@section('content')
    <!-- Header - set the background image for the header in the line below-->
    <header class="bg-image-full">
        <div class="text-center">
            <img class="img-fluid mb-4" src="{{ asset('images/bg-landing.jpg') }}" alt="..." />
            <h1 class="fs-3 fw-bolder">RK87 Billiard</h1>
            <p class="mb-0">Jl. Rohana Kudus No.Kel no.87, Kp. Jao, Kec. Padang Bar., Kota Padang, Sumatera Barat</p>
        </div>
    </header>

    <!-- Hero Section RK87 Billiard -->
    <section class="py-5"
        style="background: url('https://source.unsplash.com/1600x900/?billiard,pool') center center/cover no-repeat;">
        <div class="container my-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold">Selamat Datang di RK87 Billiard</h1>
                    <p class="lead mb-4">Tempat terbaik untuk bermain dan bersantai bersama teman, menikmati suasana
                        kompetitif dan nyaman di setiap permainan Anda.</p>
                    <p class="mb-4">Dengan fasilitas terbaik dan pelayanan ramah, kami hadir memberikan pengalaman bermain
                        billiard yang menyenangkan dan profesional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Paket Section -->
    <section class="py-5 bg-light" id="paket">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Pilihan Paket Kami</h2>
                <p class="text-muted">Nikmati berbagai pilihan paket billiard dengan harga terjangkau dan waktu fleksibel.
                </p>
            </div>
            <div class="row">
                @foreach ($pakets as $paket)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-primary">{{ $paket->nama }}</h5>
                                <p class="card-text text-muted flex-grow-1">{{ $paket->deskripsi }}</p>
                                <p class="mt-2 mb-1">
                                    <strong>Durasi:</strong> {{ $paket->durasi ?? '' }} menit<br>
                                    <strong>Harga:</strong> Rp{{ number_format($paket->harga, 0, ',', '.') }}
                                </p>
                                @if ($paket->waktu_mulai && $paket->waktu_selesai)
                                    <p class="mb-0 text-muted"><strong>Waktu:</strong>
                                        {{ \Carbon\Carbon::parse($paket->waktu_mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($paket->waktu_selesai)->format('H:i') }}</p>
                                @endif
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('paket.index', $paket->id ?? '') }}" class="btn btn-warning btn-lg text-dark fw-semibold shadow">Lihat Paket</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
