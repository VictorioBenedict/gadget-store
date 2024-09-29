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
                    <form method="POST" action="{{ route('adminlogout') }}">
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
        <div class="row justify-content-center p-10">
            <div class="col mt-5">
                <div class="title text-center" style="color: #131842"><h3>Admin Dashboard</h3></div>
                <a href="{{route ('create')}}"><button class="btn btn-light" style="color: #272829";>Add Device</button></a>
                <form action="{{ route('truncate') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-light" style="color: #272829";>Delete All Orders</button>
                </form>                
                @if(session('success'))
                <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                    <div class="d-flex">
                        <div class="toast-body text-success"> 
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                @endif          
                <div class="start justify-content-center">
                   <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card border-2" style="background-color: #405D72">
                           <div class="card-body">
                            <div class="title text-center" style="color: #F5F7F8";>
                                <h5>Total Products:</h5>
                            </div>
                            <div class="text text-center" style="color: #F5F7F8";>
                                <h4>{{$count}}</h4>
                            </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-2" style="background-color: #405D72">
                           <div class="card-body">
                            <div class="title text-center" style="color: #F5F7F8";>
                                <h5>Date:</h5>
                            </div>
                            <div class="text text-center" style="color: #F5F7F8";>
                                <h4>{{$date}}</h4>
                            </div>
                           </div>
                        </div>
                    </div>
                   </div>
                </div>
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
                        @foreach ($product as $product)
                        <tr>
                            <td><img src="{{ asset('images/' . $product->image) }}" class="card-img-top" width="50" height="50" alt="{{ $product->name }}"></td>
                            <td class="text-center">{{ $product->name }}</td>
                            <td class="text-center">{{ $product->description }}</td>
                            <td>₱{{ number_format($product->price, 2) }}</td>
                            <td>
                                <div class="d-flex justify-content-start">
                                    <a href="{{ route('view', $product->id) }}" class="btn btn-sm btn-info  me-1" style="color: #272829";>View</a>
                                    <a href="{{ route('edit', $product->id) }}" class="btn btn-sm btn-primary me-1" style="color: #272829";>Edit</a>
                                    <form action="{{ route('destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="color: #272829"; onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    </div>
</body>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    toastElList.forEach(function(toastEl) {
        var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    });
</script>


</html>