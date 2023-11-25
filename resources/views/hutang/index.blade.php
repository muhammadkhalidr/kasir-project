@include('partials.header')
@include('partials.sidebar')

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="h page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $breadcrumb }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- h -->

    <div class="container-fluid">
        <div class="h">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Hutang Karyawan</h4>
                        <div class="pesan mt-2">
                            @if (session('error'))
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span>
                                    </button> {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        @if (auth()->check())
                            @if (auth()->user()->level == 1)
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalTambahHutang">Tambah Data</button>
                            @elseif (auth()->user()->level == 2)
                            @endif
                        @endif

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
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hutangs as $h)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <th><span class="label label-primary">{{ $h->id_hutang }}</span></th>
                                            <th>{{ $h->nama }}</th>
                                            <th>Rp. {{ number_format($h->jumlah, 0, ',', '.') }}</th>
                                            <th>Rp. {{ number_format($h->total, 0, ',', '.') }}</th>
                                            @if ($h->total == 0)
                                                <th><span class="label label-success">Lunas</span></th>
                                            @else
                                                <th><span class="label label-warning">Belum Lunas</span></th>
                                            @endif
                                            @if (auth()->check())
                                                @if (auth()->user()->level == 1)
                                                    <th>
                                                        @if ($h->total != 0)
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#modalBayarHutang_{{ $h->id_hutang }}"
                                                                title="Bayar">
                                                                <i class="fa fa-money"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-sm btn-primary"
                                                                title="Sudah Lunas" disabled>
                                                                <i class="fa fa-money"></i>
                                                            </button>
                                                        @endif
                                                        <form method="POST" action="{{ 'hutang/' . $h->id_hutang }}"
                                                            style="display: inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" title="Hapus Data"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </th>
                                                @elseif (auth()->user()->level == 2)
                                                    <th>
                                                        <button class="btn btn-sm btn-warning" title="Tidak Ada Akses">
                                                            <i class="fa fa-exclamation-triangle"></i>
                                                        </button>
                                                    </th>
                                                @endif
                                            @endif
                                        </tr>
                                        <!-- Modal Bayar Hutang -->
                                        <div class="modal fade" id="modalBayarHutang_{{ $h->id_hutang }}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Bayar Hutang</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('hutang.bayar') }}" method="POST"
                                                            id="formBayar">
                                                            @csrf
                                                            <input type="hidden" name="id_hutang"
                                                                value="{{ $h->id_hutang }}">
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Nama</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        name="nama" value="{{ $h->nama }}"
                                                                        readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Jumlah</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        name="jumlah" value="{{ $h->jumlah }}"
                                                                        id="jumlah_{{ $h->id_hutang }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Total</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        name="total" value="{{ $h->total }}"
                                                                        id="total_{{ $h->id_hutang }}" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-sm-2 col-form-label">Jumlah
                                                                    Bayar</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control"
                                                                        name="jml_bayar"
                                                                        id="jml_bayar_{{ $h->id_hutang }}"
                                                                        placeholder="Rp."
                                                                        oninput="updateAmount({{ $h->id_hutang }})">
                                                                </div>
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                        </div>
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
</div>

<!-- Modal Tambah Hutang -->
<div class="modal fade" id="modalTambahHutang">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hutang Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('hutang') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_generate">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="jumlah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="total">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sumber</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="Pendapatan" disabled>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updateAmount(id) {
        var jumlah = parseFloat(document.getElementById('jumlah_' + id).value);
        var bayar = parseFloat(document.getElementById('jml_bayar_' + id).value);

        if (bayar > jumlah) {
            alert("Jumlah bayar melebihi jumlah yang harus dibayar.");
            document.getElementById('jml_bayar_' + id).value = jumlah;
            return;
        }

        var newTotal = jumlah - bayar;
        document.getElementById('total_' + id).value = newTotal;
    }
</script>

<!--**********************************
            Content body end
        ***********************************-->
@include('partials.footer')
