<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/viewProsesInsiden-uc-1.css">
    <title>Daftar Proses Insiden</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-menambahkan-view-proses-insiden-menu-item");

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
    <div class="uc-1-menambahkan-view-proses-insiden">
        <div class="uc-1-menambahkan-view-proses-insiden-sidebar">
            <div class="uc-1-menambahkan-view-proses-insiden-sidebar-content">
                <div class="uc-1-menambahkan-view-proses-insiden-sidebar-content-profile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                </div>
                <div>
                    <a href="{{ route('dashboard-insiden') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-menambahkan-view-proses-insiden-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-menambahkan-view-proses-insiden-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-menambahkan-view-proses-insiden-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-menambahkan-view-proses-insiden-menu-item-submenu">
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

        <div class="uc-1-menambahkan-view-proses-insiden-main">
            <div class="uc-1-menambahkan-view-proses-insiden-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="uc-1-menambahkan-view-proses-insiden-artikel">
                <div class="uc-1-menambahkan-view-proses-insiden-view-artikel">
                    <div class="uc-1-menambahkan-view-proses-insiden-view-artikel-view-proses-insiden">

                        <div class="uc-1-menambahkan-view-proses-insiden-view-artikel-view-proses-insiden-header">
                            <h2>{{ $insiden->master_odps->nama_instansi }}</h2>
                            <div class="uc-1-menambahkan-view-proses-insiden-view-artikel-button">
                                <div class="uc-1-menambahkan-view-proses-insiden-view-artikel-button-list">
                                    <a href="{{ route('proses-insiden') }}"><button type="button">Back</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="uc-1-menambahkan-view-proses-insiden-view-artikel-view-proses-insiden-content">
                            <h3>Jenis Insiden: {{ $insiden->jenis_insidens->nama_insiden }}</h3>
                            <h4>URL: {{ $insiden->url_insiden }}</h4>
                            @if ($insiden->nomor_surat_tte_insiden == null)
                                <p>Nomor Surat TTE: -</p>
                            @else
                                <p>Nomor Surat TTE: {{ $insiden->nomor_surat_tte_insiden }} / {{ $insiden->tanggal_surat_tte_insiden }}</p>
                            @endif

                            <div class="uc-1-menambahkan-view-proses-insiden-temuan">
                                <p>Tanggal Notifikasi Insiden: {{ $insiden->tanggal_notifikasi_insiden }}</p>
                                <p>Jam Insiden ditemukan: {{ $insiden->jam_temuan_insiden }}</p>
                                <p>Jam temuan Insiden dikirim: {{ $insiden->jam_temuan_dikirim_insiden }}</p>
                            </div>

                            <div class="uc-1-menambahkan-view-proses-insiden-status">
                                <p>Resiko Insiden: {{ $insiden->resiko_insiden }}</p>
                                <p>Status Insiden: {{ $insiden->status_insiden }}</p>
                                @if ($insiden->status_setelah_unsuspend_insiden !== null)
                                    <p>Status setelah unsuspend Insiden: {{ $insiden->status_setelah_unsuspend_insiden }}</p>
                                @endif
                                @if ($insiden->tanggal_suspend_insiden !== null)
                                    <p>Tanggal suspend Insiden: {{ $insiden->tanggal_suspend_insiden }}</p>
                                @endif
                            </div>


                            <div class="uc-1-menambahkan-view-proses-insiden-selesai">
                                @if ($insiden->tanggal_insiden_diselesaikan !== null)
                                    <p>Tanggal Insiden diselesaikan: {{ $insiden->tanggal_insiden_diselesaikan }}</p>
                                    <p>Jam Insiden diselesaikan: {{ $insiden->jam_insiden_diselesaikan }}</p>
                                @endif
                            </div>

                            <div class="uc-1-menambahkan-view-proses-insiden-keterangan">
                                <p>Keterangan:</p>
                                <p>{{ $insiden->keterangan_insiden }}</p>
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
