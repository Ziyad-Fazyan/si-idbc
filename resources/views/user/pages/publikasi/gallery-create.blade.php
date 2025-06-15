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
    {{ route($prefix . 'publish.album-index') }}
@endsection
@section('content')
    <section class="p-4">
        <form action="{{ route($prefix . 'publish.album-store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/3 px-4 mb-6">
                    <div class="bg-white shadow-md rounded-lg">
                        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                            <h5 class="text-lg font-semibold">Album Cover</h5>
                            <div>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                    <i class="fa-solid fa-paper-plane mr-2"></i>Kirim
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="mb-4">
                                <img src="{{ asset('storage/images/gallery/album-a.jpg') }}"
                                    class="w-full h-auto object-cover rounded-md mb-2" alt="Album Cover">
                                <label for="cover" class="block text-gray-700 text-sm font-bold mb-2">Image Cover</label>
                                <input type="file"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    name="cover" id="cover">
                                @error('cover')
                                    <small class="text-red-500 text-xs italic">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Album
                                    Foto</label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    name="name" id="name" placeholder="Inputkan nama album foto...">
                                @error('name')
                                    <small class="text-red-500 text-xs italic">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="desc" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi
                                    Album</label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-32 resize-none"
                                    name="desc" id="desc" placeholder="Inputkan deskripsi..."></textarea>
                                @error('desc')
                                    <small class="text-red-500 text-xs italic">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-2/3 px-4 mb-6">
                    <div class="bg-white shadow-md rounded-lg">
                        <div class="p-4 border-b border-gray-200">
                            <h5 class="text-lg font-semibold">Details Album</h5>
                        </div>
                        <div class="p-4">
                            <div id="gallery-images-container">
                                <div class="mb-4" id="file_1_div">
                                    <div class="relative mb-2">
                                        <img id="preview_1" class="w-full h-auto object-cover rounded-md" src="#"
                                            alt="Preview" style="display: none;">
                                    </div>
                                    <label for="file_1" class="block text-gray-700 text-sm font-bold mb-2">Gallery Images
                                        1</label>
                                    <div class="flex items-center">
                                        <input type="file" name="file_1" id="file_1"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            accept="image/*" onchange="previewImage(this, 'preview_1')">
                                        <button type="button"
                                            class="ml-2 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
                                            id="add_more"><i class="fa-solid fa-plus"></i></button>
                                        <button type="button"
                                            class="ml-2 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded"
                                            id="remove_last"><i class="fa-solid fa-minus"></i></button>
                                    </div>
                                    @error('file_1')
                                        <small class="text-red-500 text-xs italic">{{ $message }}</small>
                                    @enderror
                                </div>
                                @for ($i = 2; $i <= 20; $i++)
                                    <div class="mb-4" id="file_{{ $i }}_div" style="display: none;">
                                        <div class="relative mb-2">
                                            <img id="preview_{{ $i }}"
                                                class="w-full h-auto object-cover rounded-md" src="#" alt="Preview"
                                                style="display: none;">
                                        </div>
                                        <label for="file_{{ $i }}"
                                            class="block text-gray-700 text-sm font-bold mb-2">Gallery Images
                                            {{ $i }}</label>
                                        <input type="file"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            name="file_{{ $i }}" id="file_{{ $i }}" accept="image/*"
                                            onchange="previewImage(this, 'preview_{{ $i }}')">
                                        @error('file_' . $i)
                                            <small class="text-red-500 text-xs italic">{{ $message }}</small>
                                        @enderror
                                    </div>
                                @endfor
                            </div>
                            <div id="warning" class="text-red-500 text-sm italic mt-2" style="display: none;">Maksimal 20
                                Foto.</div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let currentAttachment = 1; // Start from 1 as the first input is always visible
                const maxAttachments = 20;
                const galleryContainer = document.getElementById('gallery-images-container');
                const addMoreBtn = document.getElementById('add_more');
                const removeLastBtn = document.getElementById('remove_last');
                const warningMessage = document.getElementById('warning');

                addMoreBtn.addEventListener('click', function() {
                    if (currentAttachment < maxAttachments) {
                        currentAttachment++;
                        const nextFileInputDiv = document.getElementById('file_' + currentAttachment + '_div');
                        if (nextFileInputDiv) {
                            nextFileInputDiv.style.display = 'block';
                        }
                        if (currentAttachment === maxAttachments) {
                            warningMessage.style.display = 'block';
                        }
                    }
                });

                removeLastBtn.addEventListener('click', function() {
                    if (currentAttachment > 1) { // Ensure at least one input remains
                        const currentFileInputDiv = document.getElementById('file_' + currentAttachment +
                            '_div');
                        if (currentFileInputDiv) {
                            // Clear the file input and hide the preview
                            const fileInput = currentFileInputDiv.querySelector('input[type="file"]');
                            if (fileInput) {
                                fileInput.value = ''; // Clear the selected file
                            }
                            const previewImg = currentFileInputDiv.querySelector('img');
                            if (previewImg) {
                                previewImg.src = '#';
                                previewImg.style.display = 'none';
                            }
                            currentFileInputDiv.style.display = 'none';
                        }
                        currentAttachment--;
                        warningMessage.style.display = 'none'; // Hide warning if inputs are removed
                    }
                });
            });

            function previewImage(input, imgId) {
                const preview = document.getElementById(imgId);
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '#';
                    preview.style.display = 'none';
                }
            }
        </script>
    @endpush
@endsection
