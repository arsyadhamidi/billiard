@extends('dashboard.layout.master')
@section('menuPengaturan', 'active')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pengaturan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                {{--  Biodata  --}}
                <div class="col-lg-4">
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-header">
                                <b>Biodata</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <div class="mb-4">
                                            @if ($users->foto_profile)
                                                <img src="{{ asset('storage/' . $users->foto_profile) }}"
                                                    class="img-circle elevation-1" alt="" width="100"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('images/foto-profile.png') }}"
                                                    class="img-circle elevation-1" alt="" width="120">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <div class="mb-4">
                                            <h5><strong>{{ $users->name ?? '-' }}</strong></h5>
                                            <p class="text-muted">{{ $users->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <b>Nama Lengkap</b>
                                            <p class="text-muted">{{ $users->name ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <b>Email</b>
                                            <p class="text-muted">{{ $users->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <b>Role</b>
                                            <p class="text-muted">
                                                @if ($users->level_id == '1')
                                                    Admin
                                                @else
                                                    Pelanggan
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <b>Nomor Telepon</b>
                                            <p class="text-muted">{{ $users->telp ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active mx-3" id="pills-home-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-home" type="button"
                                                        role="tab" aria-controls="pills-home" aria-selected="true"
                                                        style="border: none;">Biodata</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-3" id="pills-profile-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-profile" type="button"
                                                        role="tab" aria-controls="pills-profile" aria-selected="false"
                                                        style="border: none;">Email</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-3" id="pills-contact-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-contact" type="button"
                                                        role="tab" aria-controls="pills-contact" aria-selected="false"
                                                        style="border: none;">Password</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link mx-3" id="pills-gambar-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-gambar" type="button"
                                                        role="tab" aria-controls="pills-gambar" aria-selected="false"
                                                        style="border: none;">Photo
                                                        Profil</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                                    aria-labelledby="pills-home-tab">
                                                    @include('setting.profil')
                                                </div>
                                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                                    aria-labelledby="pills-profile-tab">
                                                    @include('setting.email')
                                                </div>
                                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                                    aria-labelledby="pills-contact-tab">
                                                    @include('setting.password')
                                                </div>
                                                <div class="tab-pane fade" id="pills-gambar" role="tabpanel"
                                                    aria-labelledby="pills-gambar-tab">
                                                    @include('setting.gambar')
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($users->foto_profile)
                        <div class="mb-4">
                            <form action="{{ route('setting.hapusgambar') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><b>Hapus Photo Profil</b></h4>
                                        <br>
                                        <p>Apakah anda yakin untuk menghapus foto profile anda ? Jika di hapus maka akan
                                            terhapus secara permanen</p>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Apakah anda yakin menghapus gambar ini ?')">
                                            <i class="fas fa-times"></i>
                                            Hapus Photo Profile
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
