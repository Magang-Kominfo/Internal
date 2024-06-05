<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/berita/koresponden.css') }}" >
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Form Data Mater Koresponden</title>
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
            <div class="uc-2-form-berita-main" >
                    {{-- back --}}
                <div class="uc-2-back-navigation">
                    <a href="{{ url('dashboard-berita') }}" style="text-decoration: none;">
                        <div class="uc-2-back-btn" style="display: flex; align-items: center;">
                            <img class="uc-2-back-button" src="{{ asset('assets/back-btn.svg') }}" alt="Back Button">
                            <h2 style="text-decoration: none; margin-right: 8px;">KEMBALI</h2>
                        </div>
                    </a>
                    <div class="uc-2-nav-description">
                        <div class="uc-2-nav-description-route">KORESPONDEN</div>
                    </div>
                </div>

                {{-- Search bar --}}
                <div class="uc-2-search">
                    <div class="uc-2-search-option-responsive">
                        <input id="searchBar" class="uc-2-search-bar" type="text" placeholder="Search bar">
                        <a href="{{ route('koresponden.form') }}" style="text-decoration: none; color:white" class="uc-2-search-add mobile">
                            +
                        </a>
                    </div>
                    <div class="uc-2-search-sort">
                        <select class="uc-2-search-sort-select" id="sortSelect">
                            <option value="none" selected>Sort</option>
                            <option value="updated-desc">Koresponden Terbaru</option>
                            <option value="updated-asc">Koresponden terlama</option>
                        </select>
                    </div>
                    <a href="{{ route('koresponden.form') }}" style="text-decoration: none; color:white">
                        <div class="uc-2-search-add web">
                            +
                        </div>
                    </a>
                </div>

                <div class="uc-2-list" >
                    @foreach ($korespondens as $koresponden)
                        <div class="uc-2-list-koresponden" data-updated="{{ $koresponden->updated_at }}">
                            <div class="uc-2-list-koresponden-item">

                                <h4>{{ $koresponden->nama_koresponden }}</h4>

                                <div class="uc-2-list-koresponden-item-desc">
                                    <div class="uc-2-list-koresponden-item-desc-email-list">
                                        @foreach ($koresponden->emails as $email)
                                            <h4>
                                                <span>
                                                    @if ($email->tipe_email == 0)
                                                        Email Instansi
                                                        @elseif ($email->tipe_email == 1)
                                                        Email Pribadi
                                                    @endif
                                                </span>
                                                - {{ $email->nama_email }}
                                            </h4>
                                        @endforeach
                                    </div>
                                    <div class="uc-2-list-button web">
                                        <h4> 
                                            <a href="{{ route('koresponden.edit',
                                            ['id_koresponden' => $koresponden->id], ) }}"  
                                            style="text-decoration: none" 
                                            class="uc-2-button-edit">Edit</a>
                                        </h4>
                                        <h4> 
                                            <form  id="deleteForm{{ $koresponden->id }}" action="{{ route('koresponden.delete', ['id_koresponden' => $koresponden->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="uc-2-button-delete" 
                                                onclick="confirmDelete('{{ $koresponden->id }}', 'Pastikan bahwa data benar benar ingin anda hapus!')">Delete</button>
                                            </form>
                                        </h4>
                                    </div>
                                </div>
                                <div class="uc-2-list-button mobile">
                                    <h4>
                                        <a href="{{ route('koresponden.edit',
                                        ['id_koresponden' => $koresponden->id], ) }}"
                                        style="text-decoration: none"
                                        class="uc-2-button-edit">Edit</a>
                                    </h4>
                                    
                                    <h4>
                                        <form  id="deleteForm{{ $koresponden->id }}" action="{{ route('koresponden.delete', ['id_koresponden' => $koresponden->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="uc-2-button-delete"
                                            onclick="confirmDelete('{{ $koresponden->id }}', 'Pastikan bahwa data benar benar ingin anda hapus!')">Delete</button>
                                        </form>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="uc-2-pagination-section">
                    <div id="uc-2-pagination-koresponden"></div>
                </div>
            </div>

        </div>
    </div>

    {{-- Impor Kebutuhan Javascript --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Konfirmasi Hapus --}}
    <script>
        function confirmDelete(korespondenId, message) {
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
                    $.ajax({
                        url: "{{ url('/koresponden-delete/') }}" + "/" + korespondenId,
                        type: 'GET',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {

                            console.log('sukses response');
                            if (response.status === 'error') {
                                console.log('error sukses response');
                                Swal.fire({
                                    title: 'Gagal',
                                    text: response.message,
                                    icon: 'error'
                                });
                            } else if (response.status === 'success') {
                                console.log(response.status);
                                // Jika data bisa dihapus, submit form untuk menghapus data
                                document.getElementById('deleteForm' + korespondenId).submit();
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log('error response');
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Terjadi kesalahan saat memeriksa data.',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        }
    </script>

    {{-- Filter, sort, search, dan pagination --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sortSelect = document.getElementById("sortSelect");
            const searchInput = document.getElementById("searchBar");
            const paginationContainer = document.getElementById("uc-2-pagination-koresponden")
            const newsItemsContainer = document.querySelector(".uc-2-list");
            const newsItems = Array.from(newsItemsContainer.querySelectorAll(".uc-2-list-koresponden"));

            const itemsPerPage = 5;
            let currentPage = 1;
            let isRetryingSearch = false;

            sortSelect.addEventListener("change", filterAndSort);
            searchInput.addEventListener("input", filterAndSort);

            function filterAndSort() {
                console.log("filter and sort");
                const sortBy = sortSelect.value;
                const searchQuery = searchInput.value.toLowerCase();
                const isDesc = sortBy.includes("desc");
                const sortKey = (sortBy.includes("updated") ? "updated" : null);

                // Filter surat berita
                let filteredNewsItems = newsItems.filter(item => {
                    return item.textContent.toLowerCase().includes(searchQuery);
                });

                console.log(filteredNewsItems);

                // Sort surat berita
                if (sortKey) {
                    filteredNewsItems.sort((a, b) => {
                        const aValue = new Date(a.dataset[sortKey]);
                        const bValue = new Date(b.dataset[sortKey]);

                        return isDesc ? bValue - aValue : aValue - bValue;
                    });
                }

                // Pagination
                const totalPages = Math.ceil(filteredNewsItems.length / itemsPerPage);

                if(currentPage === 0){
                    currentPage = Math.max(currentPage, 1);
                } else {
                currentPage = Math.min(currentPage, totalPages);
                }

                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = startIdx + itemsPerPage;
                const paginatedItems = filteredNewsItems.slice(startIdx, endIdx);

                // Refresh untuk data baru kemudian di paginate
                newsItemsContainer.innerHTML = '';
                paginatedItems.forEach(item => {
                    newsItemsContainer.appendChild(item);
                });

                // Render pagination controls
                renderPaginationControls(totalPages);
            }
            
            function renderPaginationControls(totalPages) {
                paginationContainer.innerHTML = '';

                // Previous Pagination Button
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

                // Kalkulasi Page Number 
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

                // Page Number
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

                // Next Pagination Button
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

            filterAndSort();
        });

        // Button header toggle
        function menuToggle(){
            const toggleMenu = document.querySelector('.uc-2-dropdown-user');
            toggleMenu.classList.toggle('active');
        }

    </script>

</body>
</html>
