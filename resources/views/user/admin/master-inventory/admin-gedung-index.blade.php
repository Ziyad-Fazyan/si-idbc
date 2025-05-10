@extends('base.base-dash-index')
@section('title')
    Data Master Gedung - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Gedung
@endsection
@section('submenu')
    Daftar Data Gedung
@endsection
@section('submenu0')
    Tambah Data Gedung
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Gedung
@endsection
@section('content')
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Form Add Building -->
        <div class="lg:col-span-4 col-span-1">
            <form action="{{ route($prefix . 'inventory.gedung-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 flex justify-between items-center border-b border-gray-200">
                        <h5 class="text-lg font-semibold text-gray-800">@yield('submenu0')</h5>
                        <button type="submit" class="px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="p-6">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Gedung</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="name" id="name" placeholder="Inputkan nama gedung...">
                            @error('name')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Kode Gedung ( 3 Huruf Kapital )</label>
                            <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="code" id="code" placeholder="Inputkan kode gedung..."
                                maxlength="3" uppercase onkeydown="return /[a-zA-Z]/i.test(event.key)">
                            @error('code')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Building List -->
        <div class="lg:col-span-8 col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="table1">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Gedung</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Gedung</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($gedung as $key => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500" data-label="Number">{{ ++$key }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500" data-label="Nama Gedung">{{ $item->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500" data-label="Kode Gedung">{{ $item->code }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center items-center space-x-2">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-1 border border-[#0C6E71] text-[#0C6E71] rounded hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                                    onclick="openModal('modal-edit-{{ $item->code }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form id="delete-form-{{ $item->code }}"
                                                    action="{{ route($prefix . 'inventory.gedung-destroy', $item->code) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="inline-flex items-center px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition-colors duration-300"
                                                        onclick="confirmDelete('{{ $item->code }}', '{{ $item->name }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Responsive Design for Mobile -->
                    <div class="mt-4 md:hidden">
                        @foreach ($gedung as $key => $item)
                            <div class="bg-white shadow rounded-lg mb-4 p-4 border-l-4 border-[#0C6E71]">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="font-semibold">{{ $item->name }}</h3>
                                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">{{ $item->code }}</span>
                                </div>
                                <div class="flex justify-end items-center space-x-2 mt-2">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-1 border border-[#0C6E71] text-[#0C6E71] rounded hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                        onclick="openModal('modal-edit-{{ $item->code }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form id="delete-mobile-form-{{ $item->code }}"
                                        action="{{ route($prefix . 'inventory.gedung-destroy', $item->code) }}"
                                        method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition-colors duration-300"
                                            onclick="confirmDelete('{{ $item->code }}', '{{ $item->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Edit Modals -->
    @foreach ($gedung as $item)
        <div id="modal-edit-{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route($prefix . 'inventory.gedung-update', $item->code) }}" method="POST" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="w-full">
                                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Gedung - {{ $item->name }}</h3>
                                        <div class="mt-4">
                                            <div class="mb-4">
                                                <label for="edit-name-{{ $item->code }}" class="block text-sm font-medium text-gray-700 mb-1">Nama Gedung</label>
                                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                    name="name" id="edit-name-{{ $item->code }}" placeholder="Inputkan nama gedung..." value="{{ $item->name }}">
                                                @error('name')
                                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="edit-code-{{ $item->code }}" class="block text-sm font-medium text-gray-700 mb-1">Kode Gedung ( 3 Huruf Kapital )</label>
                                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                    name="code" id="edit-code-{{ $item->code }}" placeholder="Inputkan kode gedung..." value="{{ $item->code }}"
                                                    maxlength="3" uppercase onkeydown="return /[a-zA-Z]/i.test(event.key)">
                                                @error('code')
                                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-[#0C6E71] text-white text-base font-medium hover:bg-[#095052] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71] sm:ml-3 sm:w-auto sm:text-sm">
                                <i class="fas fa-paper-plane mr-2"></i> Submit
                            </button>
                            <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                onclick="closeModal('modal-edit-{{ $item->code }}')">
                                <i class="fas fa-times mr-2"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
    <script>
        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Escape key closes modals
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('[id^="modal-"]').forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        modal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            }
        });

        // Delete confirmation
        function confirmDelete(code, name) {
            if (confirm('Are you sure you want to delete ' + name + '?')) {
                document.getElementById('delete-form-' + code).submit();
            }
        }

        // Force uppercase for code inputs
        document.querySelectorAll('input[uppercase]').forEach(input => {
            input.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        });
    </script>
    @endpush
@endsection
