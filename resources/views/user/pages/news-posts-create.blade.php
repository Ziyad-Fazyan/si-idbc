@extends('base.base-dash-index')
@section('title')
    Data Postingan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Postingan
@endsection
@section('submenu')
    Buat Postingan
@endsection
@section('submenu0')
    Tambah Postingan
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Postingan
@endsection
@section('custom-css')
@endsection
@section('content')
    <section class="py-4">
        <div class="w-full">
            <form action="{{ route('web-admin.news.post-store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="bg-white light:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 light:border-gray-700 flex justify-between items-center">
                        <h5 class="text-xl font-semibold text-gray-700 light:text-gray-200">@yield('submenu')</h5>
                        <div>
                            <a href="{{ route('web-admin.news.post-index') }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition-colors duration-200">
                                <i class="fa-solid fa-backward mr-2"></i> Kembali
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-6 grid grid-cols-1 md:grid-cols-12 gap-6">
                        <!-- Image Upload Section -->
                        <div class="md:col-span-4">
                            <div class="space-y-4">
                                <div class="aspect-w-16 aspect-h-9 bg-gray-100 light:bg-gray-700 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/images/' . Auth::user()->image) }}" class="w-full h-auto object-cover" alt="Post Cover Preview">
                                </div>
                                
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Post Cover</label>
                                    <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 light:file:bg-gray-700 light:file:text-gray-200 light:hover:file:bg-gray-600 light:text-gray-300" name="image" id="image" accept="image/*">
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Fields Section -->
                        <div class="md:col-span-8 space-y-4">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Kategori Postingan</label>
                                <select name="category_id" id="category_id" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white">
                                    <option value="" selected>Pilih Kategori</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Judul Postingan</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white" name="name" id="name" placeholder="Inputkan judul postingan...">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="keywords" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Kata Kunci Postingan</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white" name="keywords" id="keywords" placeholder="Inputkan kata kunci postingan...">
                                @error('keywords')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="metadesc" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Meta Desc Postingan</label>
                                <input type="text" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white" name="metadesc" id="metadesc" placeholder="Inputkan meta deskripsi postingan...">
                                @error('metadesc')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Content Editor Section -->
                        <div class="md:col-span-12 space-y-4">
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 light:text-gray-300 mb-1">Isi Konten Postingan</label>
                                <textarea name="content" id="summernote" class="block w-full rounded-md border-gray-300 light:border-gray-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 light:bg-gray-700 light:text-white" cols="30" rows="10"></textarea>
                                @error('content')
                                    <p class="mt-1 text-sm text-red-600 light:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                    <i class="fa-solid fa-paper-plane mr-2"></i> Submit Post
                                </button>
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
        document.getElementById("image").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('.card-img-top');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
@endsection
