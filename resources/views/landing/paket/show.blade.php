@extends('landing.layout.master')

@section('menuPaket', 'active')

@section('content')
    <form action="{{ route('paket.update', $bookings->id ?? '') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Form Pemesanan Paket -->
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h4>Detail Pemesanan</h4>
                        </div>
                        <div class="mb-3">
                            <h6>Informasi Pelanggan</h6>
                        </div>
                        <div class="mb-5">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                    <th>Jenis Paket</th>
                                </tr>
                                <tr>
                                    <td>{{ $bookings->users->name ?? '-' }}</td>
                                    <td>{{ $bookings->users->telp ?? '-' }}</td>
                                    <td>{{ $bookings->paket->nama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>No. Meja</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                </tr>
                                <tr>
                                    <td>{{ $bookings->meja->no_meja ?? '-' }}</td>
                                    <td>{{ $bookings->waktu_mulai ?? '-' }}</td>
                                    <td>{{ $bookings->waktu_selesai ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="mb-3">
                            <h6>Rincian Pemesanan</h6>
                        </div>
                        <div class="mb-5">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Jenis Paket</th>
                                    <th>Durasi</th>
                                    <th>Harga</th>
                                </tr>
                                <tr>
                                    <td>{{ $bookings->paket->nama ?? '-' }}</td>
                                    <td>{{ $bookings->paket->durasi ?? '-' }}</td>
                                    <td>{{ $bookings->paket->harga ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Total Bayar</th>
                                    <th colspan="2">{{ $bookings->total_harga ?? '-' }}</th>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-3">
                            <label>Bukti Pembayaran</label>
                            <input type="file" name="bukti_pembayaran"
                                class="form-control @error('bukti_pembayaran') is-invalid @enderror">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success w-100">
                                Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
@push('custom-script')
    <script>
        $(document).ready(function() {
            @if (Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            @if (Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
        });
    </script>
@endpush
