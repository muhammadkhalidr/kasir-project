<!DOCTYPE html>
<html>

<head>
    <title>Invoice Order # {{ $notrx }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Percetakan & Digital Printing" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@500&family=Young+Serif&display=swap');

        @font-face {
            font-family: 'Rajdhani', sans-serif;
            src: url("https://fonts.googleapis.com/css?family=Microsoft+Sans+Serif");

        }

        body {

            font-family: "Rajdhani", sans-serif;
            font-size: 10pt;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact;
            margin: 0 auto;
        }

        .w-58 {
            width: 5.8cm !important;
            margin: 0 auto;
        }

        h1,
        p {
            margin: 0px;
        }

        .main-section {

            border: 2px dashed #ffffff;
        }

        .header {
            background-color: #fff;
            padding: 10px 15px 10px 15px;
            color: #000000;
            border-bottom: 2px dashed #000
        }

        .content {
            padding: 10px 15px 10px 15px;
        }

        th {
            background-color: #ffffff;
            color: #000000;
            text-align: right;
        }

        .table td:nth-child(1),
        .table th:nth-child(1) {
            text-align: left;
        }

        .lastSection {
            padding: 20px 15px 30px 15px;
        }

        .thumbnail {
            position: absolute;
            border: 0 !important;
            z-index: 1;
            right: 30%;
            opacity: 0.7;
        }

        .border-top-0 {
            border: 0px !important
        }

        .border-bottom-0 {
            border: 0px !important
        }

        .text-center {
            text-align: center !important
        }

        .text-left {
            text-align: left !important
        }

        .font-weight-bold {
            font-weight: bold
        }

        blockquote {
            padding: 10px 10px;
            margin: 0 0 10px;
            font-size: 17.5px;
            border-left: 5px solid #eee;
        }

        address {
            margin-bottom: 0;
            font-style: normal;
            line-height: 1.42857143;
        }

        .table {
            margin-bottom: 5px;
        }

        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px dashed #000;
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            border-top: 1.5px dashed #000;
        }

        .col-lg-1,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-md-1,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-sm-1,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-xs-1,
        .col-xs-10,
        .col-xs-11,
        .col-xs-12,
        .col-xs-2,
        .col-xs-3,
        .col-xs-4,
        .col-xs-5,
        .col-xs-6,
        .col-xs-7,
        .col-xs-8,
        .col-xs-9 {
            position: relative;
            min-height: 1px;
            padding-right: 10px;
            padding-left: 10px;
        }

        .p-1 {
            padding-right: 5px;
            padding-left: 5px;
        }

        .p-2 {
            padding-right: 10px;
            padding-left: 10px;
        }

        @media print {
            body {
                -webkit-filter: grayscale(100%);
                -moz-filter: grayscale(100%);
                -ms-filter: grayscale(100%);
                filter: grayscale(100%);
            }

            img {
                -webkit-filter: grayscale(100%);
                /* Safari 6.0 - 9.0 */
                filter: grayscale(100%);
            }

            .table>tbody>tr>td,
            .table>tbody>tr>th,
            .table>tfoot>tr>td,
            .table>tfoot>tr>th,
            .table>thead>tr>td,
            .table>thead>tr>th {
                padding: 2px;
            }

            body {
                margin: 0;
                color: #000;
                background-color: #fff;
            }
        }

        img {
            -webkit-filter: grayscale(100%);
            /* Safari 6.0 - 9.0 */
            filter: grayscale(100%);
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 1px;
        }

        .qrcode {
            margin: 0 auto
        }
    </style>
    {{-- <script type="text/javascript">
        window.print();
        window.onfocus = function() {
            window.close();
        }
    </script> --}}
</head>

