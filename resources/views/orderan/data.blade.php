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
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header pb-2">
                        <div class="input-group">
                            <div class="input-group-prepend mr-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="tambahT"
                                    data-target=".bd-transaksi-modal-lg">
                                    <span class="icon text-white-50">
                                        <i class="fa fa-cart-plus fa-fw"></i>
                                    </span>
                                    <span class="text">Tambah Transaksi</span>
                                </button>
                            </div>

                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <form method="POST" action="{{ url('orderan.cari') }}" id="searchFormDate">
                                @csrf
                                <input type="hidden" name="start_date" id="start_date" />
                                <input type="hidden" name="end_date" id="end_date" />
                                <input type="text" class="form-control w-10" name="daterange" />
                            </form>

                            <div class="input-group-prepend ml-2">
                                <span class="input-group-text">Limit</span>
                            </div>
                            <form method="post" action="{{ route('orderan.filterJumlah') }}">
                                @csrf
                                <div class="input-group-prepend mr-2">
                                    <select class="form-control" id="dataOptions" name="dataOptions"
                                        onchange="this.form.submit()">
                                        @foreach ($perPageOptions as $option)
                                            <option
                                                value="{{ $option }}"{{ $dataOrderan->perPage() == $option ? 'selected' : '' }}>
                                                {{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>

                            <!-- Search input -->
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <form method="POST" action="{{ url('orderan') }}" id="searchForm">
                                @csrf
                                <input type="text" class="form-control" name="searchdata" id="searchInput"
                                    placeholder="Search..." />
                            </form>


                            <button class="btn btn-danger ml-2" id="clear">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-info pesanoff mt-2"></div>
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
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>NO ORDER</th>
                                        <th>PELANGGAN</th>
                                        <th>TGL ORDER</th>
                                        <th>KASIR</th>
                                        <th>TOTAL</th>
                                        <th>DP</th>
                                        <th>SISA</th>
                                        <th>STATUS</th>
                                        <th>AKSI</th>
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
                                            <td>{{ $item->pelanggans->nama }}</td>
                                            <td>{{ $item->formatted_date }}</td>
                                            <td>{{ $item->name_kasir }}</td>
                                            <td>{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                            <td>{{ number_format($item->uangmuka, 0, ',', '.') }}</td>
                                            <td>{{ number_format($item->sisa, 0, ',', '.') }}</td>
                                            <td><span
                                                    class="label label-{{ $item->status == 'Lunas' ? 'success' : 'warning' }}">{{ $item->status }}</span>
                                            </td>
                                            <td>
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
                                                <div class="btn-group" role="group">
                                                    <button type="button"
                                                        class="btn btn-sm mb-1 btn-primary flat dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Aksi</button>
                                                    <div class="dropdown-menu">
                                                        <p class="ml-2">NO. #{{ $item->notrx }}</p>
                                                        <a href="{{ route('orderan.print_invoice58', $item->notrx) }}"
                                                            class="dropdown-item" target="_blank">
                                                            <span class="badge badge-info flat">
                                                                <i class="fa fa-print"></i> PRINT STRUK
                                                            </span>
                                                        </a>
                                                        <a href="{{ route('orderan.print_invoice', $item->notrx) }}"
                                                            class="dropdown-item"target="_blank">
                                                            <span class="badge badge-warning flat">
                                                                <i class="fa fa-file-pdf-o"></i> PRINT PDF
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-start">
                                @php
                                    $hitungNoTrx = $dataOrderan->unique('notrx')->count();
                                @endphp

                                <p class="mr-3">Menampilkan {{ $hitungNoTrx }} hingga {{ $hitungNoTrx }} dari
                                    {{ $hitungNoTrx }} data</p>
                            </div>

                            <div class="d-flex justify-content-end">
                                {{ $dataOrderan->links() }}
                            </div>
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

            // Bersihkan nilai input di form baru kecuali nama pelanggan
            newForm.find(".namabarang").val("");
            newForm.find(".jumlah").val("");
            newForm.find(".harga").val("");
            newForm.find(".total").val("");
            // newForm.find("input").val("");


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
<script>
    $(document).ready(function() {
        // Tampilkan atau sembunyikan opsi bank dan bukti transfer berdasarkan pilihan cara bayar
        $('.caraBayar').change(function() {
            const notrx = $(this).data('notrx');
            const bankOptions = $(`#bankOptions${notrx}`);
            const buktiTransferOptions = $(`#buktiTransferOptions${notrx}`);
            const viaElement = $(`#via${notrx}`);

            if ($(this).val() === 'transfer') {
                bankOptions.show();
                buktiTransferOptions.show();
                viaElement.prop('disabled', false); // Aktifkan elemen via jika transfer dipilih
            } else {
                bankOptions.hide();
                buktiTransferOptions.hide();
                viaElement.prop('disabled', true); // Nonaktifkan elemen via jika tidak transfer
            }
        });

        // Sembunyikan opsi bank dan bukti transfer saat halaman dimuat jika caraBayar awalnya bukan 'transfer'
        $('.caraBayar').each(function() {
            const notrx = $(this).data('notrx');
            const bankOptions = $(`#bankOptions${notrx}`);
            const buktiTransferOptions = $(`#buktiTransferOptions${notrx}`);
            const viaElement = $(`#via${notrx}`);

            if ($(this).val() !== 'transfer') {
                bankOptions.hide();
                buktiTransferOptions.hide();
                viaElement.prop('disabled', true);
            }
        });

        // Hitung total yang harus dibayar berdasarkan jumlah bayar
        $('.jumlahBayar').on('input', function() {
            const notrx = $(this).data('notrx');
            const totalBayar = $(`#totalBayar${notrx}`);
            totalBayar.val($(this).val());
        });
    });
</script>
<script type="text/javascript">
    $('#cariPelanggan').on('keyup', function() {
        var query = $(this).val();
        $.ajax({
            url: "{{ url('orderan') }}",
            type: "GET",
            data: {
                'query': query
            },
            success: function(data) {
                $('#listPelanggan').html(data);
            }
        });
    });

    $('body').on('click', 'li', function() {
        var id = $(this).data('id');
        var name = $(this).text();

        // Check if there's already a value in pemesan2
        var currentName = $('#pemesan2').val();
        var currentNamee = $('#pemesan').val();

        if (currentName) {
            // If pemesan2 already has a value, replace the ID for the corresponding 'namapemesan'
            $('.namapemesan').each(function(index, element) {
                if ($(element).val() === currentName) {
                    $(element).next('.idpemesan').val(id);
                }
            });
        } else {
            // If pemesan2 is empty, append the ID as before
            $('.idpemesan').val(function(index, currentValue) {
                return currentValue + (currentValue ? ',' : '') + id;
            });
        }

        // Set the value of the input with class 'namapemesan'
        $('#pemesan2').val(name);
        $('#pemesan').val(name);
    });
</script>
<script>
    $(document).ready(function() {
        $(document).keydown(function(e) {
            if (e.which == 113) {
                buttonFunction();
            } else if (e.which == 115) {
                $('#tambahP').click();
            }
        });

        function buttonFunction() {
            $('#cariP').click();
        }
    });
</script>
{{-- <script>
    function updateStatus() {
        let date = new Date();
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let tombol = document.getElementById('tambahT');
        let pesan = document.querySelector('.pesanoff');

        let darijam = parseInt("{{ $jamTransaksi->darijam }}");
        let sampaijam = parseInt("{{ $jamTransaksi->sampaijam }}");

        if ((hours === darijam && minutes >= 55) || (hours === darijam - 1 && minutes >= 55)) {
            pesan.textContent = 'Pemesanan akan ditutup 5 menit lagi.';
        } else if (hours >= darijam || hours < sampaijam) {
            tombol.disabled = true;
            pesan.textContent = 'Pemesanan sudah ditutup, Akan Buka Kembali Pada Pukul 08:00 WIB';
        } else {
            pesan.style.display = 'none';
        }
        // else {
        //     if (!tombol.hasAttribute('disabled')) {
        //         alert('Anda tidak diizinkan untuk mengakses ini. Sistem telah mendeteksi manipulasi.');
        //     }
        //     tombol.disabled = false;
        //     pesan.style.display = 'none';
        // }
    }

    document.getElementById('tambahT').addEventListener('click', function() {
        updateStatus();
    });

    setInterval(updateStatus, 60000);
    updateStatus();
</script> --}}


<script>
    $(function() {
        var startDate;
        var endDate;

        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
            $('#searchFormDate').submit();
        });
    });
</script>
<script>
    let clear = document.querySelector('#clear');
    clear.addEventListener('click', function() {
        window.location = "{{ url('orderan') }}";
    });
</script>
<!-- Add this script at the end of your HTML body or in a separate JS file -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('searchInput');
        var searchForm = document.getElementById('searchForm');

        searchInput.addEventListener('input', function() {
            // Automatically submit the form on input change
            searchForm.submit();
        });
    });
</script>
