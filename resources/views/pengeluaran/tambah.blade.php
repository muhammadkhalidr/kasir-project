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
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pesan mt-2">
                            @if (session('error'))
                                <div class="alert alert-warning alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span>
                                    </button> {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <h2 class="card-title mb-4"> <i class="fa fa-arrow-left"
                                onclick="window.location='{{ url('pengeluaran') }}'" style="cursor: pointer"></i> Tambah
                            Data Pengeluaran</h2>
                        <div class="form-validation">
                            <form class="form-valide" action="{{ url('pengeluaran') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id_generate">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtid">No Pengeluaran<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="txtid" name="txtid"
                                            value="{{ $nomorSelanjutnya }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtket">Keterangan<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtket')
                                        is-invalid
                                        @enderror"
                                            id="txtket" name="txtket" value="{{ old('txtket') }}">
                                        @error('txtket')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtjumlah">Jumlah<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtjumlah')
                                        is-invalid
                                        @enderror"
                                            id="txtjumlah" name="txtjumlah" value="{{ old('txtjumlah') }}">
                                        @error('txtjumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtharga">Harga<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtharga')
                                        is-invalid
                                        @enderror"
                                            id="txtharga" name="txtharga" value="{{ old('txtharga') }}">
                                        @error('txtharga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txttotal">Total<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txttotal')
                                        is-invalid
                                        @enderror"
                                            id="txttotal" name="txttotal" value="{{ old('txttotal') }}" readonly>
                                        @error('txttotal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
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
