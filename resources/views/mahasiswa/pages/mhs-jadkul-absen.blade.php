{{-- @extends('base.base-dash-index')
@section('title')
    Absensi Perkuliahan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Jadwal Kuliah
@endsection
@section('submenu')
    Absen Perkuliahan
@endsection
@section('urlmenu')
@endsection
@section('subdesc')
    Halaman untuk melihat Jadwal Kuliah
@endsection
@section('content')
    <!-- Page container -->
    <div class="container mx-auto px-4 py-6">
        <!-- Attendance form -->
        <form action="{{ route('mahasiswa.home-jadkul-absen-store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-xl shadow-md overflow-hidden">
            @csrf

            <!-- Form header with background and border -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <!-- Attendance icon -->
                        <i class="fas fa-calendar-check text-blue-600 mr-2"></i>
                        @yield('submenu')
                    </h2>
                    <div class="flex space-x-2">
                        <!-- Back button -->
                        <a href="{{ route('mahasiswa.home-jadkul-index') }}"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <i class="fa-solid fa-backward mr-1"></i> Kembali
                        </a>
                        <!-- Submit button -->
                        <button type="submit"
                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                            <i class="fa-solid fa-paper-plane mr-1"></i> Kirim Absen
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form body with grid layout -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Proof of attendance upload -->
                <div class="space-y-2">
                    <label for="absen_proof" class="block text-sm font-medium text-gray-700">
                        Bukti Absensi
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                        <img id="proof-preview" src="" alt="Preview bukti absensi"
                            class="hidden w-full h-auto mb-2 rounded">
                        <input type="file" name="absen_proof" id="absen_proof"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700"
                            onchange="previewImage(this)">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Maks. 2MB)</p>
                    </div>
                    @error('absen_proof')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hidden inputs for jadkul_id and author_id -->
                <input type="hidden" name="jadkul_id" id="jadkul_id" value="{{ $jadkul->id }}">
                <input type="hidden" name="author_id" id="author_id" value="{{ Auth::guard('mahasiswa')->user()->id }}">

                <!-- Course attendance name -->
                <div class="space-y-2">
                    <label for="jadkul_name" class="block text-sm font-medium text-gray-700">
                        Absen Mata Kuliah
                    </label>
                    <input type="text" name="jadkul_name" id="jadkul_name" value="{{ $jadkul->matkul->name }}" readonly
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100 text-gray-900">
                    @error('jadkul_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student name -->
                <div class="space-y-2">
                    <label for="author_name" class="block text-sm font-medium text-gray-700">
                        Nama Mahasiswa
                    </label>
                    <input type="text" name="author_name" id="author_name"
                        value="{{ Auth::guard('mahasiswa')->user()->mhs_name }}" readonly
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100 text-gray-900">
                    @error('author_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Student class -->
                <div class="space-y-2">
                    <label for="author_class" class="block text-sm font-medium text-gray-700">
                        Kelas Mahasiswa
                    </label>
                    @php
                        $kelasList = Auth::guard('mahasiswa')->user()->kelas;
                        $kelasString =
                            $kelasList && count($kelasList)
                                ? $kelasList->pluck('name')->implode(', ')
                                : 'Tidak ada kelas';
                    @endphp
                    <input type="text" name="author_class" id="author_class" value="{{ $kelasString }}" readonly
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100 text-gray-900">
                    @error('author_class')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Attendance type select -->
                <div class="space-y-2">
                    <label for="absen_type" class="block text-sm font-medium text-gray-700">
                        Jenis Kehadiran
                    </label>
                    <select name="absen_type" id="absen_type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900">
                        <option value="">Pilih Jenis Kehadiran</option>
                        <option value="H">Hadir</option>
                        <option value="I">Izin</option>
                        <option value="S">Sakit</option>
                    </select>
                    @error('absen_type')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Attendance date -->
                <div class="space-y-2">
                    <label for="absen_date" class="block text-sm font-medium text-gray-700">
                        Tanggal Perkuliahan
                    </label>
                    <input type="date" name="absen_date" id="absen_date"
                        value="{{ \Carbon\Carbon::now()->toDateString() }}" readonly
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-100 text-gray-900">
                    @error('absen_date')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Attendance time -->
                <div class="space-y-2">
                    <label for="absen_time" class="block text-sm font-medium text-gray-700">
                        Waktu Absen
                    </label>
                    <input type="time" name="absen_time" id="absen_time"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900">
                    @error('absen_time')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Card footer for layout consistency -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                <!-- You can add messages or info here if needed -->
            </div>
        </form>
    </div>

    <!-- JavaScript for image preview -->
    <script>
        function previewImage(input) {
            const preview = document.getElementById('proof-preview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                preview.classList.add('hidden');
            }
        }

        // Set current time for absen_time on load and update every second
        document.addEventListener('DOMContentLoaded', function() {
            updateTime();
            setInterval(updateTime, 1000);
        });

        function updateTime() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var timeString = hours + ':' + minutes;
            document.getElementById('absen_time').value = timeString;
        }
    </script>
@endsection --}}
