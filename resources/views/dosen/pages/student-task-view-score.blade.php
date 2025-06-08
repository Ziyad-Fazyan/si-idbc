@extends('base.base-dash-index')
@section('title')
    Lihat Tugas Kuliah Mahasiswa - Siakad By Internal Developer
@endsection
@section('menu')
    Data Tugas Kuliah Mahasiswa
@endsection
@section('submenu')
    Tugas {{ $score->studentTask->jadkul->matkul->nama_mk }} 
@endsection
@section('urlmenu')
    {{ route('dosen.akademik.stask-view', $score->studentTask->code) }}
@endsection
@section('subdesc')
    Halaman untuk melihat detail Tugas Kuliah Mahasiswa
@endsection
@section('custom-css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4-dark.css" rel="stylesheet">
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-8">
        <form action="{{ route('dosen.akademik.stask-update-score', $score->code) }}" method="post"
            enctype="multipart/form-data" class="max-w-6xl mx-auto">
            @method('PATCH')
            @csrf
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[#0C6E71] px-6 py-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <h2 class="text-xl font-semibold text-white">
                            Jawaban @yield('submenu')
                        </h2>
                        <div class="flex space-x-2 mt-2 md:mt-0">
                            <button type="submit"
                                class="bg-[#FF6B35] hover:bg-[#E05D2E] text-white px-4 py-2 rounded-md flex items-center space-x-1 transition-colors">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Simpan</span>
                            </button>
                            <a href="@yield('urlmenu')"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md flex items-center space-x-1 transition-colors">
                                <i class="fa-solid fa-backward"></i>
                                <span>Kembali</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-6 space-y-6">
                    <!-- Student Info Row -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Nama Mahasiswa -->
                        <div>
                            <label for="mhs_name" class="block text-sm font-medium text-[#2E2E2E] mb-1">Nama
                                Mahasiswa</label>
                            <input type="text" readonly id="mhs_name" name="mhs_name"
                                class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-50 text-[#2E2E2E]"
                                value="{{ $score->student->mhs_name }}">
                            @error('mhs_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Kelas -->
                        <div>
                            <label for="mhs_class" class="block text-sm font-medium text-[#2E2E2E] mb-1">Nama Kelas</label>
                            <input type="text" readonly id="mhs_class" name="mhs_class"
                                class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-50 text-[#2E2E2E]"
                                value="{{ implode(', ', $score->student->kelas->pluck('name')->toArray()) ?: 'Tidak ada kelas' }}">
                            @error('mhs_class')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hidden Student ID -->
                        <div class="hidden">
                            <label for="student_id" class="block text-sm font-medium text-[#2E2E2E] mb-1">ID Student</label>
                            <input type="text" readonly id="student_id" name="student_id"
                                class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-50 text-[#2E2E2E]"
                                value="{{ $score->student->id }}">
                            @error('student_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Score Input -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="score" class="block text-sm font-medium text-[#2E2E2E] mb-1">Score Tugas</label>
                            <input type="number" {{ $score->score == null ? '' : 'readonly' }} id="score"
                                name="score"
                                class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md text-[#2E2E2E] focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                min="0" max="10" value="{{ $score->score == null ? null : $score->score }}"
                                placeholder="Masukkan Nilai (0-10)">
                            @error('score')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Status Tugas -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-[#2E2E2E] mb-1">Status Tugas</label>
                            <input type="text" readonly id="status" name="status"
                                class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-50 text-[#2E2E2E]"
                                value="{{ $score->status ?? 'Terkumpul' }}">
                        </div>
                    </div>
                    
                    <!-- Comment Input -->
                    <div class="mt-4">
                        <label for="comment" class="block text-sm font-medium text-[#2E2E2E] mb-1">Komentar</label>
                        <textarea id="comment" name="comment" rows="3" {{ $score->score == null ? '' : 'readonly' }}
                            class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md text-[#2E2E2E] focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                            placeholder="Masukkan komentar untuk tugas ini...">{{ $score->comment }}</textarea>
                        @error('comment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Answer Detail -->
                    <div>
                        <label for="summernote" class="block text-sm font-medium text-[#2E2E2E] mb-1">Detail Jawaban</label>
                        <textarea readonly name="desc" id="summernote"
                            class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md text-[#2E2E2E] bg-gray-50 min-h-[200px]"
                            placeholder="Inputkan keterangan singkat mengenai jawaban tugas kamu...">{!! $score->desc !!}</textarea>
                        @error('desc')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Attachments -->
                    <div class="flex flex-wrap gap-2">
                        @for ($i = 1; $i <= 8; $i++)
                            @if (!empty($score->{'file_' . $i}))
                                <a href="{{ route('dosen.akademik.stask-download', ['code' => $score->code, 'fileNumber' => $i]) }}"
                                    class="inline-flex items-center px-3 py-1 bg-[#0C6E71] text-white rounded-md hover:bg-[#0A5D60] transition-colors">
                                    <i class="fa-solid fa-download mr-1"></i>
                                    Lampiran {{ $i }}
                                </a>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('custom-js')
    <script>
        // Add any necessary JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            // Make the score input more interactive
            const scoreInput = document.getElementById('score');

            if (scoreInput) {
                scoreInput.addEventListener('focus', function() {
                    this.classList.add('ring-2', 'ring-[#FF6B35]', 'border-transparent');
                });

                scoreInput.addEventListener('blur', function() {
                    this.classList.remove('ring-2', 'ring-[#FF6B35]', 'border-transparent');
                });

                // Validate on change
                scoreInput.addEventListener('change', function() {
                    if (this.value < 0) this.value = 0;
                    if (this.value > 10) this.value = 10;
                });
            }
        });
    </script>
@endsection
@section('custom-js')
@endsection
