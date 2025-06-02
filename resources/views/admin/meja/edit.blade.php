@extends('dashboard.layout.master')
@section('menuDataMeja', 'active')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Meja</h1>
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
                        <form action="{{ route('data-meja.update', $mejas->id ?? '') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('data-meja.index') }}" class="btn btn-default">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Nomor Meja</label>
                                                <input type="number" name="no_meja"
                                                    class="form-control @error('no_meja') is-invalid @enderror"
                                                    value="{{ old('no_meja', $mejas->no_meja ?? '-') }}" placeholder="Masukan nomor meja">
                                                @error('no_meja')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Status</label>
                                                <select name="status"
                                                    class="form-control @error('status') is-invalid @enderror"
                                                    id="selectedStatus" style="width: 100%">
                                                    <option value="" selected>Pilih Status</option>
                                                    <option value="1" {{ $mejas->status == '1' ? 'selected' : '' }}>
                                                        Tersedia</option>
                                                    <option value="2" {{ $mejas->status == '2' ? 'selected' : '' }}>
                                                        Dipesan</option>
                                                    <option value="3" {{ $mejas->status == '3' ? 'selected' : '' }}>
                                                        Sedang Berlangsung</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label>Lokasi</label>
                                                <input type="text" name="lokasi"
                                                    class="form-control @error('lokasi') is-invalid @enderror"
                                                    value="{{ old('lokasi', $mejas->lokasi ?? '-') }}" placeholder="Masukan lokasi">
                                                @error('lokasi')
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
@push('custom-script')
    <script>
        //Initialize Select2 Elements
        $('#selectedStatus').select2({
            theme: 'bootstrap4'
        })
    </script>
@endpush
