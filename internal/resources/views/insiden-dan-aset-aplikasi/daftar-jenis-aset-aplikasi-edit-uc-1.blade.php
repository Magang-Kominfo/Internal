<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/menambahkanJenisAsetAplikasi-uc-1.css">
    <title>Edit Kategori Aset Aplikasi</title>
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
</script>

<body>
    <div class="uc-1-menambahkan-jenis-aset-aplikasi">
        <div class="uc-1-menambahkan-jenis-aset-aplikasi-sidebar">
            <div class="uc-1-menambahkan-jenis-aset-aplikasi-sidebar-content">
                <div class="uc-1-menambahkan-jenis-aset-aplikasi-sidebar-content-profile">
                    <img src="" alt="profile">
                </div>
                <div>
                    <a href="{{ route('dashboard') }}"><h2>Dashboard</h2></a>
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
                <div>
                    <h2>Log Out</h2>
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
                            <h1>EDIT KATEGORI ASET APLIKASI</h1>
                        </div>

                        <form action="{{ route('update-jenis-kategori-aset-aplikasi.update', ['id' => $jenis_kategori->id_jenis_kategori]) }}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="uc-1-menambahkan-jenis-aset-aplikasi-input-field">
                                    <div class="uc-1-menambahkan-jenis-aset-aplikasi-input-field-input">
                                        <label for="nama_jenis_kategori">Nama Kategori Aset Aplikasi:</label>
                                        <input type="text" name="nama_jenis_kategori" id="nama_jenis_kategori" value="{{ $jenis_kategori->nama_jenis_kategori }}">
                                    </div>

                                    <div class="uc-1-menambahkan-jenis-aset-aplikasi-input-field-input">
                                        <label for="deskripsi_jenis_kategori">Deskripsi Kategori Aset Aplikasi:</label>
                                        <textarea name="deskripsi_jenis_kategori" id="deskripsi_jenis_kategori" cols="30" rows="10">{{ $jenis_kategori->deskripsi_jenis_kategori }}</textarea>
                                    </div>

                            </div>



                            <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel-footer">
                                <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel-footer-back">
                                    <a href="{{ route('kategori-aset-aplikasi') }}"><button type="button">Back</button></a>
                                </div>

                                <div class="uc-1-menambahkan-jenis-aset-aplikasi-view-artikel-footer-save">
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