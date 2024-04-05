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
                <div>
                    <div class="payment-header">
                        <div class="back-btn">
                            <object
                                data="{{ asset('assets/back-btn.svg') }}"
                                type=""
                            ></object>
                            <a href="" style="text-decoration: none"><h2>KEMBALI</h2></a>
                        </div>
                        <div class="payment-route">
                            <div class="route">{{ $berita->tanggal_buat_berita }}</div>  
                        </div>
                    </div>
                    <div class="uc-2-sifat">{{ $berita->sifat->nama_sifat}}</div>
                </div>

                <h2>
                    {{ $berita->no_berita }}
                </h2>

                {{-- Main part --}}
                    <div class="uc-2-input-field">
                        {{-- first layer --}}
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
                                <p>Dari: Username</p>
                            </div>     
                        </div>

                        {{-- Third layer --}}
                        <div class="uc-2-first-layer-form-deskripsi">
                            
                            <h3> Deskripsi Singkat:</h3>
                            <p>{{ $berita->isi_berita }}</p>
                            {{-- <p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae 
                                dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                                 sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam 
                                 est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius 
                                 modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, 
                                 quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? 
                                 Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, 
                                 vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
                            </p>
                         --}}
                            
                        </div>

                        
                    </div>

                    <div class="uc-2-form-footer">
                        <div class="uc-2-form-footer-back">
                            <button type="submit">Correspondent</button>
                        </div>
                        <div class="uc-2-form-footer-edit">
                            <button type="submit">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
