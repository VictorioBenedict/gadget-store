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
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <title>Reset Password</title>
    <style>
        * {
            color: #FFB200;
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        body {
            background-image: url('/assets/background.jpg');
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
            background-image: url('/assets/backgroundreset.jpg');
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
            <div class="col col-md-8 mt-5">
                <div class="text-center">
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
                    @if (session('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: '{{ session('error') }}',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                </div>
                <div class="card p-5 border-2 border-black mt-5">
                    <div class="title text-center mt-3"><h3>Reset Password</h3></div>    
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <form id="resetPasswordForm" action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required style="width: 400px;">
                            </div>
                            <div class="form-group">
                                <label for="password">New Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required style="width: 400px;">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required style="width: 400px;">
                            </div>
                            <div class="input-text">
                                <button class="btn btn-primary mt-2 border-2 text-black" type="submit">Reset Password</button>
                                <a href="{{ route('login') }}" class="btn btn-primary mt-2 border-2 text-black">Back to Login</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Email',
                text: 'The email address does not exist.',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <script>
        document.getElementById('resetPasswordForm').onsubmit = function(event) {
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password !== passwordConfirmation) {
                event.preventDefault(); // Prevent form submission
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords do not match',
                    text: 'Please make sure both passwords are the same.',
                    confirmButtonText: 'OK'
                });
            }
        };

        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</body>
</html>
