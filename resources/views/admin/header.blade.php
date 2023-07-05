<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{url('assets/css/admin_app.min.css')}}" />
    <link rel="icon" type="image/x-icon" href="{{url('/assets/img/favicon.png')}}">
    <input type="hidden" id="token" value="{{csrf_token()}}">
    <?php
    //        dd($header);
    if (isset($header['css']) && count($header['css']) > 0)
        for ($i = 0; $i < count($header['css']); $i++)
            if (strpos($header['css'][$i], "http://") !== FALSE)
                echo '<link rel="stylesheet" type="text/css" href="' . $header['css'][$i] . '"/>';
            else
                echo '<link rel="stylesheet" type="text/css" href="' . url("/") . "public/" . $header['css'][$i] . '"/>';
    ?>

    <title>{{$header['title']}}</title>
</head>

<body>
    <!-- <div class="loader" id="loader">
        <div class="loader-inner">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div> -->
    <header>
        <nav class="cat-topnav navbar navbar-expand">
            <!-- Navbar Brand-->
            <a class="navbar-brand" href="">
                <img src="{{url('assets/img/logo.png')}}" alt="" class="navbar-horizontal-logo">
                <img src="{{url('assets/img/logo-icon.png')}}" alt="" class="navbar-icon">
            </a>
            <h4 class="m-0 text-white ms-4">{{$body['label']}}</h4>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-0 me-md-3 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{url('assets/img/avatar.png')}}" alt="avatar" class="img-fluid rounded-circle border" style="height: 40px;">
                        <div class="fs-6 text-white mx-2">{{ \Auth::guard('admin')->user()->username}}<small class="d-block small text-white">Admin</small></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item py-2" href="{{url('admin/profile')}}">
                                <i class="fa fa-user me-2"></i>Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2" href="{{url('admin/logout')}}">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>


            <!-- Sidebar Toggle-->
            <button class="btn p-3 d-block d-lg-none" id="sidebarToggle">
                <span class="navbar-toggler-bars"></span>
                <span class="navbar-toggler-bars"></span>
                <span class="navbar-toggler-bars"></span>
            </button>
        </nav>
    </header>
    @include('admin.sidebar')