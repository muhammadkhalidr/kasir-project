<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>FAKTUR</title>
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
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
        }

        .status-belum-lunas {
            color: red;
            text-transform: uppercase;

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
    </style>
</head>

<body>
    <h1>FAKTUR PEMBELIAN</h1>
    <table>
        <tr>
            <th>Nomor Faktur</th>
            <th>Bahan</th>
            <th>Jenis</th>
            <th>Jumlah</th>
            <th>Sataun</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>{{ $pembelian->id_pembelian }}</td>
            <td>{{ $pembelian->bahan }}</td>
            <td>{{ $pembelian->jenis }}</td>
            <td>{{ $pembelian->jumlah }} Pcs</td>
            <td>{{ $pembelian->satuan }}</td>
            <td>Rp. {{ number_format($pembelian->total, 0, ',', '.') }}</td>
        </tr>
    </table>
    <p class="tanggal">Tanggal: {{ date('Y-m-d', strtotime($pembelian->created_at)) }}</p>
    <p class="dp">Uang Muka: Rp. {{ number_format($pembelian->uang_muka, 0, ',', '.') }}</p>
    <p class="sisa">Sisa Pembayaran: Rp. {{ number_format($pembelian->sisa_pembayaran, 0, ',', '.') }}</p>

    <footer class="footer">&copy; Aneka Kreasi {{ date('Y') }}</footer>
</body>

</html>
