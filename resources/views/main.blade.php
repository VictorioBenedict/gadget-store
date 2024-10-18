<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <title>Gadget Store</title>
    <style>
        /* Ensure full height sections */
        *{
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
            scroll-behavior: smooth;
        }
        section {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* Adjust padding for each section */
        .header {
            background-color: #257dfd;
            margin-top: -20px;
        }
        .about {
            background-color: #f8f9fa;
        }
        .features {
            background-color: #dee2e6;
        }
        .logo-icon{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 8px;
        }

        /* Ensure consistent text alignment on different screen sizes */
        @media (min-width: 992px) {
            .text-lg-start {
                text-align: start !important;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="assets/logo.png" alt="Logo" class="logo-icon"> Gadget Store
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route ('products')}}">Products</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Header Section -->
    <section class="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 col-lg-6 text-center text-lg-start">
                    <h1 class="display-4 fw-bold text-white">Discover The Future of Technology.</h1>
                    <p class="lead text-white pb-3">
                        Explore our latest gadgets designed to elevate your digital lifestyle.
                    </p>
                    <a href="{{route ('login')}}" class="btn btn-light px-5 d-inline-block mt-4">Shop Now</a>
                </div>
                <div class="col-12 col-lg-5 mt-5 mt-lg-0 text-center">
                    <img src="/assets/iphone.png" class="img-fluid" alt="iPhone Image">
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-12 col-lg-4 text-center">
                    <img src="/assets/samsung (2).png" alt="Samsung Logo" class="img-fluid mx-auto d-block" style="max-height: 500px;">
                </div>
                <div class="col-12 col-lg-8">
                    <div class="text-center text-lg-start">
                        <h2 class="text-primary fs-1 fw-bold mb-3">
                            About Gadget Store
                        </h2>
                        <p>
                            Welcome to Gadget Store, your premier destination for cutting-edge technology and gadgets. At Gadget Store, we're passionate about bringing you the latest innovations in consumer electronics, ensuring you stay at the forefront of digital trends.
                        </p>
                        <p>
                            Our mission is to provide not just products, but experiences that enhance your digital lifestyle. Whether you're looking for the newest smartphones, smart home devices, wearable technology, or innovative accessories, Gadget Store is here to meet your needs.
                        </p>
                        <p>
                            Explore our online store or visit our physical locations to discover the future of technology today. Join us in embracing innovation and transforming the way you interact with the digital world. Welcome to Gadget Store, where technology meets passion.
                        </p>
                        <p>
                            Founded on a passion for technology and driven by a commitment to quality, we strive to deliver excellence in both products and customer service. Our team of experts is always on hand to provide guidance and support, helping you make informed decisions that align with your tech preferences and lifestyle.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-primary fs-1 fw-bold mb-3 text-center">
                        Key Features
                    </h2>
                </div>
            </div>
            <div class="row mt-5 g-4">
                <div class="col-12 col-lg-4">
                    <div class="card p-3 text-center">
                        <i class="bi bi-lightbulb fs-3"></i>
                        <h3 class="mt-3">Innovative Technology</h3>
                        <p class="card-text">
                            Our products featuring the latest and most innovative technologies.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card p-3 bg-primary text-center">
                        <i class="bi bi-shield-check fs-3"></i>
                        <h3 class="mt-3">Quality Assurance</h3>
                        <p class="card-text">
                            Discover our commitment to quality and customer satisfaction.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card p-3 text-center">
                        <i class="bi bi-alarm fs-3"></i>
                        <h3 class="mt-3">On-Time Delivery</h3>
                        <p class="card-text">
                            Enjoy fast and reliable delivery service for your convenience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JavaScript and Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
