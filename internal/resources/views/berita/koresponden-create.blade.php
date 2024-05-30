<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/berita/form-koresponden.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Menambahkan Koresponden</title>
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
                                <button>Back</button>
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
                <form id="formKoresponden" action="{{ route('koresponden.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="uc-2-input-field" id="extra-email">
                        {{-- first layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-1">
                                <label for="nama_koresponden">Nama koresponden</label>
                                <input type="text" name="nama_koresponden" id="nama_koresponden" placeholder="Kominfo Jawa Timur">
                                <div class="error"></div>
                            </div>
                        </div>

                        {{-- second layer --}}
                        <div class="uc-2-first-layer-form">
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
                                <label for="addButton">Action</label>
                                <button type="button" id="addButton" class="addButton">Add</button>
                            </div>
                        </div>

                    </div>

                    <div class="uc-2-form-footer">
                        <div class="uc-2-form-footer-save">
                            <button id="saveBtn" type="submit">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        const addButtons  = document.querySelectorAll(".uc-2-first-layer-form .uc-2-first-layer-form-2 .addButton")

        addButtons.forEach(function(e) {
            e.addEventListener('click', function () {
                let parent1 = this.parentElement;
                let element = parent1.parentElement;
                console.log(element);

                let newElement = document.createElement('div')
                    newElement.classList.add('uc-2-first-layer-form')
                    newElement.innerHTML =
                        `<div class="uc-2-first-layer-form-1">
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
                            <button type="button" id="removeButton" class="removeButton">Remove</button>
                        </div>`

                document.getElementById('extra-email').appendChild(newElement);
                document.querySelector('form').querySelectorAll('.removeButton')
                .forEach(function (remove) {
                    remove.addEventListener( 'click' , function(elmClick) {
                        elmClick.target.parentElement.parentElement.remove();
                    })
                })
            });
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

                    swal.fire("Success!", "Data berhasil disimpan!", "success");

                    // Implementasi pengiriman data bisa dilakukan di sini
                    this.submit();
                }
            });


        function menuToggle(){
            const toggleMenu = document.querySelector('.uc-2-dropdown-user');
            toggleMenu.classList.toggle('active');
        }


    </script>



</body>
</html>
