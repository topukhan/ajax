    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <title>Create</title>
    </head>

    <body>

        <div class="container">
    <h1 class="bg-dark text-white text-center">Laravel AJAX CRUD</h1>

            <h1>Create User</h1>
            <form method="post" id="form" class="row g-3">
                @csrf
                <div class="col-md-12">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" id="name" name="name" class="form-control">
                    <span id="nameError" class="text-danger"></span>
                </div>

                <div class="col-md-12">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" id="email" name="email" class="form-control">
                    <span id="emailError" class="text-danger"></span>
                </div>

                <div class="col-md-12">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <span id="passwordError" class="text-danger"></span>
                </div>

                <div class="col-md-12">
                    <button type="submit" id="submit" class="btn btn-info">Create</button>
                    <a href="{{ route('list') }}" class="btn btn-dark">List</a>
                </div>
            </form>

            <div id="responseMessage"></div>
        </div>

        <script>
            function clearErrors() {
                $('#nameError').text('');
                $('#emailError').text('');
                $('#passwordError').text('');
            }
            var createFormValidationRoute = "{{ route('createFormValidation') }}";

            $(document).ready(function() {
                $('#form').submit(function(e) {
                    e.preventDefault();
                    var _token = $('input[name="_token"]').val();
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var password = $('#password').val();

                    $.ajax({
                        type: "POST",
                        url: createFormValidationRoute,
                        data: {
                            _token: _token,
                            name: name,
                            email: email,
                            password: password
                        },
                        success: function(response) {
                            clearErrors(); // Clear previous error messages
                            if (response.error) {
                                var errors = JSON.parse(response.error);

                                if (errors.name) {
                                    $('#nameError').text(errors.name[0]);
                                }
                                if (errors.email) {
                                    $('#emailError').text(errors.email[0]);
                                }
                                if (errors.password) {
                                    $('#passwordError').text(errors.password[0]);
                                }
                            } else {
                                $('#responseMessage').html(
                                    '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                                    '<strong>' + response.success +
                                    '</strong>' +
                                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                    '</div>'
                                );
                            }
                        },

                        error: function(xhr, status, error) {
                            console.log(xhr.responseText); // or handle the error response
                        }
                    });
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
    </body>

    </html>
