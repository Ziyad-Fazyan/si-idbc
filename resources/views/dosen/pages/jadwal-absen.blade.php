@extends('base.base-dash-index')
@section('menu')
    Jadwal Mengajar
@endsection
@section('submenu')
    Verifikasi Absen
@endsection
@section('urlmenu')
    {{ route('dosen.akademik.jadwal-index') }}
@endsection
@section('subdesc')
    Halaman untuk memverifikasi absen
@endsection
@section('title')
    @yield('submenu') - @yield('menu') - Siakad By Internal Developer
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-6">
        <div class="max-w-7xl mx-auto">
            <!-- Lecturer Attendance Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                <div class="bg-[#0C6E71] px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Form Absensi Dosen</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('dosen.akademik.jadwal.dosen-absen', $jadkul->code) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Course Details -->
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Mata Kuliah</label>
                                    <input type="text" value="{{ $jadkul->matkul->name }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        readonly>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                                    <input type="text" value="{{ $jadkul->kelas->name }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        readonly>
                                </div>
                            </div>

                            <!-- Attendance Form -->
                            <div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Kehadiran</label>
                                    <select name="absen_type"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        required @if ($dosen_absen) disabled @endif>
                                        <option value="H"
                                            {{ $dosen_absen && $dosen_absen->raw_absen_type === 'H' ? 'selected' : '' }}>
                                            Hadir</option>
                                        <option value="I"
                                            {{ $dosen_absen && $dosen_absen->raw_absen_type === 'I' ? 'selected' : '' }}>
                                            Izin</option>
                                        <option value="S"
                                            {{ $dosen_absen && $dosen_absen->raw_absen_type === 'S' ? 'selected' : '' }}>
                                            Sakit</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Materi</label>
                                    <textarea name="deskripsi_materi" rows="3"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" required
                                        placeholder="Jelaskan materi yang diajarkan hari ini..." @if ($dosen_absen) readonly @endif>{{ $dosen_absen ? $dosen_absen->deskripsi_materi : '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            @if (!$dosen_absen)
                                <button type="submit"
                                    class="bg-[#0C6E71] hover:bg-[#0A5C5F] text-white px-4 py-2 rounded-md transition-colors">
                                    Submit Absensi
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Students Attendance Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-[#0C6E71] px-6 py-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-white">
                        Daftar Kehadiran Mahasiswa
                    </h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-white">
                            @php
                                $totalStudents = $student->count();
                                $presentStudents = $absen
                                    ->filter(function ($item) {
                                        return $item->raw_absen_type === 'H';
                                    })
                                    ->count();
                                $attendanceRate =
                                    $totalStudents > 0 ? round(($presentStudents / $totalStudents) * 100) : 0;
                            @endphp
                            Tingkat Kehadiran: {{ $attendanceRate }}%
                        </span>
                        <a href="@yield('urlmenu')"
                            class="bg-[#FF6B35] hover:bg-orange-600 text-white px-4 py-2 rounded-md flex items-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-4 md:p-6">
                    <form action="{{ route('dosen.akademik.jadwal.absen-mahasiswa.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jadkul_code" value="{{ $jadkul->code }}">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-[#E4E2DE]">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                            #</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                            NIM</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                            Nama Mahasiswa</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                            Sudah Absen</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                            Status</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                            Keterangan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                            Waktu Absen</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($student as $key => $mhs)
                                        @php
                                            $absensi = $absen->where('author_id', $mhs->id)->first();
                                        @endphp
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                                {{ ++$key }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                                {{ $mhs->mhs_nim }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                                {{ $mhs->mhs_name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                                {{ $absensi ? 'Sudah' : 'Belum' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                                <select name="absen_type[{{ $mhs->id }}]"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-1"
                                                    required>
                                                    <option value="H"
                                                        {{ $absensi && $absensi->raw_absen_type === 'H' ? 'selected' : '' }}>
                                                        Hadir</option>
                                                    <option value="I"
                                                        {{ $absensi && $absensi->raw_absen_type === 'I' ? 'selected' : '' }}>
                                                        Izin</option>
                                                    <option value="S"
                                                        {{ $absensi && $absensi->raw_absen_type === 'S' ? 'selected' : '' }}>
                                                        Sakit</option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">
                                                <input type="text" name="absen_desc[{{ $mhs->id }}]"
                                                    value="{{ $absensi ? $absensi->absen_desc : '' }}"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-1 w-full"
                                                    placeholder="Keterangan (optional)">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#2E2E2E] text-center">
                                                {{ $absensi ? \Carbon\Carbon::parse($absensi->absen_time)->format('H:i') . ' WIB' : '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="bg-[#0C6E71] hover:bg-[#0A5C5F] text-white px-4 py-2 rounded-md transition-colors">Simpan
                                Semua</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- @foreach ($absen as $item)
        <!-- Modal for each attendance -->
        <div id="updateAbsen{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal content -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('dosen.akademik.jadwal.update-absen', $item->code) }}" method="POST">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <!-- Modal content goes here -->
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg leading-6 font-medium text-[#2E2E2E]">Edit Absensi -
                                    {{ $item->mahasiswa->mhs_name }}</h3>
                                <button onclick="closeModal()" type="button" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Absensi</label>
                                    <textarea name="absen_desc" rows="3"
                                        class="shadow-sm focus:ring-[#0C6E71] focus:border-[#0C6E71] mt-1 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
                                        placeholder="Tambahkan keterangan absensi...">{{ $item->absen_desc }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#0C6E71] text-base font-medium text-white hover:bg-[#0A5C5F] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71] sm:ml-3 sm:w-auto sm:text-sm">
                                Simpan
                            </button>
                            <button onclick="closeModal()" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach --}}

    <script>
        // Modal handling
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            document.querySelectorAll('[id^="updateAbsen"]').forEach(modal => {
                modal.classList.add('hidden');
            });
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                closeModal();
            }
        }
    </script>
@endsection
