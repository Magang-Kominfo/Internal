<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/menambahkanDataMaster-uc-1.css">
    <title>Edit Data Master</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-menambahkan-data-master-menu-item");

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
</script>

<body>
    <div class="uc-1-menambahkan-data-master">
        <div class="uc-1-menambahkan-data-master-sidebar">
            <div class="uc-1-menambahkan-data-master-sidebar-content">
                <div class="uc-1-menambahkan-data-master-sidebar-content-profile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                </div>
                <div>
                    <a href="{{ route('dashboard-insiden') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-menambahkan-data-master-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-menambahkan-data-master-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-menambahkan-data-master-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-menambahkan-data-master-menu-item-submenu">
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

        <div class="uc-1-menambahkan-data-master-main">
            <div class="uc-1-menambahkan-data-master-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-menambahkan-data-master-artikel">
                <div class="uc-1-menambahkan-data-master-view-artikel">
                    <div class="uc-1-menambahkan-data-master-view-artikel-data-master">
                        <div class="uc-1-menambahkan-data-master-view-artikel-data-master-header">
                            <h1>EDIT DATA MASTER</h1>
                        </div>

                        <form action="{{ route('update-data-master.update', ['id' => $master_odp->odp_id]) }}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="uc-1-menambahkan-data-master-input-field">
                                    <div class="uc-1-menambahkan-data-master-input-field-nama">
                                        <label for="nama_instansi">Nama Instansi:</label>
                                        <input type="text" name="nama_instansi" id="nama_instansi"  value="{{ $master_odp->nama_instansi }}">
                                    </div>

                            </div>



                            <div class="uc-1-menambahkan-data-master-view-artikel-footer">
                                <div class="uc-1-menambahkan-data-master-view-artikel-footer-back">
                                    <a href="{{ route('data-master') }}"><button type="button">Back</button></a>
                                </div>

                                <div class="uc-1-menambahkan-data-master-view-artikel-footer-save">
                                    <button type="submit">Save</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
</body>
</html>
