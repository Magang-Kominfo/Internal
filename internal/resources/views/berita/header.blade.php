<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/berita/header.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Halaman Edit Pengiriman dan Header</title>
</head>

<body>
    <div class="uc-2-main">

        {{-- header --}}
        <div class="uc-2-header">
            <div>
                <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo" class="logo">
            </div>
            {{-- Toggle User profile dan back --}}
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
                    <a href="{{ route('koresponden.index', ['id_berita' => $data->id_berita]) }}" style="text-decoration: none;">
                        <div class="uc-2-back-btn" style="display: flex; align-items: center;">
                            <img class="uc-2-back-button" src="{{ asset('assets/back-btn.svg') }}" alt="Back Button">
                            <h2 style="text-decoration: none; margin-right: 8px;">KEMBALI</h2>
                        </div>
                    </a>
                    <div class="uc-2-nav-description">
                        <div class="uc-2-nav-description-route">Deskripsi koresponden</div>
                    </div>
                </div>

                <h4 style="text-align: justify">
                    Pastikan data surat berita sesuai dengan keterangan dalam surat.
                    Isi data berita dan pilih koresponden yang akan dituju. Ingat untuk
                    meng-update kembali waktu respon oleh penerima.
                </h4>

                {{-- Main form --}}
                <form id="formHeader" action="{{ route('mengirim.edit' , ['id_berita' => $data->id_berita, 'id_email' => $data->id_email]) }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="uc-2-input-field">
                        {{-- first layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-1">
                                <label for="tanggal_kirim_berita">Tanggal kirim Surat:</label>
                                <input type="datetime-local" name="tanggal_kirim_berita" id="tanggal_kirim_berita" value="{{$data->tanggal_kirim_berita }}">
                                <div class="error"></div>
                            </div>
                            <div class="uc-2-first-layer-form-1">
                                <label for="respon_time">Tanggal terima Surat:</label>
                                <input type="datetime-local" name="respon_time" id="respon_time" value="{{ $data->respon_time }}" >
                                <div class="error"></div>
                            </div>
                        </div>

                        <div class="uc-2-form-footer">
                            <div class="uc-2-copy-header-footer">
                                <div>Created at - {{ \Carbon\Carbon::parse($data->berita->created_at)
                                    ->locale('id')->isoFormat('DD MMMM YYYY') }}</div>
                                <div class="uc-2-form-footer-save">
                                    <button id="saveBtn" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                {{-- Second layer --}}
                <div class="uc-2-header-section">
                    <div class="uc-2-copy-header-label">
                        <label for="isi_berita">Header Text:</label>
                        <button class="uc-2-copy-header-text" onclick="copyToClipboard('#uc-2-header-copy-and-paste')">Copy</button>
                    </div>

                    <p id="uc-2-header-copy-and-paste">Yth. {{$data->email->koresponden->nama_koresponden}}
                        <br><br>
                        Berikut kami lampirkan keterangan surat:
                        <br>
                        Nomor Surat = {{ $data->berita->no_berita }}
                        <br>
                        Sifat Surat = {{ $data->berita->sifat->nama_sifat }}
                        <br><br>
                        Deskripsi Singkat Surat Berita<br>
                        {{ $data->berita->isi_berita }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Impor Kebutuhan Javascript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Copy dan simpan form --}}
    <script>
        // Copy text
        function copyToClipboard(element) {
            var $temp = document.createElement("textarea");

            $temp.value = document.querySelector(element).innerText;

            document.body.appendChild($temp);

            $temp.select();

            document.execCommand("copy");

            document.body.removeChild($temp);
        }

        // Simpan form
        $(document).ready(function() {
            $("#formHeader").on('submit', function(e) {
                e.preventDefault();

                $("#saveBtn").html('Menyimpan...').attr('disabled', 'disabled');

                const tanggal_kirim_berita = document.getElementById('tanggal_kirim_berita');

                const setError = (element, message) => {
                    const inputControl = element.closest('.uc-2-first-layer-form-1');
                    const errorDisplay = inputControl.querySelector('.error');

                    errorDisplay.innerText = message;
                    errorDisplay.classList.add('active');
                };

                const setSuccess = (element) => {
                    const inputControl = element.closest('.uc-2-first-layer-form-1');
                    const errorDisplay = inputControl.querySelector('.error');

                    if (errorDisplay) {
                        errorDisplay.innerText = '';
                        errorDisplay.classList.remove('active');
                    }
                };

                const validateInputs = () => {
                    let allInputsAreValid = true;

                    if (tanggal_kirim_berita.value.trim() === '') {
                        setError(tanggal_kirim_berita, 'Pastikan pemilihan tanggal surat terkirim dilakukan sebelum simpan data');
                        allInputsAreValid = false;
                        console.log("validasi: ", tanggal_kirim_berita.value.trim());
                    } else {
                        setSuccess(tanggal_kirim_berita);
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

                    swal.fire("Success!", "Data berhasil disimpan!", "success");

                    // Implementasi pengiriman data bisa dilakukan di sini
                    this.submit();
                }
            });
        });

        // Button header toggle
        function menuToggle(){
            const toggleMenu = document.querySelector('.uc-2-dropdown-user');
            toggleMenu.classList.toggle('active');
        }

    </script>

</body>
</html>
