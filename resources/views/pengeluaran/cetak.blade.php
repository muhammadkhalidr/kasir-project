<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Aneka Kreasi - Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }

        tr:hover {
            background-color: #ddd;
        }

        .tanggal {
            text-align: right;
        }

        .status-lunas {
            color: green;
            text-transform: uppercase;
            font-weight: bold;
        }

        .status-belum-lunas {
            color: red;
            text-transform: uppercase;
            font-weight: bold;

        }

        .dp,
        .sisa {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #ffffff;
            padding: 10px;
            background-color: rgb(110, 0, 0);
        }

        .kotak {
            width: 35%;
            padding: 10px;
            border: solid 2px;
            background-size: 160px;
            background-position: center;
            background-repeat: no-repeat;
        }

        .alamat {
            width: max-content;
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Laporan Pengeluaran</h1>
    <table>
        @foreach ($groupedPengeluarans as $id_pengeluaran => $groupedPengeluaran)
            <tr>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
            @foreach ($groupedPengeluaran as $cetak)
                <tr>
                    <td>{{ $cetak->keterangan }}</td>
                    <td class="text-left">{{ $cetak->jumlah }}</td>
                    <td class="text-center">Rp. {{ number_format($cetak->harga, 0, ',', '.') }}</td>
                    <td class="text-right">Rp. {{ number_format($cetak->pengeluaran, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        @endforeach
        <tr style="background-color: #4d4d4d;color:white;">
            <td></td>
            <td class="text-right">
                <b><i>Sub Total</i></b>
            </td>
            <td class="text-right">
                <b><i></i></b>
                Rp.
                {{ number_format($totals[$id_pengeluaran], 0, ',', '.') }}
            </td>
            <td class="text-center"></td>
        </tr>
    </table>

    <footer class="footer">&copy; Aneka Kreasi {{ date('Y') }}</footer>
</body>

</html>
