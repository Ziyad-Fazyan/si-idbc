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
    {{ route($prefix . 'publish.album-show', $album->slug) }}
@endsection
@section('content')
    <section class="section p-4">
        <form action="{{ route($prefix . 'publish.album-update', $album->slug) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/3 px-4 mb-6">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4 flex items-center justify-between border-b border-gray-200">
                            <h5 class="text-xl font-semibold text-gray-800">Album Cover</h5>
                            <div class="flex space-x-2">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg flex items-center space-x-2 transition duration-300 ease-in-out">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span>Simpan</span>
                                </button>
                                <a href="@yield('urlmenu')"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg flex items-center space-x-2 transition duration-300 ease-in-out">
                                    <i class="fa-solid fa-backward"></i>
                                    <span>Kembali</span>
                                </a>
                            </div>
                        </div>
                        <div class="p-4 grid grid-cols-1 gap-6">
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $album->cover) }}" class="w-full h-auto rounded-lg mb-2"
                                    alt="Album Cover">
                                <label for="cover" class="block text-gray-700 text-sm font-bold mb-2">Image Cover</label>
                                <input type="file"
                                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    name="cover" id="cover">
                                @error('cover')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Album
                                    Foto</label>
                                <input type="text"
                                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    name="name" id="name" value="{{ $album->name }}"
                                    placeholder="Inputkan nama album foto...">
                                @error('name')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="desc" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi
                                    Album</label>
                                <textarea
                                    class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline resize-y"
                                    name="desc" id="desc" placeholder="Inputkan deskripsi..." cols="30" rows="5">{{ $album->desc }}</textarea>
                                @error('desc')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-2/3 px-4 mb-6">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="p-4 border-b border-gray-200">
                            <h5 class="text-xl font-semibold text-gray-800">Details Album</h5>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <div class="relative mb-2">
                                    @if ($album->file_1)
                                        <img id="preview_1" class="w-full h-auto rounded-lg max-w-lg mx-auto"
                                            src="{{ asset('storage/' . $album->file_1) }}" alt="Preview"
                                            style="display: block;">
                                    @else
                                        <img id="preview_1" class="w-full h-auto rounded-lg max-w-lg mx-auto hidden"
                                            src="#" alt="Preview">
                                    @endif
                                </div>
                                <label for="file_1" class="block text-gray-700 text-sm font-bold mb-2">Gallery Images
                                    1</label>
                                <div class="flex items-center space-x-2">
                                    <input type="file" name="file_1" id="file_1"
                                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        accept="image/*" onchange="previewImage(this, 'preview_1')">
                                    <button type="button" id="add_more"
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg flex items-center space-x-2 transition duration-300 ease-in-out">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                    <button type="button" id="remove"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg flex items-center space-x-2 transition duration-300 ease-in-out">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </div>
                                @error('file_1')
                                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            @for ($i = 2; $i <= 20; $i++)
                                <div class="mb-4 {{ $album->{'file_' . $i} === null ? 'hidden' : '' }}"
                                    id="file_{{ $i }}_div">
                                    <div class="relative mb-2">
                                        @if ($album->{'file_' . $i})
                                            <img id="preview_{{ $i }}"
                                                class="w-full h-auto rounded-lg max-w-lg mx-auto"
                                                src="{{ asset('storage/' . $album->{'file_' . $i}) }}" alt="Preview"
                                                style="display: block;">
                                        @else
                                            <img id="preview_{{ $i }}"
                                                class="w-full h-auto rounded-lg max-w-lg mx-auto hidden" src="#"
                                                alt="Preview">
                                        @endif
                                    </div>
                                    <label for="file_{{ $i }}"
                                        class="block text-gray-700 text-sm font-bold mb-2">Gallery Images
                                        {{ $i }}</label>
                                    <input type="file"
                                        class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        name="file_{{ $i }}" id="file_{{ $i }}" accept="image/*"
                                        onchange="previewImage(this, 'preview_{{ $i }}')">
                                    @error('file_' . $i)
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endfor
                            <p id="warning" class="text-red-500 text-sm italic mt-2 {{ $album->file_21 ?? 'hidden' }}">
                                Maksimal 20 Foto.</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let currentAttachment = 2; // Mulai dari 2 karena file_1 selalu terlihat

                const addButton = document.getElementById('add_more');
                const removeButton = document.getElementById('remove');
                const warningMessage = document.getElementById('warning');

                addButton.addEventListener('click', function() {
                    if (currentAttachment <= 20) {
                        const fileDiv = document.getElementById('file_' + currentAttachment + '_div');
                        if (fileDiv) {
                            fileDiv.classList.remove('hidden');
                            currentAttachment++;
                        }
                    }
                    if (currentAttachment > 20) {
                        warningMessage.classList.remove('hidden');
                    }
                });

                removeButton.addEventListener('click', function() {
                    if (currentAttachment > 2) { // Minimal harus ada file_1
                        currentAttachment--;
                        const fileDiv = document.getElementById('file_' + currentAttachment + '_div');
                        if (fileDiv) {
                            fileDiv.classList.add('hidden');
                            // Opsional: Reset input file dan pratinjau saat disembunyikan
                            const inputFile = document.getElementById('file_' + currentAttachment);
                            if (inputFile) {
                                inputFile.value = ''; // Mengosongkan input file
                            }
                            const previewImage = document.getElementById('preview_' + currentAttachment);
                            if (previewImage) {
                                previewImage.src = '#';
                                previewImage.classList.add('hidden');
                            }
                        }
                        if (currentAttachment <= 20) {
                            warningMessage.classList.add('hidden');
                        }
                    }
                });
            });

            function previewImage(input, imgId) {
                const preview = document.getElementById(imgId);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden'); // Menampilkan gambar
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '#';
                    preview.classList.add('hidden'); // Menyembunyikan gambar
                }
            }
        </script>
    @endpush
@endsection
