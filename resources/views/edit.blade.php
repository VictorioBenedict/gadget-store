<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="assets/logo.png" type="image/png"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <title>Edit</title>
    <style>
        *{
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        body{
            background-color: #A0937D;
        }
        .logo-icon{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo-icon" draggable="false">
                Admin Dashboard
            </a>
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
                <div class="title text-center text-uppercase mt-5" style="color: #131842";><h3>{{$product->name}}'s Information Edit</h3></div>
                <form method="POST" action="{{ route('update', $product->id) }}" class="p-4 border border-2 border-black mt-5 fw-bold" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-4 text-black text-center mb-2">
                        <label for="image">Image:</label>
                        <div class="text-center">
                            <input type="file" id="image" name="image" class="form-file border-2 border-black" required>
                        </div>
                    </div>

                    <div class="form-group mt-4 text-black text-center mb-2">
                        <label for="category">Select Category: </label>
                        <div class="text-center">
                            <select name="category" id="category">
                                <option value="smartphone">Smartphone</option>
                                <option value="digitalcamera">Digital Camera</option>
                                <option value="personalcomputer">Personal Computer</option>
                                <option value="television">Television</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control mx-auto w-50" id="name" name="name" value="{{$product->name}}" required>
                    </div>
    
                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control mx-auto w-50" id="description" name="description" value="{{$product->description}}"  required>
                    </div>
                    
                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control mx-auto w-50" id="price" name="price" value="{{$product->price}}" required>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('dashboard') }}" class="btn btn-light mt-2 text-black">Back</a>
                        <button class="btn btn-light mt-2 text-black " type="submit">Update</button>
                    </div>     
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    @if ($errors->any())
        Swal.fire({
            title: "Error!",
            text: "{{ $errors->first() }}",
            icon: "error",
            confirmButtonText: "Okay",
    });
    @endif
</script>