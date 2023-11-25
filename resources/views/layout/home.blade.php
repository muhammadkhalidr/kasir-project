@extends('layout.main')

@section('judul')
    <h3>Dashboard</h3>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Pengeluaran</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Pendapatan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Orderan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">{{ $totalOrderan }} Orderan </h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-shopping-cart"></i></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body pb-0 d-flex justify-content-between">
                    <div>
                        <h4 class="mb-1">Grafik Pendapatan & Pengeluaran</h4>
                    </div>
                    <div>
                        <form action="{{ route('dashboard.index') }}" method="get">
                            <input type="date" name="date" class="form-control">
                            <button type="submit" class="btn btn-primary mt-2">Filter</button>
                        </form>
                    </div>
                </div>
                <div class="chart-wrapper">
                    <canvas id="chart_keuangan"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mendapatkan data dari PHP
        const totalPendapatan = {{ $totalPendapatanG }};
        const totalPengeluaran = {{ $totalPengeluaranG }};

        // Menggambar grafik
        var ctx = document.getElementById('chart_keuangan').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Pendapatan', 'Total Pengeluaran'],
                datasets: [{
                    label: 'Rp. ',
                    data: [totalPendapatan, totalPengeluaran],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
            }
        });
    </script>
@endsection
