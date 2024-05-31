<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/menambahkanJenisAsetAplikasi-uc-1.css">
    <title>Menambahkan Kategori Aset Aplikasi</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-menambahkan-jenis-aset-aplikasi-menu-item");

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

    <div class="uc-1-menambahkan-jenis-aset-aplikasi">
        <div class="uc-1-menambahkan-jenis-aset-aplikasi-sidebar">
            <div class="uc-1-menambahkan-jenis-aset-aplikasi-sidebar-content">
                <div class="uc-1-menambahkan-jenis-aset-aplikasi-sidebar-content-profile">
                    <a href="{{ route('user-profile') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                    </a>
                </div>
                <div>
                    <a href="{{ route('dashboard-insiden') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-menambahkan-jenis-aset-aplikasi-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-menambahkan-jenis-aset-aplikasi-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-menambahkan-jenis-aset-aplikasi-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-menambahkan-jenis-aset-aplikasi-menu-item-submenu">
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

        <div class="uc-1-menambahkan-jenis-aset-aplikasi-main">
            <div class="uc-1-menambahkan-jenis-aset-aplikasi-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-menambahkan-jenis-aset-aplikasi-artikel">
                <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel">
                    <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel-jenis-aset-aplikasi">
                        <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel-jenis-aset-aplikasi-header">
                            <h1>MENAMBAHKAN KATEGORI ASET APLIKASI</h1>
                        </div>

                        <form action="{{ route('tambahkan-kategori-aset-aplikasi.post') }}" method="post">
                        @csrf
                            <div class="uc-1-menambahkan-jenis-aset-aplikasi-input-field">
                                    <div class="uc-1-menambahkan-jenis-aset-aplikasi-input-field-input">
                                        <label for="nama_jenis_kategori">Nama Kategori Aset Aplikasi:</label>
                                        <input type="text" name="nama_jenis_kategori" id="nama_jenis_kategori" required>
                                    </div>

                                    <div class="uc-1-menambahkan-jenis-aset-aplikasi-input-field-input">
                                        <label for="deskripsi_jenis_kategori">Deskripsi Kategori Aset Aplikasi:</label>
                                        <textarea name="deskripsi_jenis_kategori" id="deskripsi_jenis_kategori" cols="30" rows="10"></textarea>
                                    </div>

                            </div>



                            <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel-footer">
                                <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel-footer-back">
                                    <a href="{{ route('kategori-aset-aplikasi') }}"><button type="button" style="cursor: pointer">Back</button></a>
                                </div>

                                <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel-footer-save">
                                    <button type="submit" style="cursor: pointer">Save</button>
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
