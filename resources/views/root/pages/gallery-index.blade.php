@extends('base.base-root-index')

@section('title', 'Album Foto | IDBC')

@section('submenu')
    Daftar Album Foto
@endsection

@section('custom-css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #0d9488 0%, #047857 100%);
            min-height: 250px;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        
        .breadcrumb {
            color: rgba(255, 255, 255, 0.9);
        }
        
        .breadcrumb a:hover {
            color: white;
            text-decoration: underline;
        }
        
        .search-input {
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            border-color: #0d9488;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.2);
        }
        
        .search-btn {
            background: linear-gradient(135deg, #0d9488 0%, #047857 100%);
            transition: all 0.3s ease;
        }
        
        .search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .album-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background: white;
        }
        
        .album-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .album-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .album-card:hover .album-image {
            transform: scale(1.05);
        }
        
        .album-overlay {
            background: linear-gradient(to top, rgba(5, 150, 105, 0.8) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .album-card:hover .album-overlay {
            opacity: 1;
        }
        
        .photo-count {
            background-color: rgba(255, 255, 255, 0.9);
            color: #0d9488;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .empty-state {
            background-color: #f0fdf4;
            border-left: 4px solid #10b981;
        }
        
        .pagination .page-link {
            color: #0d9488;
            border: 1px solid #d1fae5;
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #0d9488 0%, #047857 100%);
            border-color: #0d9488;
        }
        
        .pagination .page-link:hover {
            background-color: #f0fdf4;
        }
    </style>
@endsection

@section('content')
    <section class="py-8 px-4">
        <div class="hero-section flex items-center justify-center text-center mb-10">
            <div class="hero-overlay"></div>
            <div class="container mx-auto px-4 relative z-10">
                {{-- Breadcrumb dihapus sesuai permintaan --}}
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2">@yield('submenu')</h1>
                <p class="text-lg text-white opacity-90 max-w-2xl mx-auto">Koleksi album foto dokumentasi kegiatan dan momen berharga di IDBC</p>
            </div>
        </div>

        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <form action="{{ route('root.gallery-search') }}" method="GET" class="w-full md:w-1/2">
                    <div class="relative">
                        <input type="search" name="search" id="search"
                            class="search-input w-full pl-10 pr-4 py-3 rounded-lg focus:outline-none"
                            placeholder="Cari album foto..." value="{{ request('search') }}">
                        <div class="absolute left-3 top-3.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <button type="submit"
                            class="search-btn absolute right-1 top-1 text-white px-4 py-2 rounded-md flex items-center justify-center">
                            Cari
                        </button>
                    </div>
                </form>
                <div class="w-full md:w-auto">
                    <span class="text-sm text-gray-600">{{ $albums->total() }} album ditemukan</span>
                </div>
            </div>

            @if($albums->isEmpty())
                <div class="empty-state p-6 rounded-lg text-center mb-8">
                    <div class="w-20 h-20 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#10b981" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak ada album foto ditemukan</h3>
                    <p class="text-gray-600 mb-4">Coba gunakan kata kunci pencarian yang berbeda atau periksa kembali nanti.</p>
                    <a href="{{ route('root.gallery-index') }}" class="inline-block px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition">
                        Lihat Semua Album
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach ($albums as $item)
                        <a href="{{ route('root.gallery-show', $item->slug) }}" class="album-card group">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $item->cover) }}" alt="{{ $item->name }}"
                                    class="album-image">
                                <div class="album-overlay absolute inset-0 flex items-end p-4">
                                    <h3 class="text-xl font-semibold text-white leading-tight">{{ $item->name }}</h3>
                                </div>
                                <div class="absolute top-3 right-3 photo-count">
                                    {{ $item->photos_count ?? 0 }} Foto
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">
                                        {{ $item->created_at->format('d M Y') }}
                                    </span>
                                    <button class="text-teal-600 hover:text-teal-800 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif

            @if($albums->hasPages())
                <div class="flex justify-center mt-8">
                    {{ $albums->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Add any interactive functionality here if needed
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
@endpush