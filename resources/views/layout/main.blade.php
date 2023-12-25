@include('partials.header')
@include('partials.sidebar')


<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            </ol>
        </div>
    </div>
    <!-- row -->

    <div class="container-fluid mt-3">
        @yield('judul')
        <marquee behavior="" direction="" class="label label-dark" id="jam">Selamat Datang di Website Sistem
            Arsip Keuangan | {{ env('APP_NAME') }}
        </marquee>
        @yield('content')
    </div>
    <!-- #/ container -->
</div>
<!--**********************************
            Content body end
        ***********************************-->
{{-- @yield('js') --}}
@include('partials.footer')
@yield('js')
