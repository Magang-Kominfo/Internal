<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/daftarDataMaster-uc-1.css">
    <title>Data Master</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-data-master-menu-item");

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
    const headers = document.querySelectorAll(".uc-1-menambahkan-data-master-tabel th");

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
        const rows = document.querySelectorAll(".uc-1-menambahkan-data-master-tabel tbody tr");

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
    <div class="uc-1-data-master">
        <div class="uc-1-data-master-sidebar">
            <div class="uc-1-data-master-sidebar-content">
                <div class="uc-1-data-master-sidebar-content-profile">
                    <img src="" alt="profile">
                </div>
                <div>
                    <a href="{{ route('dashboard') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-data-master-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-data-master-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-data-master-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-data-master-menu-item-submenu">
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

        <div class="uc-1-data-master-main">
            <div class="uc-1-data-master-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-data-master-artikel">
                <div class="uc-1-data-master-view-artikel">
                    <div class="uc-1-data-master-view-artikel-data-master">
                        <div class="uc-1-data-master-view-artikel-data-master-header">
                            <h1>DATA MASTER</h1>
                            <div class="uc-1-data-master-view-artikel-button">
                                <div class="uc-1-data-master-view-artikel-button-tambah">
                                    <a href="{{ route('menambahkan-data-master') }}"><button type="button">Tambah Instansi</button></a>
                                </div>
                            </div>

                        </div>

                        <div class="uc-1-data-master-view-artikel-search">
                            <input type="text" id="searchInput" placeholder="Cari...">
                        </div>

                        <div>

                            <table class="uc-1-menambahkan-data-master-tabel">
                                <thead>
                                    <tr>
                                        <th class="uc-1-tabel-id">ID Instansi</th>
                                        <th class="uc-1-tabel-nama">Nama Instansi</th>
                                        <th class="uc-1-tabel-created">Created at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-updated">Updated at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-proses">Proses Instansi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($master_odps as $master_odp)
                                    <tr>
                                        <td class="uc-1-tabel-id-data">{{ $master_odp->odp_id }}</td>
                                        <td class="uc-1-tabel-nama-data">{{ $master_odp->nama_instansi }}</td>
                                        <td class="uc-1-tabel-created-at-data">{{ $master_odp->created_at }}</td>
                                        <td class="uc-1-tabel-updated-at-data">{{ $master_odp->updated_at }}</td>
                                        <td class="uc-1-tabel-proses-data">
                                            <div class="uc-1-tabel-proses-data-proses">
                                                <div>
                                                    <a href="{{ route('edit-data-master', ['id' => $master_odp->odp_id]) }}"><button class="uc-1-tabel-proses-data-edit">Edit</button></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div>


                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</body>
</html>
