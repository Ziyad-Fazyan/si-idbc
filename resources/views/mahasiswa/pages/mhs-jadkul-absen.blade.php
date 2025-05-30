@extends('base.base-dash-index')
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
@section('custom-css')
    <style>
        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            /* background-color: #f8f8f8; */
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: .625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
            * aria-label has no advantage, it won't be read inside a table
            content: attr(aria-label);
            */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }
        }
    </style>
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-6">
        <form action="{{ route('mahasiswa.home-jadkul-absen-store') }}" method="POST" enctype="multipart/form-data"
            class="max-w-6xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            @csrf

            <!-- Card Header -->
            <div class="bg-[#0C6E71] px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">
                    @yield('submenu')
                </h2>
                <div class="flex space-x-2">
                    <a href="{{ route('mahasiswa.home-jadkul-index') }}"
                        class="p-2 bg-white text-[#0C6E71] rounded-md hover:bg-[#E4E2DE] transition-colors">
                        <i class="fa-solid fa-backward"></i>
                    </a>
                    <button type="submit"
                        class="p-2 bg-[#FF6B35] text-white rounded-md hover:bg-[#E55C2B] transition-colors">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Bukti Absensi -->
                <div class="space-y-2">
                    <label for="absen_proof" class="block text-sm font-medium text-[#2E2E2E]">
                        Bukti Absensi
                    </label>
                    <div class="border-2 border-dashed border-[#E4E2DE] rounded-lg p-4 text-center">
                        <img id="proof-preview" src="" alt="Preview bukti absensi"
                            class="hidden w-full h-auto mb-2 rounded">
                        <input type="file" name="absen_proof" id="absen_proof"
                            class="block w-full text-sm text-[#3B3B3B] file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#0C6E71] file:text-white hover:file:bg-[#0A5C5F]"
                            onchange="previewImage(this)">
                        <p class="text-xs text-[#3B3B3B] mt-1">Format: JPG, PNG (Maks. 2MB)</p>
                    </div>
                    @error('absen_proof')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hidden Fields -->
                <input type="hidden" name="jadkul_code" id="jadkul_code" value="{{ $jadkul->code }}">
                <input type="hidden" name="author_id" id="author_id" value="{{ Auth::guard('mahasiswa')->user()->id }}">

                <!-- Absen Mata Kuliah -->
                <div class="space-y-2">
                    <label for="jadkul_name" class="block text-sm font-medium text-[#2E2E2E]">
                        Absen Mata Kuliah
                    </label>
                    <input type="text" name="jadkul_name" id="jadkul_name"
                        value="{{ $jadkul->matkul->name . ' - ' . $jadkul->pert_id }}" readonly
                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71] bg-gray-50 text-[#2E2E2E]">
                    @error('jadkul_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Mahasiswa -->
                <div class="space-y-2">
                    <label for="author_name" class="block text-sm font-medium text-[#2E2E2E]">
                        Nama Mahasiswa
                    </label>
                    <input type="text" name="author_name" id="author_name"
                        value="{{ Auth::guard('mahasiswa')->user()->mhs_name }}" readonly
                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71] bg-gray-50 text-[#2E2E2E]">
                    @error('author_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kelas Mahasiswa -->
                <div class="space-y-2">
                    <label for="author_class" class="block text-sm font-medium text-[#2E2E2E]">
                        Kelas Mahasiswa
                    </label>
                    <input type="text" name="author_class" id="author_class"
                        value="@forelse(Auth::guard('mahasiswa')->user()->kelas as $kelas){{ $kelas->name }}@if(!$loop->last), @endif@empty Tidak ada kelas @endforelse" readonly
                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71] bg-gray-50 text-[#2E2E2E]">
                    @error('author_class')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Kehadiran -->
                <div class="space-y-2">
                    <label for="absen_type" class="block text-sm font-medium text-[#2E2E2E]">
                        Jenis Kehadiran
                    </label>
                    <select name="absen_type" id="absen_type"
                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71] text-[#2E2E2E]">
                        <option value="">Pilih Jenis Kehadiran</option>
                        <option value="H">Hadir</option>
                        <option value="I">Izin</option>
                        <option value="S">Sakit</option>
                    </select>
                    @error('absen_type')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Perkuliahan -->
                <div class="space-y-2">
                    <label for="absen_date" class="block text-sm font-medium text-[#2E2E2E]">
                        Tanggal Perkuliahan
                    </label>
                    <input type="date" name="absen_date" id="absen_date"
                        value="{{ \Carbon\Carbon::now()->toDateString() }}" readonly
                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71] bg-gray-50 text-[#2E2E2E]">
                    @error('absen_date')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Waktu Absen -->
                <div class="space-y-2">
                    <label for="absen_time" class="block text-sm font-medium text-[#2E2E2E]">
                        Waktu Absen
                    </label>
                    <input type="time" name="absen_time" id="absen_time"
                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71] text-[#2E2E2E]">
                    @error('absen_time')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </form>
    </section>

    <script>
        // Image preview functionality
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
            }
        }

        // Set current time for absen_time
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('absen_time').value = `${hours}:${minutes}`;
        });
    </script>
@endsection
@section('custom-js')
    <script>
        document.getElementById("absen_proof").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('.card-img-top');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script>
        // Update waktu setiap detik
        setInterval(updateTime, 1000);

        function updateTime() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var timeString = hours + ':' + minutes;
            document.getElementById('absen_time').value = timeString;
        }
    </script>
@endsection
