@extends('logtransaksi.index')

@section('judul')
    <h1>Log Transaksi</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Kasir</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($log as $d)
                                    <tr>
                                        <td>
                                            @if ($d->pemasukan)
                                                <button class="btn btn-success btn-sm text-white" title="Pemasukan"><i
                                                        class="fa fa-arrow-circle-right"></i></button>
                                            @else
                                                <button class="btn btn-danger btn-sm text-white" title="Pengeluaran"><i
                                                        class="fa fa-arrow-circle-left"></i></button>
                                            @endif
                                        </td>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->created_at }}</td>
                                        <td>{{ $d->keterangan }}</td>
                                        <td>{{ $d->name_kasir }}</td>
                                        <td>
                                            @if ($d->pemasukan)
                                                <span class="text-success text-bold">Rp.
                                                    {{ number_format($d->pemasukan, 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-danger text-bold">Rp.
                                                    {{ number_format($d->pengeluaran, 0, ',', '.') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5"><span class="text-success text-bold">Total Pemasukan</span></td>
                                    <td><span class="text-success text-bold">Rp.
                                            {{ number_format($pemasukan, 0, ',', '.') }}</span>
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="5"><span class="text-danger text-bold">Total Pengeluaran</span></td>
                                    <td><span class="text-danger text-bold">Rp.
                                            {{ number_format($pengeluaran, 0, ',', '.') }}</span>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
