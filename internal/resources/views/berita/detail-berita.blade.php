<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/berita/detail-berita.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Detail Berita</title>
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

        {{-- Body --}}
        <div class="uc-2-form-main">
            <div class="uc-2-form-berita-main">
                {{-- Back --}}
                <div>
                    <div class="uc-2-back-navigation">
                        <a href="{{ url('dashboard-berita') }}" style="text-decoration: none;">
                            <div class="uc-2-back-btn" style="display: flex; align-items: center;">
                                <img class="uc-2-back-button" src="{{ asset('assets/back-btn.svg') }}" alt="Back Button">
                                <h2 style="text-decoration: none; margin-right: 8px;">KEMBALI</h2>
                            </div>
                        </a>
                        <div class="uc-2-nav-description">
                            <div class="uc-2-nav-description-route" style="margin-left: 12px">
                                {{ \Carbon\Carbon::parse($berita->tanggal_buat_berita)->locale('id')->isoFormat('HH:mm | DD MMMM YYYY')}}
                                </div>
                        </div>
                    </div>
                    <div class="uc-2-sifat">{{ $berita->sifat->nama_sifat}}</div>
                </div>

                {{-- Main part --}}
                <h2 class="uc-2-no-berita">
                    {{ $berita->no_berita }}
                </h2>

                    <div class="uc-2-input-field">
                        {{-- First layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-1">
                               <p>Nomor Agenda: {{ $berita->no_agenda }}</p>
                            </div>
                            <div class="uc-2-first-layer-form-1">
                                <p>Jumlah Halaman:  {{ $berita->jumlah_halaman_berita }}</p>
                            </div>
                        </div>

                        {{-- Second layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-1">
                                <p>Dari:
                                        @php
                                            $korespondenExists = false;
                                        @endphp

                                        @foreach($berita->mengirims as $data)
                                            @if($data->role === 0 && $data->email && $data->email->koresponden)
                                                {{ $data->email->koresponden->nama_koresponden }}
                                                @php
                                                    $korespondenExists = true;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if(!$korespondenExists)
                                            Data Koresponden Terhapus
                                        @endif
                                </p>
                            </div>
                        </div>

                        {{-- Third layer --}}
                        <div class="uc-2-first-layer-form-deskripsi">
                            <h3 class="uc-2-teks-deskripsi"> Deskripsi Singkat:</h3>
                            <p  style="text-align: justify">{{ $berita->isi_berita }}</p>
                        </div>
                    </div>

                    {{-- Button --}}
                    <div class="uc-2-form-footer">
                        <div class="uc-2-form-footer-back">
                            <button onclick="window.location='{{ route('koresponden.index', ['id_berita' => $berita->id]) }}'"
                                type="button">Correspondent</button>
                        </div>
                        @if($berita->dokumen_surat_berita)
                            <div class="uc-2-form-footer-download">
                                <a href="/dokumen/{{ $berita->dokumen_surat_berita }}">
                                    <button type="button">Download</button>
                                </a>
                            </div>
                        @endif
                        <div class="uc-2-form-footer-edit">
                            <button onclick="window.location='{{ route('berita.update', ['id_berita' => $berita->id]) }}'">Edit</button>
                        </div>
                        <div class="uc-2-form-footer-delete">
                            <form id="deleteForm{{ $berita->id }}" action="{{ route('berita.delete', ['id_berita' => $berita->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                onclick="confirmDelete('{{ $berita->id }}', 'Pastikan bahwa data benar benar ingin anda hapus!')">Delete</button>
                            </form>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // SweetAlert dan hapus
        function confirmDelete(beritaId, message) {
            Swal.fire({
                title: 'Apa anda yakin?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm'+beritaId).submit();
                }
            })
        }

        // Button header toggle
        function menuToggle(){
            const toggleMenu = document.querySelector('.uc-2-dropdown-user');
            toggleMenu.classList.toggle('active');
        }

    </script>

</body>
</html>
