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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <title>Order List</title>
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
                    <a class="nav-link" href="{{route('dashboard')}}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('customer')}}">Customers</a>
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

<div class="container mt-5">
    <h2 class="text-center">Customers Dashboard</h2>
    <div class="container mt-5">
        <div class="row justify-content-center">
         <div class="col-md-12">
             <div class="card border-2" style="background-color: #405D72">
                <div class="card-body">
                 <div class="title text-center" style="color: #F5F7F8";>
                     <img src="{{ asset('assets/order.png') }}" alt="User Logo" style="width: 50px; height: auto;" draggable="false">
                     <h5 class="mt-3">Total Orders: {{$count}}</h5>
                 </div>
                </div>
             </div>
         </div>
     </div>
    <table class="table table-bordered mt-2">
        <thead>
            <tr class="text-center">
                <th>User Name</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($users->isEmpty())
                <tr>
                    <td colspan="2" class="text-center">No customers found.</td>
                </tr>
            @else
                @foreach($users as $user)
                <tr class="text-center">
                    <td>{{$user->name}}</td>
                    <td>{{$user->address}}</td>
                    <td>
                        <a href="{{ route('customerview', $user->id) }}" class="btn btn-primary">View Orders</a>
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <p>
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
        </p>
        <div>
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<script>
    function confirmDelete(event, button) {
        event.preventDefault(); // Prevent the default form submission
        const form = button.closest('form');

        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this order!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form if confirmed
            }
        });
    }

    // Check for a successful deletion in the session success message
    window.onload = function() {
        @if(session('success'))
            Swal.fire(
                'Success!',
                '{{ session('success') }}',
                'success'
            );
        @endif
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
