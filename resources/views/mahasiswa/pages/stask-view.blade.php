@extends('base.base-dash-index')
@section('title')
    Lihat Tugas Kuliah - Siakad By Internal Developer
@endsection
@section('menu')
    Data Tugas Kuliah
@endsection
@section('submenu')
    Tugas {{ $stask->jadkul->matkul->name }}
@endsection
@section('urlmenu')
    {{ route('mahasiswa.akademik.tugas-index') }}
@endsection
@section('subdesc')
    Halaman untuk melihat detail Tugas Kuliah
@endsection
@section('custom-css')
@endsection
@section('content')
    <section class="min-h-screen bg-gray-50 p-4 md:p-8">
        <!-- Task Details Card -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
            <div class="bg-[#0C6E71] px-6 py-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <h2 class="text-xl font-semibold text-white">
                        Lihat @yield('submenu')
                    </h2>
                    <div>
                        <a href="@yield('urlmenu')"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md flex items-center space-x-1 transition-colors">
                            <i class="fa-solid fa-backward"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-4">
                <!-- Task Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Mata Kuliah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah</label>
                        <input type="text" readonly
                            value="{{ $stask->jadkul->matkul->name }} "
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700">
                    </div>

                    <!-- Due Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Batas Akhir Tanggal</label>
                        <input type="date" readonly value="{{ $stask->exp_date }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700">
                    </div>

                    <!-- Due Time -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Batas Akhir Waktu</label>
                        <input type="time" readonly value="{{ $stask->exp_time }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700">
                    </div>
                </div>

                <!-- Task Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Tugas</label>
                    <input type="text" readonly value="{{ $stask->title }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700"
                        placeholder="Masukkan nama judul tugas...">
                </div>

                <!-- Task Details -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Detail Tugas</label>
                    <textarea readonly rows="5" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-700"
                        placeholder="Inputkan detail tugas...">{!! $stask->detail_task !!}</textarea>
                </div>
            </div>
        </div>

        <!-- Task Submission Form -->
        @php
            $studentScore = App\Models\StudentScore::where('stask_id', $stask->id)
                ->where('student_id', Auth::guard('mahasiswa')->user()->id)
                ->first();
        @endphp

        @if($studentScore)
            <!-- Task Status Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="bg-[#0C6E71] px-6 py-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <h2 class="text-xl font-semibold text-white">
                            Status Tugas @yield('submenu')
                        </h2>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status Tugas</label>
                            <div class="px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $studentScore->status == 'Sudah dinilai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $studentScore->status }}
                                </span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nilai</label>
                            <div class="px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                                {{ $studentScore->score !== null ? $studentScore->score : 'Belum dinilai' }}
                            </div>
                        </div>
                    </div>

                    @if($studentScore->comment)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Komentar Dosen</label>
                        <div class="px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                            {{ $studentScore->comment }}
                        </div>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Waktu Pengumpulan</label>
                        <div class="px-3 py-2 border border-gray-300 rounded-md bg-gray-50">
                            {{ \Carbon\Carbon::parse($studentScore->created_at)->isoFormat('dddd, D MMMM Y, HH:mm') }} WIB
                        </div>
                    </div>
                </div>
            </div>
        @else
            <form action="{{ route('mahasiswa.akademik.tugas-store', $stask->code) }}" method="post"
                enctype="multipart/form-data" class="bg-white rounded-lg shadow-md overflow-hidden">
                @csrf

                <div class="bg-[#0C6E71] px-6 py-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <h2 class="text-xl font-semibold text-white">
                            Jawaban @yield('submenu')
                        </h2>
                        <button type="submit"
                            class="bg-[#FF6B35] hover:bg-[#E05D2E] text-white px-4 py-2 rounded-md flex items-center space-x-1 transition-colors">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Kirim Jawaban</span>
                        </button>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                <!-- File Uploads -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- File 1 (Required) -->
                    <div>
                        <label for="file_1" class="block text-sm font-medium text-gray-700 mb-1">File Tugas 1</label>
                        <input type="file" id="file_1" name="file_1"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-[#0C6E71] file:text-white
                                hover:file:bg-[#0A5D60] transition-colors">
                        @error('file_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File 2 (Optional) -->
                    <div>
                        <label for="file_2" class="block text-sm font-medium text-gray-700 mb-1">File Tugas 2
                            (Opsional)</label>
                        <input type="file" id="file_2" name="file_2"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gray-300 file:text-gray-700
                                hover:file:bg-gray-400 transition-colors">
                        @error('file_2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File 3 (Optional) -->
                    <div>
                        <label for="file_3" class="block text-sm font-medium text-gray-700 mb-1">File Tugas 3
                            (Opsional)</label>
                        <input type="file" id="file_3" name="file_3"
                            class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gray-300 file:text-gray-700
                                hover:file:bg-gray-400 transition-colors">
                        @error('file_3')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Answer Details -->
                <div>
                    <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Detail Jawaban</label>
                    <textarea name="desc" id="summernote" rows="8"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                        placeholder="Inputkan keterangan singkat mengenai jawaban tugas kamu..."></textarea>
                    @error('desc')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deadline Warning -->
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Pastikan mengumpulkan sebelum:
                                <span
                                    class="font-bold">{{ \Carbon\Carbon::parse($stask->exp_date . ' ' . $stask->exp_time)->format('d M Y H:i') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </section>
@endsection

@section('custom-js')
    <script>
        // File upload preview functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners for file inputs if you want preview functionality
            const fileInputs = document.querySelectorAll('input[type="file"]');

            fileInputs.forEach(input => {
                input.addEventListener('change', function(event) {
                    const fileName = event.target.files[0]?.name || 'No file chosen';
                    const label = event.target.nextElementSibling;

                    // You could add file preview functionality here if needed
                    console.log(`File selected: ${fileName}`);
                });
            });

            // Initialize Summernote or other rich text editor
            if (document.getElementById('summernote')) {
                // Initialize your rich text editor here
                console.log('Initialize editor');
            }
        });
    </script>
@endsection
