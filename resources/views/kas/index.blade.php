@include('partials.header')
@include('partials.sidebar')

@yield('css')

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)">Kas Penjualan</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid mt-3">
        @yield('tombol')
        @yield('content')
        @yield('modal')
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->
        @yield('js')
@include('partials.footer')
