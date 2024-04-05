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
                        <div class="route">NAMA KORESPONDEN</div>
                       
                    </div>
                </div>

                <h4>
                    Pastikan data surat berita sesuai dengan keterangan dalam surat. 
                    Isi data berita dan pilih koresponden yang akan dituju. Ingat untuk 
                    meng-update kembali waktu respon oleh penerima.
                </h4>

                {{-- Main form --}}
                {{-- Main form --}}
                <form  action="{{ route('berita.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="uc-2-input-field">
                        {{-- first layer --}}
                        
                        {{-- second layer --}}
                        <div class="uc-2-first-layer-form">
                            <div class="uc-2-first-layer-form-1">
                                <label for="pengirim">Nama koresponden</label>
                                <input type="text" name="pengirim" id="pengirim" placeholder="goes to correspondent page">
                            </div>
                            <div class="uc-2-first-layer-form-1">
                                <label for="penerima">Email Koresponden</label>
                                <input type="text" name="penerima" id="penerima" placeholder="goes to correspondent page">
                            </div>
                        </div>

                        {{-- third layer --}}
                       

                        {{-- fourth layer --}}
                        <div class="uc-2-menambahkan-insiden-input-field-deskripsi">
                            <label for="isi_berita">Deskripsi Insiden:</label>
                            <textarea name="isi_berita" id="isi_berita" cols="30" rows="10"></textarea>
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
