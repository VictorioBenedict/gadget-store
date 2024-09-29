<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <title>Admin Register</title>
    <style>
        * {
            color: #FFB200;
            font-family: "Bebas Neue", sans-serif;
        }
        body {
            background-image: url('assets/background.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
        }
        .card {
            padding: 1rem;
            border: 2px solid black;
            border-radius: 10px;
            background-image: url('assets/backgroundregister.jpg'); 
            background-size: cover;
            background-position: center;
        }
        .form-group {
            color: black;
            margin-top: 8px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center mt-5">
            <div class="col col-md-8">
                <div class="text-center"> 
                    @if (session('error'))
                        <p class="alert alert-danger fw-bold">{{ session('error') }}</p>
                    @endif
                    @if (session('success'))
                        <p class="alert alert-success fw-bold">{{ session('success') }}</p>
                    @endif
                </div>
                <div class="card p-5 mt-5">
                    <h3 class="text-center" style="color: #FFB200">Admin Register</h3>    
                    <div class="card-body mt-5">
                        <form action="{{ route('adminstore') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required min="6">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required min="6">
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Register</button>
                            <a href="{{ route('admin') }}" class="btn btn-primary mt-3">Back</a>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');

        form.addEventListener('submit', function(event) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                event.preventDefault();
                Swal.fire({
                    title: "Passwords do not match!",
                    text: "Please ensure both passwords are the same.",
                    icon: "warning",
                    confirmButtonText: "Okay",
                });
            }
        });
    });

    @if ($errors->any())
                Swal.fire({
                    title: "Error!",
                    text: "{{ $errors->first() }}",
                    icon: "error",
                    confirmButtonText: "Okay",
                });
    @endif
</script>
</html>
