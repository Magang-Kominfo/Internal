<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/daftarAsetAplikasi-uc-1.css">
    <title>Daftar Aset Aplikasi</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-menambahkan-daftar-aset-aplikasi-menu-item");

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

    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const rows = document.querySelectorAll(".uc-1-menambahkan-daftar-aset-aplikasi-tabel tbody tr");

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

    // Filter and Search
    const headers = document.querySelectorAll(".uc-1-menambahkan-daftar-aset-aplikasi-tabel th");

        headers.forEach(header => {
            header.addEventListener("click", function() {
                const index = header.cellIndex;
                const isNumeric = header.classList.contains("uc-1-tabel-id") ||
                                  header.classList.contains("uc-1-tabel-ip") ||
                                  header.classList.contains("uc-1-tabel-server") ||
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
    });

    // Sorting
    document.addEventListener("DOMContentLoaded", function() {
        const sortButton = document.getElementById("sortButton");
        const sortSelect = document.getElementById("sortSelect");
        const rows = document.querySelectorAll(".uc-1-menambahkan-daftar-aset-aplikasi-tabel tbody tr");

        sortButton.addEventListener("click", function() {
            const sortBy = sortSelect.value;
            let index, isDesc;

            if (sortBy.includes("created")) {
                index = 6;
            } else if (sortBy.includes("updated")) {
                index = 7;
            }

            isDesc = sortBy.includes("desc");

            const rowsArray = Array.from(rows);
            rowsArray.sort((a, b) => {
                let aValue = new Date(a.cells[index].textContent);
                let bValue = new Date(b.cells[index].textContent);

                aValue = aValue.getTime() || Number.NEGATIVE_INFINITY;
                bValue = bValue.getTime() || Number.NEGATIVE_INFINITY;

                return isDesc ? bValue - aValue : aValue - bValue;
            });

            rowsArray.forEach(row => {
                row.parentNode.appendChild(row);
            });
        });
    });

    // notifikasi
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.deleteButton').forEach(button => {
            button.addEventListener('click', function () {
                const modal = this.closest('tr').querySelector('.deleteConfirm');
                modal.style.display = "block";
            });
        });

        document.querySelectorAll('.uc-1-delete-confirm-close, .cancelButton').forEach(button => {
            button.addEventListener('click', function () {
                const modal = this.closest('.deleteConfirm');
                modal.style.display = "none";
            });
        });

        window.addEventListener('click', function (event) {
            document.querySelectorAll('.deleteConfirm').forEach(modal => {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        });
    });


</script>

