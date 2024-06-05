<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/daftarDataMaster-uc-1.css">
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

    @if(session()->has(['success']))
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                {{ session('success') }}
            </div>
        </div>
    @endif


    <div class="uc-1-data-master">
        <div class="uc-1-data-master-sidebar">
            <div class="uc-1-data-master-sidebar-content">
                <div class="uc-1-data-master-sidebar-content-profile">
                    <a href="{{ route('user-profile') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                    </a>
                </div>
                <div>
                    <a href="{{ route('dashboard-insiden') }}"><h2>Dashboard</h2></a>
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
                                    <a href="{{ route('menambahkan-data-master') }}"><button type="button" style="cursor: pointer">Tambah Instansi</button></a>
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
                                                        <form action="{{ route('delete-data-master.delete', ['id' => $master_odp->odp_id]) }}" method="post">
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
                                {{ $master_odps->links('vendor.pagination.default') }}
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
