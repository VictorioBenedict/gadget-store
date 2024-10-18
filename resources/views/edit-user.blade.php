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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <title>Edit User</title>
    <style>
        * {
            font-family: "Bebas Neue", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        body {
            background-color: #A0937D;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link disabled text-white" href="#">Admin Dashboard</a>
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
        <div class="row justify-content-center">
            <div class="col md-6">
                <form method="POST" action="{{ route('update-user',$user->id) }}" class="p-4 border border-2 border-black mt-5 fw-bold">
                    @method('PUT')
                    @csrf
                    <div class="title text-center" style="color: #131842"><h3>Edit User</h3></div>
                    <div class="form-group mt-4 text-black text-center mb-2">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control mx-auto w-50" id="name" name="name" value={{$user->name}} required>
                    </div>
                    
                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control mx-auto w-50" id="email" name="email" value={{$user->email}}  required>
                    </div>

                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control mx-auto w-50" id="password" name="password" placeholder="Create a new password (optional). Leave blank if you don't want to change it.">
                    </div>

                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control mx-auto w-50" id="address" name="address" value="{{ $user->address }}" required>
                    </div>                    

                    <div class="form-group mt-1 text-black text-center mb-2">
                        <label for="role">Role:</label>
                        <select class="form-select mx-auto w-50" id="role" name="role" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('users') }}" class="btn btn-light mt-2 border-2 text-black">Back</a>
                        <button class="btn btn-light mt-2 border-2 text-black" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    @if ($errors->any())
        Swal.fire({
            title: "Error!",
            text: "{{ $errors->first() }}",
            icon: "error",
            confirmButtonText: "Okay",
    });
    @endif
</script>
