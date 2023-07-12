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
                <h2 class="section-title display-4 text-uppercase text-secondary d-inline-block">About Us</h2>
                <p class="m-0 text-white fw-lighter">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora soluta ullam cumque error iure non quos eveniet.</p>
            </div>
        </section>


        <section class="inner-space text-white">
            <div class="container">
                <h2 class="fw-lighter fst-italic lh-base text-secondary">
                    Urna cursus eget nunc scelerisque. Sit amet risus nullam eget felis eget nunc lobortis. Placerat vestibulum lectus mauris ultrices. Mi in nulla posuere sollicitudin aliquam ultrices. Est sit amet facilisis magna etiam tempor orci. Nisi est sit amet facilisis
                    magna. Auctor augue mauris augue neque gravida. Sed lectus vestibulum mattis ullamcorper velit sed. Nunc id cursus metus aliquam eleifend mi in nulla posuere.
                </h2>
            </div>
        </section>

        <section class="inner-space text-center text-white pt-0">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-3 col-sm-6">
                        <div class="bg-light border rounded-5 py-5 shadow">
                            <h2 class="display-1 d-inline-block static-number">203</h2>
                            <p class="m-0 text-uppercase fs-12" style="letter-spacing: 5px;">EVENTS</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="bg-light border rounded-5 py-5 shadow">
                            <h2 class="display-1 d-inline-block static-number">145</h2>
                            <p class="m-0 text-uppercase fs-12" style="letter-spacing: 5px;">EVENTS</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="bg-light border rounded-5 py-5 shadow">
                            <h2 class="display-1 d-inline-block static-number">789</h2>
                            <p class="m-0 text-uppercase fs-12" style="letter-spacing: 5px;">EVENTS</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="bg-light border rounded-5 py-5 shadow">
                            <h2 class="display-1 d-inline-block static-number">6K+</h2>
                            <p class="m-0 text-uppercase fs-12" style="letter-spacing: 5px;">EVENTS</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr class="bg-white">

        <section class="text-center text-white inner-space">
            <div class="container">
                <h2 class="section-title text-secondary display-4 text-uppercase mb-4 d-inline-block">Meet us</h2>
                <div class="row g-5 justify-content-center">
                    <div class="col-lg-4 col-md-6">
                        <div class="team-member position-relative">
                            <img src="assets/img/ai-avatar.jpg" alt="avatar" class="img-fluid w-100 border border-2 shadow rounded-5">
                            <h6 class="text-primary text-uppercase fw-bold fs-14 rounded-5 p-3 position-absolute start-0 end-0 w-75 m-auto d-inline-block bg-white">erica Jordon</h6>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="team-member position-relative">
                            <img src="assets/img/ai-avatar.jpg" alt="avatar" class="img-fluid w-100 border border-2 shadow rounded-5">
                            <h6 class="text-primary text-uppercase fw-bold fs-14 rounded-5 p-3 position-absolute start-0 end-0 w-75 m-auto d-inline-block bg-white">erica Jordon</h6>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="team-member position-relative">
                            <img src="assets/img/ai-avatar.jpg" alt="avatar" class="img-fluid w-100 border border-2 shadow rounded-5">
                            <h6 class="text-primary text-uppercase fw-bold fs-14 rounded-5 p-3 position-absolute start-0 end-0 w-75 m-auto d-inline-block bg-white">erica Jordon</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                    <a href="" class="text-uppercase text-secondary text-decoration-none fw-lighter">Features</a>
                    <a href="" class="text-uppercase text-secondary text-decoration-none fw-lighter">Tokenomics</a>
                    <a href="" class="text-uppercase text-secondary text-decoration-none fw-lighter">Team</a>
                    <a href="" class="text-uppercase text-secondary text-decoration-none fw-lighter">Whitepaper</a>
                    <a href="" class="text-uppercase text-secondary text-decoration-none fw-lighter">Privacy Policy</a>
                    <a href="" class="text-uppercase text-secondary text-decoration-none fw-lighter">Terms of use</a>
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