<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Gadget Store</title>
    <style>
        * {
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        body {
            background-color: #A0937D;
        }
        table {
            background-color: #A0937D;
        }
        .logo-icon{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 8px;
        }
        .small-text{
            font-size: 1rem;
        }
        .custom-card {
            width: 250px;
        }

        @media (max-width: 768px) {
            .custom-card {
                width: 50%; 
                justify-content: start
                margin: 0 auto; 
            }
        }

        @media (min-width: 769px) and (max-width: 1023px) {
            .custom-card {
                width: 50%; 
                justify-content: start
                margin: 0 auto; 
            }
        }

        @media (min-width: 1024px) {
            .custom-card {
                width: 20%; 
                justify-content: start
                margin: 0 auto; 
            }
        }
    </style>
</head>
<header>
    <nav class="navbar navbar-expand-sm bg-black navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo-icon">Gadget Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('main')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('main') }}#about">About</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('main') }}#features">Features</a>
                    </li>                                       
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route ('products')}}">Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<body class="bg-secondary">
    <div class="container">
        <div class="row justify-content-start mt-1">
            <div class="title text-center mt-2 text-black"><h3>Welcome to Gadget Store</h3></div>
            <p class="text text-center text-black">Connecting you to the world, one device at a time.</p>
            <p class="d-none d-sm-flex gap-3 text-black">Select Categories:</p>
            <div class="d-none d-flex gap-3">
                <a href="{{ route('all') }}">
                    <button class="btn btn-outline-dark">All</button>
                </a>
                <a href="{{ route('smartphonee') }}">
                    <button class="btn btn-outline-dark">Smartphone</button>
                </a>
                <a href="{{ route('digitalcameraa') }}">
                    <button class="btn btn-outline-dark">Digital Camera</button>
                </a>
                <a href="{{ route('personalcomputerr') }}">
                    <button class="btn btn-outline-dark">Personal Computer</button>
                </a>
                <a href="{{ route('televisionn') }}">
                    <button class="btn btn-outline-dark">Television</button>
                </a>
            </div>

            <div class="text-center"> 
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Already in Cart',
                            text: 'This product has already been added to your cart!',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif
            </div>   

            <div class="container mt-2 mb-2">
                <div class="d-flex justify-content-center">
                    <form class="d-flex w-50 gap-2" action="{{ route('products') }}" method="GET">
                        <input class="form-control form-control-sm border-black" type="text" name="query" placeholder="Search" aria-label="Search" value="{{ old('query', $query) }}" autocomplete="off">
                        <button class="btn btn-light border border-black" type="submit">Search</button>
                    </form>
                </div>
            </div>         

            @if($product->isEmpty())
                <div class="col-12 text-center mt-5">
                    @if($query && $product->isEmpty())
                        <p class="text-black">No products found for your search: "{{ $query }}"</p>
                    @endif             
                    <p>No products found on this category.</p>     
                </div>
            @else
                @foreach ($product as $product)
                    <div class="col-md-3 mb-3 custom-card">
                        <div class="card bg-black text-white mt-2">
                            <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" draggable="false">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-center">{{ $product->name }}</h5>
                                <p class="card-text text-center">Price: ₱{{ number_format($product->price, 2) }}</p>
                                <p class="card-text text-center small-text">{{ $product->description }}</p>
                                <div class="text-center">
                                    <a href="{{ route('login')}}" class="btn btn-outline-light">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
</html>
