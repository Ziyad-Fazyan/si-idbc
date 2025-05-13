@extends('base.base-dash-index')
@section('title')
    Data Tagihan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Tagihan
@endsection
@section('submenu')
    Tambah
@endsection
@section('urlmenu')
    {{ route($prefix . 'finance.tagihan-index') }}
@endsection
@section('subdesc')
    Halaman untuk melihat data tagihan
@endsection
@section('content')
    <section class="p-4 space-y-4">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Tagihan Card -->
            <a href="{{ route($prefix . 'finance.tagihan-index') }}" class="group">
                <div class="bg-white rounded-lg shadow-md p-4 transition-all duration-300 group-hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="text-emerald-600 mr-4">
                            <i class="fa-solid fa-file-invoice text-4xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">{{ \App\Models\TagihanKuliah::all()->count() }}</p>
                            <p class="text-gray-600">Tagihan</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Pembayaran Card -->
            <a href="{{ route($prefix . 'finance.pembayaran-index') }}" class="group">
                <div class="bg-white rounded-lg shadow-md p-4 transition-all duration-300 group-hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="text-emerald-600 mr-4">
                            <i class="fa-solid fa-file-invoice-dollar text-4xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">{{ \App\Models\HistoryTagihan::where('stat', 1)->count() }}</p>
                            <p class="text-gray-600">Pembayaran</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Income Card -->
            <a href="{{ route($prefix . 'finance.keuangan-index') }}" class="group">
                <div class="bg-white rounded-lg shadow-md p-4 transition-all duration-300 group-hover:shadow-lg">
                    <div class="flex items-center">
                        <div class="text-emerald-600 mr-4">
                            <i class="fa-solid fa-dollar text-4xl"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold">{{ number_format($income, 0, ',', '.') }}</p>
                            <p class="text-gray-600">Income (IDR)</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Create Form -->
        <form action="{{ route($prefix . 'finance.tagihan-store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
            @csrf
            <div class="border-b p-4 flex justify-between items-center bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">@yield('submenu') @yield('menu')</h2>
                <div class="flex space-x-2">
                    <a href="{{ route($prefix . 'finance.tagihan-index') }}" class="px-3 py-1 bg-amber-500 text-white rounded-md hover:bg-amber-600">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        <i class="fa-solid fa-paper-plane mr-1"></i> Simpan
                    </button>
                </div>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Name Field -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Nama Tagihan</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Nama tagihan...">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Nominal Tagihan</label>
                    <input type="text" name="price" id="price" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Nominal tagihan...">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student Select -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Tagihan Mahasiswa</label>
                    <select name="users_id" id="users_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="0" selected>Pilih Mahasiswa</option>
                        @foreach ($mahasiswa as $item)
                            <option value="{{ $item->id }}">{{ $item->mhs_name }}</option>
                        @endforeach
                    </select>
                    @error('users_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Study Program Select -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Tagihan Program Studi</label>
                    <select name="prodi_id" id="prodi_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="0" selected>Pilih Program Studi</option>
                        @foreach ($prodi as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('prodi_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Course Program Select -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Tagihan Program Kuliah</label>
                    <select name="proku_id" id="proku_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="0" selected>Pilih Program Kuliah</option>
                        @foreach ($proku as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('proku_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>

        <!-- Recent Invoices Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="border-b p-4 flex justify-between items-center bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">Data Tagihan Terbaru</h2>
                <div class="flex space-x-2">
                    <a href="{{ route($prefix . 'finance.tagihan-index') }}" class="px-3 py-1 bg-amber-500 text-white rounded-md hover:bg-amber-600">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Tagihan</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tagihan</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Type Tagihan</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tagihan</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($tagihan as $key => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 whitespace-nowrap text-center">{{ ++$key }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center uppercase">{{ $item->code }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">{{ $item->name }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                @if ($item->proku_id > 0)
                                    Type Global
                                @elseif($item->prodi_id > 0)
                                    Type Pribadi
                                @elseif($item->users_id > 0)
                                    Type Pribadi
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                @if ($item->proku_id !== 0 && $item->prokuu)
                                    Program Kuliah<br>
                                    {{ $item->prokuu->name }}
                                @elseif($item->prodi_id !== 0 && $item->prodi)
                                    Program Studi<br>
                                    {{ $item->prodi->name }}
                                @elseif($item->users_id !== 0 && $item->mahasiswa)
                                    Mahasiswa<br>
                                    {{ $item->mahasiswa->mhs_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Edit Button -->
                                    <button onclick="openEditModal('{{ $item->code }}')" class="p-2 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Delete Button -->
                                    <form id="delete-form-{{ $item->code }}" action="{{ route($prefix . 'finance.tagihan-destroy', $item->code) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{ $item->code }}', '{{ $item->name }}')" class="p-2 text-red-600 hover:text-red-800">
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

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">Edit Tagihan</h3>
                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Name Field -->
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">Nama Tagihan</label>
                                        <input type="text" name="name" id="edit_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Nama tagihan...">
                                    </div>

                                    <!-- Price Field -->
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">Nominal Tagihan</label>
                                        <input type="text" name="price" id="edit_price" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Nominal tagihan...">
                                    </div>

                                    <!-- Student Select -->
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">Tagihan Mahasiswa</label>
                                        <select name="users_id" id="edit_users_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            <option value="0" selected>Pilih Mahasiswa</option>
                                            @foreach ($mahasiswa as $item)
                                                <option value="{{ $item->id }}">{{ $item->mhs_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Study Program Select -->
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">Tagihan Program Studi</label>
                                        <select name="prodi_id" id="edit_prodi_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            <option value="0" selected>Pilih Program Studi</option>
                                            @foreach ($prodi as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Course Program Select -->
                                    <div class="space-y-1">
                                        <label class="block text-sm font-medium text-gray-700">Tagihan Program Kuliah</label>
                                        <select name="proku_id" id="edit_proku_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                            <option value="0" selected>Pilih Program Kuliah</option>
                                            @foreach ($proku as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Perubahan
                        </button>
                        <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
<script>
    // Edit Modal Functions
    function openEditModal(code) {
        // Fetch data via AJAX or use data attributes
        // For simplicity, I'm assuming you'll implement the AJAX call
        document.getElementById('editForm').action = `{{ route($prefix . 'finance.tagihan-update', '') }}/${code}`;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    // Delete Confirmation
    function confirmDelete(code, name) {
        if (confirm(`Apakah Anda yakin ingin menghapus tagihan ${name}?`)) {
            document.getElementById(`delete-form-${code}`).submit();
        }
    }

    // Initialize modals when needed
    document.addEventListener('DOMContentLoaded', function() {
        // You can add any initialization code here
    });
</script>
@endsection