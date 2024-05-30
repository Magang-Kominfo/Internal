<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/insiden-dan-aset-aplikasi-css/dashboard-uc-1.css">
    <title>Dashboard Insiden dan Aset Aplikasi</title>
</head>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const menuItems = document.querySelectorAll(".uc-1-dashboard-menu-item");

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
    <div class="uc-1-dashboard">
        <div class="uc-1-dashboard-sidebar">
            <div class="uc-1-dashboard-sidebar-content">
                <div class="uc-1-dashboard-sidebar-content-profile">
                    <a href="{{ route('user-profile') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg>
                    </a>
                </div>
                <div>
                    <a href="{{ route('dashboard-insiden') }}"><h2>Dashboard</h2></a>
                </div>
                <div class="uc-1-dashboard-menu-item">
                    <h2>Aset Aplikasi</h2>
                    <ul class="uc-1-dashboard-menu-item-submenu">
                        <a href="{{ route('aset-aplikasi') }}"><li>Daftar Aset Aplikasi</li></a>
                        <a href="{{ route('kategori-aset-aplikasi') }}"><li>Kategori Aset Aplikasi</li></a>
                    </ul>
                </div>
                <div class="uc-1-dashboard-menu-item">
                    <h2>Insiden</h2>
                    <ul class="uc-1-dashboard-menu-item-submenu">
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

        <div class="uc-1-dashboard-main">
            <div class="uc-1-dashboard-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
                <div class="uc-1-dashboard-header-top-right">
                    <h1>Welcome</h1>
                </div>
            </div>

            <div class="uc-1-dashboard-artikel">
                <div class="uc-1-dashboard-view-artikel">
                    <div class="uc-1-dashboard-view-artikel-insiden">
                        <div class="uc-1-dashboard-view-artikel-insiden-header">
                            <h1>INSIDEN</h1>
                            <a href="{{ route('proses-insiden') }}"><h4>View All</h4></a>
                        </div>

                        @foreach ($insidens as $insiden)

                        <div class="uc-1-dashboard-view-artikel-insiden-view">
                            <a class="uc-1-dashboard-view-artikel-insiden-view-item" href="{{ route('view-proses-insiden', ['id' => $insiden->insiden_id]) }}">
                                <div class="uc-1-dashboard-view-artikel-insiden-view-header">
                                    <h4 style="margin: 0">{{ $insiden->jenis_insidens->nama_insiden }}</h4>
                                    <p>{{ $insiden->master_odps->nama_instansi }}</p>
                                </div>
                                <div class="uc-1-dashboard-view-artikel-insiden-view-date">

                                    <p style="margin: 0">Created at: {{ $insiden->created_at }}</p>
                                    <p style="margin: 0">Updated at: {{ $insiden->updated_at }}</p>
                                    @if ($insiden->tanggal_insiden_diselesaikan !== null)
                                        <p style="margin: 0">Tanggal Insiden diselesaikan: {{ $insiden->tanggal_insiden_diselesaikan }}</p>
                                        <p style="margin: 0">Jam Insiden diselesaikan: {{ $insiden->jam_insiden_diselesaikan }}</p>
                                    @endif

                                    <p style="margin: 0px"> Resiko: {{ $insiden->resiko_insiden }}</p>
                                    <p style="margin: 0px"> Status: {{ $insiden->status_insiden }}</p>
                                </div>
                                <div class="uc-1-dashboard-view-artikel-insiden-view-deskripsi">
                                    <p style="margin: 15px 0px 0px 0px">Keterangan:</p>
                                    <p>{{ $insiden->keterangan_insiden }} </p>
                                </div>
                            </a>
                        </div>

                        @endforeach



                        <div class="uc-1-dashboard-view-artikel-insiden-footer">
                            <a href="{{ route('proses-insiden') }}"><p>More...</p></a>
                        </div>
                    </div>

                    <div class="uc-1-dashboard-view-artikel-aset-aplikasi">
                        <div class="uc-1-dashboard-view-artikel-aset-aplikasi-header">
                            <h1>ASET APLIKASI</h1>
                            <a href="{{ route('aset-aplikasi') }}"><h4>View All</h4></a>
                        </div>

                        @foreach ($aset_aplikasis as $aset_aplikasi)

                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view">
                                <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-header">
                                    <h4 style="margin: 0">{{ $aset_aplikasi->nama_aset_aplikasi }}</h4>
                                    <p>{{ $aset_aplikasi->jenis_kategoris->nama_jenis_kategori }}</p>
                                </div>
                                <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-date">
                                    <p style="margin: 0">Created at: {{ $aset_aplikasi->created_at }}</p>
                                    <p style="margin: 0">Updated at: {{ $aset_aplikasi->updated_at }}</p>
                                </div>
                            </div>

                        @endforeach

                        <div class="uc-1-dashboard-view-artikel-aset-aplikasi-footer">
                            <a href="{{ route('aset-aplikasi') }}"><h4><p>More...</p></h4></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</body>
</html>
