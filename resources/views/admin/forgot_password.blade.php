<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$header['title']}}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel='icon' type='image/x-icon' href='assets/img/favicon.png' />
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
                <div class="col-sm-7 col-md-6 col-lg-5 col-xl-4 col-xxl-3 text-center">
                    <img class="mb-5" src="{{url('assets/img/logo.png')}}" style="width: 200px;">
                        @if(isset($errors) && $errors->first()!='')      
                        <div class="alert alert-danger" style="text-align: center;">
                            <strong>{{$errors->first()}}</strong>
                        </div>
                        @endif
                        @if(isset($success))     
                        <div class="alert alert-success" style="text-align: center;">
                            <strong>{{$success}}</strong>
                        </div>
                        @endif
                    <div class="card p-4">
                        <h3 class="mb-4 fw-bold">Forgot Password</h3>
                        <form name="form" method='Post' action="{{URL::to('admin/forgot-password')}}">
                            @csrf
                            <div class="form-floating w-100 mb-3">
                                <input type="email" name="email" class="form-control bg-transparent" id="floatingInputGrid" placeholder="name@example.com" value="">
                                <label for="floatingInputGrid">Email address</label>
                            </div>
                            <button type="submit" class="btn btn-lg gradient-btn text-white text-uppercase w-100 rounded-pill">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="{{url('assets/js/admin_app.min.js')}}"></script>