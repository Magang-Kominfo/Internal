<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/menambahkanAsetAplikasi-uc-1.css">
    <title>Edit Aset Aplikasi</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-menambahkan-aset-aplikasi-menu-item");

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
    <div class="uc-1-menambahkan-aset-aplikasi">
        <div class="uc-1-menambahkan-aset-aplikasi-sidebar">
            <div class="uc-1-menambahkan-aset-aplikasi-sidebar-content">
                <div class="uc-1-menambahkan-aset-aplikasi-sidebar-content-profile">
                    <img src="" alt="profile">
                </div>
                <div>
                    <a href="{{ route('dashboard') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-menambahkan-aset-aplikasi-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-menambahkan-aset-aplikasi-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-menambahkan-aset-aplikasi-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-menambahkan-aset-aplikasi-menu-item-submenu">
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

        <div class="uc-1-menambahkan-aset-aplikasi-main">
            <div class="uc-1-menambahkan-aset-aplikasi-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-menambahkan-aset-aplikasi-artikel">
                <div class="uc-1-menambahkan-aset-aplikasi-view-artikel">
                    <div class="uc-1-menambahkan-aset-aplikasi-view-artikel-aset-aplikasi">
                        <div class="uc-1-menambahkan-aset-aplikasi-view-artikel-aset-aplikasi-header">
                            <h1>EDIT ASET APLIKASI</h1>
                        </div>

                        <form action="{{ route('update-aset-aplikasi.update', ['id' => $aset_aplikasi->id_aset_aplikasi]) }}" method="post">
                        @csrf
                        @method('PUT')
                            <div class="uc-1-menambahkan-aset-aplikasi-input-field">
                                <div class="uc-1-menambahkan-aset-aplikasi-input-field-nama">
                                    <label for="nama_aset_aplikasi">Nama Aset Aplikasi:</label>
                                    <input type="text" name="nama_aset_aplikasi" id="nama_aset_aplikasi" value="{{ $aset_aplikasi->nama_aset_aplikasi }}" >
                                </div>

                                <div class="uc-1-menambahkan-aset-aplikasi-input-field-kategori">
                                    <label for="aa_id_jenis_kategori_foreign">Kategori Aset Aplikasi:</label>
                                    <select name="aa_id_jenis_kategori_foreign" id="aa_id_jenis_kategori_foreign">
                                        <option value="{{ $aset_aplikasi->aa_id_jenis_kategori_foreign }}">Pilih Kategori Aset Aplikasi</option>
                                        @foreach($jenisKategoriList as $jenisKategori)
                                            <option value="{{ $jenisKategori->id_jenis_kategori }}">{{ $jenisKategori->nama_jenis_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="uc-1-menambahkan-aset-aplikasi-input-field-ip">
                                    <label for="ip_aset_aplikasi">IP Address:</label>
                                    <input type="text" name="ip_aset_aplikasi" id="ip_aset_aplikasi" value="{{ $aset_aplikasi->ip_aset_aplikasi }}">
                                </div>

                                <div class="uc-1-menambahkan-aset-aplikasi-input-field-server">
                                    <label for="server_aset_aplikasi">Server:</label>
                                    <input type="text" name="server_aset_aplikasi" id="server_aset_aplikasi" value="{{ $aset_aplikasi->server_aset_aplikasi }}">
                                </div>

                                <div class="uc-1-menambahkan-aset-aplikasi-input-field-kami">
                                    <label for="indeks_kami_aset_aplikasi">Indeks KAMI:</label>
                                    <select name="indeks_kami_aset_aplikasi" id="indeks_kami_aset_aplikasi">
                                        <option>{{ $aset_aplikasi->indeks_kami_aset_aplikasi }}</option>
                                            <option value="I">Tingkat I</option>
                                            <option value="II">Tingkat II</option>
                                            <option value="III">Tingkat III</option>
                                            <option value="IV">Tingkat IV</option>
                                            <option value="V">Tingkat V</option>
                                    </select>

                                    <div class="uc-1-menambahkan-aset-aplikasi-input-field-kami-keterangan">
                                        <h4>Keterangan Indeks KAMI:</h4>
                                        <p>Tingkat I: Kondisi Awal</p>
                                        <p>Tingkat II: Penerapan Kerangka Kerja Dasar</p>
                                        <p>Tingkat III: Terdefinisi dan Konsisten</p>
                                        <p>Tingkat IV: Terkelola dan Terukur</p>
                                        <p>Tingkat V: Optimal</p>
                                    </div>
                                </div>
                            </div>


                            <div class="uc-1-menambahkan-aset-aplikasi-view-artikel-footer">
                                <div class="uc-1-aset-aplikasi-view-artikel-footer-back">
                                    <a href="{{ route('aset-aplikasi') }}"><button type="button">Back</button></a>
                                </div>

                                <div class="uc-1-menambahkan-aset-aplikasi-view-artikel-footer-save">
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
