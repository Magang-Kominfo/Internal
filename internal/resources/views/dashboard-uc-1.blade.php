<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/dashboard-uc-1.css">
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
                    <img src="" alt="profile">
                </div>
                <div>
                    <a href="{{ route('dashboard') }}"><h2>Dashboard</h2></a>
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
                        <a href="{{ route('daftar-insiden') }}"><li>Daftar Insiden</li></a>
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
                            <h4>View All</h4>
                        </div>

                        <div class="uc-1-dashboard-view-artikel-insiden-view">
                            <div class="uc-1-dashboard-view-artikel-insiden-view-header">
                                <h4 style="margin: 0">Header Insiden</h4>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-insiden-view-date">
                                <p style="margin: 0">20 Maret 2024</p>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-insiden-view-deskripsi">
                                <p style="margin: 15px 0px 0px 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget sagittis libero. Vestibulum facilisis, dolor sit amet gravida convallis, odio urna condimentum metus, vel ultrices quam nunc sed ante. </p>
                            </div>
                        </div>

                        <div class="uc-1-dashboard-view-artikel-insiden-view">
                            <div class="uc-1-dashboard-view-artikel-insiden-view-header">
                                <h4 style="margin: 0">Header Insiden</h4>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-insiden-view-date">
                                <p style="margin: 0">20 Maret 2024</p>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-insiden-view-deskripsi">
                                <p style="margin: 15px 0px 0px 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget sagittis libero. Vestibulum facilisis, dolor sit amet gravida convallis, odio urna condimentum metus, vel ultrices quam nunc sed ante. </p>
                            </div>
                        </div>

                        <div class="uc-1-dashboard-view-artikel-insiden-view">
                            <div class="uc-1-dashboard-view-artikel-insiden-view-header">
                                <h4 style="margin: 0">Header Insiden</h4>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-insiden-view-date">
                                <p style="margin: 0">20 Maret 2024</p>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-insiden-view-deskripsi">
                                <p style="margin: 15px 0px 0px 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget sagittis libero. Vestibulum facilisis, dolor sit amet gravida convallis, odio urna condimentum metus, vel ultrices quam nunc sed ante. </p>
                            </div>
                        </div>

                        <div class="uc-1-dashboard-view-artikel-insiden-footer">
                            <p>More...</p>
                        </div>
                    </div>

                    <div class="uc-1-dashboard-view-artikel-aset-aplikasi">
                        <div class="uc-1-dashboard-view-artikel-aset-aplikasi-header">
                            <h1>ASET APLIKASI</h1>
                            <h4>View All</h4>
                        </div>

                        <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view">
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-header">
                                <h4 style="margin: 0">Header Aset Aplikasi</h4>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-date">
                                <p style="margin: 0">20 Maret 2024</p>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-deskripsi">
                                <p style="margin: 15px 0px 0px 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget sagittis libero. Vestibulum facilisis, dolor sit amet gravida convallis, odio urna condimentum metus, vel ultrices quam nunc sed ante.</p>
                            </div>
                        </div>

                        <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view">
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-header">
                                <h4 style="margin: 0">Header Aset Aplikasi</h4>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-date">
                                <p style="margin: 0">20 Maret 2024</p>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-deskripsi">
                                <p style="margin: 15px 0px 0px 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget sagittis libero. Vestibulum facilisis, dolor sit amet gravida convallis, odio urna condimentum metus, vel ultrices quam nunc sed ante.</p>
                            </div>
                        </div>

                        <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view">
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-header">
                                <h4 style="margin: 0">Header Aset Aplikasi</h4>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-date">
                                <p style="margin: 0">20 Maret 2024</p>
                            </div>
                            <div class="uc-1-dashboard-view-artikel-aset-aplikasi-view-deskripsi">
                                <p style="margin: 15px 0px 0px 0px">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget sagittis libero. Vestibulum facilisis, dolor sit amet gravida convallis, odio urna condimentum metus, vel ultrices quam nunc sed ante.</p>
                            </div>
                        </div>

                        <div class="uc-1-dashboard-view-artikel-aset-aplikasi-footer">
                            <p>More...</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</body>
</html>
