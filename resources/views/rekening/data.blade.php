@extends('rekening.index')

@section('judul')
    {{-- <h1>Data Pelanggan</h1> --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Rekening</h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Data
                    </button>
                    <div class="pesan mt-2">
                        @if (session('msg'))
                            <div class="alert alert-primary alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span>
                                </button> {{ session('msg') }}
                            </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Rekening</th>
                                    <th>Atas Nama</th>
                                    <th>Bank</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $rek)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rek->no_rekening }}</td>
                                        <td>{{ $rek->atas_nama }}</td>
                                        <td>{{ $rek->bank }}</td>
                                        <td>
                                            <form method="POST" action="{{ 'rekening/' . $rek->id }}"
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

    @include('rekening.modal.modal')
@endsection
