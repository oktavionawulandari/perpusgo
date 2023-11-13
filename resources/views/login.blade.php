<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Login PerpusGo</title>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-md-center">
            <div class="col col-md-6">
                <!--Notifikasi menggunakan flash session data-->
                @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
                @endif
                <div class="card shadow rounded-3">
                    <div class="card-header text-light fs-5">
                        Form Login
                    </div>
                    <div class=" card-body">
                        <form action="{{route('post.login')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="mt-1 form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}" placeholder="Masukkan Username Anda"
                                    required>
                                <!-- error message untuk username -->
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="mt-1 form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" placeholder="Masukkan Password Anda"
                                    required>
                                <!-- error message untuk password -->
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <input type="submit" class="btn btn-primary text-light" name="btnlogin"
                                    value="Login/Masuk">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>