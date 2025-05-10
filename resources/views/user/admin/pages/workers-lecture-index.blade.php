@extends('base.base-dash-index')
@section('title')
    Data Pengguna Dosen - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Dosen
@endsection
@section('submenu')
    Daftar
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat data pengguna Dosen
@endsection
@section('content')
    <section class="p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold flex justify-between items-center">
                    @yield('menu')
                    <div>
                        <a href="{{ route('web-admin.workers.lecture-create') }}"
                            class="bg-[#0C6E71] hover:bg-[#0a5c5f] text-white px-4 py-2 rounded-md flex items-center gap-2">
                            <i class="fa-solid fa-plus"></i>
                            <span>Tambah</span>
                        </a>
                    </div>
                </h5>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NIDN</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Dosen</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gender</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Join Date</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Button</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($dosen as $key => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-center">{{ ++$key }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->dsn_nidn }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->dsn_name }}</td>
                                <td class="px-6 py-4 text-center">{{ $item->dsn_gend }}</td>
                                <td class="px-6 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('l, d M Y') }}</td>
                                @if ($item->raw_dsn_stat === 1)
                                    <td class="px-6 py-4 text-center"><span class="text-green-600">Active</span></td>
                                @elseif($item->raw_dsn_stat === 0)
                                    <td class="px-6 py-4 text-center"><span class="text-red-600">Non-Active</span></td>
                                @endif
                                <td class="px-6 py-4 flex justify-center items-center space-x-2">
                                    <button onclick="openContactModal('{{ $item->dsn_code }}')"
                                        class="bg-blue-100 hover:bg-blue-200 text-blue-800 p-2 rounded-full">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                    <a href="{{ route('web-admin.workers.lecture-edit', $item->dsn_code) }}"
                                        class="bg-blue-100 hover:bg-blue-200 text-blue-800 p-2 rounded-full">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="confirmDelete('{{ $item->dsn_code }}', '{{ $item->name }}')"
                                        class="bg-red-100 hover:bg-red-200 text-red-800 p-2 rounded-full">
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

    <!-- Contact Modal Template -->
    <div id="contactModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="flex justify-between items-center p-4 border-b">
                <h4 class="text-lg font-semibold">Lihat Data Kontak - <span id="modalDosenName"></span></h4>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <div class="flex">
                            <input type="text" id="modalPhone"
                                class="flex-1 border border-gray-300 rounded-l-md px-3 py-2" readonly>
                            <a id="modalWhatsapp" target="_blank"
                                class="bg-green-100 hover:bg-green-200 text-green-800 px-3 py-2 rounded-r-md border border-l-0 border-gray-300">
                                <i class="fa-solid fa-square-phone"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <div class="flex">
                            <input type="text" id="modalEmail"
                                class="flex-1 border border-gray-300 rounded-l-md px-3 py-2" readonly>
                            <a id="modalMailto"
                                class="bg-red-100 hover:bg-red-200 text-red-800 px-3 py-2 rounded-r-md border border-l-0 border-gray-300">
                                <i class="fa-solid fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t flex justify-end">
                <button onclick="closeModal()" class="bg-[#0C6E71] hover:bg-[#0a5c5f] text-white px-4 py-2 rounded-md">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg w-full max-w-md mx-4">
            <div class="p-4 border-b">
                <h4 class="text-lg font-semibold">Konfirmasi Hapus</h4>
            </div>
            <div class="p-4">
                <p>Anda yakin ingin menghapus data <span id="deleteItemName" class="font-semibold"></span>?</p>
            </div>
            <div class="p-4 border-t flex justify-end space-x-2">
                <button onclick="closeDeleteModal()"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md">
                    Batal
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Contact Modal Functions
        function openContactModal(dsnCode) {
            // In a real implementation, you would fetch the data via AJAX or have it in a data attribute
            // For this example, we'll simulate getting the data
            const item = {!! json_encode($dosen->keyBy('dsn_code')->toArray()) !!}[dsnCode];

            document.getElementById('modalDosenName').textContent = item.dsn_name;
            document.getElementById('modalPhone').value = item.dsn_phone;
            document.getElementById('modalEmail').value = item.dsn_mail;
            document.getElementById('modalWhatsapp').href = `https://wa.me/${item.dsn_phone}`;
            document.getElementById('modalMailto').href = `mailto:${item.dsn_mail}`;

            document.getElementById('contactModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('contactModal').classList.add('hidden');
        }

        // Delete Confirmation Functions
        function confirmDelete(dsnCode, name) {
            document.getElementById('deleteItemName').textContent = name;
            document.getElementById('deleteForm').action =
                `{{ route('web-admin.workers.lecture-destroy', '') }}/${dsnCode}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('contactModal')) {
                closeModal();
            }
            if (event.target === document.getElementById('deleteModal')) {
                closeDeleteModal();
            }
        });
    </script>
@endpush
