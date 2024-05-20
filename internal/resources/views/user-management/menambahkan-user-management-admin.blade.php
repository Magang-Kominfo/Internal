<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/user-management-css/menambahkanUserManagement-admin.css">
    <title>Menambahkan User</title>
</head>

<body>
    <div class="admin-user-management">

        <div class="admin-user-management-main">
            <div class="admin-user-management-header">
                <div>
                    <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
                </div>
            </div>

            <div class="admin-user-management-artikel">
                <div class="admin-user-management-view-artikel">
                    <div class="admin-user-management-view-artikel-content">
                        <div class="admin-user-management-view-artikel-content-header">
                            <h1>MENAMBAHKAN USER</h1>
                        </div>

                        <form action="{{ route('tambah-user.post') }}" method="post">
                        @csrf
                            <div class="admin-user-management-input-field">
                                <div class="admin-user-management-input-field-id">
                                    <label for="id_user">ID User:</label>
                                    <input type="text" name="id_user" id="id_user" >
                                </div>

                                <div class="admin-user-management-input-field-role">
                                    <label for="role">Role:</label>
                                    <select name="role" id="role">
                                            <option value="">Pilih Role</option>
                                                <option value="insiden">1. Insiden</option>
                                                <option value="berita">2. Berita</option>
                                                <option value="aset">3. Aset</option>
                                    </select>
                                </div>

                                <div class="admin-user-management-input-field-password">
                                    <label for="password">Password:</label>
                                    <input type="text" name="password" id="password" >
                                </div>
                            </div>



                            <div class="admin-user-management-view-artikel-footer">
                                <div class="admin-user-management-view-artikel-footer-back">
                                    <a href="{{ route('user-management') }}"><button type="button">Back</button></a>
                                </div>

                                <div class="admin-user-management-view-artikel-footer-save">
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
