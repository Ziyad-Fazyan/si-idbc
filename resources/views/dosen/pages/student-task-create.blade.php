@extends('base.base-dash-index')
@section('title')
    Kelola Tugas - Siakad By Internal Developer
@endsection
@section('menu')
    Kelola Tugas
@endsection
@section('submenu')
    Tambah Tugas Kuliah
@endsection
@section('urlmenu')
    {{ route('dosen.akademik.stask-index') }}
@endsection
@section('subdesc')
    Halaman untuk menambah Tugas Kuliah
@endsection
@section('custom-css')
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-6">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Task Creation Form -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <form action="{{ route('dosen.akademik.stask-store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <div class="border-b border-[#E4E2DE] px-6 py-4 bg-[#0C6E71]">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-white">
                                @yield('submenu')
                            </h2>
                            <div class="flex space-x-2">
                                <button type="submit"
                                    class="px-4 py-2 bg-[#FF6B35] text-white rounded-md hover:bg-opacity-90 transition flex items-center space-x-2">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    <span class="hidden md:inline">Kirim</span>
                                </button>
                                <a href="@yield('urlmenu')"
                                    class="px-4 py-2 bg-[#3B3B3B] text-white rounded-md hover:bg-opacity-90 transition flex items-center space-x-2">
                                    <i class="fa-solid fa-backward"></i>
                                    <span class="hidden md:inline">Kembali</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Jadwal Kuliah Selection -->
                            <div class="space-y-2">
                                <label for="jadkul_id" class="block text-sm font-medium text-[#2E2E2E]">Pilih Jadwal
                                    Kuliah</label>
                                <select name="jadkul_id" id="jadkul_id"
                                    class="w-full rounded-md border border-[#E4E2DE] px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Pilih Jadwal Kuliah</option>
                                    @foreach ($jadkul as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->kelas->name . ' - ' . $item->matkul->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jadkul_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expiration Date -->
                            <div class="space-y-2">
                                <label for="exp_date" class="block text-sm font-medium text-[#2E2E2E]">Batas Akhir
                                    Tanggal</label>
                                <input type="date" id="exp_date" name="exp_date"
                                    class="w-full rounded-md border border-[#E4E2DE] px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                @error('exp_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expiration Time -->
                            <div class="space-y-2">
                                <label for="exp_time" class="block text-sm font-medium text-[#2E2E2E]">Batas Akhir
                                    Waktu</label>
                                <input type="time" id="exp_time" name="exp_time"
                                    class="w-full rounded-md border border-[#E4E2DE] px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                @error('exp_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Task Title -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-medium text-[#2E2E2E]">Judul Tugas</label>
                            <input type="text" id="title" name="title"
                                class="w-full rounded-md border border-[#E4E2DE] px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                placeholder="Masukkan nama judul tugas...">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Task Details -->
                        <div class="space-y-2">
                            <label for="detail_task" class="block text-sm font-medium text-[#2E2E2E]">Detail Tugas</label>
                            <textarea name="detail_task" id="summernote" cols="30" rows="10"
                                class="w-full rounded-md border border-[#E4E2DE] px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                placeholder="Inputkan detail tugas..."></textarea>
                            @error('detail_task')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>

            <!-- Task List -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="border-b border-[#E4E2DE] px-6 py-4 bg-[#0C6E71]">
                    <h2 class="text-xl font-semibold text-white">Daftar Tugas Terakhir</h2>
                </div>

                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#E4E2DE]">
                        <thead class="bg-[#F3EFEA]">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    #</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    Nama Mata Kuliah</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    Nama Kelas</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    Judul Tugas</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    Batas Akhir</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#E4E2DE]">
                            @foreach ($stask as $key => $item)
                                <tr class="hover:bg-[#F3EFEA] transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ ++$key }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                        {{ $item->jadkul->matkul->name }} <br>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                        {{ $item->jadkul->kelas->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ $item->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                        {{ \Carbon\Carbon::parse($item->exp_date)->format('d M Y') . ' - ' . \Carbon\Carbon::parse($item->exp_time)->format('H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('dosen.akademik.stask-edit', $item->code) }}"
                                                class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form id="delete-form-{{ $item->code }}"
                                                action="{{ route('dosen.akademik.stask-destroy', $item->code) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('{{ $item->code }}', '{{ $item->title }}')"
                                                    class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
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
    </section>

    <script>
        function confirmDelete(code, title) {
            if (confirm(Apakah Anda yakin ingin menghapus tugas "${title}" ? )) {
                document.getElementById(delete - form - $ {
                    code
                }).submit();
            }
        }

        // Responsive table handling for mobile
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.querySelector('table');
            if (window.innerWidth < 768) {
                // Add mobile-specific table handling if needed
                // For example, you could convert the table to cards
            }
        });
    </script>
@endsection
@section('custom-js')
@endsection
