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
                        <form action="{{ route('data-pemesanan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('data-pemesanan.index') }}" class="btn btn-default">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row">

                                        {{--  Pelanggan  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Pelanggan</label>
                                                <select name="users_id"
                                                    class="form-control @error('users_id') is-invalid @enderror"
                                                    id="selectedUsers" style="width: 100%">
                                                    <option value="" selected>Pilih Pelanggan</option>
                                                    @foreach ($users as $data)
                                                        <option value="{{ $data->id ?? '' }}"
                                                            {{ old('users_id') == $data->id ? 'selected' : '' }}>
                                                            {{ $data->name ?? '-' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('users_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Meja  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Meja</label>
                                                <select name="meja_id"
                                                    class="form-control @error('meja_id') is-invalid @enderror"
                                                    id="selectedMeja" style="width: 100%">
                                                    <option value="" selected>Pilih Meja</option>
                                                    @foreach ($mejas as $data)
                                                        <option value="{{ $data->id ?? '' }}"
                                                            {{ old('meja_id') == $data->id ? 'selected' : '' }}>
                                                            {{ $data->no_meja ?? '-' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('meja_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Paket  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Paket</label>
                                                <select name="paket_id"
                                                    class="form-control @error('paket_id') is-invalid @enderror"
                                                    id="selectedPaket" style="width: 100%">
                                                    <option value="" selected>Pilih Paket</option>
                                                    @foreach ($pakets as $data)
                                                        <option value="{{ $data->id ?? '' }}"
                                                            {{ old('paket_id') == $data->id ? 'selected' : '' }}>
                                                            {{ $data->nama ?? '-' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('paket_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Status  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Status</label>
                                                <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror"
                                                    id="selectedStatus" style="width: 100%">
                                                    <option value="" selected>Pilih Status</option>
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                        Dipesan</option>
                                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>
                                                        Sedang Berlangsung</option>
                                                    <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>
                                                        Selesai</option>
                                                    <option value="4" {{ old('status') == '4' ? 'selected' : '' }}>
                                                        Batal</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Tanggal Booking  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Paket</label>
                                                <input type="date" name="tgl_booking"
                                                    class="form-control @error('tgl_booking') is-invalid @enderror"
                                                    value="{{ old('tgl_booking', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                                @error('tgl_booking')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>



                                        {{--  Waktu Mulai  --}}
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label>Waktu Mulai</label>
                                                <input type="time" name="waktu_mulai"
                                                    class="form-control @error('waktu_mulai') is-invalid @enderror"
                                                    value="{{ old('waktu_mulai') }}">
                                                @error('waktu_mulai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Waktu Selesai  --}}
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label>Waktu Selesai</label>
                                                <input type="time" name="waktu_selesai"
                                                    class="form-control @error('waktu_selesai') is-invalid @enderror"
                                                    value="{{ old('waktu_selesai') }}">
                                                @error('waktu_selesai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Bukti Pembayaran  --}}
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Bukti Pembayaran</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="bukti_pembayaran"
                                                            class="custom-file-input @error('bukti_pembayaran') is-invalid @enderror"
                                                            id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                        @error('bukti_pembayaran')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-save"></i>
                                            Simpan Data
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('custom-script')
    <script>
        $('#selectedUsers').select2({
            theme: 'bootstrap4'
        });
        $('#selectedMeja').select2({
            theme: 'bootstrap4'
        });
        $('#selectedPaket').select2({
            theme: 'bootstrap4'
        });
        $('#selectedStatus').select2({
            theme: 'bootstrap4'
        });
    </script>
@endpush
