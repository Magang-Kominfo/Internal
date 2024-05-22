<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="<?php echo asset('css/style.css')?>">
</head>

<body id="bodyAll" style="background-color:#F1F1F3">
    <nav class="navbar">
        <div class="container-fluid" >
            <img class="logoKominfo-uc-3" src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
        </div>
    </nav>
    <div>
        <h1 class="judul" style="margin: 50px">LOGIN</h1>
    </div>
    <form class="formaset" action="/login" method="POST" >
        @csrf
    <div id="loginForm" class="col-6 offset-3">
        <div class="form-floating mb-3">
            <input type="text" class="form-control"  name="id_pegawai" id="floatingInput" placeholder="" style="border:1px solid #34469A">
            <label for="floatingInput">ID User:</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control"  name="password" id="floatingPassword" placeholder="Password" style="border:1px solid #34469A">
            <label for="floatingPassword">Password User:</label>
        </div>
    </div>
    <div class="loginButton">
        <button style="background-color: #34469A" class="btn btn-primary mt-4 col-1">Login</button>
    </div>
</form>
</body>
</html>