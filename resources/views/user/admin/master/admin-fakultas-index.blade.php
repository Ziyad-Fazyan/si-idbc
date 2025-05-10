@extends('base.base-dash-index')
@section('title')
    Data Master Fakultas - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Fakultas
@endsection
@section('submenu')
    Daftar Data Fakultas
@endsection
@section('submenu0')
    Tambah Data Fakultas
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Fakultas
@endsection
@section('content')
    <section class="w-full p-4">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Form Tambah Fakultas -->
            <div class="w-full lg:w-1/3">
                <form action="{{ route($prefix . 'master.fakultas-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                        <div class="flex items-center justify-between p-4 border-b border-gray-200">
                            <h5 class="text-lg font-semibold text-gray-800">@yield('submenu0')</h5>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="p-4 space-y-4">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Fakultas</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    name="name" id="name" placeholder="Inputkan nama fakultas...">
                                @error('name')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="code" class="block text-sm font-medium text-gray-700">Kode Fakultas ( 3
                                    Huruf Kapital )</label>
                                <input type="text"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    name="code" id="code" placeholder="Inputkan kode fakultas..." maxlength="3"
                                    uppercase onkeydown="return /[a-zA-Z]/i.test(event.key)">
                                @error('code')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="head_id" class="block text-sm font-medium text-gray-700">Kepala
                                    Fakultas</label>
                                <select name="head_id" id="head_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                    <option value="" selected>Pilih Kepala Fakultas</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->dsn_name }}</option>
                                    @endforeach
                                </select>
                                @error('head_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tabel Daftar Fakultas -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-200">
                        <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                    </div>
                    <div class="p-4">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200" id="table1">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            #</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nama Fakultas</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kode Fakultas</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Kepala Fakultas</th>
                                        <th
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($fakultas as $key => $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">{{ ++$key }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->name }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $item->code }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">
                                                {{ $item->head->dsn_name }}</td>
                                            <td class="px-4 py-3 text-center text-sm text-gray-500">
                                                <div class="flex justify-center items-center space-x-2">
                                                    <button type="button"
                                                        class="inline-flex items-center justify-center p-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300"
                                                        onclick="openModal('updateFakultas{{ $item->code }}')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $item->code }}"
                                                        action="{{ route($prefix . 'master.fakultas-destroy', $item->code) }}"
                                                        method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="inline-flex items-center justify-center p-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                                                            onclick="deleteData('{{ $item->code }}')">
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
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Edit Fakultas -->
    @foreach ($fakultas as $item)
        <div id="updateFakultas{{ $item->code }}"
            class="fixed inset-0 z-50 hidden overflow-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
                <form action="{{ route($prefix . 'master.fakultas-update', $item->code) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="border-b border-gray-200 p-4 flex justify-between items-center">
                        <h4 class="text-lg font-semibold text-gray-800">Edit Fakultas - {{ $item->name }}</h4>
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="button"
                                class="inline-flex items-center justify-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                                onclick="closeModal('updateFakultas{{ $item->code }}')">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Fakultas</label>
                            <input type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="name" id="name" placeholder="Inputkan nama fakultas..."
                                value="{{ $item->name }}">
                            @error('name')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="code" class="block text-sm font-medium text-gray-700">Kode Fakultas ( 3 Huruf
                                Kapital )</label>
                            <input type="text"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                name="code" id="code" placeholder="Inputkan kode fakultas..."
                                value="{{ $item->code }}" maxlength="3" uppercase
                                onkeydown="return /[a-zA-Z]/i.test(event.key)">
                            @error('code')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label for="head_id" class="block text-sm font-medium text-gray-700">Kepala Fakultas</label>
                            <select name="head_id" id="head_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                <option value="" selected>Pilih Kepala Fakultas</option>
                                @foreach ($dosen as $dsn)
                                    <option value="{{ $dsn->id }}"
                                        {{ $item->head_id == $dsn->id ? 'selected' : '' }}>
                                        {{ $dsn->dsn_name }}</option>
                                @endforeach
                            </select>
                            @error('head_id')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </form>
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

            // Delete confirmation
            function deleteData(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    document.getElementById('delete-form-' + id).submit();
                }
            }

            // Close modal when clicking outside
            document.addEventListener('click', function(event) {
                const modals = document.querySelectorAll('[id^="updateFakultas"]');
                modals.forEach(function(modal) {
                    if (event.target === modal) {
                        modal.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            });
        </script>
    @endpush
@endsection
