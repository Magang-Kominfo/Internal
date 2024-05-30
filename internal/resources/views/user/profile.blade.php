<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="../css/user/style.css">
</head>

<body id="bodyProfile" style="background-color:#F1F1F3; display:flex; flex-direction:column; gap:50px">

    <nav class="navbar">
        <div class="container-fluid" >
            <img class="logoKominfo-uc-3" src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
        </div>
    </nav>

    <div id="content-profile" class="mx-4" width style="background-color: white; padding-bottom:50px; padding-top:25px; border-radius: 10px;display:flex; flex-direction:column;" >
        <div class="judul text-center">
            <h3>User Profile</h3>
        </div>

        <div class="text-center mb-3">
            <h4 style="font-size: 16px;text-align: center">User ID: {{ $user->id_user }}</h4>
        </div>

        <form id="formHeader" class="form-profile d-flex flex-column justify-content-center align-items-center" action="{{ route('user-profile.update') }}" method="POST" >
            @csrf
            @method("PUT")
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nama_user" name="nama_user" value="{{ $user->nama_user }}" placeholder="" style="border:1px solid #34469A;">
                    <label for="nama">Nama User</label>
                    <div class="error"></div>
                </div>
                <button type="button" id="change_password" class="profile-change-button-password">
                    Make A New Password
                </button>
                <div class="profile-password-input">
                    <div class="form-floating mb-3 user-password">
                        <input type="password" class="form-control" id="password" name="password" value="" placeholder="" style="border:1px solid #34469A">
                        <label for="password">Password</label>
                        <i class="far fa-eye-slash" id="togglePassword"></i>
                        <div class="error"></div>
                    </div>
                    <div class="form-floating mb-3 user-password">
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" placeholder="" style="border:1px solid #34469A">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="error"></div>
                        <i class="far fa-eye-slash" id="toggleConfirmPassword"></i>
                    </div>
                </div>
                <div class="footer d-flex justify-content-between gap-2">
                    @if(auth()->check() && auth()->user()->is_admin == true)
                        <a href="{{ route('admin') }}"><div type="back" class="btn btn-secondary mt-4 min-col-2">Back</div></a>

                    @elseif(auth()->check() && substr(auth()->user()->id_user, 0, 2) === '10')
                        <a href="{{ route('dashboard-insiden') }}"><div type="back" class="btn btn-secondary mt-4 min-col-2">Back</div></a>

                    @elseif(auth()->check() && substr(auth()->user()->id_user, 0, 2) === '20')
                        <a href="{{ route('dashboard-berita') }}"><div type="back" class="btn btn-secondary mt-4 min-col-2">Back</div></a>

                    @elseif(auth()->check() && substr(auth()->user()->id_user, 0, 2) === '30')
                        <a href="{{ route('dbaset-uc-3') }}"><div type="back" class="btn btn-secondary mt-4 min-col-2">Back</div></a>

                    @endif
                    <button id="saveBtn" type="submit" class="btn btn-primary mt-4 min-col-2">Update</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
            const confirmPassword = document.querySelector('#confirm_password');
            togglePassword.addEventListener('click', function (e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            toggleConfirmPassword.addEventListener('click', function (e) {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);

                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            const togglePasswordButton = document.getElementById('change_password');
            togglePasswordButton.addEventListener('click', function (e) {
                const password = document.getElementById('password');
                const confirm_password = document.getElementById('confirm_password');
                const passwordInputContainer = document.querySelector('.profile-password-input');
                if (passwordInputContainer.style.display === 'none' || passwordInputContainer.style.display === '') {
                    Swal.fire({
                        title: 'Enter Password',
                        html: `
                            <input type="password" class="form-control" id="password_swal" name="password_swal" value="" placeholder="" style="border:1px solid #34469A">
                        `,
                        focusConfirm: false,
                        preConfirm: () => {
                            const password = Swal.getPopup().querySelector('#password_swal').value;
                            if (!password) {
                                Swal.showValidationMessage(`Masukkan password Anda!`);
                                return false;
                            }
                            // Kirim password ke backend
                            return fetch('/validate-password', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: JSON.stringify({ password: password })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(response.statusText);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.valid) {
                                    return true; // Password matches
                                } else {
                                    Swal.showValidationMessage(`Password tidak sesuai!`);
                                    return false;
                                }
                            })
                            .catch(error => {
                                Swal.showValidationMessage(`Request failed: ${error.message}`);
                                return false;
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Password is validated, show password input fields
                            passwordInputContainer.style.display = 'block';
                            Swal.fire("Success!", "Silakan isi data password baru!", "success");
                        }
                    });
                } else {
                    const password = document.getElementById('password');
                    const confirmPassword = document.getElementById('confirm_password');
                    password.value = '';
                    confirmPassword.value = '';
                    passwordInputContainer.style.display = 'none';
                }
                });

            $("#formHeader").on('submit', function(e) {
                e.preventDefault();
                $("#saveBtn").html('Menyimpan...').attr('disabled', 'disabled');
                const nama_user = document.getElementById('nama_user');
                const password = document.getElementById('password');
                const confirm_password = document.getElementById('confirm_password');
                const setError = (element, message) => {
                    const inputControl = element.closest('.form-floating');
                    const errorDisplay = inputControl.querySelector('.error');
                    errorDisplay.innerText = message;
                    errorDisplay.classList.add('active');
                };
                const setSuccess = (element) => {
                    const inputControl = element.closest('.form-floating');
                    const errorDisplay = inputControl.querySelector('.error');
                    if (errorDisplay) {
                        errorDisplay.innerText = '';
                        errorDisplay.classList.remove('active');
                    }
                };
                const validateInputs = () => {
                    let allInputsAreValid = true;
                    if (nama_user.value.trim() === '') {
                        setError(nama_user, 'Masukkan nama yang sesuai');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(nama_user);
                    }
                    if (password.value.trim() === '') {
                        setSuccess(password);
                    } else{
                        if(password.value.length < 8){
                        setError(password, 'Pastikan password terdiri dari 8 karakter');
                        allInputsAreValid = false;
                        } else{
                            if(password.value.trim()!==confirm_password.value.trim()){
                                setError(password, "Password & Confirm password tidak cocok!");
                                allInputsAreValid = false;
                            }
                            else
                            setSuccess(password);
                        }
                    }
                    // Confirm Password
                    if(password.value.trim()!==confirm_password.value.trim()){
                        setError(confirm_password, "Password & Confirm password tidak cocok!");
                        allInputsAreValid = false;

                    } else {
                        setSuccess(confirm_password);

                    }
                    return allInputsAreValid;
                };
                const allInputsAreValid = validateInputs();
                if (!allInputsAreValid) {
                    console.log("gagal");
                    Swal.fire({
                        title: "Error!",
                        text: "Terdapat kesalahan dalam pengisian formulir, mohon periksa kembali.",
                        icon: "error",
                        button: "OK",
                    });
                    $("#saveBtn").html('Simpan kembali').removeAttr('disabled');
                    return;
                } else {
                    // Lakukan pengiriman data jika semua input valid
                    $("#saveBtn").html('Memindahkan halaman...').removeAttr('disabled');
                    this.submit();
                    swal.fire("Success!", "Data berhasil disimpan!", "success");

                }
            });
        });

    </script>
</body>
</html>
