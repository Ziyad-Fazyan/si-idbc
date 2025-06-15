@extends('base.base-dash-index')
@section('menu')
    Gallery Foto Album {{ $album->name }}
@endsection
@section('submenu')
    Daftar Album Foto
@endsection
@section('subdesc')
    Halaman untuk menampilkan album foto
@endsection
@section('urlmenu')
    {{ route($prefix . 'publish.album-index') }}
@endsection
@section('content')
    <section class="container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row gap-4">
            <div class="w-full">
                <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                    <form action="{{ route($prefix . 'publish.album-search') }}" method="GET"
                        class="w-full md:w-auto mb-4 md:mb-0">
                        <div class="flex items-center">
                            <input type="search"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Cari di sini..." name="search" id="search">
                            <button type="submit"
                                class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </div>
                    </form>
                    <div class="flex gap-2">
                        <a href="{{ route($prefix . 'publish.album-create') }}"
                            class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                            <i class="fa-solid fa-plus"></i> Buat
                        </a>
                        <a href=""
                            class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <i class="fa-solid fa-sync"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/3 mt-4">
                <div class="text-center">
                    <div class="relative">
                        <a href="#"
                            class="block overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 mb-4">
                            <img class="w-full h-auto object-cover rounded-xl" src="{{ asset('storage/' . $album->cover) }}"
                                alt="{{ $album->name }}" data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                            <span
                                class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white text-lg font-semibold opacity-0 hover:opacity-100 transition-opacity duration-300 rounded-xl">{{ $album->name }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 mt-4">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-semibold text-gray-800">Album {{ $album->name }}</h5>
                        <div class="flex gap-2">
                            <a href="{{ route($prefix . 'publish.album-edit', $album->slug) }}"
                                class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <i class="fa-solid fa-edit"></i>
                            </a>
                            <a href="@yield('urlmenu')"
                                class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                        </div>
                    </div>
                    <p class="text-gray-700">{{ $album->desc }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6 mb-4">
            <div class="col-span-1 text-center">
                <div class="relative">
                    <a href="#"
                        class="block overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <img class="w-full h-auto object-cover rounded-xl" src="{{ asset('storage/' . $album->file_1) }}"
                            alt="Gallery Foto 1" data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                        <span
                            class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white text-lg font-semibold opacity-0 hover:opacity-100 transition-opacity duration-300 rounded-xl">Gallery
                            Foto 1</span>
                    </a>
                </div>
            </div>
            @for ($i = 2; $i <= 20; $i++)
                @if ($album->{'file_' . $i})
                    <div class="col-span-1 text-center">
                        <div class="relative">
                            <a href="#"
                                class="block overflow-hidden rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <img class="w-full h-auto object-cover rounded-xl"
                                    src="{{ asset('storage/' . $album->{'file_' . $i}) }}"
                                    alt="Gallery Foto {{ $i }}" data-bs-target="#Gallerycarousel"
                                    data-bs-slide-to="{{ $i - 1 }}">
                                <span
                                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-white text-lg font-semibold opacity-0 hover:opacity-100 transition-opacity duration-300 rounded-xl">Gallery
                                    Foto {{ $i }}</span>
                            </a>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
    </section>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Ambil form pencarian berdasarkan atribut action-nya (lebih robust)
                const searchForm = document.querySelector(
                    'form[action="{{ route($prefix . 'publish.album-search') }}"]');
                const searchInput = document.getElementById('search');

                if (searchForm) {
                    searchForm.addEventListener('submit', function(event) {
                        event.preventDefault(); // Mencegah form submit secara default

                        var query = searchInput.value.trim();

                        if (query.length > 0) {
                            // Redirect ke halaman pencarian dengan query
                            window.location.href =
                                `{{ route($prefix . 'publish.album-search') }}?search=${encodeURIComponent(query)}`;
                        } else {
                            console.log('Input pencarian kosong');
                            // Anda bisa menambahkan feedback UI di sini, misalnya menampilkan pesan "Masukkan kata kunci"
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
