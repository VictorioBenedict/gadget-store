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
    <title>Cart</title>
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
                <a class="nav-link" href="#" style="pointer-events: none; cursor: default;">Order It Now, {{ $loggedInUser }}!</a>
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
               <div class="title text-center mt-5 text-black fw-bold"><h3>Welcome to Gadget Store</h3></div>
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
                    <table class="table table-bordered border-2 border-black mt-3 fw-bold">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                                <th>Total</th>
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
                                 <td class="w-25">
                                    <div class="input-group input-group-sm">
                                        <button type="button" class="btn btn-outline-secondary decrement-btn" data-id="{{ $id }}">-</button>
                                        <input type="text" pattern="[0-9]*" name="quantity" value="{{ $product['quantity'] }}" data-id="{{ $id }}" class="form-control quantity-input text-center" readonly>
                                        <button type="button" class="btn btn-outline-secondary increment-btn" data-id="{{ $id }}">+</button>
                                    </div>
                                </td>
                                 <td>
                                     <form action="{{ route('remove', $id) }}" method="POST" class="text-center">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" class="btn btn-sm btn-danger" style="color: #272829"; onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
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
                    <tr>
                        <td colspan="5" style="text-align:right;">
                            <form action="{{route ('session') }}" method="POST">
                                @csrf <!-- CSRF token -->
                                <a href="{{ url('index') }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i> Continue Shopping
                                </a>
                                <button class="btn btn-warning" type="submit" id="checkout-live-button" @if($total <= 0) disabled @endif>
                                    <i class="fa fa-money">Checkout</i> 
                                </button>                                
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
        // Function to update quantity and total via AJAX
        function updateQuantityAndTotal(id, quantity) {
            $.ajax({
                url: '/cart/' + id + '/update-quantity',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                success: function(response) {
                    // Update quantity in the cart object
                    var product = response.product;
                    
                    // Update total for this product with number formatting
                    $('#total-' + id).text('₱ ' + number_format(product.price * product.quantity, 2, '.', ','));

                    // Recalculate total cart amount
                    var newTotal = response.cartTotal;
                    $('#cart-total').html('<strong>₱ ' + number_format(newTotal, 2, '.', ',') + '</strong>'); // Update total cart amount
                },
                error: function(xhr) {
                    console.log(xhr.responseText); // Log any errors to the console
                }
            });
        }

        // Handle increment button click
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

        // Handle decrement button click
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
    });

    // Helper function to format numbers
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