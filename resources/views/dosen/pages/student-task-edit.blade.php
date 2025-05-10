@extends('base.base-dash-index')
@section('title')
    Kelola Tugas - Siakad By Internal Developer
@endsection
@section('menu')
    Kelola Tugas
@endsection
@section('submenu')
    Edit Tugas Kuliah
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
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Edit Task Form -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
                <form action="{{ route('dosen.akademik.stask-update', $task->code) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <!-- Card Header -->
                    <div class="bg-[#0C6E71] px-6 py-4 flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-white">
                            @yield('submenu') - {{ $task->jadkul->matkul->name . ' - ' . $task->jadkul->pert_id }}
                        </h2>
                        <div class="flex space-x-2">
                            <button type="submit"
                                class="bg-[#FF6B35] hover:bg-orange-600 text-white px-4 py-2 rounded-md flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Kirim
                            </button>
                            <a href="@yield('urlmenu')"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Jadwal Kuliah -->
                        <div class="space-y-2">
                            <label for="jadkul_id" class="block text-sm font-medium text-[#2E2E2E]">Pilih Jadwal
                                Kuliah</label>
                            <select name="jadkul_id" id="jadkul_id"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50">
                                @foreach ($jadkul as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $task->jadkul_id ? 'selected' : '' }}>
                                        {{ $item->kelas->name . ' - ' . $item->matkul->name . ' - ' . $item->pert_id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jadkul_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Batas Akhir Tanggal -->
                        <div class="space-y-2">
                            <label for="exp_date" class="block text-sm font-medium text-[#2E2E2E]">Batas Akhir
                                Tanggal</label>
                            <input type="date" id="exp_date" name="exp_date" value="{{ $task->exp_date }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50">
                            @error('exp_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Batas Akhir Waktu -->
                        <div class="space-y-2">
                            <label for="exp_time" class="block text-sm font-medium text-[#2E2E2E]">Batas Akhir Waktu</label>
                            <input type="time" id="exp_time" name="exp_time" value="{{ $task->exp_time }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50">
                            @error('exp_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Judul Tugas -->
                        <div class="space-y-2 md:col-span-3">
                            <label for="title" class="block text-sm font-medium text-[#2E2E2E]">Judul Tugas</label>
                            <input type="text" id="title" name="title" value="{{ $task->title }}"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50"
                                placeholder="Masukkan nama judul tugas...">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Detail Tugas -->
                        <div class="space-y-2 md:col-span-3">
                            <label for="detail_task" class="block text-sm font-medium text-[#2E2E2E]">Detail Tugas</label>
                            <textarea name="detail_task" id="summernote" rows="10"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-50 summernote"
                                placeholder="Inputkan detail tugas...">{!! $task->detail_task !!}</textarea>
                            @error('detail_task')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </form>
            </div>

            <!-- Daftar Tugas Terakhir -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[#0C6E71] px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Daftar Tugas Terakhir</h2>
                </div>

                <!-- Card Body -->
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    #</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    Mata Kuliah</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-[#2E2E2E] uppercase tracking-wider">
                                    Kelas</th>
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
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($stask as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ ++$key }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                        {{ $item->jadkul->matkul->name }}<br>
                                        <span class="text-gray-500">{{ $item->jadkul->pert_id }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                        {{ $item->jadkul->kelas->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ $item->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                        {{ \Carbon\Carbon::parse($item->exp_date)->format('d M Y') . ' - ' . \Carbon\Carbon::parse($item->exp_time)->format('H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('dosen.akademik.stask-edit', $item->code) }}"
                                                class="text-[#0C6E71] hover:text-teal-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form id="delete-form-{{ $item->code }}"
                                                action="{{ route('dosen.akademik.stask-destroy', $item->code) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete('{{ $item->code }}', '{{ $item->title }}')"
                                                    class="text-red-600 hover:text-red-900">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd" />
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
        </div>
    </section>

    <script>
        // Delete confirmation function
        function confirmDelete(code, title) {
            if (confirm(Apakah Anda yakin ingin menghapus tugas "${title}" ? )) {
                document.getElementById(delete - form - $ {
                    code
                }).submit();
            }
        }

        // Initialize Summernote
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.summernote')) {
                $('#summernote').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            }
        });
    </script>
@endsection
@section('custom-js')
@endsection
