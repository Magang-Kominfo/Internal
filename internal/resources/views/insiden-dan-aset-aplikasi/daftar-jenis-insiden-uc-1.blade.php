<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/daftarJenisInsiden-uc-1.css">
    <title>Daftar Jenis Insiden</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-menambahkan-daftar-insiden-menu-item");

    menuItems.forEach(function(menuItem) {
        menuItem.addEventListener("click", function() {
            menuItems.forEach(function(item) {
                if (item !== menuItem) {
                    item.classList.remove("active");
                }
            });
            menuItem.classList.toggle("active");
        });
    });
    });

    // Filter and Search
    const headers = document.querySelectorAll(".uc-1-menambahkan-daftar-insiden-tabel th");

        headers.forEach(header => {
            header.addEventListener("click", function() {
                const index = header.cellIndex;
                const isNumeric = header.classList.contains("uc-1-tabel-id") ||
                                  header.classList.contains("uc-1-tabel-created") ||
                                  header.classList.contains("uc-1-tabel-updated");

                const rowsArray = Array.from(rows);
                rowsArray.sort((a, b) => {
                    const aValue = isNumeric ? parseFloat(a.cells[index].textContent) : a.cells[index].textContent;
                    const bValue = isNumeric ? parseFloat(b.cells[index].textContent) : b.cells[index].textContent;
                    return aValue > bValue ? 1 : -1;
                });

                rowsArray.forEach(row => {
                    row.parentNode.appendChild(row);
                });
            });
        });

    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const rows = document.querySelectorAll(".uc-1-menambahkan-daftar-insiden-tabel tbody tr");

        searchInput.addEventListener("input", function() {
            const searchTerm = searchInput.value.toLowerCase();
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
        });
</script>

<body>
    <div class="uc-1-menambahkan-daftar-insiden">
        <div class="uc-1-menambahkan-daftar-insiden-sidebar">
            <div class="uc-1-menambahkan-daftar-insiden-sidebar-content">
                <div class="uc-1-menambahkan-daftar-insiden-sidebar-content-profile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                </div>
                <div>
                    <a href="{{ route('dashboard') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-menambahkan-daftar-insiden-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-menambahkan-daftar-insiden-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-menambahkan-daftar-insiden-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-menambahkan-daftar-insiden-menu-item-submenu">
                        <a href="{{ route('daftar-insiden') }}"><li>Daftar Jenis Insiden</li></a>
                        <a href="{{ route('proses-insiden') }}"><li>Proses Insiden</li></a>
                    </ul>
                </div>
                <div>
                    <a href="{{ route('data-master') }}"><li><h2>Data Master</h2></li></a>
                </div>
                <div>
                    <h2>Log Out</h2>
                </div>
            </div>
        </div>

        <div class="uc-1-menambahkan-daftar-insiden-main">
            <div class="uc-1-menambahkan-daftar-insiden-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-menambahkan-daftar-insiden-artikel">
                <div class="uc-1-menambahkan-daftar-insiden-view-artikel">
                    <div class="uc-1-menambahkan-daftar-insiden-view-artikel-daftar-insiden">
                        <div class="uc-1-menambahkan-daftar-insiden-view-artikel-daftar-insiden-header">
                            <h1>DAFTAR JENIS INSIDEN</h1>
                            <div class="uc-1-menambahkan-daftar-insiden-view-artikel-button">
                                <div class="uc-1-menambahkan-daftar-insiden-view-artikel-button-tambah">
                                    <a href="{{ route('tambah-insiden') }}"><button type="button">Tambah Jenis Insiden</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="uc-1-daftar-insiden-view-artikel-search">
                            <input type="text" id="searchInput" placeholder="Cari...">
                        </div>

                        <div>

                            <table class="uc-1-menambahkan-daftar-insiden-tabel">
                                <thead>
                                    <tr>
                                        <th class="uc-1-tabel-id">ID Insiden</th>
                                        <th class="uc-1-tabel-nama">Nama Insiden</th>
                                        <th class="uc-1-tabel-deskripsi">Deskripsi Insiden</th>
                                        <th class="uc-1-tabel-created">Created at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-updated">Updated at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-proses">Edit Jenis Insiden</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenis_insidens as $jenis_insiden)
                                    <tr>
                                        <td class="uc-1-tabel-id-data">{{ $jenis_insiden->id_jenis_insiden }}</td>
                                        <td class="uc-1-tabel-nama-data">{{ $jenis_insiden->nama_insiden }}</td>
                                        <td class="uc-1-tabel-deskripsi-data">{{ $jenis_insiden->deskripsi_insiden }}</td>
                                        <td class="uc-1-tabel-created-at-data">{{ $jenis_insiden->created_at }}</td>
                                        <td class="uc-1-tabel-updated-at-data">{{ $jenis_insiden->updated_at }}</td>
                                        <td class="uc-1-tabel-proses-data">
                                            <div class="uc-1-tabel-proses-data-proses">
                                                <div>
                                                    <a href="{{ route('edit-jenis-insiden', ['id' => $jenis_insiden->id_jenis_insiden]) }}"><button class="uc-1-tabel-proses-data-edit">Edit</button></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</body>
</html>
