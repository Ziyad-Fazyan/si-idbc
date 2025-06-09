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
    <section class="flex flex-col space-y-4">
        <div class="w-full">
            <form action="{{ route($prefix . 'document-store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="bg-white rounded-lg shadow">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h5 class="text-lg font-semibold">@yield('submenu')</h5>
                        <div class="flex space-x-2">
                            <a href="{{ route('web-admin.document-index') }}" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 grid grid-cols-1 lg:grid-cols-12 gap-4">
                        <div class="lg:col-span-4 space-y-4">
                            <img id="preview-image" src="" alt="Preview Image" class="hidden max-w-full max-h-full">
                            <div class="w-full">
                                <label for="cover" class="block text-sm font-medium text-gray-700 mb-1">Cover Document</label>
                                <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="cover" id="cover" onchange="previewImage(event)" accept="image/*">
                                @error('cover')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="lg:col-span-8 grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="w-full">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Dokumen</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="name" id="name" placeholder="Inputkan nama dokumen...">
                                @error('name')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="w-full">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">File Dokumen</label>
                                <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md" name="path" id="path">
                                @error('path')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('custom-js')
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview-image');
                output.src = reader.result;
                output.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection