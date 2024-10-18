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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
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
        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
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

        .carousel-image {
                width: 100px; 
                height: auto; 
                margin: 5px; 
        }

        @media (max-width: 768px) {
            .carousel-image {
                width: 80px; 
            }
        }

    </style>
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-sm bg-black navbar-dark">
        <div class="container">
            <span class="navbar-brand">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo-icon" draggable="false">Gadget Store
            </span>       
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('index') }}">Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{$loggedInUser}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('order') }}">Order History</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
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
                </div>
            </div>
        </div>
    </nav>
    
    
    
      
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProfileForm" method="POST" action="{{ route('updateprofile', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Enter your name" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="address" class="form-control" id="address" name="address" value="{{ $user->address }}">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Update Password (Leave blank if you don't want to change)" autocomplete="off">
                        </div>
                        <input type="hidden" name="role" value="user">
                        <div class="mb-3">
                            <label for="password_confirmation">Confirm Password:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Your Password" autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>                
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row justify-content-start mt-1">
            <p class="d-none d-sm-flex gap-3 text-black">Select Categories:</p>
        <div class="d-none d-sm-flex gap-3">
            <a href="{{ route('index') }}">
                <button class="btn btn-outline-dark">All</button>
            </a>
            <a href="{{ route('smartphone') }}">
                <button class="btn btn-outline-dark">Smartphone</button>
            </a>
            <a href="{{ route('digitalcamera') }}">
                <button class="btn btn-outline-dark">Digital Camera</button>
            </a>
            <a href="{{ route('personalcomputer') }}">
                <button class="btn btn-outline-dark">Personal Computer</button>
            </a>
            <a href="{{ route('television') }}">
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
                    <form class="d-flex w-50 gap-2" action="{{ route('index') }}" method="GET">
                        <input class="form-control form-control-sm border-black" type="text" name="query" placeholder="Search" aria-label="Search" value="{{ old('query', $query) }}" autocomplete="off">
                        <button class="btn btn-light border border-black" type="submit">Search</button>
                    </form>
                </div>
            </div>

            <div class="container d-flex align-items-center justify-content-center">
                <div class="col-md-12"> 
                    <div class="card">
                        <div class="card-body">
                            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active" data-bs-interval="5000">
                                        <div class="d-flex justify-content-center flex-wrap">
                                            <img src="{{ asset('assets/game-over.gif') }}" class="carousel-image" draggable="false">
                                            <img src="{{ asset('assets/gamer.gif') }}" class="carousel-image" draggable="false">
                                            <img src="{{ asset('assets/games.gif') }}" class="carousel-image" draggable="false">
                                        </div>
                                        <div class="text-center mt-3">
                                            <h6>Elevate your gaming experience!</h6>
                                        </div>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="5000">
                                        <div class="d-flex justify-content-center flex-wrap">
                                            <img src="{{ asset('assets/worker.gif') }}" class="carousel-image" draggable="false">
                                            <img src="{{ asset('assets/camera.gif') }}" class="carousel-image" draggable="false">
                                            <img src="{{ asset('assets/touch-screen.gif') }}" class="carousel-image" draggable="false">
                                        </div>
                                        <div class="text-center mt-3">
                                            <h6>Discover innovative gadgets!</h6>
                                        </div>
                                    </div>
                                    <div class="carousel-item" data-bs-interval="5000">
                                        <div class="d-flex justify-content-center flex-wrap">
                                            <img src="{{ asset('assets/tv.gif') }}" class="carousel-image" draggable="false">
                                            <img src="{{ asset('assets/best-price.gif') }}" class="carousel-image" draggable="false">
                                            <img src="{{ asset('assets/headphones.gif') }}" class="carousel-image" draggable="false">
                                        </div>
                                        <div class="text-center mt-3">
                                            <h6>High-quality tech!</h6>
                                        </div>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
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
                                <div class="text-center">
                                    <a href="{{ route('addtocart', $product->id) }}" class="btn btn-outline-light">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</body>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('editProfileForm');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const saveButton = document.getElementById('saveChanges');

    saveButton.addEventListener('click', function(event) {
        if (passwordInput.value !== confirmPasswordInput.value) {
            event.preventDefault();
            Swal.fire({
                title: "Passwords do not match!",
                text: "Please ensure both passwords are the same.",
                icon: "warning",
                confirmButtonText: "Okay",
            });
        } else {
            form.submit();
        }
    });
});

@if ($errors->any())
        Swal.fire({
            title: "Error!",
            text: "{{ $errors->first() }}",
            icon: "error",
            confirmButtonText: "Okay",
});
@endif
</script>
</html>
