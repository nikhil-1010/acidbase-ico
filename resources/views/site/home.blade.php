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
                                <a class="nav-link text-white fw-lighter active" aria-current="page" href="{{url('#home')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="{{url('#feature')}}">Features</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="{{url('#tokenomics')}}">Tokenomics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="{{url('#team')}}">Team</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white fw-lighter" href="#">Whitepaper</a>
                            </li>
                        </ul>
                        <div class="rounded-pill fs-6 text-uppercase p-3 border border-2 gap-3 d-flex align-items-center justify-content-center">
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

        <section class="hero-banner text-white position-relative overflow-hidden" id="home">
            <div class="hero-video position-absolute top-0 bottom-0 m-auto">
                <video width="100%" height="100%" poster="{{url('assets/img/green-waves.png')}}" muted="" autoplay="" loop="" playsinline="">
                    <source src="{{url('assets/img/green-waves.mp4')}}" type="video/mp4">
                </video>
            </div>
            <div class="container h-100 position-relative">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-lg-7">
                        <h1 class="section-title display-2 text-uppercase">Immortalise your legacy with Acidbase, Live Forever</h1>
                        <p class="fw-lighter fs-3">A revolutionary platform that harnesses the power of Artificial Intelligence to create your digital legacy.</p>
                    </div>
                    <div class="col-lg-5">
                        <div class="presale-end-panel text-center mt-5 mt-lg-0">
                            <h2 class="text-white">Our Presale Ends in</h2>
                            <div id='flip_timer' class="my-4"></div>
                            <a href="" class="btn text-white gradient-btn rounded-pill fs-5 fw-bold py-3 px-5 text-uppercase">Entr Presale</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner-space pt-0 text-white">
            <div class="container">
                <div class="row gy-4 align-items-center justify-content-center">
                    <div class="col-12 col-lg-4">
                        <div class="bg-light p-5 shadow-lg h-100 rounded-5">
                            <div class="d-flex gap-4 align-items-center mb-4">
                                <img src="{{url('assets/img/artificial-intelligence.png')}}" alt="AI" />
                                <h5 class="text-secondary text-uppercase m-0">
                                    The future of AI: Enter Acidbase
                                </h5>
                            </div>
                            <p class="m-0 fw-lighter">Acidbase's unique combination of blockchain, AI, and NFTs empowers you with unprecedented control over your personal data, creating a decentralized, secure, and transparent platform for AI-powered digital personas. This groundbreaking
                                approach positions Acidbase as a leading project in the fast-growing blockchain industry, offering a personalized and private digital experience.</p>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-6 col-lg-4">
                        <div class="text-center">
                            <img src="{{url('assets/img/acidbase-icon.png')}}" alt="acidbase-icon" class="img-fluid acidbase-animated-img">
                            <img src="{{url('assets/img/launch-hand.svg')}}" alt="launch-hand" class="img-fluid w-75">
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="bg-light p-5 shadow-lg h-100 rounded-5">
                            <div class="d-flex gap-4 align-items-center mb-4">
                                <img src="{{url('assets/img/robot.png')}}" alt="AI" />
                                <h5 class="m-0 text-secondary text-uppercase">
                                    Preserve your legacy, be immortal
                                </h5>
                            </div>
                            <p class="m-0 fw-lighter">Acidbase offers you a chance to create an AI-driven digital persona that captures your essence and interacts with future generations. Through advanced AI algorithms, Acidbase preserves your legacy, allowing for a form of immortality
                                where your life story and experiences are passed down for generations to come.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner-space bg-black bg-opacity-25" id="feature">
            <div class="container">
                <div class="row g-3">
                    <div class="col-lg-4 col-md-6">
                        <h2 class="section-title display-5 text-uppercase text-secondary">Special Features</h2>
                        <p class="m-0 text-white fw-lighter">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora soluta ullam cumque error iure non quos eveniet.</p>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="text-white px-3">
                            <img src="{{url('assets/img/cube.png')}}" alt="cube" class="border p-4 mb-4 rounded-pill" />
                            <h5>Connect with the past</h5>
                            <p class="m-0 fw-lighter opacity-50">Engage in meaningful conversations with digitally preserved loved ones unlocking insights into thoughts, feelings, and experiences.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="text-white px-3">
                            <img src="{{url('assets/img/brain.png')}}" alt="brain" class="border p-4 mb-4 rounded-pill" />
                            <h5>Share wisdom with future generations</h5>
                            <p class="m-0 fw-lighter opacity-50">Allow descendants to interact with their ancestors and benefit from their knowledge, experience, and guidance.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="text-white px-3">
                            <img src="{{url('assets/img/rotate.png')}}" alt="cube" class="border p-4 mb-4 rounded-pill" />
                            <h5>Personalized learning</h5>
                            <p class="m-0 fw-lighter opacity-50">Gain tailored advice and mentorship from historical figures or innovative thinkers, fostering personal growth and development.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="text-white px-3">
                            <img src="{{url('assets/img/integration.png')}}" alt="cube" class="border p-4 mb-4 rounded-pill" />
                            <h5>Ethical implications</h5>
                            <p class="m-0 fw-lighter opacity-50">Explore the moral philosophical and societal questions surrounding AI immortality, driving important conversations and research.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="text-white px-3">
                            <img src="{{url('assets/img/research.png')}}" alt="cube" class="border p-4 mb-4 rounded-pill" />
                            <h5>Enhanced scientific research</h5>
                            <p class="m-0 fw-lighter opacity-50">Utilize the digital representation of individuals to better understand the complex interplay between genetics, personality and human experience. personality and human experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner-space text-center">
            <h2 class="section-title display-5 text-uppercase text-secondary">PROCESS OVERVIEW</h2>
            <p class="fw-lighter text-white mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <div class="process-overview-slider">
                <div class="slide">
                    <div class="bg-black bg-opacity-25 p-3 p-md-4 p-lg-5 border-green text-start text-white shadow-lg h-100 rounded-5">
                        <div class="text-center display-3 mb-5 text-secondary"><i class="fa-solid fa-shield-halved"></i></div>
                        <h5 class="text-uppercase fw-lighter">Purchase AcidBase<br>Tokens</h5>
                        <hr>
                        <p class="m-0 fw-lighter opacity-50">Acidbase tokens available for purchase with ETH during presale on a secure platform with a user-friendly interface.</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="bg-black bg-opacity-25 p-3 p-md-4 p-lg-5 border-green text-start text-white shadow-lg h-100 rounded-5">
                        <div class="text-center display-3 mb-5 text-secondary"><i class="fa-solid fa-wallet"></i></div>
                        <h5 class="text-uppercase fw-lighter">Connect wallet to the Acidbase Platform</h5>
                        <hr>
                        <p class="m-0 fw-lighter opacity-50">Connect your wallet after token purchase for seamless management and access to AI-driven digital persona creation on Acidbase.</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="bg-black bg-opacity-25 p-3 p-md-4 p-lg-5 border-green text-start text-white shadow-lg h-100 rounded-5">
                        <div class="text-center display-3 mb-5 text-secondary"><i class="fa-solid fa-arrow-right-arrow-left"></i></div>
                        <h5 class="text-uppercase fw-lighter">Share Personal Data & Train Your AI Model</h5>
                        <hr>
                        <p class="m-0 fw-lighter opacity-50">Submit personal data, chat, and refine AI model to create an accurate digital persona of your thoughts, emotions, and personality.</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="bg-black bg-opacity-25 p-3 p-md-4 p-lg-5 border-green text-start text-white shadow-lg h-100 rounded-5">
                        <div class="text-center display-3 mb-5 text-secondary"><i class="fa-solid fa-ranking-star"></i></div>
                        <h5 class="text-uppercase fw-lighter">Feature Extraction & Data Representation</h5>
                        <hr>
                        <p class="m-0 fw-lighter opacity-50">Acidbase utilizes advanced NLP and computer vision models to extract features from text, image, and audio data, capturing your essence.</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="bg-black bg-opacity-25 p-3 p-md-4 p-lg-5 border-green text-start text-white shadow-lg h-100 rounded-5">
                        <div class="text-center display-3 mb-5 text-secondary"><i class="fa-solid fa-id-card-clip"></i></div>
                        <h5 class="text-uppercase fw-lighter">Model Training and Personalization</h5>
                        <hr>
                        <p class="m-0 fw-lighter opacity-50">Acidbase personalizes AI models using user-specific data, employing transfer learning for unique characteristics and continuous improvement.</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="bg-black bg-opacity-25 p-3 p-md-4 p-lg-5 border-green text-start text-white shadow-lg h-100 rounded-5">
                        <div class="text-center display-3 mb-5 text-secondary"><i class="fa-solid fa-code"></i></div>
                        <h5 class="text-uppercase fw-lighter">Model Storage, Deployment, & Blockchain Integration</h5>
                        <hr>
                        <p class="m-0 fw-lighter opacity-50">AI models containerized with Docker are deployed on AWS or GCP, while Ethereum blockchain ensures secure data storage and access control.</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="bg-black bg-opacity-25 p-3 p-md-4 p-lg-5 border-green text-start text-white shadow-lg h-100 rounded-5">
                        <div class="text-center display-3 mb-5 text-secondary"><i class="fa-solid fa-clipboard-list"></i></div>
                        <h5 class="text-uppercase fw-lighter">Tokenization & Access to Your Trained AI Model</h5>
                        <hr>
                        <p class="m-0 fw-lighter opacity-50">Tokenize your AI model as a unique NFT, ensuring secure access to your AI-driven digital persona and managing your digital legacy.</p>
                    </div>
                </div>
                <div class="slide">
                    <div class="bg-black bg-opacity-25 p-3 p-md-4 p-lg-5 border-green text-start text-white shadow-lg h-100 rounded-5">
                        <div class="text-center display-3 mb-5 text-secondary"><i class="fa-solid fa-handshake"></i></div>
                        <h5 class="text-uppercase fw-lighter">User Interaction and<br>Engagement</h5>
                        <hr>
                        <p class="m-0 fw-lighter opacity-50">Engage with preserved loved ones, share wisdom, and learn from historical figures through Acidbase's AI interface.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner-space bg-light text-center" id="tokenomics">
            <div class="container">
                <h2 class="section-title display-5 text-uppercase text-secondary">TOKENOMICS</h2>
                <p class="fw-lighter text-white mb-4">Acidbase's native token is ACB. The total token supply is <span class="text-secondary">1,000,000,000 ACB</span>.</p>
                <div class="row g-4 align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 text-start">
                        <div class="d-flex flex-column gap-4">
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Team (15%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 15%;background-color: #f1548e;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Strategic Reserve (15%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 15%;background-color: #f97316;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Public Sale (30%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 30%;background-color: #1251a0;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Community Rewards (10%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 10%;background-color: #22c55e;" aria-valuenow="10 " aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Beta/Testnet Incentives (2.5%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 2.5%;background-color: #2271eb;" aria-valuenow="2.5" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8">
                        <canvas id="oilChart" width="100%" height="100%"></canvas>
                    </div>
                    <div class="col-lg-4 col-md-8 text-end">
                        <div class="d-flex flex-column gap-4">
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Advisors (5%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 5%;background-color: #702b91;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Grants (6%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 6%;background-color: #f64a73;" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Partnerships (6%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 6%;background-color: #22c55e;" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Marketing (8%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 8%;background-color: #2cdcb8;" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div>
                                <p class="text-white fw-lighter m-0 fs-14">Liquidity Provision (2.5%)</p>
                                <div class="progress rounded-pill bg-dark bg-opacity-50">
                                    <div class="progress-bar" role="progressbar" style="width: 2.5%;background-color: #2b29ae;" aria-valuenow="2.5" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner-space">
            <div class="container">
                <h2 class="section-title display-5 text-uppercase text-secondary text-center">ROADMAP</h2>
                <p class="fw-lighter text-white mb-4 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <!-- <div class="d-flex flex-column gap-4 gap-lg-0 text-start text-white position-relative">
                    <div class="row gx-0 align-items-center">
                        <div class="col-lg-6 col-md-4 order-md-1">
                            <img src="{{url('assets/img/checklists.png')}}" alt="" class="ms-md-4">
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="bg-light p-4 p-sm-5">
                                <h6 class="bg-dark bg-opacity-25 px-5 py-2 m-0 d-inline-block shadow border fw-lighter text-uppercase fs-14 font-monospace">Phase 1</h6>
                                <h4 class="text-uppercase text-secondary my-3">Research & Assemble</h4>
                                <hr>
                                <ul class="m-0">
                                    <li class="fw-lighter">Market Research & Targeting</li>
                                    <li class="fw-lighter">Expert Team Assembly</li>
                                    <li class="fw-lighter">AI Model Research</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 align-items-center">
                        <div class="col-lg-6 col-md-4 text-end">
                            <img src="{{url('assets/img/startup.png')}}" alt="" class="me-md-4">
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="bg-light p-4 p-sm-5">
                                <h6 class="bg-dark bg-opacity-25 px-5 py-2 m-0 d-inline-block shadow border fw-lighter text-uppercase fs-14 font-monospace">Phase 2</h6>
                                <h4 class="text-uppercase text-secondary my-3">Launch and User Adoption</h4>
                                <hr>
                                <ul class="m-0">
                                    <li class="fw-lighter">Token Presale Launch</li>
                                    <li class="fw-lighter">Token distribution: Presale & TGE</li>
                                    <li class="fw-lighter">Secure Exchange Partnerships</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 align-items-center">
                        <div class="col-lg-6 col-md-4 order-md-1">
                            <img src="{{url('assets/img/programming.png')}}" alt="" class="ms-md-4">
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="bg-light p-4 p-sm-5">
                                <h6 class="bg-dark bg-opacity-25 px-5 py-2 m-0 d-inline-block shadow border fw-lighter text-uppercase fs-14 font-monospace">Phase 3</h6>
                                <h4 class="text-uppercase text-secondary my-3">Development and Testing</h4>
                                <hr>
                                <ul class="m-0">
                                    <li class="fw-lighter">Alpha platform release</li>
                                    <li class="fw-lighter">Personalized AI personas</li>
                                    <li class="fw-lighter">AI Algorithm Development</li>
                                    <li class="fw-lighter">User testing and iteration</li>
                                    <li class="fw-lighter">Smart Contract/NFT Development</li>
                                    <li class="fw-lighter">User feedback iteration</li>
                                    <li class="fw-lighter">Mobile app release</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 align-items-center">
                        <div class="col-lg-6 col-md-4 text-end">
                            <img src="{{url('assets/img/decentralized.png')}}" alt="" class="me-md-4">
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="bg-light p-4 p-sm-5">
                                <h6 class="bg-dark bg-opacity-25 px-5 py-2 m-0 d-inline-block shadow border fw-lighter text-uppercase fs-14 font-monospace">Phase 4</h6>
                                <h4 class="text-uppercase text-secondary my-3">Scaling and Monetization</h4>
                                <hr>
                                <ul class="m-0">
                                    <li class="fw-lighter">Language & Cultural Expansion</li>
                                    <li class="fw-lighter">Enhanced integration with blockchain</li>
                                    <li class="fw-lighter">Enhanced AI models and algorithms</li>
                                    <li class="fw-lighter">SDK Launch: Empowering Developers</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row g-0 align-items-center">
                        <div class="col-lg-6 col-md-4 order-md-1">
                            <img src="{{url('assets/img/creative.png')}}" alt="" class="ms-md-4">
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="bg-light p-4 p-sm-5">
                                <h6 class="bg-dark bg-opacity-25 px-5 py-2 m-0 d-inline-block shadow border fw-lighter text-uppercase fs-14 font-monospace">Phase 5</h6>
                                <h4 class="text-uppercase text-secondary my-3">Future Innovations</h4>
                                <hr>
                                <ul class="m-0">
                                    <li class="fw-lighter">Global User Scaling</li>
                                    <li class="fw-lighter">Strategic Partnerships</li>
                                    <li class="fw-lighter">Global Impact Campaign</li>
                                    <li class="fw-lighter">Foundation for Acidbase created</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                <section class="roadmap position-relative" id="roadmap">
                    <div class="container">
                        <div class="row clearfix left">
                            <div class="col-lg-5 box left first reveal">
                                <span class="heading green">PHASE 1</span>
                                <br/>
                                <div class="milestones vertical-line right">
                                    <span class="text-right">Market Research & Targeting</span>
                                    <span class="text-right">Expert Team Assembly</span>
                                    <span class="text-right">AI Model Research</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-5 box right first reveal">
                                <span class="heading green">PHASE 2</span>
                                <br/>
                                <div class="milestones vertical-line left">
                                    <span class="text-right">Token Presale Launch</span>
                                    <span class="text-right">Token distribution: Presale & TGE</span>
                                    <span class="text-right">Secure Exchange Partnerships</span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix left">
                            <div class="col-lg-5 box left second reveal">
                                <span class="heading green">PHASE 3</span>
                                <br/>
                                <div class="milestones vertical-line right">
                                    <span class="text-right">Alpha platform release</span>
                                    <span class="text-right">Personalized AI personas</span>
                                    <span class="text-right">AI Algorithm Development</span>
                                    <span class="text-right">User testing and iteration</span>
                                    <span class="text-right">Smart Contract/NFT Development</span>
                                    <span class="text-right">User feedback iteration</span>
                                    <span class="text-right">Mobile app release</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-5 box right second reveal">
                                <span class="heading green">PHASE 4</span>
                                <br/>
                                <div class="milestones vertical-line left">
                                    <span class="text-right">Language & Cultural Expansion</span>
                                    <span class="text-right">Enhanced integration with blockchain</span>
                                    <span class="text-right">Enhanced AI models and algorithms</span>
                                    <span class="text-right">SDK Launch: Empowering Developers</span>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix left">
                            <div class="col-lg-5 box left third reveal">
                                <span class="heading green">PHASE 5</span>
                                <br/>
                                <div class="milestones vertical-line right">
                                    <span class="text-right">Global User Scaling</span>
                                    <span class="text-right">Strategic Partnerships</span>
                                    <span class="text-right">Global Impact Campaign</span>
                                    <span class="text-right">Foundation for Acidbase created</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <section class="inner-space bg-light" id="team">
            <div class="container">
                <div class="row g-4 align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <div class="meet-us-video position-relative">
                            <video width="100%" height="100%" poster="{{url('assets/img/meet-us.png')}}" muted="" autoplay="" loop="" playsinline="">
                                <source src="{{url('assets/img/meet-us.mp4')}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="section-title display-5 text-uppercase text-secondary">Meet Us</h2>
                        <p class="fw-lighter text-white">Acidbase's team is composed of highly skilled professionals from diverse backgrounds. With expertise in fields such as artificial intelligence, blockchain development, data science, and business, the team is committed to developing
                            cutting-edge solutions for AI immortality and digital legacy management.</p>
                        <p class="m-0 fw-lighter text-white">The team's deep knowledge and experience in their respective fields are leveraged to provide a comprehensive and holistic approach to personalized AI models and NFT creation. The team members work together to ensure that Acidbase
                            stays at the forefront of innovation, continuously pushing the boundaries of what is possible in the digital world.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner-space text-center text-white">
            <div class="container">
                <h2 class="section-title display-5 text-uppercase text-secondary">faqs</h2>
                <p class="fw-lighter mb-5">Are you curious about how Acidbase can benefit you? Here are the most common questions and answers.</p>
                <div class="row gx-4">
                    <div class="col-lg-6">
                        <div class="accordion faq-panel" id="accordionFlushExample">
                            <div class="accordion-item">
                                <button id="flush-headingOne" class="accordion-button shadow-none bg-transparent fw-lighter fs-5 text-white px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                        What is Acidbase?
                                </button>
                                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-start px-0 fw-lighter fs-14">Acidbase is a revolutionary platform that harnesses the power of artificial intelligence (AI) to create AI-driven digital personas that immortalize individuals and enable them to interact with future generations. The
                                        platform allows users to submit diverse personal data, including text, images, and audio, for AI-driven digital persona creation, which can be used to connect with digitally preserved loved ones, share wisdom with
                                        future generations, and receive personalized learning opportunities.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="flush-headingTwo" class="accordion-button shadow-none bg-transparent fw-lighter fs-5 text-white px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    What is the Acidbase token used for?
                                </button>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-start px-0 fw-lighter fs-14">The Acidbase token (ACB) is the native token of our platform. It is used for transaction fees and as a means of accessing our full suite of tools and features. By holding ACB, you can benefit from discounts, rewards,
                                        and more.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="flush-headingThree" class="accordion-button shadow-none bg-transparent fw-lighter fs-5 text-white px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    How can I purchase ACB?
                                </button>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-start px-0 fw-lighter fs-14">ACB can be purchased during our presale by clicking the 'Buy Now' button and following the instructions to purchase tokens using ETH. You can also buy ACB on decentralized exchanges (DEXs) and centralized platforms
                                        (CEXs) that list our token.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="flush-headingFour" class="accordion-button shadow-none bg-transparent fw-lighter fs-5 text-white px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                    How do I store my ACB?
                                </button>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body text-start px-0 fw-lighter fs-14">You can store your ACB in any wallet that supports ERC-20 tokens. We recommend using a hardware wallet for maximum security.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="accordion faq-panel" id="accordionFlushExample2">
                            <div class="accordion-item">
                                <button id="flush-headingFive" class="accordion-button shadow-none bg-transparent fw-lighter fs-5 text-white px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                    Is Acidbase secure?
                                </button>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body text-start px-0 fw-lighter fs-14">Yes, Acidbase uses SHA-256 encryption to ensure that your data and identity are secure. Additionally, our platform is built on the Ethereum blockchain, which is known for its security and decentralization.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="flush-headingSix" class="accordion-button shadow-none bg-transparent fw-lighter fs-5 text-white px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                    Do I need technical knowledge to use Acidbase?
                                </button>
                                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body text-start px-0 fw-lighter fs-14">No, Acidbase is designed to be user-friendly and accessible to everyone. You don't need technical knowledge to use or trade your ACB or NFTs.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="flush-headingSeven" class="accordion-button shadow-none bg-transparent fw-lighter fs-5 text-white px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                    What factors affect the value of my Acidbase NFT?
                                </button>
                                <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body text-start px-0 fw-lighter fs-14">The value of your Acidbase NFT depends on market demand, the rarity of your DNA data, and other factors. Holding onto your NFT can allow you to benefit from the growth of the DeFi ecosystem and the increasing demand
                                        for decentralized identity management.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <button id="flush-headingEight" class="accordion-button shadow-none bg-transparent fw-lighter fs-5 text-white px-0 py-2 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                    How can I get involved with Acidbase?
                                </button>
                                <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample2">
                                    <div class="accordion-body text-start px-0 fw-lighter fs-14">You can get involved with Acidbase by participating in our presale, buying and holding ACB, and contributing to our community through social media, forums, and other channels. Together, we can revolutionize the way
                                        we manage personal data and identity!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="inner-space bg-light">
            <div class="container">
                <div class="row g-4 align-items-center justify-content-between">
                    <div class="col-lg-7 col-md-6">
                        <h2 class="section-title display-5 text-uppercase text-secondary">Launch Into the future with Acidbase today!</h2>
                        <p class="fw-lighter text-white mb-4">Acidbase token (ACB) will be used to access services and products offered by the Acidbase platform. It can also be used for governance purposes, such as voting on proposals and decisions related to the platform's development</p>
                        <a href="" class="btn text-white gradient-btn rounded-pill fs-5 fw-bold py-3 px-5 text-uppercase">Entr Presale</a>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <img src="{{url('assets/img/robot-present.png')}}" alt="" class="img-fluid w-100 updown-animation">
                    </div>
                </div>
            </div>
        </section>

        <section class="text-center text-white inner-space">
            <div class="container">
                <h2 class="section-title text-secondary display-4 text-uppercase mb-4">Featured In</h2>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6">
                        <div class="px-4 py-3 featured-logo"><img src="{{url('assets/img/coindesk.png')}}" alt="coindesk" class="img-fluid" /></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="px-4 py-3 featured-logo"><img src="{{url('assets/img/cointelegraph.png')}}" alt="cointelegraph" class="img-fluid" /></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="px-4 py-3 featured-logo"><img src="{{url('assets/img/tech-crunch.png')}}" alt="tech-crunch" class="img-fluid" /></div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="px-4 py-3 featured-logo"><img src="{{url('assets/img/wired.png')}}" alt="wired" class="img-fluid" /></div>
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
                        <p class="m-0 fw-lighter ms-auto">© Copyright
                            <script>
                                document.write(new Date().getFullYear());
                            </script> acidbase. All rights reserved.
                        </p>
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