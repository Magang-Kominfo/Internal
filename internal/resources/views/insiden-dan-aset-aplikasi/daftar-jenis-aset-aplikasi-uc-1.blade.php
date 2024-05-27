<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/daftarJenisAsetAplikasi-uc-1.css">
    <title>Kategori Aset Aplikasi</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-jenis-aset-aplikasi-menu-item");

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
    const headers = document.querySelectorAll(".uc-1-menambahkan-jenis-aset-aplikasi-tabel th");

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
        const rows = document.querySelectorAll(".uc-1-menambahkan-jenis-aset-aplikasi-tabel tbody tr");

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
    <div class="uc-1-jenis-aset-aplikasi">
        <div class="uc-1-jenis-aset-aplikasi-sidebar">
            <div class="uc-1-jenis-aset-aplikasi-sidebar-content">
                <div class="uc-1-jenis-aset-aplikasi-sidebar-content-profile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                </div>
                <div>
                    <a href="{{ route('dashboard-insiden') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-jenis-aset-aplikasi-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-jenis-aset-aplikasi-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-jenis-aset-aplikasi-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-jenis-aset-aplikasi-menu-item-submenu">
                        <a href="{{ route('daftar-insiden') }}"><li>Daftar Jenis Insiden</li></a>
                        <a href="{{ route('proses-insiden') }}"><li>Proses Insiden</li></a>
                    </ul>
                </div>
                <div>
                    <a href="{{ route('data-master') }}"><li><h2>Data Master</h2></li></a>
                </div>
                <div class="logout">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" ><h2>Log Out</h2></button>
                    </form>
                </div>
            </div>
        </div>

        <div class="uc-1-jenis-aset-aplikasi-main">
            <div class="uc-1-jenis-aset-aplikasi-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-jenis-aset-aplikasi-artikel">
                <div class="uc-1-jenis-aset-aplikasi-view-artikel">
                    <div class="uc-1-jenis-aset-aplikasi-view-artikel-jenis-aset-aplikasi">
                        <div class="uc-1-jenis-aset-aplikasi-view-artikel-jenis-aset-aplikasi-header">
                            <h1>KATEGORI ASET APLIKASI</h1>
                            <div class="uc-1-jenis-aset-aplikasi-view-artikel-button">
                                <div class="uc-1-jenis-aset-aplikasi-view-artikel-button-tambah">
                                    <a href="{{ route('tambah-kategori-aset-aplikasi') }}"><button type="button">Tambah Kategori</button></a>
                                </div>
                            </div>

                        </div>

                        <div class="uc-1-jenis-aset-aplikasi-view-artikel-search">
                            <input type="text" id="searchInput" placeholder="Cari...">
                        </div>


                        <div>

                            <table class="uc-1-menambahkan-jenis-aset-aplikasi-tabel">
                                <thead>
                                    <tr>
                                        <th class="uc-1-tabel-id">ID Kategori</th>
                                        <th class="uc-1-tabel-nama">Nama Kategori</th>
                                        <th class="uc-1-tabel-deskripsi">Deskripsi Kategori</th>
                                        <th class="uc-1-tabel-created">Created at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-updated">Updated at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-proses">Proses Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenis_kategoris as $jenis_kategori)
                                    <tr>
                                        <td class="uc-1-tabel-id-data">{{ $jenis_kategori->id_jenis_kategori }}</td>
                                        <td class="uc-1-tabel-nama-data">{{ $jenis_kategori->nama_jenis_kategori }}</td>
                                        <td class="uc-1-tabel-deskripsi-data">{{ $jenis_kategori->deskripsi_jenis_kategori }}</td>
                                        <td class="uc-1-tabel-created-at-data">{{ $jenis_kategori->created_at }}</td>
                                        <td class="uc-1-tabel-updated-at-data">{{ $jenis_kategori->updated_at }}</td>
                                        <td class="uc-1-tabel-proses-data">
                                            <div class="uc-1-tabel-proses-data-proses">
                                                <div>
                                                    <a href="{{ route('edit-jenis-kategori-aset-aplikasi', ['id' => $jenis_kategori->id_jenis_kategori]) }}"><button class="uc-1-tabel-proses-data-edit">Edit</button></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination" style="margin-top: 20px">
                                {{ $jenis_kategoris->links('vendor.pagination.default') }}
                            </div>
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