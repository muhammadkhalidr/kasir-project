@extends('layout.main')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @foreach ($data as $user)
                            <div class="text-center">
                                <img alt="" class="rounded-circle mt-4"
                                    src="{{ asset('/') }}assets/images/avatar/{{ $user->foto }}" width="100">
                                <h4 class="card-widget__title text-dark mt-3">{{ $user->name }}</h4>
                                <p class="text-muted">{{ $user->email }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer border-0 bg-transparent mb-5">
                        <div class="row">
                            <div class="col-4 border-right-1 pt-3">
                                <div class="text-center d-block text-muted">
                                    <button type="button" class="btn gradient-2" data-toggle="modal"
                                        data-target="#modalUbahPw"><i class="fa fa-cog"></i> Ubah Password</button>
                                </div>
                            </div>
                            <div class="col-4 border-right-1 pt-3">
                                <div class="text-center d-block text-muted">
                                    <button type="button" class="btn gradient-1" data-toggle="modal"
                                        data-target="#modalUbahFoto"><i class="fa fa-image"></i> Ubah Foto</button>
                                </div>
                            </div>
                            <div class="col-4 pt-3">
                                <div class="text-center d-block text-muted">
                                    <button type="button" class="btn gradient-3" data-toggle="modal"
                                        data-target="#modalUbahData"><i class="fa fa-user"></i> Ubah Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Password -->
    <div class="modal fade" id="modalUbahPw">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Password</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Password Lama</label>
                            <input type="password" class="form-control" name="passwordLama">
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" class="form-control" name="passwordBaru">
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" name="konfirmasiPassword">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Foto -->
    <div class="modal fade" id="modalUbahFoto">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Foto</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            @foreach ($data as $item)
                                <div class="container mb-2 text-center">
                                    <img src="{{ asset('/') }}assets/images/avatar/{{ $item->foto }}"
                                        class="rounded-circle mt-4" width="100">
                                </div>
                            @endforeach
                            <label>Pilih Foto Baru</label>
                            <input type="file" class="form-control" name="foto">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Data -->
    <div class="modal fade" id="modalUbahData">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        @foreach ($data as $datas)
                        @endforeach
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="{{ $datas->name }}">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $datas->username }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $datas->email }}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- #/ container -->
