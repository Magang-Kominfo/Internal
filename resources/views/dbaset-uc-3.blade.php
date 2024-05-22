<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>">
</head>

    <body id="bodyAll" style="background-color:#F1F1F3">
        <nav class="navbar">
            <div class="container-fluid" >
                <img class="logoKominfo-uc-3" src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                <form class="d-flex">
                    <input id="searchInput" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <ul id="assetList" class="list-group"></ul>
                    <button class="btn btn-outline-secondary" type="button" onclick="search()">Search</button>
                </form>
            </div>
        </nav>

        <div class="bodyDaftarAset">
            <div class="judul">
                <h3>Daftar Aset</h3>
                </div>
                <div class="d-flex w-100 justify-content-end mb-3">
                <a href="/tambahaset">
                    <div class="btn btn-primary">Tambah Aset</div>
                </a>
                </div>
                <table id="example" style="width:100%"" class="table display table-striped table-light">
                  
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Aset</th>
                          <th>Nomor Aset</th>
                          <th>Perlakuan</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($aset as $index => $asetItem)
                    <tr>
                    <td class="align-middle">{{ $index }}</td>
                      <td class="align-middle"><a href="/show/{{ $asetItem->id }}">{{ $asetItem->nama }}</a></td>
                      <td class="align-middle">{{ $asetItem->nomor_aset }}</td>
                      <td class="align-middle">
                        <a href="/edit/{{ $asetItem->id }}" type="button" class="btn btn-warning d-inline">Edit</a>                 
                        <button class="btn btn-danger "data-bs-toggle="modal" data-bs-target="#exampleModal">Delete</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Anda yakin akan menghapus ini?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <form class="d-inline" action="/delete/{{ $asetItem->id }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-danger">Delete</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  </table>
                  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                <script src="/js/app.js"></script>
                <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
                <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
                <script>
                  
                    function search() {
    var input, filter, table, tr, td, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    table = document.querySelector(".table.table-light tbody");
    tr = table.getElementsByTagName('tr');
    for (var i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Mengambil sel kedua (Nama Aset)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

                </script>
    </body>
</html>