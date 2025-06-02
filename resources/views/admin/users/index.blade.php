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
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('data-users.create') }}" class="btn btn-default">
                                    <i class="fas fa-plus"></i>
                                    Tambah User Registrasi
                                </a>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped" id="myTable" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->name ?? '-' }}</td>
                                                <td>{{ $data->email ?? '-' }}</td>
                                                <td>
                                                    @if ($data->level_id == '1')
                                                        <span class="badge badge-primary">Admin</span>
                                                    @elseif ($data->level_id == '2')
                                                        <span class="badge badge-success">Pelanggan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $data->telp ?? '-' }}
                                                </td>
                                                <td class="d-flex">
                                                    <a href="{{ route('data-users.edit', $data->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('data-users.destroy', $data->id ?? '') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger mx-2" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')">
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
