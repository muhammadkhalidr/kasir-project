<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
        }

        .invoice {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
            text-align: center;
        }

        .invoice header h1 {
            color: #333;
        }

        .invoice .billing-details,
        .invoice .invoice-details {
            margin-bottom: 20px;
        }

        .invoice .invoice-details .value,
        .invoice .billing-details .value {
            font-weight: bold;
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .invoice table th,
        .invoice table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .invoice table th {
            background-color: #f5f5f5;
        }

        .invoice table .item-desc {
            max-width: 250px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .invoice table .text-right {
            text-align: right;
        }

        .invoice .total {
            border-bottom: 2px solid #333;
            margin-top: 10px;
            padding-top: 20px;
            font-weight: bold;
            text-align: right;

        }

        .invoice .thank-you {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            color: #ffffff;
            background-color: #600000;
        }

        .invoice .logo-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .contact {
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: center;
        }
    </style>
</head>

<body>

    @foreach ($orderans as $notrx => $orderanGroup)
        <div class="invoice">
            <div class="logo-header">
                <img src="{{ asset('assets/images/logo-warna.png') }}" alt="">
            </div>
            <header>
                <h1>Invoice</h1>
                <div class="contact">
                    <p><i class="fa-brands fa-instagram"></i> {{ $settings->first()->instagram }}</p>
                    <p><i class="fa-regular fa-envelope"></i> {{ $settings->first()->email }}</p>
                    <p><i class="fa-solid fa-location-dot"></i> {{ $settings->first()->alamat }}</p>
                    <p><i class="fa-brands fa-whatsapp"></i> {{ $settings->first()->phone }}</p>
                </div>
            </header>

            <div class="invoice-details">
                <div class="value">
                    <p>Invoice #:{{ $notrx }}</p>
                    <p>Date: {{ $data->first()->created_at }}</p>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama pemesan</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderanGroup as $orderan)
                        <tr>
                            <td>{{ $orderan->namapemesan }}</td>
                            <td>{{ $orderan->namabarang }}</td>
                            <td>{{ $orderan->jumlah }}</td>
                            <td>Rp. {{ number_format($orderan->harga, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($orderan->total, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total">
                <p>Total : Rp. {{ number_format($orderanGroup->first()->subtotal, 0, ',', '.') }} <br>
                    Dp : Rp. {{ number_format($orderanGroup->first()->uangmuka, 0, ',', '.') }} <br>
                    Sisa : Rp. {{ number_format($orderanGroup->first()->sisa, 0, ',', '.') }} <br>
                </p>

            </div>

            <div class="thank-you">
                <footer>Copyright &copy; Khalid R {{ date('Y') }}</footer>
            </div>
        </div>
    @endforeach
</body>

</html>
