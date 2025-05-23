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
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                    <h2 class="text-xl md:text-2xl font-semibold text-gray-800">@yield('submenu')</h2>
                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <a href="{{ route('web-admin.workers.admin-create') }}"
                            class="bg-[#0C6E71] hover:bg-teal-200 text-white hover:text-black px-4 py-2.5 rounded-lg transition-all duration-200 ease-in-out flex items-center justify-center shadow-sm text-sm md:text-base w-full">
                            <i class="fa-solid fa-plus mr-2"></i>
                            <span>Tambah</span>
                        </a>
                        <a href="{{ route('web-admin.services.convert.export-users') }}"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2.5 rounded-lg transition-all duration-200 ease-in-out flex items-center justify-center shadow-sm text-sm md:text-base w-full">
                            <i class="fa-solid fa-file-export mr-2"></i>
                            <span>Export</span>
                        </a>
                        <button onclick="openImportModal()"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2.5 rounded-lg transition-all duration-200 ease-in-out flex items-center justify-center shadow-sm text-sm md:text-base w-full">
                            <i class="fa-solid fa-file-import mr-2"></i>
                            <span>Import</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Nama
                                Karyawan</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Role
                                Karyawan</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Join Date
                            </th>
                            <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-center font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($admin as $key => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 py-3 whitespace-nowrap text-center">{{ ++$key }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">{{ $item->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">{{ $item->type }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">{{ $item->gend }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs font-medium
                                        {{ $item->status === 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $item->status === 1 ? 'Active' : 'Non-Active' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                    <div class="flex justify-center gap-2">
                                        <button
                                            onclick="openContactModal('{{ $item->code }}', '{{ $item->name }}', '{{ $item->phone }}', '{{ $item->email }}')"
                                            class="bg-blue-100 text-blue-600 p-2 rounded hover:bg-blue-200 transition-colors duration-200"
                                            title="Kontak">
                                            <i class="fas fa-phone fa-sm"></i>
                                        </button>
                                        <a href="{{ route('web-admin.workers.admin-edit', $item->code) }}"
                                            class="bg-blue-100 text-blue-600 p-2 rounded hover:bg-blue-200 transition-colors duration-200"
                                            title="Edit">
                                            <i class="fas fa-edit fa-sm"></i>
                                        </a>
                                        <form action="{{ route('web-admin.workers.admin-destroy', $item->code) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this package?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
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
    </section>

    <!-- Import Modal -->
    <div id="importModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none">
        <div class="bg-white rounded-lg w-full max-w-lg mx-4 transform transition-all duration-300 scale-95">
            <form action="{{ route('web-admin.services.convert.import-users') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h4 class="text-lg font-semibold">Import Pengguna</h4>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="bg-primary-600 text-white px-3 py-1 rounded hover:bg-primary-700 transition-colors duration-200">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                        <button type="button" onclick="closeImportModal()"
                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors duration-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <label for="import" class="block text-sm font-medium text-gray-700 mb-2">Import Files (xlsx,
                            csv)</label>
                        <input type="file" name="import" id="import"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                            accept=".xls, .xlsx, .csv" required>
                        @error('import')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-xs text-gray-500">
                        <p>Pastikan file sesuai dengan format yang ditentukan. Unduh template <a href="#"
                                class="text-primary-600 hover:underline">di sini</a>.</p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Contact Modal (Single Dynamic Modal) -->
    <div id="contactModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0 pointer-events-none">
        <div class="bg-white rounded-lg w-full max-w-lg mx-4 transform transition-all duration-300 scale-95">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h4 class="text-lg font-semibold" id="contactModalTitle">Kontak Admin</h4>
                <button onclick="closeContactModal()"
                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors duration-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <div class="flex">
                        <input type="text" id="contactPhone"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                            readonly>
                        <a id="whatsappLink" target="_blank"
                            class="bg-green-500 text-white px-3 py-2 rounded-r-md hover:bg-green-600 transition-colors duration-200 flex items-center">
                            <i class="fa-solid fa-square-phone mr-1"></i>
                            <span class="hidden sm:inline">WhatsApp</span>
                        </a>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                    <div class="flex">
                        <input type="text" id="contactEmail"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                            readonly>
                        <a id="emailLink"
                            class="bg-red-500 text-white px-3 py-2 rounded-r-md hover:bg-red-600 transition-colors duration-200 flex items-center">
                            <i class="fa-solid fa-envelope mr-1"></i>
                            <span class="hidden sm:inline">Email</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div id="loadingIndicator" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg flex items-center gap-4">
            <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-primary-600"></div>
            <span class="text-gray-700">Memproses...</span>
        </div>
    </div>

    <script>
        // Import Modal Functions
        function openImportModal() {
            const modal = document.getElementById('importModal');
            modal.classList.remove('pointer-events-none');
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }

        function closeImportModal() {
            const modal = document.getElementById('importModal');
            modal.classList.add('pointer-events-none');
            modal.classList.remove('opacity-100');
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-95');
        }

        // Contact Modal Functions (Single Dynamic Modal)
        function openContactModal(code, name, phone, email) {
            document.getElementById('contactModalTitle').textContent = `Kontak - ${name}`;
            document.getElementById('contactPhone').value = phone;
            document.getElementById('contactEmail').value = email;
            document.getElementById('whatsappLink').href = `https://wa.me/${phone}`;
            document.getElementById('emailLink').href = `mailto:${email}`;

            const modal = document.getElementById('contactModal');
            modal.classList.remove('pointer-events-none');
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }

        function closeContactModal() {
            const modal = document.getElementById('contactModal');
            modal.classList.add('pointer-events-none');
            modal.classList.remove('opacity-100');
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-95');
        }

        // Delete Confirmation Functions
        function confirmDelete(code, name) {
            document.getElementById('deleteMessage').textContent = `Apakah Anda yakin ingin menghapus admin "${name}"?`;

            // Menggunakan route name yang Anda berikan
            document.getElementById('deleteForm').action = `/workers/data-admin/${code}/destroy`;

            // Alternatif jika ingin menggunakan route() helper Laravel:
            // document.getElementById('deleteForm').action = `{{ route('web-admin.workers.admin-destroy', '') }}/${code}`;

            const modal = document.getElementById('deleteModal');
            modal.classList.remove('pointer-events-none');
            modal.classList.add('opacity-100');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('pointer-events-none');
            modal.classList.remove('opacity-100');
            modal.querySelector('div').classList.remove('scale-100');
            modal.querySelector('div').classList.add('scale-95');
        }

        // Handle form submission
        document.getElementById('deleteForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showLoading();

            fetch(this.action, {
                    method: 'POST', // Tetap POST karena menggunakan method spoofing
                    body: new FormData(this),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    hideLoading();
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        return response.json().then(data => {
                            if (data.success) {
                                window.location.reload();
                            } else {
                                alert(data.message || 'Gagal menghapus data');
                            }
                        });
                    }
                })
                .catch(error => {
                    hideLoading();
                    alert('Terjadi kesalahan: ' + error.message);
                });
        });

        // Loading Indicator
        function showLoading() {
            document.getElementById('loadingIndicator').classList.remove('hidden');
        }

        function hideLoading() {
            document.getElementById('loadingIndicator').classList.add('hidden');
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(event) {
            if (event.target.id === 'importModal') {
                closeImportModal();
            }
            if (event.target.id === 'deleteModal') {
                closeDeleteModal();
            }
            if (event.target.id === 'contactModal') {
                closeContactModal();
            }
        });

        // Add loading indicator to form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', () => {
                showLoading();
            });
        });
    </script>
@endsection
