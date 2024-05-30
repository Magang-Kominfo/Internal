<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/berita/dashboard.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Dashboard Berita</title>
</head>

<body>
    <div class="uc-2-main">

        {{-- header --}}
        <div class="uc-2-header">
            <div class="uc-2-left-header">
                <img src="{{ asset('img/logoKominfo.png') }}" alt="Kominfo" class="logo">
            </div>

            <div class="uc-2-right-header">
                <h4><a href="{{ route('koresponden.show') }}" style="text-decoration: none; color: var(--bluedark);">Daftar Koresponden</a></h4>
                <a class="uc-2-user-navigate" onclick="menuToggle()">
                    <img src="{{ asset('assets/userProf.svg') }}" alt="Kominfo" class="user" >
                </a>
                {{-- Menu --}}
                <div class="uc-2-dropdown-user">
                    <div class="uc-2-username">
                        <span class="uc-2-name">
                            {{ $user->nama_user }}
                        </span>
                        <span class="uc-2-role">
                            {{ $user->id_user }}
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
        <div class="uc-2-main-dashboard">
            <div class="uc-2-main-dashboard-berita">

                {{-- back --}}
                <div class="uc-2-main-title-text">
                    <h3>Dashboard Surat Berita</h3>
                </div>

                {{-- Search bar --}}
                <div class="uc-2-search">
                    <div class="uc-2-search-option-responsive">
                        <input id="searchBar" class="uc-2-search-bar" type="text" placeholder="Search bar">
                        <a href="{{ url('form-berita-create') }}" style="text-decoration: none; color:white" class="uc-2-search-add mobile">
                            +
                        </a>
                    </div>
                    <div class="uc-2-search-option-responsive-filter-and-sort">
                        <div class="uc-2-search-filter">
                            <select class="uc-2-search-filter-select" id="filterSelect">
                                <option value="all" selected>Filter</option>
                                <option value="surat-masuk">Surat Masuk</option>
                                <option value="surat-keluar">Surat Keluar</option>
                            </select>
                        </div>
                        <div class="uc-2-search-sort">
                            <select class="uc-2-search-sort-select" id="sortSelect">
                                <option value="none" selected>Sort</option>
                                <option value="created-desc">Pencatatan Terbaru</option>
                                <option value="created-asc">Pencatatan Terakhir</option>
                                <option value="updated-desc">Surat Terbaru</option>
                                <option value="updated-asc">Surat Terlama</option>
                            </select>
                        </div>
                    </div>
                    <a href="{{ url('form-berita-create') }}" style="text-decoration: none; color:white" class="uc-2-search-add web">
                        +
                    </a>
                </div>

                <div class="uc-2-berita">
                    @foreach($beritas as $berita)
                        <a href="{{ url('detailberita/' . $berita->id) }}" style="text-decoration: none;">
                            <div class="uc-2-berita-item"
                            data-created="{{ $berita->updated_at }}" data-updated="{{ $berita->tanggal_buat_berita }}"
                            data-type="{{ $berita->alursurat->id == 1 ? 'surat-masuk' : 'surat-keluar' }}">
                                <div class="uc-2-berita-item-header">
                                    <h4 class="uc-2-berita-no-surat" style=" margin: 0 8px 0 0;">{{ $berita->no_berita }} -
                                        <span style="
                                        @if ( $berita->alursurat->id == 1)
                                            color: var(--bluedark);
                                        @elseif ($berita->alursurat->id == 2)
                                            color: var(--red-edit);
                                        @endif">
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
                                        </span>
                                    </h4>
                                    <span style=" font-weight:500; text-align:right;
                                        @if ( $berita->alursurat->id == 1)
                                            color: var(--bluedark);
                                        @elseif ($berita->alursurat->id == 2)
                                            color: var(--red-edit);
                                        @endif
                                        ">{{ $berita->alursurat->nama_alur_surat }} -
                                        {{ \Carbon\Carbon::parse($berita->tanggal_buat_berita)->locale('id')->isoFormat('HH:mm | DD MMMM YYYY') }}
                                    </span>
                                </div>
                                <p style="text-align:justify;">
                                    {{ Str::limit($berita->isi_berita, 300, '...') }}
                                </p>
                                <h5 style="margin: 0">To:
                                    @php
                                        $korespondenExists = false;
                                    @endphp

                                    @foreach($berita->mengirims as $data)
                                        @if($data->role === 1 && $data->email && $data->email->koresponden)
                                            {{ $data->email->koresponden->nama_koresponden }},
                                            @php
                                                $korespondenExists = true;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if(!$korespondenExists)
                                        Data Koresponden Terhapus
                                    @endif
                                </h5>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div class="uc-2-pagination-section">
                    <div id="uc-2-pagination-dashboard"></div>
                </div>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterSelect = document.getElementById("filterSelect");
            const sortSelect = document.getElementById("sortSelect");
            const searchInput = document.getElementById("searchBar");
            const paginationContainer = document.getElementById("uc-2-pagination-dashboard")
            const newsItemsContainer = document.querySelector(".uc-2-berita");
            const newsItems= Array.from(newsItemsContainer.querySelectorAll(".uc-2-berita-item"));

            const itemsPerPage = 5;
            let currentPage = 1;

            filterSelect.addEventListener("change", filterAndSort);
            sortSelect.addEventListener("change", filterAndSort);
            searchInput.addEventListener("input", filterAndSort);

            function filterAndSort() {
                const filterBy = filterSelect.value;
                const sortBy = sortSelect.value;
                const searchQuery = searchInput.value.toLowerCase();
                const isDesc = sortBy.includes("desc");
                const sortKey = sortBy.includes("created") ? "created" : (sortBy.includes("updated") ? "updated" : null);

                // Filter news items
                let filteredNewsItems = newsItems.filter(item => {
                    const matchesFilter = filterBy === "all" || item.dataset.type === filterBy;
                    const matchesSearch = item.textContent.toLowerCase().includes(searchQuery);
                    return matchesFilter && matchesSearch;

                });

                // Sort news items if a sorting option is selected
                if (sortKey) {
                    filteredNewsItems.sort((a, b) => {
                        const aValue = new Date(a.dataset[sortKey]);
                        const bValue = new Date(b.dataset[sortKey]);

                        return isDesc ? bValue - aValue : aValue - bValue;
                    });
                }

                // Pagination logic
                const totalPages = Math.ceil(filteredNewsItems.length / itemsPerPage);

                if(currentPage === 0){
                    currentPage = Math.max(currentPage, 1);
                } else {
                currentPage = Math.min(currentPage, totalPages);
                }

                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = startIdx + itemsPerPage;
                const paginatedItems = filteredNewsItems.slice(startIdx, endIdx);

                // Clear current items and append sorted, filtered, and paginated items
                newsItemsContainer.innerHTML = '';
                paginatedItems.forEach(item => {
                    const parentAnchor = item.closest('a');
                    if (parentAnchor) {
                        newsItemsContainer.appendChild(parentAnchor);
                    }
                });

                // Render pagination controls
                renderPaginationControls(totalPages);
            }

            function renderPaginationControls(totalPages) {
                paginationContainer.innerHTML = '';

                if (currentPage > 1) {
                    const prevButton = document.createElement('button');
                    prevButton.textContent = '<';
                    prevButton.className = 'page-button-navigator';
                    prevButton.addEventListener('click', () => {
                        currentPage -= 1;
                        filterAndSort();
                    });
                    paginationContainer.appendChild(prevButton);
                }

                const pageNumbers = [];
                const maxVisiblePages = 3;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (endPage - startPage < maxVisiblePages - 1) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }

                for (let i = startPage; i <= endPage; i++) {
                    pageNumbers.push(i);
                }

                if (startPage > 1) {
                    pageNumbers.unshift(1, '...');
                }
                if (endPage < totalPages) {
                    pageNumbers.push('...', totalPages);
                }

                pageNumbers.forEach(page => {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = page;
                    pageButton.className = 'page-button';
                    if (page === currentPage) {
                        pageButton.classList.add('active');
                    }
                    if (page !== '...') {
                        pageButton.addEventListener('click', () => {
                            currentPage = page;
                            filterAndSort();
                        });
                    }
                    paginationContainer.appendChild(pageButton);
                });

                if (currentPage < totalPages) {
                    const nextButton = document.createElement('button');
                    nextButton.textContent = '>';
                    nextButton.className = 'page-button-navigator';
                    nextButton.addEventListener('click', () => {
                        currentPage += 1;
                        filterAndSort();
                    });
                    paginationContainer.appendChild(nextButton);
                }

            }

            // Initial display of all items sorted by default option
            filterAndSort();
        });

        function menuToggle(){
            const toggleMenu = document.querySelector('.uc-2-dropdown-user');
            toggleMenu.classList.toggle('active');
        }


    </script>



</body>
</html>
