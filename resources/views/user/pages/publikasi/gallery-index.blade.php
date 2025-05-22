@extends('base.base-dash-index')
@section('menu')
    Album Foto
@endsection
@section('submenu')
    Daftar Album Foto
@endsection
@section('subdesc')
    Halaman untuk menampilkan album foto
@endsection
@section('urlmenu')
    #
@endsection
@section('content')
    <section class="py-6">
        <div class="w-full mb-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="w-full md:w-auto">
                    <form action="{{ route($prefix . 'publish.album-search') }}" method="GET" class="flex">
                        <input type="search"
                            class="w-full px-4 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-1 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                            placeholder="Search here..." name="search" id="search">
                        <button type="submit"
                            class="flex items-center justify-center px-4 py-2 bg-[#0C6E71] text-white rounded-r hover:bg-[#095456] transition-colors duration-200">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </form>
                </div>
                <div>
                    <a href="{{ route($prefix . 'publish.album-create') }}"
                        class="inline-flex items-center px-4 py-2 bg-[#0C6E71] text-white rounded hover:bg-[#095456] transition-colors duration-200">
                        <i class="fa-solid fa-plus mr-2"></i> Create
                    </a>
                </div>
            </div>
        </div>

        <div class="w-full">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($album as $item)
                    <div class="relative group">
                        <a href="{{ route($prefix . 'publish.album-show', $item->slug) }}"
                            class="block overflow-hidden rounded-xl shadow-md transition-transform duration-300 group-hover:scale-[1.02]">
                            <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $item->cover) }}"
                                alt="{{ $item->name }}">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-80 rounded-xl">
                            </div>
                            <span class="absolute bottom-0 left-0 right-0 p-4 text-white font-medium text-center">
                                {{ $item->name }}
                            </span>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $album->links() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.querySelector('form[action*="album-search"]');
            if (searchForm) {
                searchForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const searchInput = document.getElementById('search');
                    const query = searchInput.value.trim();

                    if (query.length > 0) {
                        // Show loading indicator
                        const resultsContainer = document.querySelector('.grid');
                        if (resultsContainer) {
                            resultsContainer.innerHTML = `
                                <div class="col-span-full flex justify-center items-center py-12">
                                    <svg class="animate-spin h-8 w-8 text-[#0C6E71]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            `;
                        }

                        // Send search request
                        fetch(`${this.action}?search=${encodeURIComponent(query)}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.text();
                            })
                            .then(html => {
                                // Replace the content with the search results
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newContent = doc.querySelector('.grid');
                                const pagination = doc.querySelector('.mt-8');

                                if (newContent && resultsContainer) {
                                    resultsContainer.innerHTML = newContent.innerHTML;
                                }

                                const paginationContainer = document.querySelector('.mt-8');
                                if (pagination && paginationContainer) {
                                    paginationContainer.innerHTML = pagination.innerHTML;
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                if (resultsContainer) {
                                    resultsContainer.innerHTML = `
                                        <div class="col-span-full text-center py-12">
                                            <p class="text-red-500">Terjadi kesalahan saat mencari. Silakan coba lagi.</p>
                                        </div>
                                    `;
                                }
                            });
                    } else {
                        // If search query is empty, reload the page to show all albums
                        window.location.href = "{{ route($prefix . 'publish.album-index') }}";
                    }
                });
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Custom hover effects */
        .group:hover img {
            filter: brightness(1.05);
        }

        /* Improve pagination styling (if needed) */
        .pagination {
            @apply flex justify-center space-x-1 mt-6;
        }

        .pagination .page-item {
            @apply inline-block;
        }

        .pagination .page-link {
            @apply px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded;
        }

        .pagination .active .page-link {
            @apply bg-[#0C6E71] text-white border-[#0C6E71];
        }

        .pagination .disabled .page-link {
            @apply bg-gray-100 text-gray-400 cursor-not-allowed;
        }
    </style>
@endpush
