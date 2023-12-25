@extends('pelanggan.index')

@section('judul')
    {{-- <h1>Data Pelanggan</h1> --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Table</h4>
                    <div class="pesan mt-2">
                        @if (session('msg'))
                            <div class="alert alert-primary alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button> {{ session('msg') }}
                            </div>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary"
                        onclick="window.location='{{ url('tambah-pelanggan') }}'">
                        <i class="fa fa-plus-circle"></i> Tambah Data Baru
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>Kode Pelanggan</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Handphone</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $d->kode_pelanggan }}</td>
                                        <td>{{ $d->nama }}</td>
                                        <td>{{ $d->alamat }}</td>
                                        <td>{{ $d->nohp }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>
                                            <button onclick="window.location='{{ url('pelanggan/' . $d->id) }}'"
                                                class="btn btn-sm btn-info" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <form method="POST" action="{{ 'pelanggan/' . $d->id }}"
                                                style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Hapus Data" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                    <i class="fa fa-trash"></i>
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
@endsection
