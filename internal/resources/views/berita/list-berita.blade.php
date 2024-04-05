<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" >
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
                    <h3>Dashboard Surat Berita</h3>
                </div>

                {{-- Search bar --}}
                <div class="uc-2-search">
                    <div class="uc-2-search-bar"> Search bar </div>
                    <div class="uc-2-search-filter">Filter</div>
                    <div class="uc-2-search-sort">Sort</div>
                    <div class="uc-2-search-add">+</div>
                </div>

                <div class="uc-2-berita">
                    <div class="uc-2-berita-item"> 
                        <div class="uc-2-berita-item-header">
                            <h4>Nomor Surat Berita - <span>From</span></h4>
                            <span>DD/MM/YYYY</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                        </p>
                        <h5>To: Username</h5>
                    </div>

                    <div class="uc-2-berita-item"> 
                        <div class="uc-2-berita-item-header">
                            <h4>Nomor Surat Berita - <span>From</span></h4>
                            <span>DD/MM/YYYY</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                        </p>
                        <h5>To: Username</h5>
                    </div>

                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
