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
    <section class="section row">
        <div class="col-lg-12">

            <div class="d-flex justify-content-between align-items-center">
                <div class="a d-flex justify-content-center">
                    <form action="{{ route($prefix . 'publish.album-search') }}" method="GET">
                        <div class="a d-flex justify-content-center">
                            <input type="search" class="form-control" placeholder="Search here..." name="search"
                                id="search">
                            <button type="submit" class="btn btn-info" style="margin-left: 5px"><i
                                    class="fa-solid fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="b d-flex justify-content-center">
                    <a href="{{ route($prefix . 'publish.album-create') }}" class="btn btn-primary"><i
                            class="fa-solid fa-plus"></i> Create</a>
                    <div class="">
                        <a href="" style="margin-left: 5px" class="btn btn-warning"><i
                                class="fa-solid fa-sync"></i></a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4  mt-2">
            <div class="text-center">
                <div class="position-relative">
                    <a href="#" class="overlay-container mb-2 mt-2">
                        <img class="w-100 active" style="border-radius: 20px" src="{{ asset('storage/' . $album->cover) }}"
                            data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                        <span class="overlay-text">{{ $album->name }}</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-2">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Album {{ $album->name }}</h5>
                    <div class="">
                        <a href="{{ route($prefix . 'publish.album-edit', $album->slug) }}" style="margin-left: 5px"
                            class="btn btn-primary"><i class="fa-solid fa-edit"></i></a>
                        <a href="@yield('urlmenu')" style="margin-left: 5px" class="btn btn-warning"><i
                                class="fa-solid fa-backward"></i></a>

                    </div>
                </div>
                <div class="card-body">
                    <p>{{ $album->desc }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 row mt-2 mb-2">
            <div class="col-12 col-sm-12 col-lg-3 mt-2 mb-2 mt-md-0 mb-md-0 text-center">
                <div class="position-relative">
                    <a href="#" class="overlay-container">
                        <img class="w-100 active" style="border-radius: 20px" src="{{ asset('storage/' . $album->file_1) }}"
                            data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                        <span class="overlay-text">Gallery Foto 1 </span>
                    </a>
                </div>
            </div>
            @for ($i = 2; $i <= 20; $i++)
                @if ($album->{'file_' . $i})
                    <div class="col-6 col-sm-12 col-lg-3 mt-2 mb-2 mt-md-0 mb-md-0 text-center">
                        <div class="position-relative">
                            <a href="#" class="overlay-container">
                                <img class="w-100 active" style="border-radius: 20px;"
                                    src="{{ asset('storage/' . $album->{'file_' . $i}) }}"
                                    data-bs-target="#Gallerycarousel" data-bs-slide-to="{{ $i - 1 }}">
                                <span class="overlay-text">Gallery Foto {{ $i }}</span>
                            </a>
                        </div>
                    </div>
                @endif
            @endfor
            {{-- {{ $album->links() }} --}}
        </div>
    </section>
@endsection
@section('custom-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form submit secara default

                // Ambil nilai dari input pencarian
                var query = document.getElementById('query').value.trim();

                // Lakukan validasi minimal satu karakter sebelum melakukan pencarian
                if (query.length > 0) {
                    // Kirim permintaan pencarian ke endpoint yang sesuai
                    fetch(
                            `{{ route($prefix . 'publish.album-index') }}?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            // Handle data yang diterima dari server
                            console.log('Hasil pencarian:', data);
                            // Misalnya, tampilkan hasil pencarian di tempat yang sesuai di halaman Anda
                            // Contoh: document.getElementById('hasilPencarian').innerHTML = data;
                        })
                        .catch(error => console.error('Error:', error));
                } else {
                    // Jika input pencarian kosong, lakukan sesuatu (contoh: tampilkan pesan kesalahan)
                    console.log('Input pencarian kosong');
                    // Contoh: document.getElementById('pesanError').innerHTML = 'Masukkan kata kunci pencarian';
                }
            });
        });
    </script>
@endsection
