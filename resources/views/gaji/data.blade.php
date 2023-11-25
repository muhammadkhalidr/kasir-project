@include('partials.header')
@include('partials.sidebar')

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
                        <h4 class="card-title">Data Karyawan</h4>
                        @if (auth()->check())
                            @if (auth()->user()->level == 1)
                                <button type="button" class="btn btn-primary"
                                    onclick="window.location='{{ url('tambah-gaji') }}'">
                                    <i class="fa fa-plus-circle"></i> Tambah Data Baru
                                </button>
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
                                        <th>Nama Karywan</th>
                                        <th>Jumlah Gaji</th>
                                        <th>Jumlah Kerja</th>
                                        <th>Persen Gaji</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($gajikaryawans)
                                        @foreach ($gajikaryawans as $gaji)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <th>{{ $gaji->nama_karyawan }}</th>
                                                <th>Rp. {{ number_format($gaji->jumlah_gaji, 0, ',', '.') }}</th>
                                                <th>{{ $gaji->jumlah_kerja }}</th>
                                                <th>{{ $gaji->persen_gaji }} %</th>
                                                @if (auth()->check())
                                                    @if (auth()->user()->level == 1)
                                                        <th>
                                                            <form method="POST"
                                                                action="{{ 'gajikaryawan/' . $gaji->id_gaji }}"
                                                                style="display: inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" title="Hapus Data"
                                                                    class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fa fa-trash"></i> Hapus
                                                                </button>
                                                            </form>
                                                        </th>
                                                    @elseif (auth()->user()->level == 2)
                                                        <th><button class="btn btn-sm btn-warning" title="Tidak Ada Akses">
                                                                <i class="fa fa-exclamation-triangle"></i> </button></th>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endisset
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
<!--**********************************
            Content body end
        ***********************************-->
@include('partials.footer')
