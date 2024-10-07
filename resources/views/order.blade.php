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
    <title>Order Details</title>
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
    </style>
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" style="pointer-events: none; cursor: default;">Order Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
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
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            showCloseButton: true,
                        });
                    </script>
                    @endif
                </div>          
                <div class="table-responsive">
                    <table class="table table-bordered border-2 border-black mt-5 fw-bold">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th class="text-center">Action</th>
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
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $product['id'] }}" style="color: #272829;">Cancel</button>
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
                                    <td colspan="4"><strong>Total</strong></td>
                                    <td id="cart-total"><strong>₱ {{ number_format($total, 2, '.', ',') }}</strong></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <tr>
                        <td colspan="5" style="text-align:right;">
                            <div class="d-flex gap-1">
                                <a href="{{ url('index') }}" class="btn btn-primary">
                                    <i class="fa fa-arrow-left"></i> Continue Shopping
                                </a>
                                @if ($total > 0)
                                <button class="btn btn-danger" id="cancel-orders-btn">Cancel All Orders</button>
                                @else
                                <button class="btn btn-danger" disabled>Cancel All Orders</button>
                                @endif
                            </div>
                        </td>                        
                    </tr>              
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('cancel-orders-btn')?.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will cancel all your orders!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep them'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('cancelorders') }}";
                    form.innerHTML = '@csrf @method("DELETE")';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to cancel this order?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, cancel my order!',
                    cancelButtonText: 'No, keep my order'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ url('deleteorders') }}/" + id; // Adjust the URL as necessary
                        form.innerHTML = '@csrf @method("DELETE")';
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
