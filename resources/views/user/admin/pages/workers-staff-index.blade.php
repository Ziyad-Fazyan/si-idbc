@extends('base.base-dash-index')

@section('title')
    Data Pengguna Karyawan - Siakad By Internal Developer
@endsection

@section('menu')
    Data Pengguna Karyawan
@endsection

@section('submenu')
    Data Pengguna Karyawan
@endsection

@section('urlmenu')
    #
@endsection

@section('subdesc')
    Halaman untuk melihat data pengguna Karyawan
@endsection

@section('content')
    <section class="section">
        <div class="bg-white shadow-md rounded-md overflow-hidden">
            <div class="px-6 py-4 bg-[#f0f9ff]">
                <h5 class="text-lg font-semibold text-gray-900 flex justify-between items-center">
                    @yield('submenu')
                    <a href="{{ route('web-admin.workers.staff-create') }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </h5>
            </div>
            <div class="p-6">
                <table class="min-w-full leading-normal" id="table1">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                #
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Nama Karyawan
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Role Karyawan
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Gender
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Join Date
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $key => $item)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center"
                                    data-label="Number">
                                    {{ ++$key }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center"
                                    data-label="Nama Karyawan">
                                    {{ $item->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center"
                                    data-label="Role Karyawan">
                                    {{ $item->type }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center"
                                    data-label="Gender">
                                    {{ $item->gend }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center"
                                    data-label="Join Date">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('l, d M Y') }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center"
                                    data-label="Status">
                                    @if ($item->status === 1)
                                        <span class="text-green-500">Active</span>
                                    @elseif($item->status === 0)
                                        <span class="text-red-500">Non-Active</span>
                                    @endif
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" data-label="Button">
                                    <div class="flex justify-center items-center">
                                        <button onclick="openModal('contactModal{{ $item->code }}')"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                        <button onclick="openModal('editModal{{ $item->code }}')"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form id="delete-form-{{ $item->code }}"
                                            action="{{ route('web-admin.workers.staff-destroy', $item->code) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
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
    </section>

    {{-- Contact Modal --}}
    @foreach ($admin as $item)
        <div id="contactModal{{ $item->code }}" class="modal hidden fixed z-10 inset-0 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-[#f0f9ff] px-4 py-3 sm:px-6 sm:py-4">
                        <h3 class="text-lg font-semibold text-gray-900" id="modal-title">
                            Lihat Data Kontak - {{ $item->name }}
                        </h3>
                        <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                            onclick="closeModal('contactModal{{ $item->code }}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="bg-white px-4 pb-5 sm:p-6 sm:pb-4">
                        <div class="grid grid-cols-1 gap-4">
                            <div class="col-span-1">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                                <div class="flex justify-between items-center">
                                    <input type="text" id="phone"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        value="{{ $item->phone }}" readonly>
                                    <a href="https://wa.me/{{ $item->phone }}" target="_blank"
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">
                                        <i class="fa-solid fa-square-phone"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                                <div class="flex justify-between items-center">
                                    <input type="text" id="email"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        value="{{ $item->email }}" readonly>
                                    <a href="mailto:{{ $item->email }}"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                                        <i class="fa-solid fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Edit Modal --}}
        <div id="editModal{{ $item->code }}" class="modal hidden fixed z-10 inset-0 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-[#f0f9ff] px-4 py-3 sm:px-6 sm:py-4">
                        <h3 class="text-lg font-semibold text-gray-900" id="modal-title">
                            Edit Data Karyawan - {{ $item->name }}
                        </h3>
                        <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700"
                            onclick="closeModal('editModal{{ $item->code }}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="bg-white px-4 pb-5 sm:p-6 sm:pb-4">
                        <form action="{{ route('web-admin.workers.staff-update', $item->code) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 gap-4">
                                <div class="col-span-1">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama
                                        Karyawan</label>
                                    <input type="text" name="name" id="name"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        value="{{ $item->name }}">
                                </div>
                                <div class="col-span-1">
                                    <label for="type" class="block text-sm font-medium text-gray-700">Role
                                        Karyawan</label>
                                    <select name="type" id="type"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                        <option value="admin" {{ $item->type == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="staff" {{ $item->type == 'staff' ? 'selected' : '' }}>Staff
                                        </option>
                                    </select>
                                </div>
                                <div class="col-span-1">
                                    <label for="gend" class="block text-sm font-medium text-gray-700">Gender</label>
                                    <select name="gend" id="gend"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                        <option value="male" {{ $item->gend == 'male' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="female" {{ $item->gend == 'female' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="col-span-1">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="status"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                        <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Non-Active
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button type="submit"
                                    class="bg-[#0C6E71] hover:bg-[#085558] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">
                                    Simpan
                                </button>
                                <button type="button"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    onclick="closeModal('editModal{{ $item->code }}')">
                                    Batal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('custom-js')
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        function deleteData(code) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById('delete-form-' + code).submit();
            }
        }
    </script>
@endsection
