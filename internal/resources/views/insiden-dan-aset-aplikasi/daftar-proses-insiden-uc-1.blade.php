<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/daftarProsesInsiden-uc-1.css">
    <title>Daftar Proses Insiden</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-menambahkan-daftar-proses-insiden-menu-item");

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
        const rows = document.querySelectorAll(".uc-1-menambahkan-daftar-proses-insiden-tabel tbody tr");

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
    const headers = document.querySelectorAll(".uc-1-menambahkan-daftar-proses-insiden-tabel th");

        headers.forEach(header => {
            header.addEventListener("click", function() {
                const index = header.cellIndex;
                const isNumeric = header.classList.contains("uc-1-tabel-id") ||
                                  header.classList.contains("uc-1-tabel-tanggal-selesai") ||
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
        const rows = document.querySelectorAll(".uc-1-menambahkan-daftar-proses-insiden-tabel tbody tr");

        sortButton.addEventListener("click", function() {
            const sortBy = sortSelect.value;
            let index, isDesc;

            if (sortBy.includes("created")) {
                index = 7;
            } else if (sortBy.includes("updated")) {
                index = 8;
            } else if (sortBy.includes("completed")) {
                index = 6;
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

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }
    function goBack() {
        window.history.back();
    }


</script>

<body>

    @if(session()->has('success'))
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="uc-1-menambahkan-daftar-proses-insiden">
        <div class="uc-1-menambahkan-daftar-proses-insiden-sidebar">
            <div class="uc-1-menambahkan-daftar-proses-insiden-sidebar-content">
                <div class="uc-1-menambahkan-daftar-proses-insiden-sidebar-content-profile">
                    <a href="{{ route('user-profile') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                    </a>
                </div>
                <div>
                    <a href="{{ route('dashboard-insiden') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-menambahkan-daftar-proses-insiden-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-menambahkan-daftar-proses-insiden-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-menambahkan-daftar-proses-insiden-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-menambahkan-daftar-proses-insiden-menu-item-submenu">
                        <a href="{{ route('daftar-insiden') }}"><li>Daftar Jenis Insiden</li></a>
                        <a href="{{ route('proses-insiden') }}"><li>Proses Insiden</li></a>
                    </ul>
                </div>
                <div>
                    <a href="{{ route('data-master') }}"><li><h2>Data Master</h2></li></a>
                </div>
                <div class="logout">
                    @if(auth()->check() && auth()->user()->is_admin == true)
                        <a href="{{ route('admin') }}"><li><h2>Admin Dashboard</h2></li></a>

                    @else
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" ><h2>Log Out</h2></button>
                        </form>

                    @endif
                </div>
            </div>
        </div>

        <div class="uc-1-menambahkan-daftar-proses-insiden-main">
            <div class="uc-1-menambahkan-daftar-proses-insiden-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-menambahkan-daftar-proses-insiden-artikel">
                <div class="uc-1-menambahkan-daftar-proses-insiden-view-artikel">
                    <div class="uc-1-menambahkan-daftar-proses-insiden-view-artikel-daftar-proses-insiden">
                        <div class="uc-1-menambahkan-daftar-proses-insiden-view-artikel-daftar-proses-insiden-header">
                            <h1>DAFTAR PROSES INSIDEN</h1>
                            <div class="uc-1-menambahkan-daftar-proses-insiden-view-artikel-button">
                                <div class="uc-1-menambahkan-daftar-proses-insiden-view-artikel-button-tambah">
                                    <a href="{{ route('tambah-proses-insiden') }}"><button type="button" style="cursor: pointer">Tambah Proses Insiden</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="uc-1-menambahkan-daftar-proses-insiden-view-artikel-daftar-proses-insiden-search">
                            <input type="text" id="searchInput" placeholder="Cari...">
                            <select id="sortSelect">
                                <option value="created-desc">Created at (Newest)</option>
                                <option value="created-asc">Created at (Oldest)</option>
                                <option value="updated-desc">Updated at (Newest)</option>
                                <option value="updated-asc">Updated at (Oldest)</option>
                                <option value="completed-desc">Completed at (Newest)</option>
                                <option value="completed-asc">Completed at (Oldest)</option>
                            </select>
                            <button id="sortButton" style="cursor: pointer">Sort</button>
                        </div>

                        <div>

                            <table class="uc-1-menambahkan-daftar-proses-insiden-tabel">
                                <thead>
                                    <tr>
                                        <th class="uc-1-tabel-id">ID Insiden</th>
                                        <th class="uc-1-tabel-nama">Nama Instansi</th>
                                        <th class="uc-1-tabel-jenis">Jenis Insiden</th>
                                        <th class="uc-1-tabel-resiko">Resiko Insiden</th>
                                        <th class="uc-1-tabel-status">Status Insiden</th>
                                        <th class="uc-1-tabel-url">URL Insiden</th>
                                        <th class="uc-1-tabel-tanggal-selesai">Tanggal Diselesaikan <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-created">Created at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-updated">Updated at <small style="font-weight: normal">YYYY/MM/DD<small></th>
                                        <th class="uc-1-tabel-proses">Edit Proses Insiden</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($insidens as $insiden)
                                    <tr>
                                        <td class="uc-1-tabel-id-data">{{ $insiden->insiden_id }}</td>
                                        <td class="uc-1-tabel-nama-data">
                                            @if ($insiden->master_odps)
                                                <a class="uc-1-tabel-view" href="{{ route('view-proses-insiden', ['id' => $insiden->insiden_id]) }}">{{ $insiden->master_odps->nama_instansi }}</a>
                                            @else
                                                Data Telah Dihapus
                                            @endif
                                        </td>


                                        <td class="uc-1-tabel-jenis-data">

                                            @if ($insiden->jenis_insidens)
                                                {{ $insiden->jenis_insidens->nama_insiden }}
                                            @else
                                                Data Telah Dihapus
                                            @endif

                                        </td>
                                        <td class="uc-1-tabel-resiko-data">{{ $insiden->resiko_insiden }}</td>
                                        <td class="uc-1-tabel-status-data">{{ $insiden->status_insiden }}</td>
                                        <td class="uc-1-tabel-url-data">{{ $insiden->url_insiden }}</td>
                                        <td class="uc-1-tabel-tanggal-selesai-data">{{ $insiden->tanggal_insiden_diselesaikan }}</td>
                                        <td class="uc-1-tabel-created-at-data">{{ $insiden->created_at }}</td>
                                        <td class="uc-1-tabel-updated-at-data">{{ $insiden->updated_at }}</td>
                                        <td class="uc-1-tabel-proses-data">
                                            <div class="uc-1-tabel-proses-data-proses">
                                                <div>
                                                    <a href="{{ route('edit-proses-insiden', ['id' => $insiden->insiden_id]) }}"><button class="uc-1-tabel-proses-data-edit" style="cursor: pointer">Edit</button></a>
                                                </div>
                                                <div class="deleteForm">
                                                    <button type="button" class="deleteButton uc-1-tabel-proses-data-delete" style="cursor: pointer">Hapus</button>
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
                                                        <form action="{{ route('delete-proses.softDelete', ['id' => $insiden->insiden_id]) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                               <button type="submit" class="uc-1-delete-confirm-hapus">Hapus</button>
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
                            <div class="pagination" style="margin-top: 20px">
                                {{ $insidens->links('vendor.pagination.default') }}
                            </div>
                            <div>
                                <a href="{{ route('proses-insiden.export') }}" class="btn-export">Download Data Table</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</body>
</html>
