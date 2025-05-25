@extends('base.base-dash-index')
@section('title')
    Data Pengguna Mahasiswa - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Mahasiswa
@endsection
@section('submenu')
    Lihat Data
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat data pengguna Mahasiswa
@endsection
@section('content')
    <section class="p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h5 class="text-lg font-semibold flex justify-between items-center">
                    @yield('menu')
                    <div class="flex space-x-2">
                        <a href="{{ route($prefix . 'workers.student-create') }}"
                            class="bg-[#0C6E71] text-white px-4 py-2 rounded hover:bg-[#0a5c5f] transition">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                        <a href="{{ route($prefix . 'services.convert.export-student') }}"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                            <i class="fa-solid fa-file-export"></i>
                        </a>
                        <button onclick="toggleModal('importStudent')"
                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                            <i class="fa-solid fa-file-import"></i>
                        </button>
                    </div>
                </h5>
            </div>
            <div class="p-4 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">NIM
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Mahasiswa</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kelas</th>
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
                        @foreach ($student as $key => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ ++$key }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->mhs_nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->mhs_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->kelas->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->mhs_gend }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('l, d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->mhs_stat }}</td>
                                <td class="px-6 py-4 whitespace-nowrap flex justify-center space-x-2">
                                    <button onclick="toggleModal('viewContact{{ $item->mhs_code }}')"
                                        class="bg-blue-100 text-blue-600 p-2 rounded hover:bg-blue-200 transition">
                                        <i class="fas fa-phone"></i>
                                    </button>
                                    <a href="{{ route($prefix . 'workers.student-edit', $item->mhs_code) }}"
                                        class="bg-blue-100 text-blue-600 p-2 rounded hover:bg-blue-200 transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('web-admin.workers.student-destroy', $item->mhs_code) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this package?')">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Import Student Modal -->
    <div id="importStudent" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route($prefix . 'services.convert.import-student') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Import Mahasiswa</h3>
                            <div class="flex space-x-2">
                                <button type="submit"
                                    class="bg-[#0C6E71] text-white px-3 py-1 rounded hover:bg-[#0a5c5f] transition">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <button type="button" onclick="toggleModal('importStudent')"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="import" class="block text-sm font-medium text-gray-700">Import Files (xlsx,
                                    csv)</label>
                                <input type="file" name="import" id="import"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                    accept=".xls, .xlsx, .csv">
                                @error('import')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Contact Modals -->
    @foreach ($student as $item)
        <div id="viewContact{{ $item->mhs_code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Lihat Data Kontak -
                                {{ $item->mhs_name }}</h3>
                            <button type="button" onclick="toggleModal('viewContact{{ $item->mhs_code }}')"
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text"
                                        class="flex-1 block w-full rounded-none rounded-l-md border-gray-300 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        value="{{ $item->mhs_phone }}" readonly>
                                    <a href="https://wa.me/{{ $item->mhs_phone }}" target="_blank"
                                        class="inline-flex items-center px-3 rounded-r-md bg-green-600 text-white hover:bg-green-700 transition">
                                        <i class="fa-solid fa-square-phone"></i>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Alamat Email</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input type="text"
                                        class="flex-1 block w-full rounded-none rounded-l-md border-gray-300 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        value="{{ $item->mhs_mail }}" readonly>
                                    <a href="mailto:{{ $item->mhs_mail }}"
                                        class="inline-flex items-center px-3 rounded-r-md bg-red-600 text-white hover:bg-red-700 transition">
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('custom-js')
    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        function deleteData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
