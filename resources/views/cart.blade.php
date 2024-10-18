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
    <title>Cart</title>
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
        td {
            width: 100px;
        }
        .logo-icon{
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 8px;
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

        @media (max-width: 768px) {
            .quantity-input {
                width: 50px; 
                font-size: 1rem; 
            }

            .btn {
                font-size: 0.75rem; 
                min-width: 30px; 
            }

            .d-flex {
                flex-direction: row; 
                align-items: center; 
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
                        <a class="nav-link" href="{{ route('index') }}">Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    

    <div class="container d-flex align-items-center justify-content-center">
        <div class="col-md-12 mt-5"> 
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="text-center"> 
                    @if (session('success'))
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        });
                    </script>
                    @endif
                </div>   
                <div class="table-responsive">
                    <table class="table table-bordered border-2 border-black mt-2 fw-bold">
                        <thead>
                            <tr>
                                <th style="width: 2%">Name</th>
                                <th style="width: 3%">Price</th>
                                <th style="width: 1%">Quantity</th>
                                <th style="width: 1%">Action</th>
                                <th style="width: 5%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                             @forelse($cart as $id => $product)
                             <tr id="product-{{ $id }}">
                                 <td>{{ $product['name'] }}</td>
                                 <td>₱ {{ number_format($product['price'], 2, '.', ',') }}</td>
                                 <td>
                                    <div class="mb-2 d-flex align-items-center">
                                        <button type="button" class="btn btn-outline-secondary decrement-btn" data-id="{{ $id }}">-</button>
                                        <input type="text" pattern="[0-9]*" name="quantity" value="{{ $product['quantity'] }}" data-id="{{ $id }}" class="form-control quantity-input text-center mx-1" readonly>
                                        <button type="button" class="btn btn-outline-secondary increment-btn" data-id="{{ $id }}">+</button>
                                    </div>
                                </td>
                                 <td>
                                     <form action="{{ route('remove', $id) }}" method="POST" class="text-center">
                                         @csrf
                                         @method('DELETE')
                                         <button type="button" class="btn btn-sm btn-danger delete-btn" style="color: #272829">Delete</button>
                                     </form>
                                 </td>
                                 <td id="total-{{ $id }}">{{ '₱ ' . number_format($product['price'] * $product['quantity'], 2, '.', ',') }}</td>
                             </tr>
                             @php
                                 $total += $product['price'] * $product['quantity'];
                             @endphp
                         @empty
                             <tr>
                                 <td colspan="5" class="text-center">Your cart is empty.</td>
                             </tr>
                         @endforelse
                            @if ($total > 0)
                                <tr>
                                    <td colspan="4"><strong>Total</strong></td>
                                    <td id="cart-total"><strong>₱ {{ number_format($total, 2, '.', ',') }}</strong></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <h4>
                        Address: {{$user->address}}
                    </h4>
                    <tr>
                        <td colspan="5" style="text-align:right;">
                            <form action="{{route ('session') }}" method="POST" >
                                @csrf
                                <div class="d-flex gap-1">
                                    <a href="{{ url('index') }}" class="btn btn-primary">
                                        <i class="fa fa-arrow-left"></i> Continue Shopping
                                    </a>
                                    <button class="btn btn-warning" type="submit" id="checkout-live-button" @if($total <= 0) disabled @endif>
                                        <i class="fa fa-money"></i> Checkout
                                    </button>
                                </div>                          
                            </form>
                        </td>                        
                    </tr>          
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function updateQuantityAndTotal(id, quantity) {
                $.ajax({
                    url: '/cart/' + id + '/update-quantity',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: quantity
                    },
                    success: function(response) {
                        var product = response.product;
                        $('#total-' + id).text('₱ ' + number_format(product.price * product.quantity, 2, '.', ','));
                        var newTotal = response.cartTotal;
                        $('#cart-total').html('<strong>₱ ' + number_format(newTotal, 2, '.', ',') + '</strong>');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            $(document).on('click', '.increment-btn', function() {
                var id = $(this).data('id');
                var input = $('input[data-id="' + id + '"]');
                var currentValue = parseInt(input.val());

                if (!isNaN(currentValue)) {
                    var newValue = currentValue + 1;
                    input.val(newValue);
                    updateQuantityAndTotal(id, newValue);
                }
            });

            $(document).on('click', '.decrement-btn', function() {
                var id = $(this).data('id');
                var input = $('input[data-id="' + id + '"]');
                var currentValue = parseInt(input.val());

                if (!isNaN(currentValue) && currentValue > 1) {
                    var newValue = currentValue - 1;
                    input.val(newValue);
                    updateQuantityAndTotal(id, newValue);
                }
            });

            $(document).on('click', '.delete-btn', function(event) {
                event.preventDefault();
                var form = $(this).closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to remove this product?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove this product!',
                    cancelButtonText: 'No, keep this product!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = parseFloat(number);
            if (!decimals) decimals = 0;
            if (!dec_point) dec_point = '.';
            if (!thousands_sep) thousands_sep = ',';
            var roundedNumber = Math.round(Math.abs(number) * ('1e' + decimals)) + '';
            var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
            var decimalsString = decimals ? dec_point + roundedNumber.slice(decimals * -1) : '';
            var thousandString = thousands_sep ? numbersString.replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep) : numbersString;
            return (number < 0 ? '-' : '') + thousandString + decimalsString;
        }
    </script>
</body>
</html>
