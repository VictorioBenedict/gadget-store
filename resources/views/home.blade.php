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
    <title>Gadget Store</title>
    <style>
        *{
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        body{
            background-color: #A0937D;
        }
        table{
            background-color: #A0937D;
        }
    </style>
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Benedict Victorio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('index') }}">Home</a>
            </li>
            <li class="nav-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf <!-- CSRF Protection -->
                </form>
                
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>                        
            </li>
        </ul>
        <div class="d-flex justify-content-end">
            <a class="btn btn-outline-light position-relative" href="{{ route('cart') }}">
                <i class="fa fa-shopping-cart me-1" aria-hidden="true"></i> Cart
                <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle">
                    {{ count((array) session('cart')) }}
                    <span class="visually-hidden">items in cart</span>
                </span>
            </a>
            <a class="btn btn-outline-light position-relative ms-2 cart-link" href="{{ route('order') }}">
                <i class="fa fa-file-alt me-1" aria-hidden="true"></i> Order Details
            </a>
        </div>
      </div>
    </nav>  

    <div class="container">
        <div class="row justify-content-start">
            <div class="title text-center mt-4 text-black"><h3>Welcome to Gadget Store</h3></div>
            <p class="text text-center mt-2 text-black">Connecting you to the world, one device at a time.</p>
            <p class="text-black">Select Categories:</p>
            <div class="d-flex gap-3">
                <a href="{{ route('index') }}">
                    <button class="btn btn-outline-dark">All</button>
                </a>
                <a href="{{ route('tecno') }}">
                    <button class="btn btn-outline-dark">Tecno</button>
                </a>
                <a href="{{ route('iphone') }}">
                    <button class="btn btn-outline-dark">iPhone</button>
                </a>
                <a href="{{ route('blackshark') }}">
                    <button class="btn btn-outline-dark">Black Shark</button>
                </a>
                <a href="{{ route('samsung') }}">
                    <button class="btn btn-outline-dark">Samsung</button>
                </a>
            </div>
            <div class="text-center"> 
                @if (session('success'))
                <p class="alert fw-bold" style="font-size: 0.875rem;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </p>
                @endif
            </div>    
            <div class="container mt-4">
                <div class="d-flex justify-content-center">
                    <form class="d-flex w-50 gap-2" action="{{ route('index') }}" method="GET">
                            <input class="form-control form-control-sm border-black" type="text" name="query" placeholder="Search" aria-label="Search" value="{{ old('query', $query) }}">
                            <button class="btn btn-light border border-black" type="submit">Search</button>
                    </form>
                </div>
            </div>         
            @if($product->isEmpty())
                <div class="col-12 text-center mt-4">
                    <p class="text-black">No products found for your search: "{{ $query }}"</p>
                </div>
            @else
            @foreach ($product as $product)
            <div class="col-md-3 mb-4 mt-3" style="width: 250px;">
                <div class="card bg-black text-white">
                    <img src="{{ asset('images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">{{ $product->name }}</h5>
                        <p class="card-text text-center">Price: ₱{{ number_format($product->price, 2) }}</p>
                        <div class="text-center">
                            <a href="{{route('addtocart',$product->id)}}" class="btn btn-outline-light">Add to Cart</a>
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