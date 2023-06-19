<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="{{url('assets/css/admin_app.min.css')}}" />
      <link rel="icon" type="image/x-icon" href="{{url('/assets/img/favicon.png')}}">
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

    <div class="bg-dark main-content position-relative">

        <div class="loader" id="loader">
            <div class="loader-inner">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <header class="py-2 py-md-3">
            <nav class="navbar navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img src="{{url('assets/img/logo.png')}}" alt="" class="navbar-horizontal-logo">
                    </a>

                    <div class="d-flex gap-2 order-lg-1">
                        <button type="button" class="btn gradient-btn text-white rounded-pill fw-bold fs-6 text-uppercase px-4 py-3 d-none" id="btn-connect">Connect To Wallet</button>
                        <button type="button" class="btn gradient-btn text-white rounded-pill fw-bold fs-6 text-uppercase px-4 py-3 d-none meta_address" id="btn-disconnect">Connect To Wallet</button>
                        <button class="border navbar-toggler py-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bars"></span>
                        <span class="navbar-toggler-bars"></span>
                        <span class="navbar-toggler-bars"></span>
                    </button>
                    </div>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto gap-lg-3">
                            <hr class="bg-white d-lg-none">
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-lighter active" aria-current="page" href="#">Launchpad</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-lighter" href="#">White Papper</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-secondary fw-lighter" href="#">How to Buy?</a>
                            </li>
                            <button type="button" class="btn gradient-btn text-white rounded-pill fw-bold fs-6 text-uppercase px-4 py-3 d-block d-sm-none" data-bs-toggle="modal" data-bs-target="#changeNetwork">Connect To Wallet</button>
                        </ul>
                    </div>

                </div>
            </nav>
        </header>

        <section class="py-3 bg-light">
            <div class="container">
                <div class="d-flex gap-2 flex-wrap justify-content-between align-items-center">
                    <h2 class="text-white fw-bold display-5 m-0">Portfolio</h2>
                    <h3 class="text-white-50 ms-auto fw-bold m-0">Balance: <span id="token-balance">0</span> ACB</h3>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="container">
                <div class="card p-4">
                    <div class="row g-2">
                        <div class="col-lg-4 col-xl-3">
                            <div class="flex-lg-column nav-pills me-3 d-flex gap-3 flex-wrap" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="btn border px-4 py-3 fs-6 rounded-pill text-start fw-lighter text-white gradient-btn border-0" type="button"><i class="fa-solid fa-seedling me-3"></i>Seed Round</button>
                                <button class="btn border px-4 py-3 fs-6 rounded-pill text-start fw-lighter text-white" type="button"><i class="fa-solid fa-briefcase me-3"></i>Private Round</button>
                                <button class="btn border px-4 py-3 fs-6 rounded-pill text-start fw-lighter text-white" type="button"><i class="fa-solid fa-user-tie me-3"></i>Public Round</button>
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-9">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <p class="m-0 fs-5 fw-lighter text-center text-white py-5">Please connect your wallet account to view your portfolio</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <footer class="py-3 mt-auto border-top border-secondary position-absolute w-100 bottom-0">
            <div class="container">
                <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
                    <p class="text-white m-0 fw-lighter">© Copyright
                        <script>
                            document.write(new Date().getFullYear());
                        </script> acidbase. All rights reserved.
                    </p>
                    <div class="d-flex align-items-center gap-2 ms-auto">
                        <a target="_blank" href="https://www.facebook.com"><i
                                class="fa-brands fa-facebook-f bg-light text-secondary rounded-3 p-3 fs-6"></i></a>
                        <a target="_blank" href="https://www.instagram.com"><i
                                class="fa-brands fa-instagram bg-light text-secondary rounded-3 p-3 fs-6"></i></a>
                        <a target="_blank" href="https://www.linkedin.com"><i
                                class="fa-brands fa-linkedin-in bg-light text-secondary rounded-3 p-3 fs-6"></i></a>
                        <a target="_blank" href="https://www.twitter.com"><i
                                class="fa-brands fa-twitter bg-light text-secondary rounded-3 p-3 fs-6"></i></a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Modal -->
        <div class="modal fade" id="disconnectWallet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="disconnectWalletLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark p-4 border border-secondary">
                    <div class="modal-body text-center text-white">
                        <div class="text-end">
                            <button class="btn btn-outline-primary fs-6" data-bs-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        </div>
                        <h2 id="disconnectWalletLabel" class="fw-bold m-0 display-5">Connected With</h2>
                        <h4 class="text-primary my-4 fw-bold">0xD2 .... D741 <i class="fa-regular fa-copy mx-1 cursor-pointer"></i> <i class="fa-solid fa-arrow-up-right-from-square cursor-pointer"></i></h4>
                        <button type="button" class="btn gradient-btn text-white rounded-pill fw-bold fs-6 text-uppercase px-4 py-3" data-bs-dismiss="modal">Disconnect Wallet
                    </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="change-chain-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="changeNetworkLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark p-4 border border-secondary">
                    <div class="modal-body text-center text-white">
                        <div class="text-end">
                            <button class="btn btn-outline-primary fs-6" data-bs-dismiss="modal"><i
                                class="fa-solid fa-xmark"></i></button>
                        </div>
                        <h2 id="changeNetworkLabel" class="fw-bold m-0 display-5">Oops...</h2>
                        <p class="my-4 fs-6">It appears that you are on a different chain id, please check and select the correct one.</p>
                        <button type="button" class="btn gradient-btn text-white rounded-pill fw-bold fs-6 text-uppercase px-4 py-3" id="change-network-btn">Change MetaMask Network</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    var is_live = `{{env('APP_ENV')}}`;
    var c_id = `{{env('CHAIN_ID')}}`;
    var TokenContractAddress = `{{env('TOKEN_CONTRACT')}}`;
    var SeedContractAddress = `{{env('SEED_CONTRACT')}}`;
    var PrivateSaleContractAddress = `{{env('PRIVATE_SALE_CONTRACT')}}`;
    var PublicSaleContractAddress = `{{env('PUBLIC_SALE_CONTRACT')}}`;
</script>
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