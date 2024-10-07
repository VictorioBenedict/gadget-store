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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <link rel="icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    <script>
        // Push a new state to the history stack on page load
        window.onload = function() {
            history.pushState(null, document.title, window.location.href);
        };

        // Prevent going back to the previous state
        window.onpopstate = function() {
            history.pushState(null, document.title, window.location.href);
        };
    </script>
    <title>Admin Dashboard</title>
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
    <div class="container">
        <div class="row justify-content-center p-10">
            <div class="col mt-5">
                <div class="title text-center" style="color: #131842"><h3>Admin Dashboard</h3></div>
                <div class="input-group gap-1">
                    <a href="{{route('add-user')}}"><button class="btn btn-light" style="color: #272829";>Add User</button></a>       
                    <a href="{{route ('dashboard')}}"><button class="btn btn-light" style="color: #272829";>Back</button></a>           
                </div>   
                @if(session('success'))
                <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                    <div class="d-flex">
                        <div class="toast-body text-success"> 
                            {{ session('success') }}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                @endif     
                @if(session('error'))
                <div class="toast align-items-center mt-2" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                    <div class="d-flex">
                        <div class="toast-body text-danger"> 
                            {{ session('error') }}
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
                @endif       
                <div class="start justify-content-center">
                   <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="card border-2" style="background-color: #405D72">
                           <div class="card-body">
                            <div class="title text-center" style="color: #F5F7F8";>
                                <img src="{{ asset('assets/users.png') }}" alt="User Logo" style="width: 50px; height: auto;">
                                <h5 class="mt-3">Total Number of Users: {{$userCount}}</h5>
                            </div>
                           </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-2" style="background-color: #405D72">
                           <div class="card-body">
                            <div class="title text-center" style="color: #F5F7F8";>
                                <img src="{{ asset('assets/admins.png') }}" alt="User Logo" style="width: 50px; height: auto;">
                                <h5 class="mt-3">Total Number of Admins: {{$adminCount}}</h5>
                            </div>
                           </div>
                        </div>
                    </div>
                   </div>
                </div>
                <table class="table border table-light mt-2 fw-bold"> 
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user) 
                        <tr class="text-center">
                            <td>{{ $user->name }}</td> 
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('edit-user', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('delete-user', $user->id) }}" method="POST" id="delete-form-{{$user->id}}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $user->id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>    
                <div class="d-flex justify-content-between">
                    <p>
                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $count }} results
                    </p>
                    <div>
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div> 
                </div>      
            </div>
        </div>
    </div>    
    </div>
</body>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script>
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    toastElList.forEach(function(toastEl) {
        var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    });

    function confirmDelete(userId) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>
</html>