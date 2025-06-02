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
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('data-paket.create') }}" class="btn btn-default">
                                    <i class="fas fa-plus"></i>
                                    Tambahkan Data Paket
                                </a>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped" id="myTable" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">#</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Mulai</th>
                                            <th>Selesai</th>
                                            <th>Durasi</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pakets as $data)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $data->nama ?? '-' }}</td>
                                                <td>{{ $data->harga ?? '-' }}</td>
                                                <td>{{ $data->waktu_mulai ?? '-' }}</td>
                                                <td>{{ $data->waktu_selesai ?? '-' }}</td>
                                                <td>{{ $data->durasi ?? '-' }}</td>
                                                <td>{{ $data->deskripsi ?? '-' }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('data-paket.edit', $data->id) }}" class="btn btn-info">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('data-paket.destroy', $data->id ?? '') }}"
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
