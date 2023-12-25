@extends('keuangan.main')

@section('judul')
    <h3>Log Keuangan</h3>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card card-widget">
                <div class="card-body gradient-3">
                    <div class="media">
                        <span class="card-widget__icon"><a href="{{ url('pengeluaran') }}"><i
                                    class="icon-credit-card"></i></a></span>
                        <div class="media-body">
                            <h2 class="card-widget__title">Pengeluaran</h2>
                            <h5 class="card-widget__subtitle">Rp. {{ number_format($kaskeluar, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-widget">
                <div class="card-body gradient-4">
                    <div class="media">
                        <span class="card-widget__icon"><a href="{{ url('orderan') }}"><i
                                    class="icon-credit-card"></i></a></span>
                        <div class="media-body">
                            <h2 class="card-widget__title">Pemasukan</h2>
                            <h5 class="card-widget__subtitle">Rp. {{ number_format($kasmasuk, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-widget">
                <div class="card-body gradient-4">
                    <div class="media">
                        <span class="card-widget__icon"><a href="{{ url('gaji_karyawan') }}"><i
                                    class="icon-emotsmile"></i></a></span>
                        <div class="media-body">
                            <h2 class="card-widget__title">Gaji Karyawan</h2>
                            <h5 class="card-widget__subtitle">Rp. {{ number_format($gajiKaryawans, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card card-widget">
                <div class="card-body gradient-6">
                    <div class="media">
                        <span class="card-widget__icon"><a href="#"><i class="icon-credit-card"></i></a></span>
                        <div class="media-body">
                            <h2 class="card-widget__title">Total Pengeluran</h2>
                            <h5 class="card-widget__subtitle">Rp.
                                {{ number_format($gajiKaryawans + $kaskeluar, 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
