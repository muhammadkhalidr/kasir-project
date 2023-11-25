<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title }}</title>
    <!-- Favicon icon -->
    @foreach ($logo as $item)
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/settings/{{ $item->favicon }}">
    @endforeach
    <!-- Custom Stylesheet -->
    <link href="{{ asset('/') }}assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('/') }}assets/css/style.css" rel="stylesheet">
</head>

<body>
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


    <!--**********************************
            Main wrapper start
        ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
                Nav header start
            ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ asset('/') }}">
                    @foreach ($logo as $item)
                        <b class="logo-abbr"><img src="assets/images/settings/{{ $item->logo }}" alt=""> </b>
                        <span class="logo-compact"><img src="assets/images/settings/{{ $item->logo }}"
                                alt=""></span>
                        <span class="brand-title">
                            <img src="assets/images/settings/{{ $item->logo }}" alt="" width="120">
                        </span>
                    @endforeach
                </a>
            </div>
        </div>
        <!--**********************************
                Nav header end
            ***********************************-->

        <!--**********************************
                Header start
            ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                @foreach ($foto as $item)
                                    <img src="{{ asset('/') }}assets/images/avatar/{{ $item->foto }}"
                                        height="40" width="40" alt="">
                                @endforeach
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <span>{{ $user->level == 1 ? 'Administrator' : 'Owner' }}</span>
                                            {{-- <span>{{ $user->name }}</span> --}}
                                        </li>
                                        <li>
                                            <a href="{{ url('profile') }}"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                            <hr class="my-2">
                                            <a href="{{ url('setting') }}"><i class="fa fa-cogs"></i>
                                                <span>Setting</span></a>
                                        </li>
                                        <hr class="my-2">
                                        <li><a href="{{ url('logout') }}"><i class="icon-key"></i>
                                                <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
                Header end ti-comment-alt
            ***********************************-->
