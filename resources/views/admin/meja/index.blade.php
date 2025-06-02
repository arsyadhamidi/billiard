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
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('data-meja.create') }}" class="btn btn-default">
                                <i class="fas fa-plus"></i>
                                Tambahkan Data Meja
                            </a>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped" id="myTable" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="width: 4%">#</th>
                                        <th>No. Meja</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mejas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->no_meja ?? '-' }}</td>
                                            <td>{{ $data->lokasi ?? '-' }}</td>
                                            <td>
                                                @if ($data->status == '1')
                                                    <span class="badge badge-success">
                                                        Tersedia
                                                    </span>
                                                @elseif($data->status == '2')
                                                    <span class="badge badge-primary">
                                                        Dipesan
                                                    </span>
                                                @elseif($data->status == '3')
                                                    <span class="badge badge-warning">
                                                        Sedang Berlangsung
                                                    </span>
                                                @else
                                                    <span class="badge badge-secondary">
                                                        Tidak Tersedia
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{ route('data-meja.edit', $data->id) }}" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('data-meja.destroy', $data->id ?? '') }}"
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
    </section>

@endsection
