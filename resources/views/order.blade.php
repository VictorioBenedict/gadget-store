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
    <title>Order Details</title>
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
                <a class="nav-link" href="#" style="pointer-events: none; cursor: default;">Order Now, {{ $name }}!</a>
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
      </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">
               <div class="title text-center mt-5 text-black fw-bold"><h3>Order Details</h3></div>
                <p class="text text-center mt-2 text-black fw-bold">Connecting you to the world, one device at a time.</p>
                <div class="text-center"> 
                    @if (session('success'))
                    <p class="alert fw-bold" style="font-size: 0.875rem;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </p>
                    @endif
                </div>          
                <div class="table-responsive">
                    <table class="table table-bordered border-2 border-black mt-5 fw-bold">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                             @forelse($cartItems as $id => $product)
                             <tr id="product-{{ $id }}">
                                 <td>{{ $product['name'] }}</td>
                                 <td>₱ {{ number_format($product['price'], 2, '.', ',') }}</td>
                                 <td class="w-25">
                                    <div class="input-group input-group-sm">
                                        <input type="text" pattern="[0-9]*" name="quantity" value="{{ $product['quantity'] }}" data-id="{{ $id }}" class="form-control quantity-input text-center" readonly>                                    
                                    </div>
                                </td>
                                 <td id="total-{{ $id }}">{{ '₱ ' . number_format($product['price'] * $product['quantity'], 2, '.', ',') }}</td>
                             </tr>
                             @php
                                 $total += $product['price'] * $product['quantity'];
                             @endphp
                         @empty
                             <tr>
                                 <td colspan="5" class="text-center">You haven't ordered a single item yet.</td>
                             </tr>
                         @endforelse
                            @if ($total > 0)
                                <tr>
                                    <td colspan="3"><strong>Total</strong></td>
                                    <td id="cart-total"><strong>₱ {{ number_format($total, 2, '.', ',') }}</strong></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <tr>
                        <td colspan="5" style="text-align:right;">
                            <div class="d-flex">
                                <a href="{{ url('index') }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i> Continue Shopping
                                </a>
                            
                                <form action="{{ route('cancelorders') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Cancel All Orders</button>
                                </form>
                            </div>
                            
                        </td>                        
                    </tr>              
                </div>
            </div>
        </div>
    </div>
</body>
</html>