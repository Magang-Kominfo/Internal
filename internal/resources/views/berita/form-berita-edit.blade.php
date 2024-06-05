
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/berita/form-berita.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <title>Form Pembaharuan Surat Berita</title>
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
                    <a href="{{ route('berita.detail', ['id_berita' => $edit['berita']->id]) }}" style="text-decoration: none;">
                        <div class="uc-2-back-btn" style="display: flex; align-items: center;">
                            <img class="uc-2-back-button" src="{{ asset('assets/back-btn.svg') }}" alt="Back Button">
                            <h2 style="text-decoration: none; margin-right: 8px;">KEMBALI</h2>
                        </div>
                    </a>
                    <div class="uc-2-nav-description">
                        <div class="uc-2-nav-description-route">Menyunting Berita</div>
                    </div>
                </div>

                <h4 style="text-align: justify">
                    Pastikan data surat berita sesuai dengan keterangan dalam surat.
                    Isi data berita dan pilih koresponden yang akan dituju. Ingat untuk
                    meng-update kembali waktu respon oleh penerima.
                </h4>

                {{-- Main form --}}
                <form  action="{{ route('berita.edit', ['id_berita' => $edit['berita']->id]) }}"
                    id="addForm" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')

                    <div class="uc-2-input-field" id="percobaan" data-id="{{ $edit['berita']->id }}">
                        {{-- first layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-2">
                                <label for="no_berita">Nomor Berita:</label>
                                <input type="text" name="no_berita" id="no_berita" value="{{$edit['berita']->no_berita}}">
                                <div class="error"></div>
                            </div>

                            <div class="uc-2-first-layer-form-2">
                                <label for="no_agenda">Nomor Agenda:</label>
                                <input type="text" name="no_agenda" id="no_agenda" value="{{$edit['berita']->no_agenda}}">
                                <div class="error"></div>
                            </div>
                            <div class="uc-2-first-layer-form-2">
                                <label for="jumlah_halaman_berita">Jumlah Halaman:</label>
                                <input type="number" min="1" value="1" name="jumlah_halaman_berita" id="jumlah_halaman_berita" value="{{$edit['berita']->jumlah_halaman_berita}}">
                                <div class="error"></div>
                            </div>
                            <div class="uc-2-first-layer-form-2">
                                <label for="tanggal_buat_surat">Tanggal Buat Surat:</label>
                                <input type="datetime-local" name="tanggal_buat_berita" id="tanggal_buat_berita" value="{{$edit['berita']->tanggal_buat_berita }}">
                                <div class="error"></div>
                            </div>
                        </div>

                        {{-- second layer --}}
                        <div class="uc-2-first-layer-form-corespondent">
                            <div class="uc-2-first-layer-form-1">
                                <label for="pengirim">Pengirim:</label>
                                <select id="selectpengirim"  name="emailpengirim_id"
                                    class=" uc-2-corespondent-button" >
                                </select>
                                <div class="error"></div>
                            </div>
                            <div class="uc-2-first-layer-form-1">
                                <label for="penerima">Penerima:</label>
                                <select multiple id="selectpenerima"  name="emailpenerima_id[]"
                                    class=" uc-2-corespondent-button" >
                                </select>
                                <div class="error"></div>
                            </div>
                        </div>

                        {{-- third layer --}}
                        <div class="uc-2-third-layer-form">
                            <label for="sifat_berita">Sifat Berita:</label>
                            <div class="uc-2-radio-button">
                                @foreach($edit['sifats'] as $sifat)
                                    <div class="uc-2-radio-button-option">
                                        <input type="radio" id="sifat{{$sifat->id}}" name="id_sifat" 
                                        value="{{$sifat->id}}" @if($sifat->id == $edit['berita']->id_sifat) checked  @endif>
                                        <label for="sifat{{$sifat->id}}">{{$sifat->nama_sifat}}</label><br>
                                    </div>
                                @endforeach
                            </div>
                            <div class="error"></div>
                        </div>

                        <div class="uc-2-fourth-layer-form">
                            <label for="alur_surat">Alur Surat:</label>
                            <div class="uc-2-radio-button">
                                @foreach($edit['alursurats'] as $alursurat)
                                    <div class="uc-2-radio-button-option">
                                        <input type="radio" id="sifat{{$alursurat->id}}" name="id_alur_surat" 
                                        value="{{$alursurat->id}}" @if($alursurat->id == $edit['berita']->id_alur_surat) checked  @endif>
                                        <label for="alursurat{{$alursurat->id}}">{{$alursurat->nama_alur_surat}}</label><br>
                                    </div>
                                @endforeach
                            </div>
                            <div class="error"></div>
                        </div>

                        {{-- fourth layer --}}
                        <div class="uc-2-layer-deskripsi">
                            <label for="isi_berita">Deskripsi Insiden:</label>
                            <textarea name="isi_berita" id="isi_berita" cols="30" rows="10" >{{$edit['berita']->isi_berita}}</textarea>
                            <div class="error"></div>
                        </div>

                        {{-- fifth layer --}}
                        <div class="uc-2-first-layer-form-2">
                            @if($edit['berita']->dokumen_surat_berita)
                                <div class="uc-2-dokumen-saat-ini">
                                    <label>Dokumen saat ini:</label>
                                    <a href="/dokumen/{{ $edit['berita']->dokumen_surat_berita }}" target="_blank" class="uc-2-button-download">
                                        Cek Kembali
                                    </a>
                                </div>
                            @endif
                            
                            <label for="dokumen_surat_berita">Dokumen Surat Berita:</label>
                            <div class="uc-2-input-file">
                                <input type="file" name="dokumen_surat_berita" class="uc-2-form-control" 
                                    id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" 
                                    aria-label="Upload">
                            </div>
                        </div>
                    </div>

                    <div class="uc-2-form-footer">
                        <div class="uc-2-form-footer-save">
                            <button type="submit" id="saveBtn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Impor Kebutuhan Javascript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script Select2 dan simpan form --}}
    <script>
       $(document).ready(function() {
            var selectedIds = [];
            var pengirimIds = [];
            var penerimaIds = [];

            // Function untuk Select2 

            // Melakukan format pada tampilan opsi dropdown select2
            function formatEmailOption(email) {
                if (!email.id) {
                    return email.text;
                } else {

                    var $option = $(
                        '<div class="uc-2-list-koresponden-item">' +
                        '<h4>' + email.nama + '</h4>'
                    );

                    if (email.id !== 'K') {
                        $option.append(
                            '<div class="uc-2-list-koresponden-item-check">' +
                                '<h4>' +
                                '<span>' + (email.tipe == '0' ? 'Email Instansi' : 'Email Pribadi') + '</span>' +
                                ' - ' + email.email +
                                '</h4>' +
                            '</div>'
                        );
                    }

                    $option.append('</div>');

                    return $option;

                }
            }

            // Melakukan format pada tampilan opsi terpilih select2
            function formatSelectedOption(selectedOption) {
                if (!selectedOption.id) {
                    return selectedOption.text;
                }
                console.log("selected option", selectedOption);

                // Construct the selected tag HTML
                return selectedOption.text;
            }

            var beritaId = $('#percobaan').data('id');

            // Mengambil nilai dari database
            $.ajax({
                url: "{{  url("email-default-option") }}", // Endpoint to get default data
                dataType: 'json',
                data: { id: beritaId }
            }).then(function(response) {

                var pengirimDefaultOptions = [];
                var penerimaDefaultOptions = [];

                if (response.pengirim && Array.isArray(response.pengirim)) {
                    console.log("Array Pengirim: ", response.pengirim);
                    pengirimDefaultOptions = response.pengirim.map(function(data) {
                        console.log("ID Pengirim: ", data.id);

                        pengirimIds.push(data.id);
                        console.log("pengirim IDs: ", pengirimIds);

                        selectedIds.push(data.id);
                        console.log("selected IDs: ", selectedIds);

                        return new Option(data.nama + ' - ' + data.email, data.id, true, true);
                    });
                }

                if (response.penerima && Array.isArray(response.penerima)) {
                    console.log("Array Penerima: ", response.penerima);
                    penerimaDefaultOptions = response.penerima.map(function(data) {
                        console.log("ID Penerima: ", data.id);
                        penerimaIds.push(data.id);
                        console.log("Penerima IDs: ", penerimaIds);

                        selectedIds.push(data.id);
                        console.log("selected IDs: ", selectedIds);
                        return new Option(data.nama + ' - ' + data.email, data.id, true, true);
                    });
                }

                //Mengmabil nilai selected dari database dan mengirim kepada selectpengirim
                pengirimDefaultOptions.forEach(function(option) {
                    $('#selectpengirim').append(option).trigger('change');
                });

                //Mengmabil nilai selected dari database dan mengirim kepada selectpenerima
                penerimaDefaultOptions.forEach(function(option) {
                    $('#selectpenerima').append(option).trigger('change');
                });

                $("#selectpengirim").select2({
                    placeholder: 'Tentukan pengirim pengiriman',
                    allowClear: true,
                    ajax: {
                        url: "{{  url("email-option") }}",
                        dataType: "json",
                        processResults: function(data, params) {
                            if (data.length === 0 && params.term) {
                                var newOption = {
                                    id: 'K',
                                    nama: 'Click here to add a new correspondent'
                                };
                                return { results: [newOption] };
                            } else {
                                // Filter out selected items
                                var filteredData = data.filter(function(item) {
                                    return selectedIds.indexOf(item.id) === -1;
                                });

                                return {
                                    results: filteredData.map(function(item) {
                                        return {
                                            id: item.id,
                                            text: item.koresponden.nama_koresponden + ' - ' + item.nama_email,
                                            email: item.nama_email,
                                            nama: item.koresponden.nama_koresponden,
                                            tipe: item.tipe_email
                                        };
                                    }),
                                    pagination: { more: data.more }
                                };
                            }
                        }
                    },
                    templateResult: formatEmailOption,
                    templateSelection: formatSelectedOption
                }).on('select2:select', function(e) {
                    var data = e.params.data;
                    console.log("Pengirim IDs: ", data.id);

                    if (data.id === 'K') {
                        window.open('/form-new-koresponden', '_blank');
                    } else {
                        var newDataId = data.id;

                        if (!pengirimIds.includes(newDataId)) {
                            // Jika belum ada, tambahkan nilai baru ke dalam array
                            pengirimIds.push(newDataId);
                            console.log("New pengirim IDs: ", pengirimIds);
                        }

                        console.log("arrays pengirim lama: ", pengirimIds)

                        // Loop melalui array selectedIds
                        for (var i = 0; i < selectedIds.length; i++) {
                        // Periksa apakah nilai pengirim ID pada indeks tertentu sama dengan nilai lama
                        console.log("selected id: ", selectedIds[i], "compared IDs: ", pengirimIds[0]);

                            if (selectedIds[i] === pengirimIds[0]) {
                                console.log('ubah selected id dengan pengirim');
                                selectedIds[i] = pengirimIds[1];
                                console.log("selected id terbaru: ", selectedIds[i]);
                                var index = pengirimIds.findIndex(function(id) {
                                    return id == pengirimIds[0];
                                });
                                if (index !== -1) {
                                    pengirimIds.splice(index, 1);
                                }
                            }
                        }

                        console.log("arrays pengirim baru: ", pengirimIds)

                        if (!selectedIds.includes(newDataId)) {
                            // Jika belum ada, tambahkan nilai baru ke dalam array
                            selectedIds.push(newDataId);

                        }

                        console.log("New selected IDs: ", selectedIds);
                    }
                }).on('select2:unselecting', function(e) {
                    var data = e.params.args.data;
                    var removedId = data.id;

                    // Hapus ID dari array selectedIds
                    console.log("Before filtering IDs: ", selectedIds);

                    var index = selectedIds.findIndex(function(id) {
                        console.log("DeletedId IDs: ", removedId, "comparedId: ", id);
                        return id == removedId;
                    });
                    if (index !== -1) {
                        selectedIds.splice(index, 1);
                        pengirimIds = [];
                    }

                    console.log("Hapus Pengirim IDs: ", selectedIds, "arrays pengirim baru: ", pengirimIds);
                });

                $("#selectpenerima").select2({
                    placeholder: 'Tentukan penerima pengiriman',
                    allowClear: true,
                    ajax: {
                        url: "{{ url('email-option') }}",
                        dataType: "json",
                        processResults: function(data, params) {
                            if (data.length === 0 && params.term) {
                                var newOption = {
                                    id: 'K',
                                    nama: 'Click here to add a new correspondent'
                                };
                                return { results: [newOption] };
                            } else {
                                // Filter out selected items
                                var filteredData = data.filter(function(item) {
                                    return selectedIds.indexOf(item.id) === -1;
                                });

                                return {
                                    results: filteredData.map(function(item) {
                                        return {
                                            id: item.id,
                                            text: item.koresponden.nama_koresponden + ' - ' + item.nama_email,
                                            email: item.nama_email,
                                            nama: item.koresponden.nama_koresponden,
                                            tipe: item.tipe_email
                                        };
                                    }),
                                    pagination: { more: data.more }
                                };
                            }
                        }
                    },
                    templateResult: formatEmailOption,
                    templateSelection: formatSelectedOption
                }).on('select2:select', function(e) {
                    var data = e.params.data;
                    if (data.id === 'K') {
                        window.open('/form-new-koresponden', '_blank');
                    } else {
                        // Add selected ID to the array
                        selectedIds.push(data.id);
                        penerimaIds.push(data.id);
                        console.log("New selected IDs: ", selectedIds);
                    }
                }).on('select2:unselecting', function(e) {
                    var data = e.params.args.data;
                    var removedId = data.id;

                    // Hapus ID dari array selectedIds
                    console.log("Before filtering IDs: ", selectedIds);

                    var index = selectedIds.findIndex(function(id) {
                        console.log("DeletedId IDs: ", removedId, "comparedId: ", id);
                        return id == removedId;
                    });
                    if (index !== -1) {
                        selectedIds.splice(index, 1);
                    }

                    // Hapus ID dari array penerimaIds
                    var indeks = penerimaIds.findIndex(function(id) {
                        console.log("DeletedId IDs: ", removedId, "comparedId: ", id);
                        return id == removedId;
                    });
                    if (indeks !== -1) {
                        penerimaIds.splice(index, 1);
                    }

                    console.log("Filtered selected IDs: ", selectedIds);
                });

            });

            // Tangani pengiriman formulir
            $("#addForm").on('submit', function(e) {
                e.preventDefault();

                $("#saveBtn").html('Menyimpan...').removeAttr('disabled');

                // Ambil seluruh nilai input
                const noBerita = document.getElementById('no_berita');
                const noAgenda = document.getElementById('no_agenda');
                const jumlahHalamanBerita = document.getElementById('jumlah_halaman_berita');
                const tanggalBuatBerita = document.getElementById('tanggal_buat_berita');
                const emailPengirim = document.getElementById('selectpengirim');
                const emailPenerima = document.getElementById('selectpenerima');
                const sifatBerita = document.querySelector('input[name="id_sifat"]:checked');
                const alurSurat = document.querySelector('input[name="id_alur_surat"]:checked');
                const isiBerita = document.getElementById('isi_berita');
                const dokumenSuratBerita = document.getElementById('inputGroupFile04');

                // Validasi jika terdapat error
                const setError = (element, message) => {
                    const inputControl = element.closest('.uc-2-first-layer-form-2') ||
                                        element.closest('.uc-2-third-layer-form') ||
                                        element.closest('.uc-2-fourth-layer-form') ||
                                        element.closest('.uc-2-layer-deskripsi') ||
                                        element.closest('.uc-2-first-layer-form-1');

                    const errorDisplay = inputControl.querySelector('.error');

                    errorDisplay.innerText = message;
                    errorDisplay.classList.add('active');
                };

                // Validasi jika telah sukses
                const setSuccess = (element) => {
                    const inputControl = element.closest('.uc-2-first-layer-form-2') ||
                                        element.closest('.uc-2-third-layer-form') ||
                                        element.closest('.uc-2-fourth-layer-form') ||
                                        element.closest('.uc-2-layer-deskripsi') ||
                                        element.closest('.uc-2-first-layer-form-1');

                    const errorDisplay = inputControl.querySelector('.error');

                    if (errorDisplay) {
                        errorDisplay.innerText = '';
                        errorDisplay.classList.remove('active');
                    }
                };

                // Validasi mengecek allInputsAreValid
                const validateInputs = () => {
                    let allInputsAreValid = true;

                    if (noBerita.value.trim() === '') {
                        setError(noBerita, 'Masukkan Nomor Berita');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(noBerita);
                    }

                    if (noAgenda.value.trim() === '') {
                        setError(noAgenda, 'Masukkan Nomor Agenda');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(noAgenda);
                    }

                    if (jumlahHalamanBerita.value.trim() === '' || jumlahHalamanBerita.value <= 0) {
                        setError(jumlahHalamanBerita, 'Perhatikan Jumlah halaman yang sesuai');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(jumlahHalamanBerita);
                    }

                    if (tanggalBuatBerita.value.trim() === '') {
                        setError(tanggalBuatBerita, 'Masukkan Tanggal Pembuatan Surat Berita');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(tanggalBuatBerita);
                    }

                    if (pengirimIds.length === 0) {
                        setError(emailPengirim, 'Pilih Pengirim Surat Berita');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(emailPengirim);
                    }

                    if (penerimaIds.length === 0) {
                        setError(emailPenerima,  'Pilih Penerima Surat Berita');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(emailPenerima);
                    }

                    if (!sifatBerita) {
                        setError(document.querySelector('.uc-2-third-layer-form .uc-2-radio-button'), 'Tentukan Sifat Surat Berita');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(document.querySelector('.uc-2-third-layer-form .uc-2-radio-button'));
                    }

                    if (!alurSurat) {
                        setError(document.querySelector('.uc-2-fourth-layer-form .uc-2-radio-button'), 'Tentukan Alur Surat Berita');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(document.querySelector('.uc-2-fourth-layer-form .uc-2-radio-button'));
                    }

                    if (isiBerita.value.trim() === '') {
                        setError(isiBerita, 'Masukkan Deskripsi Surat Berita yang sesuai');
                        allInputsAreValid = false;
                    } else {
                        setSuccess(isiBerita);
                    }

                    console.log("hi ", allInputsAreValid);

                    return allInputsAreValid;
                };

                // Memanggil fungsi untuk memvalidasi input
                const allInputsAreValid = validateInputs();

                console.log(allInputsAreValid);

                if (!allInputsAreValid) {
                    // Menampilkan pesan kesalahan menggunakan SweetAlert jika ada input yang tidak valid
                    swal.fire({
                        title: "Error!",
                        text: "Terdapat kesalahan dalam pengisian formulir, mohon periksa kembali.",
                        icon: "error",
                        button: "OK",
                    });
                    $("#saveBtn").html('Simpan kembali').removeAttr('disabled');
                } else {
                    // Lakukan pengiriman data jika semua input valid
                    var link = $("#addForm").attr('action');

                    $.ajax({
                        url: link,
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        data: new FormData(this),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $("#saveBtn").html('Memindahkan halaman...').removeAttr('disabled');
                            if (response.status) {
                                $('#selectpengirim').val(null).trigger("change");
                                $('#selectpenerima').val(null).trigger("change");
                                swal.fire("Success!", response.message, "success");
                            };
                            window.location.href = '/detailberita/' + response.beritaId;
                        },
                        error: function(xhr, status, error) {
                            $("#saveBtn").html('Simpan kembali').removeAttr('disabled');
                            swal.fire("Error!", "Terjadi kesalahan saat menyimpan data: " + error, "error");
                        }
                    });
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
