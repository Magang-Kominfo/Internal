<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/user-management-css/daftarUserManagement-admin.css">
    <title>Admin- User Management</title>
</head>

<script>

    // Filter and Search
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const rows = document.querySelectorAll(".admin-user-management-tabel tbody tr");

        searchInput.addEventListener("input", function() {
            const searchTerm = searchInput.value.toLowerCase();
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
        });

    // notifikasi
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.deleteButton').forEach(button => {
            button.addEventListener('click', function () {
                const modal = this.closest('tr').querySelector('.deleteConfirm');
                modal.style.display = "block";
            });
        });

        document.querySelectorAll('.admin-delete-confirm-close, .cancelButton').forEach(button => {
            button.addEventListener('click', function () {
                const modal = this.closest('.deleteConfirm');
                modal.style.display = "none";
            });
        });

        window.addEventListener('click', function (event) {
            document.querySelectorAll('.deleteConfirm').forEach(modal => {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });
        });
    });

</script>

<body>
    <div class="admin-user-management">

        <div class="admin-user-management-main">
            <div class="admin-user-management-header">
                <div>
                    <a href="{{ route('admin') }}"><img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo"></a>
                </div>
                <div class="admin-user-management-header-top-right">
                    <h1>ADMIN</h1>
                </div>
            </div>

            <div class="admin-user-management-artikel">
                <div class="admin-user-management-artikel-title">
                    <h1>USER MANAGEMENT</h1>
                </div>

                <div class="admin-user-management-artikel-header">
                    <input class="admin-user-management-artikel-search" type="text" id="searchInput" placeholder="Cari...">

                    <div class="admin-user-management-artikel-button">
                        <a href="{{ route('tambah-user') }}"><button>Tambah User</button></a>
                    </div>
                </div>

                <div class="admin-user-management-artikel-view">
                    <table class="admin-user-management-tabel">
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td class="admin-tabel-id-data">ID User: {{ $user->id_user }}</td>
                                <td class="admin-tabel-nama-data">Nama: {{ $user->nama_user }}</td>
                                <td class="admin-tabel-role-data">Role: Admin {{ $user->role }}</td>
                                <td class="admin-tabel-proses-data">
                                    <div class="admin-tabel-proses-data-proses">
                                        <div>
                                            <a href="{{ route('edit-user-management', ['id' => $user->id_user]) }}"><button class="admin-tabel-proses-data-edit">Edit</button></a>
                                        </div>

                                        <div class="deleteForm">
                                            <button type="button" class="deleteButton admin-tabel-proses-data-delete">Hapus</button>
                                        </div>

                                        <div class="deleteConfirm admin-detele-confirm">
                                            <div class="admin-delete-confirm-content">
                                              <div class="admin-delete-confirm-header">
                                                <span class="admin-delete-confirm-close">&times;</span>
                                                <h2>Konfirmasi Hapus</h2>
                                              </div>
                                              <div class="admin-delete-confirm-body">
                                                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                              </div>
                                              <div class="admin-delete-confirm-footer">
                                                <button class="cancelButton admin-delete-confirm-batal">Batal Hapus</button>
                                                    <form action="{{ route('delete-user.softDelete', ['id' => $user->id_user]) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="admin-delete-confirm-hapus">Hapus</button>
                                                    </form>
                                              </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
