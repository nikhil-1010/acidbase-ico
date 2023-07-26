<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{$header['title']}}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel='icon' type='image/x-icon' href='assets/img/favicon.png' />
    <link rel="stylesheet" href="{{url('assets/css/admin_app.min.css')}}" />
    <input type="hidden" id="base_url" value="{{url('/')}}">
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
                        <h3 class="mb-4 fw-bold">Reset Password</h3>
                        <form name="form" method='Post' id="reset_password_form" action="{{URL::to('admin/reset-password')}}">
                            @csrf
                            <input type="hidden" id="pass_token" name="pass_token" value="{{$body['token']}}"/>
                            <div class="form-floating w-100 mb-3">
                                <input type="password" name="new_password" class="form-control bg-transparent" id="new_password" value="">
                                <label for="new_password">New Password</label>
                            </div>
                            <div class="form-floating w-100 mb-3">
                                <input type="password" name="confirm_password" class="form-control bg-transparent" id="confirm_password" value="">
                                <label for="confirm_password">Confirm Password</label>
                            </div>
                            <button type="button" id="submit_forgot" class="btn btn-lg gradient-btn text-white text-uppercase w-100 rounded-pill">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="{{url('assets/js/admin_app.min.js')}}"></script>
<script src="{{url('assets/js/admin/forgot_password.min.js')}}"></script>