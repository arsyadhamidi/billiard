@extends('landing.layout.master')
@section('menuRiwayat', 'active')

@section('content')
    <!-- Form Pemesanan Paket -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <div class="card shadow rounded-4">
                            <div class="card-body p-5">
                                <h3 class="mb-4 text-center fw-bold text-primary mb-3">Detail Pelanggan</h3>
                                <table class="table">
                                    <tr>
                                        <td>
                                            Nama Lengkap
                                        </td>
                                        <td style="text-align: right">
                                            {{ $users->name ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Email
                                        </td>
                                        <td style="text-align: right">
                                            {{ $users->email ?? '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Status
                                        </td>
                                        <td style="text-align: right">
                                            Pelanggan
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Telepon
                                        </td>
                                        <td style="text-align: right">
                                            {{ $users->telp ?? '-' }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <div class="card shadow rounded-4">
                            <div class="card-body p-5 table-responsive">
                                <h3 class="mb-4 text-center fw-bold text-primary mb-3">Riwayat Pemesanan</h3>
                                <table class="table table-bordered table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 3%">No.</th>
                                            <th>Kode</th>
                                            <th>Tanggal</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $booking->kode_booking ?? '-' }}</td>
                                                <td>{{ $booking->tgl_booking ?? '-' }}</td>
                                                <td>{{ $booking->waktu_mulai ?? '-' }}</td>
                                                <td>{{ $booking->waktu_selesai ?? '-' }}</td>
                                                <td>
                                                    @if ($booking->status == '1')
                                                        Dipesan
                                                    @elseif($booking->status == '2')
                                                        Sedang Berlangsung
                                                    @elseif($booking->status == '3')
                                                        Selesai
                                                    @elseif($booking->status == '4')
                                                        Batal
                                                    @else
                                                        Tidak Tersedia
                                                    @endif
                                                </td>
                                                <td>{{ $booking->total_harga ?? '-' }}</td>
                                                <td>
                                                    <a href="{{ route('riwayat.generatepdf', $booking->id ?? '') }}"
                                                        class="btn btn-primary" target="_blank">
                                                        Pemesanan
                                                    </a>
                                                    <a href="{{ asset('storage/' . $booking->bukti_pembayaran ?? '') }}"
                                                        class="btn btn-warning" target="_blank">
                                                        Pembayaran
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
