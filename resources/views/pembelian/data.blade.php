@include('partials.header')
@include('partials.sidebar')

<style>
    .modal-fullscreen {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        max-width: 100%;
    }

    .modal-fullscreen .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    .modal-fullscreen .modal-body {
        overflow-y: auto;
    }
</style>
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $breadcrumb }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Pembelian</h4>
                        <button type="button" class="btn btn-primary"
                            onclick="window.location='{{ url('pembelianbaru') }}'">
                            <i class="fa fa-plus-circle"></i> Tambah Data Baru
                        </button>
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target=".bd-pembelian-modal-lg"> <i class="fa fa-plus"></i> Tambah Data</button> --}}
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
                                        <th>No Faktur</th>
                                        <th>Bahan</th>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Total</th>
                                        <th>DP</th>
                                        <th>Sisa</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembelians as $row)
                                        <tr>
                                            <th><span class="label label-info">{{ $loop->iteration }}</span></th>
                                            <th>{{ $row->id_pembelian }}</th>
                                            <th>{{ $row->bahan }}</th>
                                            <th>{{ $row->jenis }}</th>
                                            <th>{{ $row->jumlah }}</th>
                                            <th>{{ $row->satuan }}</th>
                                            <th>Rp. {{ number_format($row->total, 0, ',', '.') }}</th>
                                            <th>Rp. {{ number_format($row->uang_muka, 0, ',', '.') }}</th>
                                            <th>Rp. {{ number_format($row->sisa_pembayaran, 0, ',', '.') }}</th>
                                            <th>{{ $row->created_at }}</th>
                                            <th>
                                                <button
                                                    onclick="window.location='{{ url('pembelian/' . $row->id_pembelian) }}'"
                                                    class="btn btn-sm btn-info" title="Edit Data">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <form method="POST" action="{{ 'pembelian/' . $row->id_pembelian }}"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus Data"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('pembelian.print_faktur', $row->id_pembelian) }}"
                                                    class="btn btn-sm btn-primary mb-1" title="Print Faktur"
                                                    target="_blank">
                                                    <i class="fa fa-print"></i>
                                                </a>

                                            </th>
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
    <!-- #/ container -->

    {{-- Modal --}}
    <div class="modal fade bd-pembelian-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('pembelian') }}" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <table class="table table-striped table-sm" id="table_pengeluaran">
                                <thead>
                                    <tr>
                                        <td>No Faktur</td>
                                        <td>Bahan</td>
                                        <td>Jenis</td>
                                        <td>Qty</td>
                                        <td>Satuan</td>
                                        <td>DP</td>
                                        <td>Sisa</td>
                                        <td>Sub total</td>
                                        {{-- <td><button type="button" class="btn btn-info btn-sm add_mores"><i
                                                    class="fa fa-plus"></i></button></td> --}}
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="row_Count" id="row_Count">
                                        <td>
                                            <input type="text"
                                                class="form-control input-default @error('txtid')
                                        is-invalid
                                        @enderror"
                                                id="txtid" name="txtid" value="{{ old('txtid') }}">
                                            @error('txtid')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <input type="text"
                                                    class="form-control input-default @error('txtbahan')
                                            is-invalid
                                            @enderror"
                                                    id="txtbahan" name="txtbahan" value="{{ old('txtbahan') }}">
                                                @error('txtbahan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <input type="text"
                                                    class="form-control input-default @error('txtjenis')
                                            is-invalid
                                            @enderror"
                                                    id="txtjenis" name="txtjenis" value="{{ old('txtjenis') }}">
                                                @error('txtjenis')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </td>
                                        <td> <input type="text"
                                                class="form-control input-default @error('txtjumlah')
                                        is-invalid
                                        @enderror"
                                                id="txtjumlah" name="txtjumlah" value="{{ old('txtjumlah') }}">
                                            @error('txtjumlah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td> <input type="text"
                                                class="form-control input-default @error('txtsatuan')
                                        is-invalid
                                        @enderror"
                                                id="txtsatuan" name="txtsatuan" value="{{ old('txtsatuan') }}">
                                            @error('txtsatuan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text"
                                                class="form-control input-default @error('txtsisa')
                                    is-invalid
                                    @enderror"
                                                id="txtsisa" name="txtsisa" value="{{ old('txtsisa') }}">
                                            @error('txtsisa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td> <input type="text"
                                                class="form-control input-default @error('txtdp')
                                        is-invalid
                                        @enderror"
                                                id="txtdp" name="txtdp" value="{{ old('txtdp') }}">
                                            @error('txtdp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td> <input type="text"
                                                class="form-control input-default @error('txttotal')
                                    is-invalid
                                    @enderror"
                                                id="txttotal" name="txttotal" value="{{ old('txttotal') }}">
                                            @error('txttotal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".add_mores").click(function() {
                var newRow = '<tr class="row_Count" id="row_Count">' +
                    '<td><input id="id_pengeluaran_" type="hidden"><input class="form-control form-control-sm" type="text"></td>' +
                    '<td><div class="input-group mb-3"><input class="form-control form-control-sm" type="text"><input type="hidden"></div></td>' +
                    '<td><div class="input-group mb-3"><input class="form-control form-control-sm flat" id="supplier_" type="text"><input id="id_supplier_" type="hidden"></div></td>' +
                    '<td><input class="form-control form-control-sm" type="text"></td>' +
                    '<td><input class="form-control form-control-sm" type="text"></td>' +
                    '<td><input class="form-control form-control-sm" type="text"></td>' +
                    '<td><input class="form-control form-control-sm" type="text"></td>' +
                    '<td><input class="form-control form-control-sm" type="text"></td>' +
                    '<td><button class="btn btn-danger btn-sm del_more"><i class="fa fa-times"></i></button></td>' +
                    '</tr>';

                // Menambahkan baris baru ke dalam tabel
                $("#table_pengeluaran tbody").append(newRow);
            });
        });
    </script>

    <!--**********************************
            Content body end
        ***********************************-->
    @include('partials.footer')
