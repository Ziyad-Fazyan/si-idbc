@extends('base.base-dash-index')
@section('title')
    Data Pengguna Admin - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Admin
@endsection
@section('submenu')
    Data Pengguna Admin
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat data pengguna Admin
@endsection
@section('content')
    <section class="p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold flex justify-between items-center">
                    @yield('submenu')
                    <div class="flex space-x-2">
                        <a href="{{ route('web-admin.workers.admin-create') }}" class="bg-[#0C6E71] text-white px-4 py-2 rounded hover:bg-teal-700 flex items-center">
                            <i class="fa-solid fa-plus mr-2"></i>Tambah
                        </a>
                        <a href="{{ route('web-admin.services.convert.export-users') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 flex items-center">
                            <i class="fa-solid fa-file-export mr-2"></i>Export
                        </a>
                        <button onclick="openImportModal()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 flex items-center">
                            <i class="fa-solid fa-file-import mr-2"></i>Import
                        </button>
                    </div>
                </h5>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Karyawan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role Karyawan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Join Date</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($admin as $key => $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ ++$key }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->gend }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('l, d M Y') }}
                                </td>
                                @if ($item->status === 1)
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-green-600">Active</td>
                                @elseif($item->status === 0)
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-red-600">Non-Active</td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap text-center flex justify-center space-x-2">
                                    <button onclick="openContactModal('{{ $item->code }}')" class="bg-blue-100 text-blue-600 p-2 rounded hover:bg-blue-200">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                    <a href="{{ route('web-admin.workers.admin-edit', $item->code) }}" class="bg-blue-100 text-blue-600 p-2 rounded hover:bg-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete('{{ $item->code }}', '{{ $item->name }}')" class="bg-red-100 text-red-600 p-2 rounded hover:bg-red-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Import Modal -->
    <div id="importModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg w-full max-w-lg">
            <form action="{{ route('web-admin.services.convert.import-users') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h4 class="text-lg font-semibold">Import Pengguna</h4>
                    <div class="flex space-x-2">
                        <button type="submit" class="bg-[#0C6E71] text-white px-3 py-1 rounded hover:bg-teal-700">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        <button type="button" onclick="closeImportModal()" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <label for="import" class="block text-sm font-medium text-gray-700 mb-1">Import Files (xlsx, csv)</label>
                        <input type="file" name="import" id="import" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent" accept=".xls, .xlsx, .csv">
                        @error('import')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Contact Modals -->
    @foreach ($admin as $item)
        <div id="contactModal{{ $item->code }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg w-full max-w-lg">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h4 class="text-lg font-semibold">Lihat Data Kontak - {{ $item->name }}</h4>
                    <button onclick="closeContactModal('{{ $item->code }}')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <div class="flex">
                            <input type="text" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent" value="{{ $item->phone }}" readonly>
                            <a href="https://wa.me/{{ $item->phone }}" target="_blank" class="bg-green-500 text-white px-3 py-2 rounded-r-md hover:bg-green-600">
                                <i class="fa-solid fa-square-phone"></i>
                            </a>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <div class="flex">
                            <input type="text" class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent" value="{{ $item->email }}" readonly>
                            <a href="mailto:{{ $item->email }}" class="bg-red-500 text-white px-3 py-2 rounded-r-md hover:bg-red-600">
                                <i class="fa-solid fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-4 border-b border-gray-200">
                <h4 class="text-lg font-semibold">Konfirmasi Hapus</h4>
            </div>
            <div class="p-4">
                <p id="deleteMessage" class="mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
<script>
    // Import Modal Functions
    function openImportModal() {
        document.getElementById('importModal').classList.remove('hidden');
    }

    function closeImportModal() {
        document.getElementById('importModal').classList.add('hidden');
    }

    // Contact Modal Functions
    function openContactModal(code) {
        document.getElementById('contactModal' + code).classList.remove('hidden');
    }

    function closeContactModal(code) {
        document.getElementById('contactModal' + code).classList.add('hidden');
    }

    // Delete Confirmation Functions
    function confirmDelete(code, name) {
        document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus ${name}?`;
        document.getElementById('deleteForm').action = `/web-admin/workers/admin/${code}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        if (event.target.id === 'importModal') {
            closeImportModal();
        }
        if (event.target.id === 'deleteModal') {
            closeDeleteModal();
        }
        @foreach ($admin as $item)
            if (event.target.id === 'contactModal{{ $item->code }}') {
                closeContactModal('{{ $item->code }}');
            }
        @endforeach
    }
</script>
@endsection
