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
    <title>Login</title>
    <style>
        *{
            color: #FFB200;
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        body{
            background-image: url('assets/background.jpg'); /* Specify the path to your background image */
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Prevent background image from repeating */
        }
        .card{
            position: relative;
            padding: 1rem;
            border: 2px solid black;
            overflow: hidden;
            border-radius: 10px;
            background-image: url('assets/backgroundlogin.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
            z-index: 0; /* Ensure the background image is behind other content */
        }
        .form-group{
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
                    @if (session('error'))
                    <p class="alert fw-bold" style="font-size: 0.875rem;">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </p>
                    @endif
                    @if (session('success'))
                    <p class="alert fw-bold" style="font-size: 0.875rem;">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </p>
                    @endif
                </div>
                <div class="card p-5 border-2 border-black mt-5">
                    <div class="title text-center mt-3"><h3>Login</h3></div>    
                    <div class="card-body mt-5">
                        <form action="{{ route('loginpost') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="input-text">
                                <button class="btn btn-primary mt-2 border-2 text-black" type="submit">Login</button>
                                <a href="{{route('register')}}" class="btn btn-primary mt-2 border-2 text-black">User Register</a>
                                <a href="{{route('admin')}}" class="btn btn-primary mt-2 border-2 text-black">Admin Login</a>
                                <a href="{{route('adminregister')}}" class="btn btn-primary mt-2 border-2 text-black">Admin Register</a>
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
</html>