@extends('laporan.main')

@section('judul')
    <h3>Laporan</h3>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 m-b-30">
            <div class="row m-b-30">
                <div class="col-lg-12">
                    <div class="card border-primary">
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ route('laporan.cetakLaporan') }}" method="POST">
                                    @csrf
                                    <div class="form-row col-12">
                                        <div class="col-6">
                                            <label for="" class="col-lg-4 col-form-label">Tanggal</label>
                                            <input type="text" class="form-control" name="daterange"
                                                placeholder="Silakan pilih tanggal">
                                        </div>
                                        <div class="col-6">
                                            <label for="" class="col-lg-4 col-form-label">Jenis</label>
                                            <select name="txtjenis" id="txtjenis" class="form-control" required>
                                                <option value="" selected> Pilih Jenis</option>
                                                <option value="111">Pengeluaran</option>
                                                <option value="222">Pemasukan</option>
                                                <option value="333">Gaji Karyawan</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <button type="submit" class="btn btn-primary w-100"><i
                                                    class="fa fa-search"></i> Cari Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tampilkan Data Ketika User klik tampilkan dan Pilih Tanggal dari dan tanggal sampai --}}
            <div class="row m-b-30">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ route('laporan.cetakLaporan') }}" class="btn btn-sm btn-primary mb-1"
                                    title="Print Faktur" target="_blank">
                                    <i class="fa fa-print"></i>
                                </a>

                                <div class="table-responsive">
                                    <table class="table header-border text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Keterangan</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (empty($pengeluarans) && empty($orderans) && empty($gajikaryawans))
                                                <tr>
                                                    <td colspan="4" align="center">
                                                        Data tidak ditemukan
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($pengeluarans as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $row->keterangan }}</td>
                                                        <td>{{ $row->jumlah }}</td>
                                                        <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($orderans as $or)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $or->nama_barang }}</td>
                                                        <td>{{ $or->jumlah_total }}</td>
                                                        <td>{{ date('Y-m-d', strtotime($or->created_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                                @foreach ($gajikaryawans as $gaji)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $gaji->nama_karyawan }}</td>
                                                        <td>{{ $gaji->jumlah_gaji }}</td>
                                                        <td>{{ date('Y-m-d', strtotime($gaji->created_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Col -->
        </div>
    </div>
@endsection
