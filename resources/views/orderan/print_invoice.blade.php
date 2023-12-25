<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>INVOICE #{{ $notrx }}</title>

    <style>
        body {
            margin-top: 20px;
            background: #eee;
        }

        .invoice {
            background: #fff;
            padding: 20px
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: #f0f3f4;
            padding: 20px
        }

        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: table-cell;
            width: 1%
        }

        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }

        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }

        .invoice-date {
            text-align: right;
            padding-left: 20px
        }

        .invoice-price {
            background: #f0f3f4;
            display: table;
            width: 100%
        }

        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }

        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }

        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }

        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }

        .invoice-price .invoice-price-right {
            width: 25%;
            background: #2d353c;
            color: #fff;
            font-size: 28px;
            text-align: right;
            vertical-align: bottom;
            font-weight: 300
        }

        .invoice-price .invoice-price-right small {
            display: block;
            opacity: .6;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px
        }

        .invoice-footer {
            border-top: 2px dashed #000000;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #860000;
            margin-top: 80px;
            font-size: 85%
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
        }

        .btn.btn-white,
        .btn.btn-white.disabled,
        .btn.btn-white.disabled:focus,
        .btn.btn-white.disabled:hover,
        .btn.btn-white[disabled],
        .btn.btn-white[disabled]:focus,
        .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }

        .thank-you {
            margin-top: 20px;
            padding: 10px;
            text-align: center;
            color: #ffffff;
            background-color: #600000;
        }

        .cobas {
            border-top: 2px dashed #000;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="col-md-12">
            <div class="invoice">
                <!-- begin invoice-company -->
                <div class="invoice-company text-inverse f-w-600 text-center">
                    <img src="{{ asset('/') }}assets/images/settings/{{ $logo->first()->login_logo }}"
                        alt="{{ $logo->first()->perusahaan }}" class="logo-login" width="150">
                    <p class="mt-4" style="font-size:10pt">{{ $settings->first()->alamat }}</p>
                    <p style="font-size:10pt">
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-brands fa-instagram"></i>
                            {{ $settings->first()->instagram }}</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-brands fa-whatsapp"></i>
                            {{ $settings->first()->phone }}</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i>
                            {{ $settings->first()->email }}</span>
                    </p>
                </div>
                <!-- end invoice-company -->
                <!-- begin invoice-header -->
                @foreach ($formatTgl as $notrx => $orderanGroup)
                    <div class="invoice-header">
                        <div class="invoice-to">
                            <small>Kepada :</small>
                            <address class="m-t-5 m-b-5">
                                <strong class="text-inverse">{{ $orderanGroup->first()->pelanggans->nama }}</strong><br>
                                <p class="text-inverse">{{ $orderanGroup->first()->pelanggans->nohp }} <br>
                                    {{ $orderanGroup->first()->pelanggans->alamat }}</p>
                            </address>
                        </div>
                        <div class="invoice-date">
                            <small>Invoice</small>
                            <div class="date text-inverse m-t-5">{{ $orderanGroup->formatted_date }}</div>
                            <div class="invoice-detail">
                                NO.# {{ $notrx }}
                            </div>
                        </div>
                    </div>
                    <div class="cobas"></div>
                    <!-- end invoice-header -->
                    <!-- begin invoice-content -->
                    <div class="invoice-content">
                        <!-- begin table-responsive -->
                        <div class="table-responsive">
                            <table class="table table-invoice">
                                <thead>
                                    <tr>
                                        <th width="10%">PRODUK</th>
                                        <th class="text-center" width="40%">KETERANGAN</th>
                                        <th class="text-center" width="10%">QTY</th>
                                        <th class="text-center" width="10%">HARGA</th>
                                        <th class="text-right" width="20%">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderanGroup as $orderan)
                                        <tr>
                                            <td>
                                                <span class="text-inverse">{{ $orderan->namabarang }}</span>
                                            </td>
                                            <td class="text-center">{{ $orderan->keterangan }}</td>
                                            <td class="text-center">{{ $orderan->jumlah }}</td>
                                            <td class="text-center">Rp.
                                                {{ number_format($orderan->harga, 0, ',', '.') }}</td>
                                            <td class="text-right">Rp.
                                                {{ number_format($orderan->total, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                        <!-- begin invoice-price -->
                        <div class="invoice-price">
                            <div class="invoice-price-left">
                                <div class="sub-price">
                                    <small>UANG MUKA</small>
                                    <span class="text-inverse">Rp.
                                        {{ number_format($orderanGroup->first()->uangmuka, 0, ',', '.') }}</span>
                                </div>
                                <div class="sub-price">
                                    <i class="fas fa-grip-lines-vertical text-muted"></i>
                                </div>
                                <div class="sub-price">
                                    <small>SISA</small>
                                    <span class="text-inverse">Rp.
                                        {{ number_format($orderanGroup->first()->sisa, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="invoice-price-right">
                                <small>TOTAL</small> <span class="f-w-600">Rp.
                                    {{ number_format($orderanGroup->first()->subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <!-- end invoice-price -->
                    </div>
                    <!-- end invoice-content -->
                    <!-- begin invoice-note -->
                    <div class="invoice-note">
                        <h6>
                            {{-- jika tidak ada data via maka redirect back --}}
                            {{-- @if ($via->count() == 0)
                        @php
                            return redirect()->back();
                        @endphp
                    @endif --}}
                            STATUS : {{ $orderanGroup->first()->status }} <br>
                            PEMBAYARAN : {{ $bank = $via->first()->bank ?? '' }} -
                            {{ $via->first()->via ?? 'TUNAI' }}
                            {{-- {{ "Via: $bank" }} --}}
                        </h6>
                    </div>
                    <!-- end invoice-note -->
                    <!-- begin invoice-footer -->
                    <div class="invoice-footer">
                        @foreach ($rekening as $item)
                            <p class="text-center">Pembayaran Via Rekening : {{ $item->bank }}
                                | No Rek : {{ $item->no_rekening }} | A.n {{ $item->atas_nama }}
                            </p>
                        @endforeach
                        <p class="text-center m-b-5 f-w-600">
                            TERIMA KASIH <i class="fa fa-heart"></i> <br>
                            {{ $settings->first()->pesan }}
                        </p>
                    </div>
                    <!-- end invoice-footer -->
                    <div class="thank-you">
                        <footer>Copyright &copy; Khalid R {{ date('Y') }}</footer>
                    </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>
