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
                        <button type="button" class="btn btn-primary"
                            onclick="window.location='{{ url('pengeluaranbaru') }}'">
                            <i class="fa fa-plus-circle"></i> Tambah Data Baru
                        </button>

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
                                                    <thead class="thead-primary">
                                                        <tr>
                                                            <th style="width:4%!important" class="text-right">#No.</th>
                                                            <th>Keterangan</th>
                                                            <th class="text-left" style="width:30%!important">Jumlah
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
</div>
<!--**********************************
            Content body end
        ***********************************-->

@include('partials.footer')
