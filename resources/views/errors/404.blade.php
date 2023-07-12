<!DOCTYPE html>
<html lang="en">

<head>
    <title>404 Page Not Found</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" type="image/x-icon" href="{{url('/assets/img/favicon.png')}}">
    <link rel="stylesheet" href="{{url('assets/css/admin_app.min.css')}}" />
</head>

<body>
    <div class="bg-dark">
        <div class="loader" id="loader">
            <div class="loader-inner">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-center vh-100 text-white">
            <div class="row justify-content-center w-100">
                <div class="col-md-7 col-lg-4">
                    <div class="border rounded-5 py-5 bg-light shadow-lg text-center">
                        <h1 class="typing-demo text-secondary fw-bolder m-auto">
                           404
                        </h1>
                        <h3 class="text-uppercase mb-5 fw-lighter">Ooop! Page not found.</h3>
                        <a href="{{url('')}}" class="btn text-white gradient-btn rounded-pill py-3 px-5 text-uppercase">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="{{url('assets/js/admin_app.min.js')}}"></script>