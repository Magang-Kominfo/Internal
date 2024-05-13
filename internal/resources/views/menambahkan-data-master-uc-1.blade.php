<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/menambahkanDataMaster-uc-1.css">
    <title>Menambahkan Data Master</title>
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
                    <img src="" alt="profile">
                </div>
                <div>
                    <a href="{{ route('dashboard') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-menambahkan-data-master-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-menambahkan-data-master-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('tambah-aset-aplikasi') }}"><li>Tambahkan Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-menambahkan-data-master-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-menambahkan-data-master-menu-item-submenu">
                        <a href="{{ route('daftar-insiden') }}"><li>Daftar Insiden</li></a>
                        <a href="{{ route('proses-insiden') }}"><li>Proses Insiden</li></a>
                        <a href="{{ route('tambah-insiden') }}"><li>Tambahkan Insiden</li></a>
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
                            <h1>MENAMBAHKAN DATA MASTER</h1>
                        </div>

                        <form action="{{ route('tambahkan-instansi.post') }}" method="post">
                        @csrf
                            <div class="uc-1-menambahkan-data-master-input-field">
                                    <div class="uc-1-menambahkan-data-master-input-field-nama">
                                        <label for="nama_instansi">Nama Instansi:</label>
                                        <input type="text" name="nama_instansi" id="nama_instansi" >
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
