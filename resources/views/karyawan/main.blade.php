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
                                    onclick="window.location='{{ url('tambah-karyawan') }}'">
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
                                        <th>Id Karyawan</th>
                                        <th>Nama Karywan</th>
                                        <th>Alamat</th>
                                        <th>No Handphone</th>
                                        <th>Email</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $row)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <th>{{ $row->id_karyawan }}</th>
                                            <th>{{ $row->nama_karyawan }}</th>
                                            <th>{{ $row->alamat }}</th>
                                            <th>{{ $row->no_hp }}</th>
                                            <th>{{ $row->email }}</th>
                                            <th><img src="assets/images/fotokaryawan/{{ $row->foto }}"
                                                    alt="Foto Karyawan" width="100" height="120">
                                            </th>
                                            @if (auth()->check())
                                                @if (auth()->user()->level == 1)
                                                    <th>
                                                        <button
                                                            onclick="window.location='{{ url('karyawan/' . $row->id_karyawan) }}'"
                                                            class="btn btn-sm btn-info" title="Edit Data">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <form method="POST"
                                                            action="{{ 'karyawan/' . $row->id_karyawan }}"
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
                                                    <th><button class="btn btn-sm btn-warning" title="Tidak Ada Akses">
                                                            <i class="fa fa-exclamation-triangle"></i> </button></th>
                                                @endif
                                            @endif
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
</div>
<!--**********************************
            Content body end
        ***********************************-->
@include('partials.footer')
