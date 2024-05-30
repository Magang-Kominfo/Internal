<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>">
</head>
<body class="bodydbaset" style="background-color:#F1F1F3">
    
    <nav class="navbar">
        <div class="container-fluid" >
            <img class="logoKominfo-uc-3" src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
        </div>
    </nav>

    <div class="bodyTambahaset" style="background-color: white" >
        <div class="judul">
        <h3>Detail Aset</h3>
        </div>
        <div class="d-flex w-100 justify-content-start ms-5">
        <a href="/dbaset">
            <div class="btn btn-warning">Kembali</div>
        </a>
        </div>
    <main id="mainShow" class="container mt-1">
        
        <div class="showImage">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <div class="carousel-inner">
                    @if ($aset->images)
                        @foreach ($aset->images as $image)
                            <div class="carousel-item active">
                                <img src="{{ $image }}" class="d-block w-100" alt="...">
                            </div>
                        @endforeach
                    @endif
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div id="carouselExample" class="carousel slide">
            </div>
        </div>
        <div class="showCard">
                <div class="card-header">
                    {{ $aset->nomor_aset }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $aset->nama }}</h5>
                    <p class="card-text my-3">Jumlah: {{ $aset->jumlah }}</p>
                    <p class="card-text">Pemanfaatan: {{ $aset->pemanfaatan }}</p>
                    <p class="card-text">Kondisi: {{ $aset->kondisi }}</p>
                </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>