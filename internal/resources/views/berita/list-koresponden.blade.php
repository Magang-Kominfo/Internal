<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/berita/list-koresponden.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>List Koresponden Berita</title>
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
                    <div class="uc-2-back-btn">
                        <object
                            data="{{ asset('assets/back-btn.svg') }}"
                            type=""
                        ></object>
                        <a href="
                            @foreach($datas as $data)
                            {{ route('berita.detail', ['id_berita' => $data->id_berita]) }}"
                             @endforeach
                            style="text-decoration: none"><h2>KEMBALI</h2></a>

                    </div>
                    <div class="uc-2-nav-description">
                        <div class="uc-2-nav-description-route">KORESPONDEN</div>
                    </div>
                </div>

                {{-- Search bar --}}
                <div class="uc-2-search">
                    <input id="searchBar" class="uc-2-search-bar" type="text" placeholder="Search bar">
                    <div class="uc-2-search-filter">
                        <select class="uc-2-search-filter-select" id="filterSelect">
                            <option value="all" selected>Filter</option>
                            <option value="sudah-terbalas">Sudah Terbalas</option>
                            <option value="belum-terbalas">Belum Terbalas</option>
                        </select>
                    </div>
                    <div class="uc-2-search-sort">
                        <select class="uc-2-search-sort-select" id="sortSelect">
                            <option value="none" selected>Sort</option>
                            <option value="created-desc">Pencatatan Terbaru</option>
                            <option value="created-asc">Pencatatan Terakhir</option>
                        </select>
                    </div>
                </div>

                <div class="uc-2-list-koresponden">
                    @foreach($datas as $data)
                        @if($data->role === 1)
                            <a href="{{ route('mengirim.show', ['id_berita' => $data->id_berita,
                            'id_email' => $data->id_email],
                            ) }}"  style="text-decoration: none" >
                                <div class="uc-2-list-koresponden-item"
                                    data-created="{{ $data->updated_at }}"
                                    data-type="{{ is_null($data->respon_time) ? 'belum-terbalas' : 'sudah-terbalas' }}">
                                    <h4>{{ $data->email->koresponden->nama_koresponden ?? '' }}
                                        - {{ $data->email->nama_email ?? ''}}</h4>
                                    <span>
                                        @if($data->respon_time == '0000-00-00 00:00:00' || is_null($data->respon_time))
                                            Belum ada Balasan
                                        @else
                                            {{ \Carbon\Carbon::parse($data->respon_time)->locale('id')->isoFormat('HH:mm | DD MMMM YYYY')  }}
                                        @endif
                                    </span>
                                </div>
                            </a>
                        @endif
                    @endforeach

                </div>

                <div class="uc-2-pagination-section">
                    <div id="uc-2-pagination-list-koresponden"></div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filterSelect = document.getElementById("filterSelect");
            const sortSelect = document.getElementById("sortSelect");
            const searchInput = document.getElementById("searchBar");
            const paginationContainer = document.getElementById("uc-2-pagination-list-koresponden")
            const newsItemsContainer = document.querySelector(".uc-2-list-koresponden");
            const newsItems = Array.from(newsItemsContainer.querySelectorAll(".uc-2-list-koresponden-item"));

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
                const sortKey = sortBy.includes("created") ? "created" : null;

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

        function menuToggle(){
            const toggleMenu = document.querySelector('.uc-2-dropdown-user');
            toggleMenu.classList.toggle('active');
        }

    </script>

</body>
</html>
