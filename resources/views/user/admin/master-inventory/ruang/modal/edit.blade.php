@foreach ($ruang as $item)
    <div id="modal-{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true"
                onclick="closeModal('modal-{{ $item->code }}')">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route($prefix . 'inventory.ruang-update', $item->code) }}" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="bg-white px-6 py-6">
                        <!-- Header -->
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-lg font-semibold text-gray-800">Edit Ruang - {{ $item->name }}</h5>
                            <button type="button" onclick="closeModal('modal-{{ $item->code }}')"
                                    class="text-gray-500 hover:text-gray-700 transition-colors">
                                <i class="fas fa-fw fa-times mr-1"></i>
                            </button>
                        </div>

                        <hr class="mb-4">

                        <!-- Form Fields -->
                        <div class="space-y-4">
                            <!-- Gedung Field -->
                            <div>
                                <label for="gedung_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Gedung
                                </label>
                                <select name="gedung_id" id="gedung_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" selected>Pilih Gedung</option>
                                    @foreach ($gedung as $gd)
                                        <option value="{{ $gd->id }}"
                                            {{ $item->gedung_id == $gd->id ? 'selected' : '' }}>{{ $gd->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gedung_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Type Ruang Field -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Type Ruang
                                </label>
                                <select name="type" id="type"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="" selected>Pilih Type Ruang</option>
                                    <option value="0" {{ $item->raw_type == 0 ? 'selected' : '' }}>Ruang Kelas</option>
                                    <option value="1" {{ $item->raw_type == 1 ? 'selected' : '' }}>Ruang Laboratorium</option>
                                    <option value="2" {{ $item->raw_type == 2 ? 'selected' : '' }}>Ruang Kerja</option>
                                    <option value="3" {{ $item->raw_type == 3 ? 'selected' : '' }}>Ruang Pribadi</option>
                                    <option value="4" {{ $item->raw_type == 4 ? 'selected' : '' }}>Fasilitas Umum</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Floor Field -->
                            <div>
                                <label for="floor" class="block text-sm font-medium text-gray-700 mb-1">
                                    Lokasi Lantai Gedung
                                </label>
                                <input type="number" name="floor" id="floor" value="{{ $item->floor }}"
                                    placeholder="Ada dilantai berapa ruangan ini?..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                @error('floor')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Ruangan
                                </label>
                                <input type="text" name="name" id="name" value="{{ $item->name }}"
                                    placeholder="Inputkan nama ruangan..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Code Field -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
                                    Kode Ruangan (5 Huruf Bebas)
                                </label>
                                <input type="text" name="code" id="code" value="{{ $item->code }}"
                                    placeholder="Inputkan kode ruangan..." maxlength="5"
                                    onkeydown="return /[a-zA-Z0-9]/i.test(event.key)"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 uppercase">
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="closeModal('modal-{{ $item->code }}')"
                                class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Tutup
                            </button>
                            <button type="submit"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