<body>
    <div class="uc-1-menambahkan-daftar-aset-aplikasi">
        <div class="uc-1-menambahkan-daftar-aset-aplikasi-sidebar">
            <div class="uc-1-menambahkan-daftar-aset-aplikasi-sidebar-content">
                <div class="uc-1-menambahkan-daftar-aset-aplikasi-sidebar-content-profile">
                    <img src="" alt="profile">
                </div>
                <div>
                    <a href="{{ route('dashboard') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-menambahkan-daftar-aset-aplikasi-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-menambahkan-daftar-aset-aplikasi-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-menambahkan-daftar-aset-aplikasi-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-menambahkan-daftar-aset-aplikasi-menu-item-submenu">
                        <a href="{{ route('daftar-insiden') }}"><li>Daftar Insiden</li></a>
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

        <div class="uc-1-menambahkan-daftar-aset-aplikasi-main">
            <div class="uc-1-menambahkan-daftar-aset-aplikasi-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-menambahkan-daftar-aset-aplikasi-artikel">
                <div class="uc-1-menambahkan-daftar-aset-aplikasi-view-artikel">
                    <div class="uc-1-menambahkan-daftar-aset-aplikasi-view-artikel-daftar-aset-aplikasi">
                        <div class="uc-1-menambahkan-daftar-aset-aplikasi-view-artikel-daftar-aset-aplikasi-header">
                            <h1>DAFTAR ASET APLIKASI</h1>

                            <div class="uc-1-daftar-aset-aplikasi-view-artikel-button-tambah">
                                <a href="{{ route('tambah-aset-aplikasi') }}"><button type="button">Tambah Aset Aplikasi</button></a>
                            </div>
                        </div>

                        <div class="uc-1-menambahkan-daftar-aset-aplikasi-view-artikel-daftar-aset-aplikasi-search">
                            <input type="text" id="searchInput" placeholder="Cari...">
                            <select id="sortSelect">
                                <option value="created-desc">Created at (Newest)</option>
                                <option value="created-asc">Created at (Oldest)</option>
                                <option value="updated-desc">Updated at (Newest)</option>
                                <option value="updated-asc">Updated at (Oldest)</option>
                            </select>
                            <button id="sortButton">Sort</button>
                        </div>

                        <div>

                            <table class="uc-1-menambahkan-daftar-aset-aplikasi-tabel">
                                <thead>
                                    <tr>
                                        <th class="uc-1-tabel-id">ID Aset Aplikasi</th>
                                        <th class="uc-1-tabel-nama">Nama Aset Aplikasi</th>
                                        <th class="uc-1-tabel-kategori">Kategori Aset Aplikasi</th>
                                        <th class="uc-1-tabel-ip">IP Aset Aplikasi</th>
                                        <th class="uc-1-tabel-server">Server Status Aplikasi</th>
                                        <th class="uc-1-tabel-indeks">Indeks KAMI</th>
                                        <th class="uc-1-tabel-created">Created at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-updated">Updated at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-proses">Edit Aset Aplikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aset_aplikasis as $aset_aplikasi)
                                    <tr>
                                        <td class="uc-1-tabel-id-data">{{ $aset_aplikasi->id_aset_aplikasi }}</td>
                                        <td class="uc-1-tabel-nama-data">{{ $aset_aplikasi->nama_aset_aplikasi }}</td>
                                        <td class="uc-1-tabel-kategori-data">{{ $aset_aplikasi->jenis_kategoris->nama_jenis_kategori }}</td>
                                        <td class="uc-1-tabel-ip-data">{{ $aset_aplikasi->ip_aset_aplikasi }}</td>
                                        <td class="uc-1-tabel-server-data">{{ $aset_aplikasi->server_aset_aplikasi }}</td>
                                        <td class="uc-1-tabel-indeks-data">{{ $aset_aplikasi->indeks_kami_aset_aplikasi }}</td>
                                        <td class="uc-1-tabel-created-at-data">{{ $aset_aplikasi->created_at }}</td>
                                        <td class="uc-1-tabel-updated-at-data">{{ $aset_aplikasi->updated_at }}</td>
                                        <td class="uc-1-tabel-proses-data">
                                            <div class="uc-1-tabel-proses-data-proses">
                                                <div>
                                                    <a href="{{ route('edit-aset-aplikasi', ['id' => $aset_aplikasi->id_aset_aplikasi]) }}"><button class="uc-1-tabel-proses-data-edit">Edit</button></a>
                                                </div>
                                                <div class="deleteForm">
                                                    <button type="button" class="deleteButton uc-1-tabel-proses-data-delete">Hapus</button>
                                                </div>

                                                <div class="deleteConfirm uc-1-detele-confirm">
                                                    <div class="uc-1-delete-confirm-content">
                                                      <div class="uc-1-delete-confirm-header">
                                                        <span class="uc-1-delete-confirm-close">&times;</span>
                                                        <h2>Konfirmasi Hapus</h2>
                                                      </div>
                                                      <div class="uc-1-delete-confirm-body">
                                                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                      </div>
                                                      <div class="uc-1-delete-confirm-footer">
                                                        <button class="cancelButton uc-1-delete-confirm-batal">Batal Hapus</button>

                                                        <form action="{{ route('delete-aset.softDelete', ['id' => $aset_aplikasi->id_aset_aplikasi]) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="uc-1-delete-confirm-hapus" type="submit">Hapus</button>
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

                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
</body>
</html>
