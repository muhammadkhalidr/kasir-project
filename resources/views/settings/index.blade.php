@extends('settings.main')

@section('judul')
    <h3> <i class="fa fa-cogs"></i> Settings</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pesan mt2">
                            @if (session('msg'))
                                <div class="alert alert-success">
                                    {{ session('msg') }}
                                </div>
                            @endif
                        </div>
                        @foreach ($data as $item)
                            <form action="{{ route('setting.update', $item->id_setting) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $item->id_setting }}" name="id_setting">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="perusahaan">Nama Perusahaan</label>
                                        <input type="text" class="form-control" id="perusahaan" name="nama_perusahaan"
                                            value="{{ $item->perusahaan }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="{{ $item->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="{{ $item->alamat }}">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="phone">No Handphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            value="{{ $item->phone }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="instagram">Instagram</label>
                                        <input type="text" class="form-control" id="instagram" name="ig"
                                            value="{{ $item->instagram }}">
                                    </div>
                                </div>
                                @if (auth()->check())
                                    @if (auth()->user()->level == 2)
                                        <hr>
                                        <h4 class="text-center"><i class="bi bi-clock"></i> Jam Transaksi</h4>
                                        <hr>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dari">Dari Jam</label>
                                                <input type="number" class="form-control" id="dari" name="darijam"
                                                    value="{{ $item->darijam }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="sampaijam">Sampai Jam</label>
                                                <input type="number" class="form-control" id="sampaijam" name="sampaijam"
                                                    value="{{ $item->sampaijam }}">
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <div class="form-group">
                                    <label for="footer-invoice">Footer Invoice</label>
                                    <textarea name="footer_invoice" id="" cols="30" rows="10" class="form-control text-center">{{ $item->pesan }}
                                    </textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('setting') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" class="form-control" id="logo"
                                    value="{{ $item->logo }}">
                            </div>
                            <div class="form-group">
                                <label for="favicon">Favicon</label>
                                <input type="file" name="favicon" class="form-control" id="favicon"
                                    value="{{ $item->favicon }}">
                            </div>
                            <div class="form-group">
                                <label for="logo_login">Logo Login</label>
                                <input type="file" name="logo_login" class="form-control" id="logo_login"
                                    value="{{ $item->logo_login }}">
                            </div>
                            <div class="form-group">
                                <label for="lunas">Logo Lunas</label>
                                <input type="file" name="lunas" class="form-control" id="lunas"
                                    value="{{ $item->logo_lunas }}">
                            </div>
                            <div class="form-group">
                                <label for="blunas">Logo Belum Lunas</label>
                                <input type="file" name="blunas" class="form-control" id="blunas"
                                    value="{{ $item->logo_blunas }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        @foreach ($data as $item)
                            <div class="form-group col-md-6">
                                <label for="">Logo</label>
                                <img src="assets/images/settings/{{ $item->logo }}" alt="Logo"
                                    class="logo-settings form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="faviocn">Favicon</label>
                                <img src="assets/images/settings/{{ $item->favicon }}" alt="favicon"
                                    class="favicon-settings form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="login-logo">Login Logo</label>
                                <img src="assets/images/settings/{{ $item->login_logo }}" alt="login-logo"
                                    class="logo-settings form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="login-logo">Login Lunas</label>
                                <img src="assets/images/settings/{{ $item->logo_lunas }}" alt="logo-lunas"
                                    class="logo-settings form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="login-logo">Login Belum Lunas</label>
                                <img src="assets/images/settings/{{ $item->logo_blunas }}" alt="logo-blunas"
                                    class="logo-settings form-control">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- #/ container -->
