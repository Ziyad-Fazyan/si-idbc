@extends('base.base-dash-index')
@section('title')
    Manajemen Mahasiswa Kelas {{ $kelas->name }} - Siakad By Internal Developer
@endsection
@section('menu')
    Data Kelas
@endsection
@section('submenu')
    Manajemen Mahasiswa Kelas {{ $kelas->name }}
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola mahasiswa pada kelas {{ $kelas->name }}
@endsection

@section('content')
    <section class="p-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- Daftar Mahasiswa yang Sudah Terdaftar -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h5 class="flex justify-between items-center text-lg font-semibold">
                        Mahasiswa Terdaftar di Kelas
                        <div class="flex gap-2">
                            <a href="{{ route($prefix . 'master.kelas-index') }}"
                                class="inline-flex items-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                        </div>
                    </h5>
                </div>
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="table1">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Mahasiswa</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($enrolled_mahasiswa as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ ++$key }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ $item->mhs_nim }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900 text-center">{{ $item->mhs_name }}</td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        <form action="{{ route($prefix . 'master.kelas-management-remove', $kelas->code) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="mahasiswa_id" value="{{ $item->id }}">
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini dari kelas?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Form Tambah Mahasiswa ke Kelas -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold">Tambah Mahasiswa ke Kelas</h5>
                </div>
                <div class="p-4">
                    <form action="{{ route($prefix . 'master.kelas-management-add', $kelas->code) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="mahasiswa_ids" class="block text-sm font-medium text-gray-700 mb-2">Pilih Mahasiswa</label>
                            <select name="mahasiswa_ids[]" id="mahasiswa_ids" class="form-select block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50" multiple>
                                @foreach ($available_mahasiswa as $mahasiswa)
                                    <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->mhs_nim }} - {{ $mahasiswa->mhs_name }}</option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Tahan tombol Ctrl (Windows) atau Command (Mac) untuk memilih beberapa mahasiswa</p>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-[#0C6E71] border border-transparent rounded-md font-semibold text-white hover:bg-[#0A5C5E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]">
                                Tambahkan ke Kelas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
        $('#table1').DataTable({
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari Data",
            }
        });
    });
</script>
@endsection