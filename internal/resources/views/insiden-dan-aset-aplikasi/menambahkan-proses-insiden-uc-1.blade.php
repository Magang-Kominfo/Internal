<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/menambahkanProsesInsiden-uc-1.css">
    <title>Proses Insiden</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-proses-insiden-menu-item");

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

    <div class="uc-1-proses-insiden">
        <div class="uc-1-proses-insiden-sidebar">
            <div class="uc-1-proses-insiden-sidebar-content">
                <div class="uc-1-proses-insiden-sidebar-content-profile">
                    <a href="{{ route('user-profile') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                    </a>
                </div>
                <div>
                    <a href="{{ route('dashboard-insiden') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-proses-insiden-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-proses-insiden-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-proses-insiden-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-proses-insiden-menu-item-submenu">
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

        <div class="uc-1-proses-insiden-main">
            <div class="uc-1-proses-insiden-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-proses-insiden-artikel">
                <div class="uc-1-proses-insiden-view-artikel">
                    <div class="uc-1-proses-insiden-view-artikel-data-master">
                        <div class="uc-1-proses-insiden-view-artikel-data-master-header">
                            <h1>PROSES INSIDEN</h1>
                        </div>

                        <form action="{{ route('proses-insiden.post') }}" method="post">
                        @csrf
                            <div class="uc-1-proses-insiden-input-field">
                                    <div class="uc-1-proses-insiden-input-field-opd">
                                        <label for="insidens_odp_id_foreign">Nama Instansi:</label>
                                        <select name="insidens_odp_id_foreign" id="insidens_odp_id_foreign" required>
                                            <option value="" >Pilih Instansi</option>
                                            @foreach($masterOdpList as $masterOdp)
                                                <option value="{{ $masterOdp->odp_id }}">{{ $masterOdp->nama_instansi }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-jenis-insiden">
                                        <label for="insidens_id_jenis_insiden_foreign">Nama Insiden:</label>
                                        <select name="insidens_id_jenis_insiden_foreign" id="insidens_id_jenis_insiden_foreign" required>
                                            <option value="">Pilih Jenis Insiden</option>
                                            @foreach($jenisInsidenList as $jenisInsiden)
                                                <option value="{{ $jenisInsiden->id_jenis_insiden }}">{{ $jenisInsiden->nama_insiden }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-nomor-surat-insiden">
                                        <label for="nomor_surat_tte_insiden">Nomor Surat TTE Insiden:</label>
                                        <input type="text" name="nomor_surat_tte_insiden" id="nomor_surat_tte_insiden" >
                                    </div>
                                    <div class="uc-1-proses-insiden-input-field-nomor-url">
                                        <label for="url_insiden">URL Insiden:</label>
                                        <input type="text" name="url_insiden" id="url_insiden" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-status-insiden">
                                        <label for="status_insiden">Status Insiden:</label>
                                        <select name="status_insiden" id="status_insiden">
                                            <option value="">Pilih Status</option>
                                                <option value="notifikasi">1. Notifikasi</option>
                                                <option value="penanganan">2. Penanganan</option>
                                                <option value="pemulihan">3. Pemulihan</option>
                                                <option value="solved">4. Solved</option>
                                                <option value="suspended">5. Suspended</option>
                                        </select>
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-resiko-insiden">
                                        <label for="resiko_insiden">Resiko Insiden:</label>
                                        <select name="resiko_insiden" id="resiko_insiden">
                                            <option value="">Pilih Resiko</option>
                                                <option value="rendah">1. Rendah</option>
                                                <option value="menengah">2. Menengah</option>
                                                <option value="tinggi">3. Tinggi</option>
                                                <option value="kritis">4. Kritis</option>
                                                <option value="informasi">5. Informasi</option>
                                        </select>
                                    </div>


                                    <div class="uc-1-proses-insiden-input-field-tanggal-notifikasi">
                                        <label for="tanggal_notifikasi_insiden">Tanggal Notifikasi:</label>
                                        <input type="date" name="tanggal_notifikasi_insiden" id="tanggal_notifikasi_insiden" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-jam-temuan">
                                        <label for="jam_temuan_insiden">Jam Temuan Insiden:</label>
                                        <input type="time" name="jam_temuan_insiden" id="jam_temuan_insiden" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-tanggal-surat-tte">
                                        <label for="tanggal_surat_tte_insiden">Tanggal Surat TTE:</label>
                                        <input type="date" name="tanggal_surat_tte_insiden" id="tanggal_surat_tte_insiden" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-tanggal-suspend">
                                        <label for="tanggal_suspend_insiden">Tanggal Suspend:</label>
                                        <input type="date" name="tanggal_suspend_insiden" id="tanggal_suspend_insiden" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-tanggal-pemulihan">
                                        <label for="tanggal_pemulihan_insiden">Tanggal Pemulihan:</label>
                                        <input type="date" name="tanggal_pemulihan_insiden" id="tanggal_pemulihan_insiden" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-status-setelah-unsuspend">
                                        <label for="status_setelah_unsuspend_insiden">Status Setelah Unsuspend:</label>
                                        <input type="text" name="status_setelah_unsuspend_insiden" id="status_setelah_unsuspend_insiden" >
                                    </div>


                                    <div class="uc-1-proses-insiden-input-field-jam-temuan-dikirim">
                                        <label for="jam_temuan_dikirim_insiden">Jam Temuan Dikirim Insiden:</label>
                                        <input type="time" name="jam_temuan_dikirim_insiden" id="jam_temuan_dikirim_insiden" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-jam-insiden-diselesaikan">
                                        <label for="jam_insiden_diselesaikan">Jam Insiden Diselesaikan:</label>
                                        <input type="time" name="jam_insiden_diselesaikan" id="jam_insiden_diselesaikan" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-tanggal-insiden-diselesaikan">
                                        <label for="tanggal_insiden_diselesaikan">Tanggal Insiden Diselesaikan:</label>
                                        <input type="date" name="tanggal_insiden_diselesaikan" id="tanggal_insiden_diselesaikan" >
                                    </div>

                                    <div class="uc-1-proses-insiden-input-field-keterangan">
                                        <label for="keterangan_insiden">Keterangan:</label>
                                        <textarea name="keterangan_insiden" id="keterangan_insiden" cols="30" rows="10"></textarea>
                                    </div>


                            </div>



                            <div class="uc-1-proses-insiden-view-artikel-footer">
                                <div class="uc-1-proses-insiden-view-artikel-footer-back">
                                    <a href="{{ route('proses-insiden') }}"><button type="button" style="cursor: pointer">Back</button></a>
                                </div>

                                <div class="uc-1-proses-insiden-view-artikel-footer-save">
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
