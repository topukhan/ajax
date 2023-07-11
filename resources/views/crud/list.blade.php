<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Create</title>
</head>

<body>
    <h1 class="bg-dark text-white text-center">Laravel AJAX CRUD</h1>
    <div class="container mt-5">
        <div class="col-md-5">
            <a href="{{ route('createForm') }}" <?php session_start();
            unset($_SESSION['success']); ?> class="btn btn-primary">create user</a>
            <hr>
        </div>
        <h3>User List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $sl = 1;
                @endphp
        
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $sl++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @php
                            $maskedPassword = substr($user->password, 0, 4) . str_repeat('*', strlen($user->password) - 4);
                        @endphp
                        <td>
                            <span class="password-mask">{{ $maskedPassword }}</span>
                        </td>
                        <td>
                            <a href="{{ route('editForm', ['id' => $user->id]) }}" class="btn btn-primary d-inline mx-1">Edit</a>
                            <form action="" method="post" onsubmit="return confirmDelete();" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-danger mx-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
