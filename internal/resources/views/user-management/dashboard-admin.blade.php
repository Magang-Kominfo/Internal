<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/user-management-css/dashboardAdmin.css">
    <title>Admin - Dashboard</title>
</head>

<style>
    .admin-header-top-right button{
        padding: 10px 15px 10px 15px;
        font-weight: bold;
        font-size: 20px;
        border-radius: 5px;
        border: 1px solid black;
    }

    .admin-header-top-right button:hover{
        background-color:#c6c6c6;
        border: 2px solid #c6c6c6;
    }
</style>

<body>
    <div class="admin">

        <div class="admin-main">
            <div class="admin-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
                <div class="admin-header-top-right">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="cursor: pointer">Log Out</button>
                    </form>
                </div>
            </div>

            <div class="admin-artikel">
                <div class="admin-artikel-title">
                    <h1>DASHBOARD ADMIN</h1>
                </div>



                <div class="admin-artikel-view">
                    <a href="{{ route('dashboard-insiden') }}" class="admin-artikel-view-box">
                        <div class="admin-artikel-box">
                            <div class="admin-artikel-logo"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6.012 18H21V4a2 2 0 0 0-2-2H6c-1.206 0-3 .799-3 3v14c0 2.201 1.794 3 3 3h15v-2H6.012C5.55 19.988 5 19.805 5 19s.55-.988 1.012-1M8 6h9v2H8z"/></svg></div>
                            <div class="admin-artikel-title">INSIDEN</div>
                        </div>
                    </a>

                    <a href="{{ route('dashboard-berita') }}" class="admin-artikel-view-box">
                        <div class="admin-artikel-box">
                            <div class="admin-artikel-logo"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M16.75 4a2.25 2.25 0 0 1 2.245 2.096L19 6.25V17.5a.5.5 0 0 0 .992.09L20 17.5V7.014a2.25 2.25 0 0 1 1.994 2.072L22 9.25v7.5a3.25 3.25 0 0 1-3.066 3.245L18.75 20H5.25a3.25 3.25 0 0 1-3.245-3.066L2 16.75V6.25a2.25 2.25 0 0 1 2.096-2.245L4.25 4zm-7.502 7h-3.5a.75.75 0 0 0-.75.75v3.5c0 .414.336.75.75.75h3.5a.75.75 0 0 0 .75-.75v-3.5a.75.75 0 0 0-.75-.75m6.004 3.5h-2.498l-.102.007A.75.75 0 0 0 12.754 16h2.498l.102-.007a.75.75 0 0 0-.102-1.493m-6.754-2v2h-2v-2zM15.25 11l-2.498.005l-.102.006a.75.75 0 0 0 .104 1.494l2.499-.005l.101-.007A.75.75 0 0 0 15.251 11m.001-3.496H5.748l-.102.007a.75.75 0 0 0 .102 1.493h9.504l.102-.006a.75.75 0 0 0-.102-1.494"/></svg></div>
                            <div class="admin-artikel-title">BERITA</div>
                        </div>
                    </a>

                    <a href="{{ route('dbaset-uc-3') }}" class="admin-artikel-view-box">
                        <div class="admin-artikel-box">
                            <div class="admin-artikel-logo"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M3 6.25A3.25 3.25 0 0 1 6.25 3h11.5A3.25 3.25 0 0 1 21 6.25v11.5A3.25 3.25 0 0 1 17.75 21H6.25A3.25 3.25 0 0 1 3 17.75zm3.75.5a.75.75 0 0 0 0 1.5h10.5a.75.75 0 0 0 0-1.5z"/></svg></div>
                            <div class="admin-artikel-title">ASET</div>
                        </div>
                    </a>

                    <a href="{{ route('user-management') }}" class="admin-artikel-view-box">
                        <div class="admin-artikel-box">
                            <div class="admin-artikel-logo"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><circle cx="12" cy="6" r="4" fill="currentColor"/><path fill="currentColor" d="M20 17.5c0 2.485 0 4.5-8 4.5s-8-2.015-8-4.5S7.582 13 12 13s8 2.015 8 4.5"/></svg></div>
                            <div class="admin-artikel-title">USER MANAGEMENT</div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
