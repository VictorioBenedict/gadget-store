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
    <title>Customer Orders</title>
</head>
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
        <h3 class="text-center mt-4">Orders for {{ $user->name }}</h3> <!-- Display user name once -->
        
        <div class="table-responsive">
            <table class="table table-bordered text-center text-black mt-5">
                <thead>
                    <tr>
                        <th style="width: 5%">Product Name</th>
                        <th style="width: 5%">Quantity</th>
                        <th style="width: 5%">Price</th>
                        <th style="width: 5%">Status</th>
                        <th style="width: 5%">Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orders->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No orders found for this user.</td>
                    </tr>
                    @else
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ number_format($order->price, 2) }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <p>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results</p>
            <div>
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        </div>
        
        <div class="text-center mt-3">
            <a href="{{ route('customer') }}" class="btn btn-light">Back to Customer List</a>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
