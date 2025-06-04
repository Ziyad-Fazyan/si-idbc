@foreach ($gedung as $item)
    <div id="modal-edit-{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-sm transition-all duration-300">
                    <!-- Loading Indicator -->
                    <div id="loading-edit-{{ $item->code }}" class="hidden py-8">
                        <div class="flex justify-center items-center">
                            <div class="animate-spin rounded-full h-10 w-10 border-t-2 border-b-2 border-blue-500"></div>
                        </div>
                    </div>

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-lg font-semibold text-gray-800">Edit Gedung - {{ $item->name }}</h5>
                        <button type="button" onclick="closeModal('modal-edit-{{ $item->code }}')"
                            class="text-gray-500 hover:text-gray-700 transition-colors">
                            <i class="fas fa-fw fa-times mr-1"></i>
                        </button>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                        <div class="flex items-start">
                            <i class="text-yellow-500 fa-solid fa-circle-info mt-1 mr-2"></i>
                            <p class="text-sm text-gray-700">
                                Kolom yang memiliki tanda <span class="text-red-500 font-medium">*</span> <span
                                    class="text-red-500">wajib diisi.</span>
                            </p>
                        </div>
                    </div>

                    <!-- Form Section -->
                    <div id="content-edit-{{ $item->code }}">
                        <form action="{{ route($prefix . 'inventory.gedung-update', $item->code) }}" method="POST"
                            enctype="multipart/form-data" class="space-y-5">
                            @method('PATCH')
                            @csrf

                            <div class="space-y-4">
                                <!-- Name Field -->
                                <div>
                                    <label for="edit-name-{{ $item->code }}" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nama Gedung<span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="edit-name-{{ $item->code }}" name="name" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Inputkan nama gedung..." value="{{ $item->name }}">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Code Field -->
                                <div>
                                    <label for="edit-code-{{ $item->code }}" class="block text-sm font-medium text-gray-700 mb-1">
                                        Kode Gedung <span class="text-gray-500">(3 Huruf Kapital)</span><span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="edit-code-{{ $item->code }}" name="code" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Inputkan kode gedung..." value="{{ $item->code }}"
                                        maxlength="3" uppercase onkeydown="return /[a-zA-Z]/i.test(event.key)">
                                    @error('code')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-3 pt-4">
                                <button type="button" onclick="closeModal('modal-edit-{{ $item->code }}')"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <i class="fas fa-times mr-2"></i>
                                    Batal
                                </button>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
