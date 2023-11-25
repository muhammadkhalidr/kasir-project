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
                        <h2 class="card-title mb-4"> <i class="fa fa-arrow-left"
                                onclick="window.location='{{ url('pembelian') }}'" style="cursor: pointer"></i> Tambah
                            Data Pembelian</h2>
                        <div class="form-validation">
                            <form class="form-valide" action="{{ url('pembelian/' . $txtid) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtid">No Faktur<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control-plaintext @error('txtid')
                                        is-invalid
                                        @enderror"
                                            id="txtid" name="txtid" value="{{ $txtid }}" readonly>
                                        @error('txtid')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtbahan">Bahan<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtbahan')
                                        is-invalid
                                        @enderror"
                                            id="txtbahan" name="txtbahan" value="{{ $txtbahan }}">
                                        @error('txtbahan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtjenis">Jenis<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtjenis')
                                        is-invalid
                                        @enderror"
                                            id="txtjenis" name="txtjenis" value="{{ $txtjenis }}">
                                        @error('txtjenis')
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
                                            id="txtjumlah" name="txtjumlah" value="{{ $txtjumlah }}">
                                        @error('txtjumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtsatuan">Satuan<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtsatuan')
                                        is-invalid
                                        @enderror"
                                            id="txtsatuan" name="txtsatuan" value="{{ $txtsatuan }}">
                                        @error('txtsatuan')
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
                                            id="txttotal" name="txttotal" value="{{ $txttotal }}">
                                        @error('txttotal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtdp">Uang Muka<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtdp')
                                        is-invalid
                                        @enderror"
                                            id="txtdp" name="txtdp" value="{{ $txtdp }}">
                                        @error('txtdp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtsisa">Sisa<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtsisa')
                                        is-invalid
                                        @enderror"
                                            id="txtsisa" name="txtsisa" value="{{ $txtsisa }}">
                                        @error('txtsisa')
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
