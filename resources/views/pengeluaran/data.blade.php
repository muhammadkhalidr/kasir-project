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
                        <h4 class="card-title">Data Pengeluaran</h4>
                        {{-- <button type="button" class="btn btn-primary"
                            onclick="window.location='{{ url('pengeluaranbaru') }}'">
                            <i class="fa fa-plus-circle"></i> Tambah Data Baru
                        </button> --}}

                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target=".bd-transaksi-modal-lg"> <i class="fa fa-plus"></i> Pengeluaran
                            Baru</button>
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
                                    <th>Data</th>
                                </thead>
                                <tbody>
                                    @foreach ($groupedPengeluarans as $id_pengeluaran => $groupedPengeluaran)
                                        <tr data-parent="#table-guest">
                                            <td colspan="5" class="p-0">
                                                <table class="table table-striped">
                                                    <thead class="thead-success">
                                                        <tr>
                                                            <th>No Faktur</th>
                                                            <th>
                                                                <button class="btn btn-dark btn-sm">#
                                                                    {{ $groupedPengeluaran[0]->id_pengeluaran }}</button>
                                                            </th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <thead class="thead-primary">
                                                        <tr>
                                                            <th style="width:4%!important" class="text-right">#No.</th>
                                                            <th>Keterangan</th>
                                                            <th class="text-left" style="width:10%!important">Jumlah
                                                            </th>
                                                            <th class="text-center">Harga</th>
                                                            <th class="text-right">Nominal</th>
                                                            <th class="text-right">Tanggal</th>
                                                            <th class="w-10 text-right">Aksi</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @php $firstRow = true; @endphp
                                                        @foreach ($groupedPengeluaran as $pengeluaran)
                                                            <tr>
                                                                <td class="text-center"><span
                                                                        class="label label-info">{{ $loop->iteration }}</span>
                                                                </td>
                                                                <td>{{ $pengeluaran->keterangan }}</td>
                                                                <td class="text-left">{{ $pengeluaran->jumlah }}</td>
                                                                <td class="text-center">Rp.
                                                                    {{ number_format($pengeluaran->harga, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-right">Rp.
                                                                    {{ number_format($pengeluaran->pengeluaran, 0, ',', '.') }}
                                                                </td>
                                                                <td class="text-right">
                                                                    {{ $pengeluaran->formatted_date }}</td>

                                                                <td class="text-right">
                                                                    @if ($firstRow)
                                                                        <form method="POST"
                                                                            action="{{ 'pengeluaran/' . $pengeluaran->id_pengeluaran }}"
                                                                            style="display: inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" title="Hapus Data"
                                                                                class="btn btn-sm btn-danger hapus-btn"
                                                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                                <i class="fa fa-trash"></i> Hapus
                                                                            </button>
                                                                        </form>

                                                                        <a href="{{ route('cetak.print_invoice', $pengeluaran->id_pengeluaran) }}"
                                                                            class="btn btn-sm btn-primary mb-1"
                                                                            title="Print Invoice" target="_blank">
                                                                            <i class="fa fa-print"></i>
                                                                        </a>
                                                                        @php $firstRow = false; @endphp
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        <tr style="background-color: #4d4d4d;color:white;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td class="text-right">
                                                                <b><i>Total</i></b>
                                                            </td>
                                                            <td class="text-right">
                                                                <b><i></i></b>
                                                                Rp.
                                                                {{ number_format($totals[$id_pengeluaran], 0, ',', '.') }}
                                                            </td>
                                                            <td class="text-center"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-left"><strong>Total Pengeluaran</strong></td>
                                        <td class="text-right">
                                            <strong>Rp.{{ number_format($totals->sum(), 0, ',', '.') }}</strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
    @include('pengeluaran.components.modal')
</div>
<!--**********************************
            Content body end
        ***********************************-->

@include('partials.footer')

<script>
    $(document).ready(function() {
        // Menangani klik pada tombol tambahform
        $(document).on("click", ".tambahform", function() {
            // Duplikat form-transaksi
            var newForm = $(".form-transaksi:first").clone();

            // Bersihkan nilai input di form baru
            newForm.find("input").val("");

            // Sisipkan form baru setelah form terakhir
            $(".form-transaksi:last").after(newForm);

            // Tambahkan event handler untuk tombol hapus pada form baru
            newForm.find(".hapusform").on("click", function() {
                // Hapus form saat tombol hapus diklik
                $(this).closest(".form-transaksi").remove();
            });

            $(document).on("click", ".hapusform", function() {
                // Hapus form saat tombol hapus diklik
                $(this).closest(".form-transaksi").remove();
            });
        });

        $(document).on("input", ".jumlah, .harga, .uangmuka, .sisa", function() {
            // Menghitung total untuk setiap form
            $(".form-transaksi").each(function() {
                var jumlah = parseFloat($(this).find(".jumlah").val()) || 0;
                var harga = parseFloat($(this).find(".harga").val()) || 0;

                var total = jumlah * harga;

                $(this).find(".total").val(total);
            });

            // Menghitung subtotal dari semua total
            var subtotal = 0;
            $(".form-transaksi").each(function() {
                subtotal += parseFloat($(this).find(".total").val()) || 0;
            });

            // Mengambil nilai uang muka
            var uangMuka = parseFloat($(".uangmuka").val()) || 0;

            // Mengurangkan uang muka dari total, bukan dari subtotal
            var totalSetelahUangMuka = subtotal - uangMuka;

            // Mengupdate nilai input subtotal
            $(".subtotal").val(subtotal);

            var sisaPembayaran = parseFloat($(".sisa").val()) || 0;
            $(".sisa").val(totalSetelahUangMuka);
        });

        // Menambahkan event listener untuk input uangmuka
        $(document).on("input", ".uangmuka", function() {
            // Menghitung kembali subtotal saat input uangmuka diubah
            var subtotal = 0;
            $(".form-transaksi").each(function() {
                subtotal += parseFloat($(this).find(".total").val()) || 0;
            });

            // Mengambil nilai uang muka
            var uangMuka = parseFloat($(".uangmuka").val()) || 0;

            // Mengurangkan uang muka dari total
            var totalSetelahUangMuka = uangMuka;

            // Mengupdate nilai input subtotal
            $(".subtotal").val(subtotal);
        });


        // Menangani perubahan nilai saat formulir baru ditambahkan
        $(document).on("input", ".form-transaksi:last .jumlah, .form-transaksi:last .harga", function() {
            var jumlah = parseFloat($(this).closest(".row").find(".jumlah").val()) || 0;
            var harga = parseFloat($(this).closest(".row").find(".harga").val()) || 0;

            var total = jumlah * harga;

            $(this).closest(".row").find(".total").val(total);
        });
    });
</script>
