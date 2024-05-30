<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?php echo asset('css/user/style.css')?>">
</head>

<script>
    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }
    function goBack() {
        window.history.back();
    }
</script>

<body id="bodyAll" style="background-color:#F1F1F3">

    <nav class="navbar">
        <div class="container-fluid" >
            <img class="logoKominfo-uc-3" src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
        </div>
    </nav>

    @if(session()->has('login-error'))
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                {{ session('login-error') }}
            </div>
        </div>
    @endif

    <div>
        <h1 class="judul" style="margin: 50px">LOGIN</h1>
    </div>

        <form class="formaset" action="{{ route('login.post') }}" method="POST" >
            @csrf
            <div id="loginForm" class="col-6 offset-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('id_user') is-invalid @enderror"  name="id_user" id="floatingInput" placeholder="" style="border:1px solid #34469A" value="{{ old('id_user') }}"  required>
                    <label for="floatingInput">ID User:</label>
                    @error('id_user')
                        <div class="invalid-feedback" style="margin-left:10px">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control"  name="password" id="floatingPassword" placeholder="Password" style="border:1px solid #34469A" required>
                    <label for="floatingPassword">Password:</label>
                </div>
            </div>

            <div class="loginButton">
                <button type="submit">Login</button>
            </div>
        </form>


</body>
</html>