<body>


    <div class="container padding">
        <div class="row">

            <div class="w-58">
                <div class="row main-section">
                    <div class="col-md-12 col-sm-12 header text-center">
                        <h1><img src="{{ asset('/') }}assets/images/settings/{{ $logo->first()->login_logo }}"
                                width="75%" alt="" /></h1>
                    </div>
                    <div class="col-md-12 col-sm-12 content text-center">

                        <p>{{ $settings->first()->perusahaan }}</p>
                        <p>{{ $settings->first()->alamat }}</p>
                        <p><span class="sosmed">{{ $settings->first()->phone }}</span></p>

                    </div>
                    @foreach ($formatTgl as $notrx => $orderanGroup)
                        <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                            <p>Invoice # {{ $notrx }}</p>
                            <span>Tgl : {{ $orderanGroup->formatted_date }}</span>
                            <p>Kepada : {{ $orderanGroup->first()->pelanggans->nama }}</p>
                            <p>Tlp. : {{ $orderanGroup->first()->pelanggans->nohp }}</p>
                        </div>

                        <div class="col-md-12 col-sm-12 text-right">
                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td coslpan="2" class="font-weight-bold">URAIAN ORDER</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderanGroup as $orderan)
                                            <tr>
                                                <td class="text-left">{{ $orderan->namabarang }}</td>
                                                <th class="text-left">&nbsp</th>
                                            </tr>
                                            <tr>
                                                <td class="text-right font-weight-bold border-top-0">
                                                    {{ $orderan->jumlah }} PCS x
                                                    {{ number_format($orderan->harga, 0, ',', '.') }}
                                                </td>
                                                <td class="text-right font-weight-bold border-top-0">
                                                    {{ number_format($orderan->total, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class=" border-top-0">
                                                    Uk.: | Bhn.:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class=" border-top-0">
                                                    Ket.: {{ $orderan->keterangan }}
                                                </td>
                                            </tr>
                                            <tr class="">
                                                <td colspan="2" class=" border-top-0">

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12 col-print-12 p-0">
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td style="width:40px;font-weight:bold" class="font-weight-bold border-top-1">
                                            Total Order</td>
                                        <td style="width:40px;font-weight:bold" class="font-weight-bold border-top-1">
                                            Rp.</td>
                                        <td style="width:40px;font-weight:bold"
                                            class="text-right font-weight-bold border-top-1">
                                            {{ number_format($orderanGroup->first()->subtotal, 0, ',', '.') }}</td>
                                    </tr>

                                    </tr>

                                    <td style="width:40px;font-weight:bold">Piutang</td>
                                    <td style="width:40px;font-weight:bold" class="font-weight-bold border-top-1">Rp.
                                    </td>
                                    <td style="width:40px;font-weight:bold" class="text-right">
                                        {{ number_format($orderanGroup->first()->sisa, 0, ',', '.') }}</td>


                                    <tr>
                                        <td class="border-bottom-0">
                                            <div class="thumbnail ">
                                                <img src="{{ asset('/') . $stamp }}" style="width:100px;"
                                                    alt="{{ $alt }}">
                                            </div>
                                    <tr>
                                        <td class="text-left border-top-0" style="width:40%">Pelanggan,</td>
                                        <td class="border-top-0" style="width:1px"></td>
                                        <td class="text-right border-top-0" style="width:40%">Kasir</td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0"></td>
                                        <td class="border-top-0"></td>
                                        <td class="border-top-0"></td>
                                    </tr>
                                    <tr>
                                        <td class="border-top-0"></td>
                                        <td class="border-top-0"></td>
                                        <td class="border-top-0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">{{ $orderanGroup->first()->namapemesan }}</td>
                                        <td class="border-top-0"></td>
                                        <td class="text-right">{{ $user->name }}</td>
                                    </tr>

                                    </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-0 border-top-0">
                                    <tr>
                                        <td colspan="3" class="border-top-0">
                                            <span>No.Rekening</span>
                                        </td>
                                        <td colspan="2" class="border-top-0 text-right">
                                            <span></span>
                                        </td>
                                    </tr>
                                    @foreach ($rekening as $item)
                                        <tr>
                                            <td colspan="3" class="">
                                                <address class="">
                                                    <span class="perhatian">{{ $item->bank }}
                                                        <b>{{ $item->no_rekening }}</b> a.n
                                                        {{ $item->atas_nama }}</span>
                                                </address>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="p-2">
                                            <div class="qrcode" style="width:100px; height:100px;">
                                                <img src="{{ asset('/') }}assets/images/qrcode/qrcode.jpg"
                                                    alt="" style="width:100px; height:100px;" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="pt-0">
                                            <address class="text-center">
                                                Terima Kasih &#9829; <br> {{ $settings->first()->pesan }} </address>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            </table>

                        </div><!-- /.col -->

                </div>
            </div>
        </div>
    </div>
    @endforeach
</body>

</html>
