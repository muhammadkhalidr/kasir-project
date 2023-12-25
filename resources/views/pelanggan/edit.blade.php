@include('partials.header')
@include('partials.sidebar')


<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
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
                                onclick="window.location='{{ url('pelanggan') }}'" style="cursor: pointer"></i> Edit
                            Data
                            Pelanggan</h2>
                        <div class="form-validation">
                            <form class="form-valide" action="{{ url('pelanggan/' . $id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="id">ID Pelanggan
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control-plaintext" id="id"
                                            name="id" value="{{ $id }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nama">Nama <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('nama')
                                        is-invalid
                                        @enderror"
                                            id="nama" name="nama" value="{{ $nama }}">
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="alamat">Alamat <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea name="alamat" id="alamat" cols="30" rows="10"
                                            class="form-control @error('alamat')
                                        is-invalid
                                        @enderror">{{ $alamat }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="nohp">No Handphone<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('nohp')
                                        is-invalid
                                        @enderror"
                                            id="nohp" name="nohp" value="{{ $nohp }}">
                                        @error('nohp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="email">Email<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text"
                                            class="form-control @error('email')
                                        is-invalid
                                        @enderror"
                                            id="email" name="email" value="{{ $email }}">
                                        @error('email')
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
