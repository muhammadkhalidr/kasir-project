<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>404 - Not Found</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet">

</head>

<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->



    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="error-content">
                        <div class="card mb-0">
                            <div class="card-body text-center pt-5">
                                <h1 class="error-text text-primary">404</h1>
                                <h4 class="mt-4"><i class="fa fa-exclamation text-danger"></i> Oppps, gak ketemu
                                    nih...</h4>
                                <p>Sudah aku cari ke mana-mana, nampaknya apa yang kamu cari tidak tersedia.</p>
                                <form class="mt-5 mb-5">

                                    <div class="text-center mb-4 mt-4"><a href="{{ url('/home') }}"
                                            class="btn btn-primary">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('/') }}assets/plugins/common/common.min.js"></script>
    <script src="{{ asset('/') }}assets/js/custom.min.js"></script>
    <script src="{{ asset('/') }}assets/js/settings.js"></script>
    <script src="{{ asset('/') }}assets/js/gleek.js"></script>
    <script src="{{ asset('/') }}assets/js/styleSwitcher.js"></script>
</body>

</html>
