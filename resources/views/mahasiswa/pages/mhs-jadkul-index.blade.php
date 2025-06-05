@extends('base.base-dash-index')
@section('title')
    Data Jadwal Kuliah - Siakad By Internal Developer
@endsection
@section('menu')
    Data Jadwal Kuliah
@endsection
@section('submenu')
    Data Jadwal Kuliah
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
        <div class="max-w-7xl mx-auto">
            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[#0C6E71] px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">
                        @yield('submenu')
                    </h2>
                </div>

                <!-- Card Body -->
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#E4E2DE]">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    #</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Nama Kelas</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Mata Kuliah</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Dosen</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Metode</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Lokasi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Waktu</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($jadkul as $key => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ ++$key }}</td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">{{ $item->kelas->code }}</td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">
                                        {{ $item->matkul->name }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">{{ $item->dosen->dsn_name }}</td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">
                                        {{ $item->ruang->gedung->name }}<br>
                                        <span
                                            class="text-gray-500">{{ $item->ruang->name . ' - Lantai ' . $item->ruang->floor }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">
                                        {{ \Carbon\Carbon::parse($item->date)->isoFormat('dddd') }}<br>
                                        <span
                                            class="text-gray-500">{{ \Carbon\Carbon::parse($item->date)->isoFormat('D MMMM Y') }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">
                                        {{ $item->start }} <br>
                                        <span class="text-gray-500">-</span> <br>
                                        {{ $item->ended }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex flex-col space-y-2">
                                            <a href="{{ route('mahasiswa.home-jadkul-absen', $item->code) }}"
                                                class="bg-[#0C6E71] hover:bg-teal-800 text-white px-3 py-2 rounded-md text-sm flex items-center justify-center transition-colors">
                                                <i class="fas fa-calendar-check mr-2"></i>
                                                Absensi
                                            </a>
                                            <button onclick="openModal('feedbackModal{{ $item->code }}')"
                                                class="bg-[#FF6B35] hover:bg-orange-600 text-white px-3 py-2 rounded-md text-sm flex items-center justify-center transition-colors">
                                                <i class="fas fa-star mr-2"></i>
                                                FeedBack
                                            </button>
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

    <!-- Feedback Modals -->
    @foreach ($jadkul as $item)
        <div id="feedbackModal{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <!-- Modal content -->
                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('mahasiswa.jadkul.feedback-store', $item->code) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-[#2E2E2E] mb-4">
                                        FeedBack - {{ $item->matkul->name }}
                                    </h3>

                                    <div class="mt-2 space-y-4">
                                        <div>
                                            <label for="fb_score" class="block text-sm font-medium text-[#3B3B3B]">Skor
                                                FeedBack</label>
                                            <select name="fb_score" id="fb_score"
                                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71] sm:text-sm rounded-md">
                                                <option value="" selected>Pilih Salah Satu</option>
                                                <option value="Tidak Puas">Tidak Puas</option>
                                                <option value="Cukup Puas">Cukup Puas</option>
                                                <option value="Sangat Puas">Sangat Puas</option>
                                            </select>
                                            @error('fb_score')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <p class="mt-1 text-sm text-gray-500">Ayo berikan FeedBack sebagai anonim</p>
                                        </div>

                                        <div>
                                            <label for="fb_reason" class="block text-sm font-medium text-[#3B3B3B]">Berikan
                                                Alasan</label>
                                            <textarea name="fb_reason" id="fb_reason" rows="4"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-[#0C6E71] focus:border-[#0C6E71] sm:text-sm"
                                                placeholder="Berikan Alasanmu..."></textarea>
                                            @error('fb_reason')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#0C6E71] text-base font-medium text-white hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71] sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim
                            </button>
                            <button type="button" onclick="closeModal('feedbackModal{{ $item->code }}')"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                <i class="fas fa-times mr-2"></i> Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // Modal handling with pure JavaScript
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            document.querySelectorAll('[id^="feedbackModal"]').forEach(modal => {
                if (event.target === modal) {
                    closeModal(modal.id);
                }
            });
        }
    </script>
@endsection
