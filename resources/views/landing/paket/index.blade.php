@extends('landing.layout.master')
@section('menuPaket', 'active')

@section('content')
    <!-- Form Pemesanan Paket -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <div class="card shadow rounded-4">
                            <div class="card-body p-5">
                                <h3 class="mb-4 text-center fw-bold text-primary mb-3">Detail Paket</h3>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Nama Paket
                                        </td>
                                        <td style="text-align: right">
                                            {{ $pakets->nama ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Harga
                                        </td>
                                        <td style="text-align: right">
                                            {{ $pakets->harga ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Waktu Mulai
                                        </td>
                                        <td style="text-align: right">
                                            {{ $pakets->waktu_mulai ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Waktu Selesai
                                        </td>
                                        <td style="text-align: right">
                                            {{ $pakets->waktu_selesai ?? '-' }}
                                        </td>
                                    </tr>
                                </table>

                                <p>
                                    <b>Deskripsi</b>
                                    <br>
                                    {{ $pakets->deskripsi ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="card shadow rounded-4">
                            <div class="card-body p-5">
                                <h3 class="mb-4 text-center fw-bold text-primary">Rekening Pembayaran</h3>

                                {{-- satu bank --}}
                                <div class="d-flex align-items-center mb-4">
                                    <i class="fa-solid fa-building-columns fa-2x text-primary me-3"></i>
                                    <div class="flex-grow-1">
                                        <span class="badge bg-primary-subtle text-primary fw-semibold mb-1">BANK BCA</span>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fs-5 fw-semibold">000885002173284</span>
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="navigator.clipboard.writeText('1234567890')">
                                                <i class="fa-solid fa-copy me-1"></i> Salin
                                            </button>
                                        </div>
                                        <small class="text-muted">a/n RK87 Billiard</small>
                                    </div>
                                </div>

                                {{-- bank kedua, jika ada --}}
                                <div class="d-flex align-items-center mb-4">
                                    <i class="fa-solid fa-building-columns fa-2x text-success me-3"></i>
                                    <div class="flex-grow-1">
                                        <span class="badge bg-success-subtle text-success fw-semibold mb-1">BANK BRI</span>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fs-5 fw-semibold">001 234 567 8910</span>
                                            <button class="btn btn-sm btn-outline-success"
                                                onclick="navigator.clipboard.writeText('0012345678910')">
                                                <i class="fa-solid fa-copy me-1"></i> Salin
                                            </button>
                                        </div>
                                        <small class="text-muted">a/n RK87 Billiard</small>
                                    </div>
                                </div>

                                <hr>

                                <p class="text-center small mb-0">
                                    Setelah transfer, silakan unggah bukti pembayaran pada halaman konfirmasi.<br>
                                    <span class="text-danger fw-semibold">* Pembayaran maksimal 2 jam setelah booking</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">

                    <div class="card shadow rounded-4">
                        <div class="card-body p-5">
                            <h3 class="mb-4 text-center fw-bold text-primary">Form Pemesanan Paket</h3>

                            <div class="mb-3">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                            </div>

                            <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="users_id" class="form-control" value="{{ $users->id ?? '' }}">
                                <input type="hidden" name="paket_id" class="form-control" value="{{ $pakets->id ?? '' }}">
                                <!-- Nama -->
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama Anda" readonly
                                        value="{{ $users->name ?? '-' }}">
                                </div>

                                <!-- Pilih Meja -->
                                <div class="mb-3">
                                    <label class="form-label">Pilih Meja</label>
                                    <select class="form-select" name="meja_id" required>
                                        <option value="" selected>-- Pilih Meja --</option>
                                        @foreach ($mejas as $meja)
                                            <option value="{{ $meja->id ?? '' }}"
                                                {{ old('meja_id') == $meja->id ? 'selected' : '' }}>
                                                Meja {{ $meja->no_meja ?? '' }} - {{ $meja->lokasi ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('meja_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Tanggal -->
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Pemesanan</label>
                                    <input type="date" class="form-control @error('tgl_booking') is-invalid @enderror"
                                        name="tgl_booking" required
                                        value="{{ old('tgl_booking', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                    @error('tgl_booking')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <!-- Waktu Mulai -->
                                <div class="mb-3">
                                    <label for="waktu" class="form-label">Waktu Mulai</label>
                                    <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        name="waktu_mulai" required>
                                    @error('waktu_mulai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Waktu Selesai -->
                                <div class="mb-3">
                                    <label for="waktu" class="form-label">Waktu Selesai</label>
                                    <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror"
                                        name="waktu_selesai" required>
                                    @error('waktu_selesai')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{--  <div class="mb-3">
                                    <label>Bukti Pembayaran</label>
                                    <input type="file" name="bukti_pembayaran" class="form-control @error('bukti_pembayaran') is-invalid @enderror">
                                    @error('bukti_pembayaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>  --}}

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary px-5">Pesan Sekarang</button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
