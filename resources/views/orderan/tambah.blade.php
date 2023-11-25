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
                                onclick="window.location='{{ url('orderan') }}'" style="cursor: pointer"></i> Tambah
                            Data Orderan</h2>
                        <div class="form-validation">
                            <form class="form-valide" action="{{ url('orderan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="txtid">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtnoinv">No TRX- <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtnoinv')
                                        is-invalid
                                        @enderror"
                                            id="txtnoinv" name="txtnoinv" value="{{ env('TRX_CODE') }}">
                                        @error('txtnoinv')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtnama">Nama Pemesan <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtnama')
                                        is-invalid
                                        @enderror"
                                            id="txtnama" name="txtnama" value="{{ old('txtnama') }}">
                                        @error('txtnama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtbarang">Nama Barang <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtbarang')
                                        is-invalid
                                        @enderror"
                                            id="txtbarang" name="txtbarang">
                                        @error('txtbarang')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtjumlah">Jumlah Barang <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtjumlah')
                                        is-invalid
                                        @enderror"
                                            id="txtjumlah" name="txtjumlah">
                                        @error('txtjumlah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtharga">Harga Barang <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtharga')
                                        is-invalid
                                        @enderror"
                                            id="txtharga" name="txtharga">
                                        @error('txtharga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txttotal">Total Harga<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txttotal')
                                        is-invalid
                                        @enderror"
                                            id="txttotal" name="txttotal" readonly>
                                        @error('txttotal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtket">Keterangan<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <select name="txtket" id="txtket"
                                            class="form-control @error('txtket')
                                        is-invalid
                                        @enderror">
                                            <option value="" selected>Pilih Keterangan</option>
                                            <option value="L">Lunas</option>
                                            <option value="BL">Belum Lunas</option>
                                        </select>
                                        @error('txtket')
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
                                            id="txtdp" name="txtdp">
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
                                            id="txtsisa" name="txtsisa" readonly>
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
