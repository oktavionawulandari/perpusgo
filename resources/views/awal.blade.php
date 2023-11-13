<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>PerpusGo</title>
</head>

<body>

    <div class="p-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/logo.png" alt="" width="200">
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4 fs-4">Selamat datang di PerpusGo <br> Silahkan Login terlebih dahulu untuk masuk ke
                sistem</p>
        </div>
        <div class="sticky-sm-bottom ms-auto">
            @if(Auth::guard('user')->user())
            <a class="btn btn-lg btn-primary fs-5" href="{{route('home.pegawai')}}">Login</a>
            @elseif(Auth::guard('anggota')->user())
            <a class="btn btn-lg btn-primary fs-5" href="{{route('home.anggota')}}">Login</a>
            @else
            <a class="btn btn-lg btn-primary fs-5" href="{{route('login')}}">Login</a>
            @endif
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>