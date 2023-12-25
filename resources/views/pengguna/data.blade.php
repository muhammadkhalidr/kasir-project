{{-- @if (auth()->check())
    @if (auth()->user()->level == 1) --}}
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
                        <h4 class="card-title">Data Penguna</h4>
                        <button type="button" class="btn btn-primary"
                            onclick="window.location='{{ url('admin-baru') }}'">
                            <i class="fa fa-plus-circle"></i> Tambah Pengguna
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penggunas as $data)
                                        <tr>    
                                            <th><span class="label label-info">{{ $loop->iteration }}</span>
                                            </th>
                                            <th>{{ $data->name }}</th>
                                            <th>{{ $data->email }}</th>
                                            <th>{{ $data->username }}</th>
                                            <th>{{ $data->level == 1 ? 'Admin' : ($data->level == 3 ? 'Kasir' : 'Owner') }}
                                            </th>
                                            <th>
                                                <form method="POST" action="{{ 'pengguna/' . $data->id }}"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus Data"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="fa fa-trash"></i> Hapus Data
                                                    </button>
                                                </form>
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
</div>
<!--**********************************
                Content body end
            ***********************************-->
@include('partials.footer')
{{-- @elseif (auth()->user()->level == 2)
            <script>
                window.location = "/home"
            </script>
        @endif
    @endif --}}
