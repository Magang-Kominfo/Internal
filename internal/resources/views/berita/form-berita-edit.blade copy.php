<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Menambahkan Insiden</title>
</head>

<body>
    <div class="uc-2-main">

        {{-- header --}}
        <div class="uc-2-header">
            <div>
                <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo">
            </div>

            <div>
            </div>
        </div>

        {{-- body --}}
        <div class="uc-2-form-main">
            <div class="uc-2-form-berita-main">
                    
                {{-- back --}}
                <div class="payment-header">
                    <div class="back-btn">
                        <object
                            data="{{ asset('assets/back-btn.svg') }}"
                            type=""
                        ></object>
                        <a href="" style="text-decoration: none"><h2>KEMBALI</h2></a>
                    </div>
                    <div class="payment-route">
                        <div class="route">ISI BERITA</div>
                        <div class="route">
                            <iconify-icon
                                icon="mingcute:right-fill"
                            ></iconify-icon>
                                KORESPONDEN
                        </div>
                    </div>
                </div>

                <h4>
                    Pastikan data surat berita sesuai dengan keterangan dalam surat. 
                    Isi data berita dan pilih koresponden yang akan dituju. Ingat untuk 
                    meng-update kembali waktu respon oleh penerima.
                </h4>

                {{-- Main form --}}
                <form  action="{{ route('berita.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="uc-2-input-field">
                        {{-- first layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-2">
                                <label for="no_berita">Nomor Berita:</label>
                                <input type="text" name="no_berita" id="no_berita" >
                            </div>
                            <div class="uc-2-first-layer-form-2">
                                <label for="no_agenda">Nomor Agenda:</label>
                                <input type="text" name="no_agenda" id="no_agenda" >
                            </div>
                            <div class="uc-2-first-layer-form-2">
                                <label for="jumlah_halaman_berita">Jumlah Halaman:</label>
                                <input type="number" min="1" value="1" name="jumlah_halaman_berita" id="jumlah_halaman_berita" >
                            </div>
                            <div class="uc-2-first-layer-form-2">
                                <label for="tanggal_buat_surat">Tanggal Buat Surat:</label>
                                <input type="date" name="tanggal_buat_berita" id="tanggal_buat_berita" >
                            </div>
                        </div>

                        {{-- second layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-1">
                                <label for="pengirim">Pengirim:</label>
                                <input type="text" name="pengirim" id="pengirim" placeholder="goes to correspondent page">
                            </div>
                            <div class="uc-2-first-layer-form-1">
                                <label for="penerima">Penerima:</label>
                                <input type="text" name="penerima" id="penerima" placeholder="goes to correspondent page">
                            </div>
                        </div>

                        {{-- third layer --}}
                        <div class="uc-2-third-layer-form">
                            <label for="sifat_berita">Sifat Berita:</label>
                            <div class="uc-2-radio-button">
                                @foreach($sifats as $sifat)
                                    <input type="radio" id="sifat{{$sifat->id}}" name="id_sifat" value="{{$sifat->id}}">
                                    <label for="sifat{{$sifat->id}}">{{$sifat->nama_sifat}}</label><br>
                                @endforeach
                            </div>
                        </div>

                        {{-- fourth layer --}}
                        <div class="uc-2-menambahkan-insiden-input-field-deskripsi">
                            <label for="isi_berita">Deskripsi Insiden:</label>
                            <textarea name="isi_berita" id="isi_berita" cols="30" rows="10"></textarea>
                        </div>

                        {{-- fifth layer --}}
                        <div class="uc-2-first-layer-form-2">
                            <label for="dokumen_surat_berita">Dokumen Surat Berita:</label>
                            <div class="input-group">
                                <input type="file" name="dokumen_surat_berita" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            </div>
                        </div>
                        
                    </div>

                    <div class="uc-2-form-footer">
                        <div class="uc-2-form-footer-save">
                            <button type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
