<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan</title>
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
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
                            @foreach ($gajiKaryawans as $gaji)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $gaji->nama_karyawan }}</td>
                                    <td>{{ $gaji->jumlah_gaji }}</td>
                                    <td>{{ date('Y-m-d', strtotime($gaji->created_at)) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
