<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/user-management-css/dashboardAdmin.css">
    <title>Admin - Dashboard</title>
</head>

<body>
    <div class="admin">

        <div class="admin-main">
            <div class="admin-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
                <div class="admin-header-top-right">
                    <h1>ADMIN</h1>
                </div>
            </div>

            <div class="admin-artikel">
                <div class="admin-artikel-title">
                    <h1>DASHBOARD</h1>
                </div>



                <div class="admin-artikel-view">
                    <a href="{{ route('dashboard') }}" class="admin-artikel-view-box">
                        <div class="admin-artikel-box">
                            <div class="admin-artikel-logo">Logo</div>
                            <div class="admin-artikel-title">INSIDEN</div>
                        </div>
                    </a>

                    <a href="#" class="admin-artikel-view-box">
                        <div class="admin-artikel-box">
                            <div class="admin-artikel-logo">Logo</div>
                            <div class="admin-artikel-title">BERITA</div>
                        </div>
                    </a>

                    <a href="#" class="admin-artikel-view-box">
                        <div class="admin-artikel-box">
                            <div class="admin-artikel-logo">Logo</div>
                            <div class="admin-artikel-title">ASET</div>
                        </div>
                    </a>

                    <a href="{{ route('user-management') }}" class="admin-artikel-view-box">
                        <div class="admin-artikel-box">
                            <div class="admin-artikel-logo">Logo</div>
                            <div class="admin-artikel-title">USER MANAGEMENT</div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
