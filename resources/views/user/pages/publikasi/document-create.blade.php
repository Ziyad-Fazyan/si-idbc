@extends('base.base-dash-index')
@section('title')
    Data Dokumen - Siakad By Internal Developer
@endsection
@section('menu')
    Data Dokumen
@endsection
@section('submenu')
    Daftar Dokumen
@endsection
@section('submenu0')
    Tambah Dokumen
@endsection
@section('urlmenu')
    {{ route($prefix . 'document-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengelola Dokumen
@endsection
@section('content')
    <section class="flex flex-col space-y-6 p-4 md:p-8">
        <div class="w-full bg-white rounded-xl shadow-lg overflow-hidden">
            <form action="{{ route($prefix . 'document-store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                    <h5 class="text-xl font-semibold text-gray-800">@yield('submenu0')</h5>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('web-admin.document-index') }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white font-medium text-sm rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            <i class="fa-solid fa-backward mr-2"></i> Kembali
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium text-sm rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            <i class="fa-solid fa-paper-plane mr-2"></i> Simpan
                        </button>
                    </div>
                </div>
                <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div
                        class="lg:col-span-1 flex flex-col items-center justify-center p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <label for="cover" class="block text-sm font-medium text-gray-700 mb-3 text-center">Cover Dokumen
                            (Pratinjau)</label>
                        <img id="preview-image" src="{{ asset('assets/images/default-placeholder.png') }}"
                            alt="Preview Cover"
                            class="w-48 h-48 object-cover rounded-lg shadow-md mb-4 border border-gray-300">
                        <div class="w-full">
                            <label for="cover-upload" class="block text-sm font-medium text-gray-700 mb-2">Pilih Cover
                                Dokumen</label>
                            <input type="file"
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                name="cover" id="cover-upload" onchange="previewImage(event)" accept="image/*">
                            @error('cover')
                                <small class="text-red-600 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div
                        class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="w-full">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Dokumen</label>
                            <input type="text"
                                class="block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm placeholder-gray-400"
                                name="name" id="name" placeholder="Inputkan nama dokumen..."
                                value="{{ old('name') }}">
                            @error('name')
                                <small class="text-red-600 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label for="path" class="block text-sm font-medium text-gray-700 mb-2">File Dokumen</label>
                            <input type="file"
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                                name="path" id="path">
                            @error('path')
                                <small class="text-red-600 text-sm mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @push('scripts')
        <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    const output = document.getElementById('preview-image');
                    output.src = reader.result;
                    // Tidak perlu lagi menghilangkan kelas 'hidden' karena gambar placeholder akan selalu terlihat
                    // dan diganti dengan gambar yang diunggah.
                }
                if (event.target.files && event.target.files[0]) {
                    reader.readAsDataURL(event.target.files[0]);
                } else {
                    // Jika tidak ada file yang dipilih, kembali ke gambar placeholder
                    document.getElementById('preview-image').src = '{{ asset('assets/images/default-placeholder.png') }}';
                }
            }
        </script>
    @endpush
@endsection
