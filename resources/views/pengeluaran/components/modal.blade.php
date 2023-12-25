    {{-- Modal Tambah Pengeluaran --}}
    <div class="modal fade bd-transaksi-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengeluaran Baru</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex justify-content-end">
                        <div class="col-1">
                            <a class="btn btn-success tambahform" title="Copy"> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <form action="{{ url('pengeluaran') }}" method="POST">
                        @csrf
                        <div id="formContainer" class="form-transaksi">
                            <div class="row">
                                <div class="col">
                                    <label for="">No Pengeluaran</label>
                                    <input type="text" class="form-control nomorp" name="nopengeluaran[]">
                                </div>
                                <div class="col">
                                    <label for="">Keterangan</label>
                                    <input type="text" class="form-control keterangan" name="keterangan[]">
                                </div>
                                <div class="col">
                                    <label for="">Jumlah</label>
                                    <input type="text" class="form-control jumlah" id="jumlah" name="jumlah[]">
                                </div>
                                <div class="col">
                                    <label for="">Harga</label>
                                    <input type="text" class="form-control harga" name="harga[]">
                                </div>
                                <div class="col">
                                    <label for="">Total</label>
                                    <input type="text" class="form-control total" id="total" name="total[]"
                                        readonly>
                                </div>
                                <div class="col">
                                    <button type="button" class="btn btn-danger hapusform"><i
                                            class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col">
                                <label for="">Sub Total</label>
                                <input type="text" class="form-control subtotal" name="subtotal" readonly>
                            </div>
                        </div>

                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                            {{-- <button type="submit" class="btn btn-primary">Simpan</button> --}}
                            <p class="btn btn-danger" data-toggle="modal" data-target="#bayarPengeluaran">Bayar</p>
                        </div>

                        <div class="modal fade" id="bayarPengeluaran" tabindex="-1"
                            aria-labelledby="bayarPengeluaranLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bayarPengeluaranLabel">Pilih Metode Pembayaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col">
                                                <select name="metode" class="form-control">
                                                    <option value="">Pilih Metode</option>
                                                    @foreach ($bank as $via)
                                                        <option value="{{ $via }}">Kas Bank {{ $via }}
                                                        </option>
                                                    @endforeach
                                                    <option value="tunai">Kas Penjualan</option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
