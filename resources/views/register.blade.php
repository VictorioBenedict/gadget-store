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
    <title>Register</title>
    <style>
        * {
            color: #FFB200;
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        body {
            background-image: url('assets/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .card {
            position: relative;
            padding: 1rem;
            border: 2px solid black;
            overflow: hidden;
            border-radius: 10px;
            background-image: url('assets/backgroundregister.jpg');
            background-size: cover;
            background-position: center;
            z-index: 0;
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
                        <script>
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: '{{ session('error') }}',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                </div>
                <div class="card p-5 border-2 border-black mt-5">
                    <div class="title text-center"><h3>Register</h3></div>    
                    <div class="card-body">
                        <form action="{{ route('registerpost') }}" method="post" class="mt-5">
                            @csrf
                            <div class="form-group mt-5">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password:</label>
                                <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" required>
                            </div>
                            <div class="input-text">
                                <button class="btn btn-primary mt-2 border-2 text-black" type="submit">Register</button>
                                <a href="{{ route('login') }}" class="btn btn-primary mt-2 border-2 text-black">Back</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
