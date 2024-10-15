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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <script>
        // Push a new state to the history stack on page load
        window.onload = function() {
            history.pushState(null, document.title, window.location.href);
        };

        // Prevent going back to the previous state
        window.onpopstate = function() {
            history.pushState(null, document.title, window.location.href);
        };
    </script>
    <title>Admin Dashboard</title>
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
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('customer')}}">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  position-relative" href="{{ route('orderlist') }}">
                        Orders
                        @if($notification > 0)
                            <span class="badge rounded-pill bg-danger position-absolute top-0 start-100 translate-middle">
                                {{ $notification }}
                                <span class="visually-hidden">new notifications</span>
                            </span>
                        @endif
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users')}}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admins')}}">Admin</a>
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="border border-2 border-black rounded p-4 mt-3">
                        <form method="POST" action="{{ route('store') }}" class="fw-bold" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mt-1 text-black mb-2 text-center">
                                <label for="image">Image:</label>
                                <div class="text-center">
                                    <input type="file" id="image" name="image" class="form-file border-2" required>
                                </div>
                            </div>
        
                            <div class="form-group mt-1 text-black mb-2 text-center">
                                <label for="category">Select Category:</label>
                                <div class="text-center">
                                    <select name="category" id="category" class="form-select w-50 mx-auto" required>
                                        <option value="smartphone">Smartphone</option>
                                        <option value="digitalcamera">Digital Camera</option>
                                        <option value="personalcomputer">Personal Computer</option>
                                        <option value="television">Television</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="form-group mt-1 text-black mb-2 text-center">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control mx-auto w-50" id="name" name="name" required>
                            </div>
        
                            <div class="form-group mt-1 text-black mb-2 text-center">
                                <label for="description">Description:</label>
                                <input type="text" class="form-control mx-auto w-50" id="description" name="description" required>
                            </div>
        
                            <div class="form-group mt-1 text-black mb-2 text-center">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control mx-auto w-50" id="price" name="price" required>
                            </div>
                            
                            <div class="text-center">
                                <button class="btn btn-light mt-2 border-2 text-black" type="submit">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="row justify-content-center mt-2">
                <div class="container col-md-10">
                    @if(session('success'))
                    <div class="toast align-items-center mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body text-success"> 
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif     
                    @if(session('error'))
                    <div class="toast align-items-center mb-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body text-danger"> 
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif 
                </div>
                <div class="col-md-5">
                    <div class="card border-2" style="background-color: #405D72">
                        <div class="card-body">
                            <div class="title text-center" style="color: #F5F7F8;">
                                <img src="{{ asset('assets/products.png') }}" alt="User Logo" style="width: 50px; height: auto;" draggable="false">
                                <h5 class="mt-3">Total Number of Products: {{$count}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card border-2" style="background-color: #405D72">
                        <div class="card-body">
                            <div class="title text-center" style="color: #F5F7F8;">
                                <img src="{{ asset('assets/calendar.png') }}" alt="User Logo" style="width: 50px; height: auto;" draggable="false">
                                <h5 class="mt-3">Today's Date: {{$date}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            

            <div class="container mt-2">
                <div class="d-flex justify-content-center">
                    <form class="d-flex w-50 gap-2" action="{{ route('search') }}" method="GET">
                        <input class="form-control form-control-sm border-black" type="text" name="query" placeholder="Search Product" aria-label="Search" value="{{ old('query', $query) }}" autocomplete="off">
                        <button class="btn btn-light border border-black" type="submit">Search</button>
                    </form>
                </div>
            </div>

            @if ($products->isEmpty())
            <div class="col-12 text-center mt-2">
                @if($query && $products->isEmpty())
                    <p class="text-black">No products found for your search: "{{ $query }}"</p>
                @endif              
            </div>
            @endif
            
        
            <div class="row justify-content-center mt-1">
                <div class="col-md-10">
                    <table class="table border table-light mt-2 fw-bold"> 
                        <thead>
                            <tr class="text-center">
                                <th>Image</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @if($products->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No products found.</td>
                                </tr>
                            @else
                                @foreach ($products as $product)
                                <tr>
                                    <td><img src="{{ asset('images/' . $product->image) }}" class="card-img-top" width="50" height="50" alt="{{ $product->name }}" draggable="false"></td>
                                    <td class="text-center">{{ $product->name }}</td>
                                    <td class="text-center">{{ $product->description }}</td>
                                    <td>₱{{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('view', $product->id) }}" class="btn btn-sm btn-info me-1" style="color: #272829;">View</a>
                                            <a href="{{ route('edit', $product->id) }}" class="btn btn-sm btn-primary me-1" style="color: #272829;">Edit</a>
                                            <form action="{{ route('destroy', $product->id) }}" method="POST" class="d-inline" id="delete-form-{{ $product->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger" style="color: #272829;" onclick="confirmDelete({{ $product->id }})">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <p>
                            Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $count }} results
                        </p>
                        <div>
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div> 
                    </div>               
                </div>
            </div>
        </div>        
    </div>
    
    <script>
        function confirmDelete(productId) {
            if (confirm("Are you sure you want to delete this product?")) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }
    </script>
    
</body>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    toastElList.forEach(function(toastEl) {
        var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    });

    function confirmDelete(productId) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this product!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                document.getElementById('delete-form-' + productId).submit();
            }
        });
    }
</script>
</html>