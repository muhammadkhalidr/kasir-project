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
                        <h4 class="card-title">Data Orderan</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target=".bd-transaksi-modal-lg"> <i class="fa fa-plus"></i> Transaksi
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
                        <div class="pesan mt-2">
                            @if (session('success'))
                                <div class="alert alert-primary alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">&times;</span>
                                    </button> {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No TRX</th>
                                        <th>Nama Pemesan</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataOrderan as $item)
                                        @if (!$loop->first && $item->notrx == $dataOrderan[$loop->index - 1]->notrx)
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a class="label label-success text-white" style="cursor: pointer"
                                                    data-toggle="modal"
                                                    data-target=".bd-datatransaksi-modal-lg{{ $item->notrx }}"><i
                                                        class="fa fa-search"></i> {{ $item->notrx }}</a>
                                            </td>
                                            <td>{{ $item->namapemesan }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('l\, d-m-Y') }}</td>
                                            <td><span class="label label-info">{{ $item->status }}</span></td>
                                            <td>
                                                {{-- <button
                                                    onclick="window.location='{{ url('orderan/' . $item->id_transaksi) }}'"
                                                    class="btn btn-sm btn-info" title="Edit Data">
                                                    <i class="fa fa-edit"></i>
                                                </button> --}}
                                                @php
                                                    if ($item->status == 'Lunas') {
                                                        $disable = 'disabled';
                                                    } else {
                                                        $disable = '';
                                                    }
                                                @endphp
                                                <button class="btn btn-sm btn-success" title="Pelunasan"
                                                    {{ $disable }} data-toggle="modal"
                                                    data-target="#pelunasanModal{{ $item->notrx }}">
                                                    <i class="fa fa-money"></i><a href="javascript:void(0)"></a>
                                                </button>
                                                <form method="POST" action="{{ 'orderan/' . $item->notrx }}"
                                                    style="display: inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus Data"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
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

    @include('orderan.components.modal')

    <!-- #/ container -->

</div>


{{-- End Modal --}}
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
