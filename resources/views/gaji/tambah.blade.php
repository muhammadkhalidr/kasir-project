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
                                onclick="window.location='{{ url('gajikaryawan') }}'" style="cursor: pointer"></i>
                            Gaji Karyawan</h2>
                        <div class="settings">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#settingHargaKerja"><i class="fa fa-cog"></i></button>
                        </div>
                        <div class="form-validation">
                            <form class="form-valide" action="{{ url('gajikaryawan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="txtid">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtnama">Nama Karyawan <span
                                            class="text-danger">*</span>
                                    </label>

                                    <div class="col-lg-6">
                                        <select name="txtnama" id="txtnama"
                                            class="form-control @error('txtnama')
                                        is-invalid
                                        @enderror">
                                            <option value="" selected>Pilih Karyawan</option>
                                            @foreach ($karyawans as $n)
                                                <option value="{{ $n->nama_karyawan }}"
                                                    {{ old('txtnama') == $n->nama_karyawan ? 'selected' : '' }}>
                                                    {{ $n->nama_karyawan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('txtnama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtjumlahkerja">Jumlah Kerja<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtjumlahkerja')
                                        is-invalid
                                        @enderror"
                                            id="txtjumlahkerja" name="txtjumlahkerja"
                                            value="{{ old('txtjumlahkerja') }}">
                                        @error('txtjumlahkerja')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtpersen">Persen Gaji<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtpersen')
                                        is-invalid
                                        @enderror"
                                            id="txtpersen" name="txtpersen" value="{{ old('txtpersen') }}">
                                        @error('txtpersen')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="txtgaji">Jumlah Gaji<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('txtgaji')
                                        is-invalid
                                        @enderror"
                                            id="txtgaji" name="txtgaji" value="{{ old('txtgaji') }}">
                                        @error('txtgaji')
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
    {{-- Modal --}}
    <div class="modal fade" id="settingHargaKerja">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setting</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label for="hargaKerja">Harga Kerja:</label>
                    <input type="number" id="hargaKerja" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button id="updateButton" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!--**********************************
            Content body end
        ***********************************-->
@include('partials.footer')
