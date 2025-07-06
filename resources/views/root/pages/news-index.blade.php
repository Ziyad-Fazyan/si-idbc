@extends('base.base-root-index')

@section('title', 'Berita | IDBC')

@section('submenu')
    Daftar Berita
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
            /* Dihapus agar tidak ada pola titik-titik */
        }

        /* --- Gaya untuk elemen berita --- */
        .news-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background: white;
            display: flex;
            flex-direction: column;
            height: 100%; /* Memastikan semua kartu memiliki tinggi yang sama */
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .news-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-card:hover .news-image {
            transform: scale(1.05);
        }

        .news-content {
            padding: 1rem;
            flex-grow: 1; /* Memastikan konten mengisi ruang yang tersedia */
            display: flex;
            flex-direction: column;
        }

        .news-title {
            font-size: 1.125rem; /* text-lg */
            font-weight: 600; /* font-semibold */
            color: #1a202c; /* text-gray-900 atau sejenisnya */
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .news-excerpt {
            font-size: 0.875rem; /* text-sm */
            color: #4a5568; /* text-gray-600 */
            margin-top: 0.5rem;
            flex-grow: 1; /* Memastikan excerpt mengisi ruang */
        }

        .news-date {
            display: block;
            margin-top: 1rem;
            font-size: 0.75rem; /* text-xs */
            color: #a0aec0; /* text-gray-400 */
            text-align: right;
        }

        .empty-state {
            background-color: #f0fdf4; /* Mirip bg-teal-100 */
            border-left: 4px solid #10b981; /* Mirip border-teal-500 */
            color: #065f46; /* Mirip text-teal-700 */
            padding: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        
        .empty-state .font-bold {
            color: #065f46; /* Menjaga warna teks bold konsisten */
        }

        .pagination .page-link {
            color: #0d9488;
            border: 1px solid #d1fae5;
            transition: all 0.2s ease-in-out;
            border-radius: 0.375rem; /* rounded-md */
        }
        
        .pagination .page-link:hover {
            background-color: #e6fffa; /* Tailwind: teal-50 */
            border-color: #38b2ac; /* Tailwind: teal-400 */
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #0d9488 0%, #047857 100%);
            border-color: #0d9488;
            color: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .pagination .page-item.disabled .page-link {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')
    <section class="py-8 px-4">
        <div class="hero-section flex items-center justify-center text-center mb-10">
            <div class="hero-overlay"></div>
            <div class="container mx-auto px-4 relative z-10">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2">@yield('submenu')</h1>
                <p class="text-lg text-white opacity-90 max-w-2xl mx-auto">Informasi terbaru seputar kegiatan dan prestasi IDBC</p>
            </div>
        </div>

        <div class="container mx-auto px-4">
            @if ($posts->isEmpty())
                <div class="empty-state">
                    <div class="w-20 h-20 mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#10b981" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-3m-2 7l-4-4m0 0l-4 4m4-4v7m-4-7h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Belum ada berita tersedia</h3>
                    <p class="text-gray-600 mb-4">Nantikan update terbaru dari IDBC!</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                    @foreach ($posts as $post)
                        <a href="{{ route('root.post-view', $post->slug) }}" class="news-card">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->name }}" class="news-image">
                            <div class="news-content">
                                <h3 class="news-title">{{ \Str::limit($post->name, 60) }}</h3>
                                <p class="news-excerpt">{{ \Str::limit(strip_tags($post->content), 100) }}</p>
                                <span class="news-date">{{ $post->created_at->format('d M Y') }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <div class="flex justify-center mt-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Placeholder for any specific JavaScript for this page
        });
    </script>
@endpush