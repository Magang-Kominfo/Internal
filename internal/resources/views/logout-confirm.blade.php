<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm</title>
    <link rel="stylesheet" type="text/css" href="../css/logoutConfirm.css">
</head>
<body>

    <div class="logout-confirm-main">
        <div class="logout-confirm-header">
            <h2>Confirm</h2>
        </div>

        <div class="logout-confirm-content">
            <p>Anda sudah Login dengan {{ $user->nama_user }} {{ $user->id_user }}, anda harus log out terlebih dahulu sebelum login dengan user yang berbeda</p>
        </div>

        <div class="logout-confirm-btn">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" ><h2>Log Out</h2></button>
            </form>

            @if(auth()->check() && auth()->user()->is_admin == true)
                <a href="{{ route('admin') }}"><h2>Kembali</h2></a>

            @elseif(auth()->check() && substr(auth()->user()->id_user, 0, 2) === '10')
                <a href="{{ route('dashboard-insiden') }}"><h2>Kembali</h2></a>

            @elseif(auth()->check() && substr(auth()->user()->id_user, 0, 2) === '20')
                <a href="{{ route('dashboard-berita') }}"><h2>Kembali</h2></a>

            @elseif(auth()->check() && substr(auth()->user()->id_user, 0, 2) === '30')
                <a href="{{ route('dashboard-aset') }}"><h2>Kembali</h2></a>

            @endif
        </div>
    </div>


</body>
</html>
