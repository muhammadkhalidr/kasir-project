    {{-- Modal Transaksi --}}
    <div class="modal fade bd-transaksi-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">
                        Transaksi Baru dengan
                        No
                        #{{ $notrx }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-header">

                </div>
                <div class="modal-body">
                    {{-- <div class="col">
                        <input type="text" class="form-control" id="pemesan" readonly>
                    </div>
                    <div class="col mt-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#pelangganModal">
                            <i class="fa fa-plus"></i> Cari Pelanggan
                        </button>
                    </div> --}}


                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-none row">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card shadow-none row">
                                                <div class="card-header d-flex justify-content-between py-0">
                                                    <h5 class="card-title">
                                                        <label for="" class="form-label">Nama Pemesan</label>
                                                        <input type="text" class="form-control" id="pemesan"
                                                            autocomplete="off" readonly>
                                                    </h5>
                                                    <div class="d-flex ">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#pelangganModal" title="Cari pelanggan"
                                                                class="btn btn-primary btn-sm cari flat"
                                                                id="cariP"><i
                                                                    class="fa fa-search fa-1x"></i>[F2]</button>
                                                            <button type="button" data-toggle="modal"
                                                                data-target="#tambahPelangganModal"
                                                                title="Cari pelanggan"
                                                                class="btn btn-info btn-sm cari flat" id="tambahP"><i
                                                                    class="fa fa-user-plus fa-1x"></i>[F4]</button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="card-body py-0">
                                                    Alamat : <span id="alamat"></span>
                                                    <hr class="p-1 m-0">
                                                    Telp: <span id="nohp"></span>
                                                    <hr class="p-1 m-0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group mb-1">
                                                <div class="input-group">
                                                    <span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
                                                        <span
                                                            class="input-group-text border-info bg-info col-12 text-white"
                                                            data-toggle="tooltip" data-placement="right"
                                                            title="Format MM/DD/YYYY">Tanggal Order</span>
                                                    </span>
                                                    <input type="date" class="form-control text-center tgl_invoice"
                                                        id="tgl_invoice"
                                                        value="{{ carbon\Carbon::now()->format('Y-m-d') }}">
                                                </div>
                                            </div>
                                            <div class="form-group mb-1">
                                                <div class="input-group">
                                                    <span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
                                                        <span
                                                            class="input-group-text border-success bg-success col-12 text-white"
                                                            data-toggle="tooltip" data-placement="right"
                                                            title="Format MM/DD/YYYY">Tanggal
                                                            Selesai</span>
                                                    </span>
                                                    <input type="date" class="form-control text-center"
                                                        id="tgl_ambil" style="width:120px!important" value="">
                                                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                                    <input type="text" class="form-control text-center jam"
                                                        onchange="cektgl()" id="jam_ambil" value=""
                                                        placeholder="Jam">
                                                </div>
                                            </div>
                                            <div class="form-group mb-1">
                                                <input type="hidden" id="marketing" value="">

                                                <div class="input-group">
                                                    <span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
                                                        <span
                                                            class="input-group-text border-primary bg-primary col-12 text-white">Kasir</span>
                                                    </span>
                                                    <input type="text" class="form-control" id="namamarketing"
                                                        value="{{ $user->name }}"@readonly(true)>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <div class="input-group">
                                                    <span class="input-group-prepend col-3 ml-0 mr-0 pl-0 pr-0">
                                                        <span class="input-group-text col-12">Pajak</span>
                                                    </span>
                                                    <input type="text" class="form-control text-center w-15"
                                                        id="pajaksum" value="" readonly="readonly">
                                                    <span class="input-group-prepend">
                                                        <span class="input-group-text">Total Order</span>
                                                    </span>
                                                    <input type="text" class="form-control text-right w-30"
                                                        id="totalSum" name="totalSum" readonly="readonly"
                                                        aria-describedby="sizing-addon1">
                                                    <input type="hidden" class="form-control text-right w-30"
                                                        id="sum_total_order" name="sum_total_order"
                                                        readonly="readonly" aria-describedby="sizing-addon1">
                                                </div>
                                            </div>
                                            <div class="form-group mb-1">
                                                <div class="input-group">
                                                    <span class="input-group-prepend col-3 ml-0 mr-0 pl-0 pr-0">
                                                        <span class="input-group-text col-12">Total Bayar</span>
                                                    </span>
                                                    <input type="text"
                                                        class="form-control text-right margin-5 w-25" id="uangmuka"
                                                        value="" readonly="readonly">
                                                    <span class="input-group-prepend  title_diskon">
                                                        <span class="input-group-text border-success bg-success"
                                                            id="title_diskon">Diskon</span>
                                                    </span>
                                                    <input type="text"
                                                        class="form-control text-right margin-5 w-30 title_diskon"
                                                        id="potongan_harga_diskon" readonly="readonly">
                                                    <input type="hidden" class="form-control text-right margin-5"
                                                        id="potongan_harga" value="" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group mb-1">
                                                <div class="input-group">
                                                    <span class="input-group-prepend col-3 ml-0 mr-0 pl-0 pr-0">
                                                        <span
                                                            class="input-group-text border-danger bg-danger  col-12">Piutang</span>
                                                    </span>
                                                    <input type="text" class="form-control text-right margin-5"
                                                        id="sisaSum" value="0" readonly="readonly">

                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="row d-flex justify-content-end mt-2">
                        <div class="col-1">
                            <a class="btn btn-success tambahform" title="Copy"> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                    <form action="{{ url('orderan') }}" method="POST">
                        @csrf
                        <div id="formContainer" class="form-transaksi">
                            <input type="hidden" class="form-control notrx" name="notrx[]"
                                value="{{ $notrx }}">
                            <input type="hidden" value="{{ $user->name }}" name="namakasir">
                            <div class="row">
                                <input type="hidden" class="form-control namapemesan" name="namapemesan[]"
                                    id="pemesan2">
                                <input type="hidden" class="form-control idpemesan" name="idpelanggan[]">
                                <div class="col">
                                    <label for="">Nama Barang</label>
                                    <input type="text" class="form-control namabarang" name="namabarang[]"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control keterangan" name="keterangan[]"
                                        required>
                                </div>
                                <div class="col">
                                    <label for="">Jumlah Barang</label>
                                    <input type="text" class="form-control jumlah" name="jumlah[]" required>
                                </div>
                                <div class="col">
                                    <label for="">Harga Barang</label>
                                    <input type="text" class="form-control harga" name="harga[]" required>
                                </div>
                                <div class="col">
                                    <label for="">Total</label>
                                    <input type="text" class="form-control total" name="total[]" readonly>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger hapusform"><i
                                            class="fa fa-trash"></i></button>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <div class="col">
                                <label for="">Uang Muka</label>
                                <input type="text" class="form-control uangmuka" name="uangmuka">
                            </div>
                            <div class="col">
                                <label for="">Sub Total</label>
                                <input type="text" class="form-control subtotal" name="subtotal" readonly>
                            </div>
                            <div class="col">
                                <label for="">Sisa Pembayaran</label>
                                <input type="text" class="form-control sisa" name="sisa" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    <p class="text-info"><i>*Silakah simpan untuk melakukan pelunasan</i></p>
                    <p class="text-warning"><i>*Jika ada uang muka silahkan simpan</i></p>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal DATATransaksi --}}
    @foreach ($dataOrderan->groupBy('notrx') as $notrx => $details)
        <div class="modal fade bd-datatransaksi-modal-lg{{ $notrx }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Data Transaksi No Invoice# {{ $notrx }}</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        {{-- start --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card shadow-none row">
                                    <div class="card-body py-0">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card shadow-none row">
                                                    <div class="card-header d-flex justify-content-between py-0">
                                                        <h5 class="card-title">
                                                            <strong>{{ $details->first()->pelanggans->nama }}</strong>
                                                        </h5>
                                                    </div>
                                                    <div class="card-body py-0">
                                                        Alamat: <span
                                                            id="alamat">{{ $details->first()->pelanggans->alamat }}</span>
                                                        <hr class="p-1 m-0">
                                                        Telp: <span
                                                            id="nohp">{{ $details->first()->pelanggans->nohp }}</span>
                                                        <hr class="p-1 m-0">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group mb-1">
                                                    <div class="input-group">
                                                        <span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
                                                            <span
                                                                class="input-group-text border-info bg-info col-12 text-white"
                                                                data-toggle="tooltip" data-placement="right"
                                                                title="Format MM/DD/YYYY">Tanggal Order</span>
                                                        </span>
                                                        <input type="date"
                                                            class="form-control text-center tgl_invoice"
                                                            id="tgl_invoice"
                                                            value="{{ carbon\Carbon::now()->format('Y-m-d') }}"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <div class="input-group">
                                                        <span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
                                                            <span
                                                                class="input-group-text border-success bg-success col-12 text-white"
                                                                data-toggle="tooltip" data-placement="right"
                                                                title="Format MM/DD/YYYY">Tanggal
                                                                Pelunasan</span>
                                                        </span>
                                                        <input type="text" class="form-control text-center"
                                                            id="tgl_ambil" style="width:120px!important"
                                                            value="{{ $pelunasan->first() && $pelunasan->first()->created_at ? \Carbon\Carbon::parse($pelunasan->first()->created_at)->format('l, d-m-Y') : '00' }}"
                                                            disabled>
                                                        <span class="input-group-text"><i
                                                                class="fa fa-clock-o"></i></span>
                                                        <input type="text" class="form-control text-center jam"
                                                            onchange="cektgl()" id="jam_ambil"
                                                            value="{{ $pelunasan->first() && $pelunasan->first()->created_at ? \Carbon\Carbon::parse($pelunasan->first()->created_at)->format('H:i') : '00' }}"
                                                            placeholder="Jam" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <input type="hidden" id="marketing" value="">

                                                    <div class="input-group">
                                                        <span class="input-group-prepend col-4 ml-0 mr-0 pl-0 pr-0">
                                                            <span
                                                                class="input-group-text border-primary bg-primary col-12 text-white">Kasir</span>
                                                        </span>
                                                        <input type="text" class="form-control"
                                                            value="{{ $details->first()->name_kasir }}"@readonly(true)>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- end --}}

                        <div class="row d-flex justify-content-end"></div>
                        @foreach ($details as $detail)
                            <div class="row">
                                {{-- <div class="col">
                                    <label for="">Nama Pemesan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-lock text-danger"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" value="{{ $detail->namapemesan }}"
                                            readonly>
                                    </div>
                                </div> --}}
                                <div class="col">
                                    <label for="">Nama Barang</label>
                                    <input type="text" class="form-control namabarang"
                                        value="{{ $detail->namabarang }}" readonly>
                                </div>
                                <div class="col">
                                    <label for="">Jumlah Barang</label>
                                    <input type="text" class="form-control jumlah" value="{{ $detail->jumlah }}"
                                        readonly>
                                </div>
                                <div class="col">
                                    <label for="">Harga Barang</label>
                                    <input type="text" class="form-control harga" value="{{ $detail->harga }}"
                                        readonly>
                                </div>
                                <div class="col">
                                    <label for="">Total</label>
                                    <input type="text" class="form-control total" value="{{ $detail->total }}"
                                        readonly>
                                </div>
                            </div>
                        @endforeach

                        <div class="row mt-4">
                            <div class="col">
                                <label for="">Uang Muka</label>
                                <input type="text" class="form-control dp"
                                    value="{{ $details->first()->uangmuka }}" readonly>
                            </div>
                            <div class="col">
                                <label for="">Sub Total</label>
                                <input type="text" class="form-control subtotal"
                                    value="{{ $details->first()->subtotal }}" readonly>
                            </div>
                            <div class="col">
                                <label for="">Sisa</label>
                                <input type="text" class="form-control sisa"
                                    value="{{ $details->first()->sisa }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('orderan.print_invoice', $details->first()->notrx) }}"
                            class="btn btn-sm btn-primary mb-1" title="Print Invoice" target="_blank">
                            <i class="fa fa-print"></i> Cetak Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Pelunasan --}}
    @foreach ($dataOrderan as $bayar)
        <div class="modal fade" id="pelunasanModal{{ $bayar->notrx }}" tabindex="-1"
            aria-labelledby="pelunasanModalLabel{{ $bayar->notrx }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pelunasanModalLabel{{ $bayar->notrx }}">Pelunasan Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('orderan.pelunasan') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="notrx" value="{{ $bayar->notrx }}">

                            <div class="form-group">
                                <label for="caraBayar{{ $bayar->notrx }}">Pilih Cara Bayar:</label>
                                <select class="form-control caraBayar" data-notrx="{{ $bayar->notrx }}"
                                    name="caraBayar">
                                    <option value="tunai">Tunai</option>
                                    <option value="transfer">Transfer Bank</option>
                                </select>
                            </div>

                            <div class="bankOptions" id="bankOptions{{ $bayar->notrx }}" style="display:none;">
                                <div class="form-group">
                                    <label for="via{{ $bayar->notrx }}">Pilih Bank:</label>
                                    <select class="form-control" id="via{{ $bayar->notrx }}" name="via">
                                        @foreach ($rekening as $data)
                                            <option value="{{ $data->bank }}">{{ $data->bank }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jumlahBayar{{ $bayar->notrx }}">Jumlah Bayar:</label>
                                <input type="number" class="form-control jumlahBayar"
                                    id="jumlahBayar{{ $bayar->notrx }}" name="jumlahBayar" required>
                            </div>

                            <div class="form-group">
                                <label for="totalBayar{{ $bayar->notrx }}">Total yang Harus Dibayar:</label>
                                <input type="number" class="form-control totalBayar"
                                    id="totalBayar{{ $bayar->notrx }}" name="totalBayar"
                                    value="{{ $bayar->sisa }}" readonly>
                            </div>

                            <div class="buktiTransferOptions" id="buktiTransferOptions{{ $bayar->notrx }}"
                                style="display:none;">
                                <div class="form-group">
                                    <label for="buktiTransfer{{ $bayar->notrx }}">Bukti Transfer:</label>
                                    <input type="file" class="form-control-file"
                                        id="buktiTransfer{{ $bayar->notrx }}" name="buktiTransfer">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal cari nama pelanggan --}}
    <div class="modal fade" id="pelangganModal" tabindex="-1" aria-labelledby="pelangganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pelangganModalLabel">Cari Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('orderan') }}" action="GET">
                        @csrf
                        <div class="col mt-2">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control mb-3" placeholder="Cari Nama Pelanggan"
                                name="q" id="cariPelanggan">
                            <span id="listPelanggan"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="pilih"
                        data-dismiss="modal">Pilih</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal cari tambah pelanggan --}}
    <div class="modal fade right-modal" id="tambahPelangganModal" tabindex="-1"
        aria-labelledby="tambahPelangganModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPelangganModalLabel">Tambah Pelanggan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('orderan.tambahPelanggan') }}" method="POST">
                        @csrf
                        <div class="col">
                            <label for="kode">Kode Pelanggan</label>
                            <input type="text" class="form-control mb-3" name="kode" required>
                        </div>
                        <div class="col">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control mb-3" name="nama" required>
                        </div>
                        <div class="col">
                            <label for="nohp">No Hanphone</label>
                            <input type="text" class="form-control mb-3" name="nohp" required>
                        </div>
                        <div class="col">
                            <label for="email">Email</label>
                            <input type="text" class="form-control mb-3" name="email" required>
                        </div>
                        <div class="col">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control mb-3" name="alamat" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
