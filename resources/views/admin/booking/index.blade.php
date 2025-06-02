@extends('dashboard.layout.master')
@section('menuDataBooking', 'active')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pemesanan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('data-pemesanan.create') }}" class="btn btn-default">
                                    <i class="fas fa-plus"></i>
                                    Tambahkan Data Pemesanan
                                </a>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped" id="myTable" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">#</th>
                                            <th>Kode</th>
                                            <th>Pelanggan</th>
                                            <th>Meja</th>
                                            <th>Paket</th>
                                            <th>Tanggal</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Status</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->kode_booking ?? '-' }}</td>
                                                <td>{{ $data->users->name ?? '-' }}</td>
                                                <td>{{ $data->meja->no_meja ?? '-' }}</td>
                                                <td>{{ $data->paket->nama ?? '-' }}</td>
                                                <td>{{ $data->tgl_booking ?? '-' }}</td>
                                                <td>{{ $data->waktu_mulai ?? '-' }}</td>
                                                <td>{{ $data->waktu_selesai ?? '-' }}</td>
                                                <td>
                                                    @if ($data->status == '1')
                                                        <span class="badge badge-primary">
                                                            Dipesan
                                                        </span>
                                                    @elseif($data->status == '2')
                                                        <span class="badge badge-warning">
                                                            Sedang Berlangsung
                                                        </span>
                                                    @elseif($data->status == '3')
                                                        <span class="badge badge-success">
                                                            Selesai
                                                        </span>
                                                    @elseif($data->status == '4')
                                                        <span class="badge badge-danger">
                                                            Batal
                                                        </span>
                                                    @else
                                                        <span class="badge badge-secondary">
                                                            Tidak Tersedia
                                                        </span>
                                                    @endif
                                                </td>
                                                <td>{{ $data->total_harga ?? '-' }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('data-pemesanan.edit', $data->id) }}"
                                                        class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @php
                                                        $telp = $data->users->telp ?? '6282287632611';

                                                        $lines = [
                                                            "Halo {$data->users->name}, berikut detail pemesanan Anda di RK87 Billiard:",
                                                            "Kode Booking : {$data->kode_booking}",
                                                            'Tanggal      : ' .
                                                            \Carbon\Carbon::parse($data->tgl_booking)->translatedFormat(
                                                                'd F Y',
                                                            ),
                                                            "Waktu Mulai  : {$data->waktu_mulai}",
                                                            "Waktu Selesai: {$data->waktu_selesai}",
                                                            "Meja         : {$data->meja->nama_meja}",
                                                            "Paket        : {$data->paket->nama_paket}",
                                                            'Total Harga  : Rp ' .
                                                            number_format($data->total_harga, 0, ',', '.'),
                                                            '',
                                                            'Silakan datang tepat waktu. Terima kasih!',
                                                        ];

                                                        // gabung dengan \n, lalu urlencode sekali saja
                                                        $pesan = implode("\n", $lines);
                                                        $linkWa = "https://wa.me/{$telp}?text=" . urlencode($pesan);
                                                    @endphp

                                                    <a href="{{ $linkWa }}" class="btn btn-success mx-2"
                                                        target="_blank">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>

                                                    <a href="{{ asset('storage/' . $data->bukti_pembayaran ?? '') }}" class="btn btn-warning me-2"
                                                        target="_blank">
                                                        <i class="fas fa-download"></i>
                                                    </a>

                                                    <form action="{{ route('data-pemesanan.destroy', $data->id ?? '') }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger mx-2"
                                                            onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
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
