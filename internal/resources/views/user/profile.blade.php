<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="../css/user/style.css">
</head>

<body id="bodyAll" style="background-color:#F1F1F3; display:flex; flex-direction:column; gap:50px">

    <nav class="navbar">
        <div class="container-fluid" >
            <img class="logoKominfo-uc-3" src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
          <form class="d-flex">
            <button class="btn btn-outline-secondary mb-3" type="submit">LogOut</button>
          </form>
        </div>
    </nav>

    <div class="mx-4" width style="background-color: white; padding-bottom:50px; padding-top:25px; border-radius: 10px;display:flex; flex-direction:column;" >
        <div class="judul text-center">
            <h3>User Profile</h3>
        </div>

        <div class="text-center mb-3">
            <h4 style="font-size: 16px;text-align: center">User ID: 12345</h4>
        </div>

        <form class="form-profile d-flex flex-column justify-content-center align-items-center" action="#" method="POST" >
            @csrf
            @method("PUT")
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="nama" value="" style="border:1px solid #34469A;">
                    <label for="nama">Nama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="password" value="" style="border:1px solid #34469A">
                    <label for="password">Password</label>
                </div>
                <div class="footer d-flex justify-content-between gap-2">
                        <div type="back" class="btn btn-secondary mt-4 min-col-2">Back</div>
                        <button type="submit" class="btn btn-primary mt-4 min-col-2">Update</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
