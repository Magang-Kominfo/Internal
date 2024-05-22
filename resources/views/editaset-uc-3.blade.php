<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aset</title>
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

    <div class="bodyEditAset" style="background-color: white" >
        <div class="judul">
        <h3>Edit Aset</h3>
        </div>

        <form class="formaset" action="/update/{{ $aset->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="col-6 offset-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nomor_aset" name="nomor_aset" placeholder="" value="{{ $aset->nomor_aset }}" style="border:1px solid #34469A"> 
                    <label for="nomor_aset">Nomor Aset:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="namaaset" value="{{ $aset->nama }}" style="border:1px solid #34469A">
                    <label for="nama">Nama Aset</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="" value="{{ $aset->jumlah }}" style="border:1px solid #34469A">
                    <label for="jumlah">Jumlah Aset</label>
                </div>
              
                <div class="form-group mb-3">
                    <label class="form-label" for="pemanfaatan">Pemanfaatan Aset</label>
                    <textarea class="form-control" id="pemanfaatan" name="pemanfaatan" rows="3" style="border:1px solid #34469A">{{ $aset->pemanfaatan }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="kondisi">Kondisi Aset</label>
                    <textarea class="form-control" id="kondisi" name="kondisi" rows="3" 
                    style="border:1px solid #34469A">{{ $aset->kondisi }}</textarea>
                </div>
                <div class="form-group">
                    <div >
                        <label class="form-label" for="image" >Foto Aset</label>
                        <input type="file" class="form-control" name="images[]" id="images" multiple style="border:1px solid #34469A" required>
                    </div>
                    <div class="text-sm text-danger">
                        *upload foto akan mengganti foto sebelumnya
                    </div>
                </div>
                <div class="footer d-flex justify-content-end gap-2">
                    <a href="/dbaset" style="background-color: #FFFFFF; color:black;">
                        <div type="back" class="btn btn-secondary mt-4 min-col-2">Back</div></a>
                        <button type="submit" class="btn btn-primary mt-4 min-col-2">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>