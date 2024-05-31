<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/berita/form-koresponden.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Memperbaharui Koresponden</title>
</head>

<body>
    <div class="uc-2-main">

        {{-- header --}}
        <div class="uc-2-header">
            <div>
                <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo" class="logo">
            </div>

            <div class="uc-2-right-header">
                <a class="uc-2-user-navigate" onclick="menuToggle()">
                    <img src="{{ asset('assets/userProf.svg') }}" alt="Kominfo" class="user" >
                </a>
                {{-- Menu --}}
                <div class="uc-2-dropdown-user">
                    <div class="uc-2-username">
                        <span class="uc-2-name">
                            {{ $user->id_user }}
                        </span>
                        <span class="uc-2-role">
                            {{ $user->nama_user }}
                        </span>
                    </div>
                    <ul>
                        <li>
                            <a href="{{ route('user-profile') }}">
                            <button>Profil</button>
                            </a>
                        </li>
                        @if(auth()->check() && auth()->user()->is_admin == true)
                            <li>
                                <a href="{{ route('admin') }}">
                                <button>Admin Dashboard</button>
                                </a>
                            </li>
                        @else
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" >Log Out</button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        {{-- body --}}
        <div class="uc-2-form-main">
            <div class="uc-2-form-berita-main">

                {{-- back --}}
                <div class="uc-2-back-navigation">
                    <div class="uc-2-back-btn">
                        <object
                            data="{{ asset('assets/back-btn.svg') }}"
                            type=""
                        ></object>
                        <a href="{{ url('form-koresponden') }}" style="text-decoration: none"><h2>KEMBALI</h2></a>
                    </div>
                    <div class="uc-2-nav-description">
                        <div class="uc-2-nav-description-route">MENDAFTARKAN KORESPONDEN</div>
                    </div>
                </div>

                <h4>
                    Pastikan data surat berita sesuai dengan keterangan dalam surat.
                    Isi data berita dan pilih koresponden yang akan dituju. Ingat untuk
                    meng-update kembali waktu respon oleh penerima.
                </h4>

                {{-- Main form --}}
                <form id="formKoresponden" action="{{ route('koresponden.update', $koresponden->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="uc-2-input-field" id="extra-email">
                        {{-- first layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-1">
                                <label for="nama_koresponden">Nama koresponden</label>
                                <input type="text" name="nama_koresponden" id="nama_koresponden"
                                placeholder="Kominfo Jawa Timur" value="{{ $koresponden->nama_koresponden }}">
                                <div class="error"></div>
                            </div>
                        </div>

                        {{-- second layer --}}
                        @foreach($koresponden->emails as $index => $email)
                            <div class="uc-2-first-layer-form">
                                <div class="uc-2-first-layer-form-1">
                                    <label for="email">Email Koresponden</label>
                                    <input type="text" name="email[{{ $index }}]" id="email"
                                        placeholder="Kominfojatim@Kominfo.id" value="{{ $email->nama_email }}">
                                    <input type="hidden" name="email_id[]" value="{{ $email->id }}">
                                    <div class="error"></div>
                                </div>
                                <div class="uc-2-first-layer-form-2">
                                    <label for="tipeemail">Tipe Email</label>
                                    <select id="tipe_email" name="tipe_email[]">
                                        <option id="email_instansi" value="0" {{ $email->tipe_email == 0 ? 'selected' : '' }}>Email Instansi</option>
                                        <option id="email_pribadi" value="1" {{ $email->tipe_email == 1 ? 'selected' : '' }}>Email Pribadi</option>
                                    </select>
                                </div>
                                <div class="uc-2-first-layer-form-2">
                                    @if($index == 0)
                                        <label for="addButton">Action</label>
                                        <button type="button" class="addButton">Add</button>
                                    @else
                                        <label for="removeButton">Action</label>
                                        <button type="button" class="removeButton" data-index="{{ $index }}">Remove</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="uc-2-form-footer">
                        <div class="uc-2-form-footer-save">
                            <button id="saveBtn" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        const addButtons = document.querySelectorAll(".uc-2-first-layer-form .uc-2-first-layer-form-2 .addButton");

        addButtons.forEach(function (e) {
            e.addEventListener('click', function () {

                let newElement = document.createElement('div');
                newElement.classList.add('uc-2-first-layer-form');

                newElement.innerHTML = `
                <div class="uc-2-first-layer-form-1">
                    <label for="email">Email Koresponden</label>
                    <input type="text" name="email[]" id="email" placeholder="Kominfojatim@Kominfo.id">
                    <div class="error"></div>
                </div>
                <div class="uc-2-first-layer-form-2">
                    <label for="tipeemail">Tipe Email</label>
                    <select id="tipe_email" name="tipe_email[]">
                        <option id="email_instansi" value="0">Email Instansi</option>
                        <option id="email_pribadi" value="1">Email Pribadi</option>
                    </select>
                </div>
                <div class="uc-2-first-layer-form-2">
                    <label for="removeButton">Action</label>
                    <button type="button" class="removeButton">Remove</button>
                </div>`;

                document.getElementById('extra-email').appendChild(newElement);

                callEvent();

            });
        });


        function callEvent() {
            document.querySelector('form').querySelectorAll('.removeButton').forEach(function (remove) {
                remove.addEventListener('click', function (elmClick) {
                    // Memeriksa apakah tombol "Remove" memiliki ID
                    const elementToRemove = elmClick.target.parentElement.parentElement;
                    confirmDelete(elementToRemove);
                });
            });
        }

        function confirmDelete(elementToRemove) {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: `Data akan terhapus dari tampilan, tetapi belum terhapus hingga database.
                Kembali atau muat ulang halaman jika anda tidak jadi melakukan perubahan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi penghapusan, hapus elemen dari DOM
                    elementToRemove.remove();
                }
            })
        }



        // Panggil callEvent untuk pertama kali saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function () {
            callEvent();
        });

        $("#formKoresponden").on('submit', function(e) {
                e.preventDefault();

                $("#saveBtn").html('Menyimpan...').attr('disabled', 'disabled');

                const nama = document.getElementById('nama_koresponden');
                const emailInputs = document.querySelectorAll('input[name="email[]"]');


                const setError = (element, message) => {
                    const inputControl = element.closest('.uc-2-first-layer-form-1') || element.closest('uc-2-first-layer-form');
                    const errorDisplay = inputControl.querySelector('.error');

                    errorDisplay.innerText = message;
                    errorDisplay.classList.add('active');
                };

                const setSuccess = (element) => {
                    const inputControl = element.closest('.uc-2-first-layer-form-1') || element.closest('uc-2-first-layer-form');
                    const errorDisplay = inputControl.querySelector('.error');

                    if (errorDisplay) {
                        errorDisplay.innerText = '';
                        errorDisplay.classList.remove('active');
                    }
                };

                const isValidEmail = email => {
                    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
                };

                const validateInputs = () => {
                    let allInputsAreValid = true;

                    if (nama.value.trim() === '') {
                        setError(nama, 'Masukkan Nama Koresponden');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(nama);
                    }

                    emailInputs.forEach(emailInput => {
                        if (emailInput.value.trim() === '') {
                            setError(emailInput, 'Masukkan Email Koresponden');
                            allInputsAreValid = false;
                        } else if (!isValidEmail(emailInput.value.trim())) {
                            setError(emailInput, 'Pastikan Email Sesuai Format');
                            allInputsAreValid = false;
                        } else {
                            setSuccess(emailInput);
                        }
                    });

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
                    console.log("sudah disumbit");

                    e.currentTarget.submit();

                    swal.fire("Success!", "Data berhasil disimpan!", "success");

                    // Implementasi pengiriman data bisa dilakukan di sini

                }
            });

        function menuToggle(){
            const toggleMenu = document.querySelector('.uc-2-dropdown-user');
            toggleMenu.classList.toggle('active');
        }

    </script>





</body>
</html>
