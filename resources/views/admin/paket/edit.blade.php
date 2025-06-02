@extends('dashboard.layout.master')
@section('menuDataPaket', 'active')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Paket</h1>
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
                        <form action="{{ route('data-paket.update', $pakets->id ?? '') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('data-paket.index') }}" class="btn btn-default">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Nama Paket</label>
                                                <input type="text" name="nama"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    value="{{ old('nama', $pakets->nama ?? '-') }}" placeholder="Masukan nama paket">
                                                @error('nama')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Harga Paket</label>
                                                <input type="number" name="harga"
                                                    class="form-control @error('harga') is-invalid @enderror"
                                                    value="{{ old('harga', $pakets->harga ?? '-') }}" placeholder="Masukan harga paket">
                                                @error('harga')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label>Waktu Mulai</label>
                                                <input type="time" name="waktu_mulai"
                                                    class="form-control @error('waktu_mulai') is-invalid @enderror"
                                                    value="{{ old('waktu_mulai', $pakets->waktu_mulai ?? '') }}">
                                                @error('waktu_mulai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label>Waktu Selesai</label>
                                                <input type="time" name="waktu_selesai"
                                                    class="form-control @error('waktu_selesai') is-invalid @enderror"
                                                    value="{{ old('waktu_selesai', $pakets->waktu_selesai ?? '') }}">
                                                @error('waktu_selesai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Durasi</label>
                                                <input type="number" name="durasi"
                                                    class="form-control @error('durasi') is-invalid @enderror"
                                                    value="{{ old('durasi', $pakets->durasi ?? '') }}" placeholder="Masukan durasi">
                                                @error('durasi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5"
                                                    placeholder="Masukan deskripsi">{{ old('deskripsi', $pakets->deskripsi ?? '-') }}</textarea>
                                                @error('deskripsi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
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
