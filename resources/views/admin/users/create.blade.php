@extends('dashboard.layout.master')
@section('menuUserRegistrasi', 'active')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Registrasi</h1>
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
                        <form action="{{ route('data-users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('data-users.index') }}" class="btn btn-default">
                                        <i class="fas fa-arrow-left"></i>
                                        Kembali
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{--  Nama Lengkap  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Nama Lengkap</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" placeholder="Masukan nama lengkap">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Email  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Alamat email</label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" placeholder="Masukan alamat email">
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Telepon  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Telepon</label>
                                                <input type="text" name="telp"
                                                    class="form-control @error('telp') is-invalid @enderror"
                                                    value="{{ old('telp') }}" placeholder="Masukan nomor telepon">
                                                @error('telp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{--  Role  --}}
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label>Role</label>
                                                <select name="level_id"
                                                    class="form-control @error('level_id') is-invalid @enderror"
                                                    id="selectedLevel" style="width: 100%">
                                                    <option value="" selected>Pilih Role</option>
                                                    <option value="1" {{ old('level_id') == '1' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>
                                                    <option value="2" {{ old('level_id') == '2' ? 'selected' : '' }}>
                                                        Pelanggan</option>
                                                </select>
                                                @error('level_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Photo Profil</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="foto_profile"
                                                            class="custom-file-input @error('foto_profile') is-invalid @enderror"
                                                            id="customFile">
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                        @error('foto_profile')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
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
        //Initialize Select2 Elements
        $('#selectedLevel').select2({
            theme: 'bootstrap4'
        })
    </script>
@endpush
