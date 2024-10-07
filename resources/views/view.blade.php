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
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <title>Document</title>
    <style>
        *{
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        body{
            background-color: #A0937D;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link disabled text-white" href="#">Admin Dashboard</a>
                </li>                
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link" style="border: none; background: none; cursor: pointer;">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>       
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col md-6">
                <form method="POST" action="{{ route('view', $product->id) }}" class="p-4 border border-2 border-black mt-4 fw-bold" enctype="multipart/form-data">
                    <div class="title text-center text-uppercase mt-2" style="color: #131842";><h3>{{$product->name}}'s Information</h3></div>
                    <div class="form-group mt-4 text-black text-center mb-4">
                        <img src="{{ asset('images/' . $product->image) }}" height="250" width="250" alt="{{ $product->name }}">
                    </div>

                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control  mx-auto w-50" id="name" name="name" readonly value="{{$product->name}}">
                    </div>
    
                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control  mx-auto w-50" id="description" name="description" readonly value="{{$product->description}}">
                    </div>
                    
                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control mx-auto w-50" id="price" name="price" readonly value="{{ number_format($product->price, 2) }}">
                    </div>
                    <div class="text-center">
                        <a href="{{ route('dashboard') }}" class="btn btn-light mt-2 text-black">Back</a>
                    </div>     
                </form>
            </div>
        </div>
    </div>
</body>
</html>