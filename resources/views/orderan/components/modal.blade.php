    {{-- Modal Transaksi --}}
    <div class="modal fade bd-transaksi-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Transaksi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-end">
                        <div class="col-1">
                            <a class="btn btn-success tambahform" title="Copy"> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <form action="{{ url('orderan') }}" method="POST">
                        @csrf
                        <div id="formContainer" class="form-transaksi">
                            <div class="row">
                                <div class="col">
                                    <label for="">Nama Pemesan</label>
                                    <input type="text" class="form-control" name="namapemesan[]">
                                </div>
                                <div class="col">
                                    <label for="">Nama Barang</label>
                                    <input type="text" class="form-control namabarang" name="namabarang[]">
                                </div>
                                <div class="col">
                                    <label for="">Jumlah Barang</label>
                                    <input type="text" class="form-control jumlah" name="jumlah[]">
                                </div>
                                <div class="col">
                                    <label for="">Harga Barang</label>
                                    <input type="text" class="form-control harga" name="harga[]">
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
                        <div class="row d-flex justify-content-end"></div>
                        @foreach ($details as $detail)
                            <div class="row">
                                <div class="col">
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
                                </div>
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

                            <input type="text" name="notrx" value="{{ $bayar->notrx }}">

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
                                    <label for="bank{{ $bayar->notrx }}">Pilih Bank:</label>
                                    <select class="form-control" id="bank{{ $bayar->notrx }}" name="bank">
                                        <option value="bca">BCA</option>
                                        <option value="bri">BRI</option>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tampilkan atau sembunyikan opsi bank dan bukti transfer berdasarkan pilihan cara bayar
            $('.caraBayar').change(function() {
                const notrx = $(this).data('notrx');
                const bankOptions = $(`#bankOptions${notrx}`);
                const buktiTransferOptions = $(`#buktiTransferOptions${notrx}`);

                if ($(this).val() === 'transfer') {
                    bankOptions.show();
                    buktiTransferOptions.show();
                } else {
                    bankOptions.hide();
                    buktiTransferOptions.hide();
                }
            });

            // Hitung total yang harus dibayar berdasarkan jumlah bayar
            $('.jumlahBayar').on('input', function() {
                const notrx = $(this).data('notrx');
                const totalBayar = $(`#totalBayar${notrx}`);
                totalBayar.val($(this).val());
            });
        });

        // Fungsi untuk menyimpan perubahan (Anda dapat menggantinya sesuai kebutuhan)
        // function saveChanges() {
        //     alert('Perubahan disimpan!');
        // }
    </script>
