<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{url('assets/css/admin_app.min.css')}}" />
    <link rel="icon" type="image/x-icon" href="{{url('assets/img/favicon.png')}}">
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
    <div class="bg-dark">

        <div class="loader" id="loader">
            <div class="loader-inner">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <div class="back-to-top position-fixed start-0 bottom-0 m-4 cursor-pointer fs-1 text-secondary"><i class="fa-solid fa-circle-arrow-up"></i></div>

        <header class="py-2 py-md-3 ws-header position-sticky top-0">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{url('assets/img/logo.png')}}" alt="" class="navbar-horizontal-logo">
                    </a>


                    <button class="border navbar-toggler py-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bars"></span>
                        <span class="navbar-toggler-bars"></span>
                        <span class="navbar-toggler-bars"></span>
                    </button>

                    <div class="collapse navbar-collapse gap-3" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto gap-lg-3">
                            <hr class="bg-white d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter active" aria-current="page" href="{{url('/#home')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="{{url('/#feature')}}">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="{{url('/#tokenomics')}}">Tokenomics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="{{url('/#roadmap')}}">Roadmap</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="{{url('/#team')}}">Team</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="#">Whitepaper</a>
                            </li>
                        </ul>
                        <div class="rounded-pill fs-6 text-uppercase p-3 border border-2 gap-3 d-flex align-items-center justify-content-center d-lg-none d-xl-flex">
                            <a href="" class="text-white"><i class="fa-brands fa-telegram"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-discord"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-twitter"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-medium"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-reddit"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <section class="inner-space text-white pb-0">
          <div class="container">
                <h2 class="section-title display-4 text-uppercase text-secondary d-inline-block">Privacy Policy</h2>
            </div>
        </section>  

        <div class="inner-space">
            <div class="container ck-editor-content">
                {!! $body['privacy_policy']['data'] !!}
            </div>
        </div>

      
        <footer class="bg-light pt-5">
            <div class="container">
                <div class="row align-items-center justify-content-between g-4 g-lg-0">
                    <div class="col-lg-6">
                        <a class="navbar-brand" href="{{url('/')}}">
                            <img src="{{url('assets/img/logo.png')}}" alt="" class="navbar-horizontal-logo">
                        </a>
                        <p class="m-0 text-white mt-3 fw-lighter fs-5">Acidbase token (ACB) will be used to access services and products offered by the Acidbase platform.</p>
                    </div>
                    <div class="col-lg-5">
                        <h5 class="text-uppercase text-white fw-bold mb-3">Subscribe acidbase!</h5>
                        <form class="d-flex align-items-center gap-2 border p-2 rounded-pill">
                            <div class="form-floating w-100 text-white">
                                <input type="email" class="form-control bg-transparent border-0" id="floatingInputGrid" placeholder="name@example.com" value="" required>
                                <label for="floatingInputGrid">Email address</label>
                            </div>
                            <button type="button" class="btn gradient-btn rounded-pill text-white fs-3 px-3"><i class="fa-solid fa-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-3 gap-lg-5 align-items-center justify-content-center my-5">
                    <a href="{{url('/#feature')}}" class="text-uppercase text-secondary text-decoration-none fw-lighter">Features</a>
                    <a href="{{url('/#tokenomics')}}" class="text-uppercase text-secondary text-decoration-none fw-lighter">Tokenomics</a>
                    <a href="{{url('/#team')}}" class="text-uppercase text-secondary text-decoration-none fw-lighter">Team</a>
                    <a href="" class="text-uppercase text-secondary text-decoration-none fw-lighter">Whitepaper</a>
                    <a href="{{url('privacy-policy')}}" class="text-uppercase text-secondary text-decoration-none fw-lighter">Privacy Policy</a>
                    <a href="{{url('terms-condition')}}" class="text-uppercase text-secondary text-decoration-none fw-lighter">Terms of use</a>
                    <a href="{{url('about')}}" class="text-uppercase text-secondary text-decoration-none fw-lighter">About Us</a>
                    <a href="{{url('contact-us')}}" class="text-uppercase text-secondary text-decoration-none fw-lighter">Contact Us</a>
                </div>
            </div>
            <div class="py-4 border-top border-secondary fs-14 text-white">
                <div class="container">
                    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
                        <div class="rounded-pill fs-6 text-uppercase p-3 border border-2 gap-3 d-flex align-items-center justify-content-center">
                            <a href="" class="text-white"><i class="fa-brands fa-telegram"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-discord"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-twitter"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-medium"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-reddit"></i></a>
                            <a href="" class="text-white"><i class="fa-brands fa-linkedin"></i></a>
                        </div>
                        <p class="m-0 fw-lighter ms-auto">© Copyright {{date('Y')}} acidbase. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

<?php
if (isset($footer['js'])) {
    for ($i = 0; $i < count($footer['js']); $i++) {
        if (strpos($footer['js'][$i], "https://") !== FALSE || strpos($footer['js'][$i], "http://") !== FALSE)
            echo '<script type="text/javascript" src="' . $footer['js'][$i] . '"></script>';
        else
            echo '<script type="text/javascript" src="' . \URL::to('/assets/js/' . $footer['js'][$i]) . '"></script>';
    }
}
?>
</html>