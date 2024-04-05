<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/list-koresponden.css') }}" >
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
                        <div class="route">KORESPONDEN</div>
                       
                    </div>
                </div>

                {{-- Search bar --}}
                <div class="uc-2-search">
                    <div class="uc-2-search-bar"> Search bar </div>
                    <div class="uc-2-search-filter">Filter</div>
                    {{-- <div class="uc-2-search-sort">Sort</div>
                    <div class="uc-2-search-add">+</div> --}}
                </div>

                <div class="uc-2-list-koresponden">
                    <div class="uc-2-list-koresponden-item"> 
                        <h4>Nama Koresponden</h4>
                        <span>Belum ada balasan</span>
                    </div>

                    <div class="uc-2-list-koresponden-item"> 
                        <h4>Nama Koresponden</h4>
                        <span>DD/MM/YYYY</span>
                    </div>

                    <div class="uc-2-list-koresponden-item"> 
                        <h4>Nama Koresponden</h4>
                        <span>DD/MM/YYYY</span>
                    </div>
                    
                    <div class="uc-2-list-koresponden-item"> 
                        <h4>Nama Koresponden</h4>
                        <span>DD/MM/YYYY</span>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
