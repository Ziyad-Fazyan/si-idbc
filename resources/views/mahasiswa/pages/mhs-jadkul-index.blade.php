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
@section('content')
    <!-- Main container -->
    <div class="container mx-auto px-4 py-6">
        <!-- Card container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Card header with background and border -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <!-- Calendar icon -->
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                        @yield('submenu')
                    </h2>
                    <div class="flex space-x-2">
                        <!-- Add button placeholder if needed -->
                    </div>
                </div>
            </div>

            <!-- Table container with horizontal scroll -->
            <div class="overflow-x-auto">
                <!-- Schedule table -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                #
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Kelas
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mata Kuliah
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dosen
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lokasi
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hari
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Waktu
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $hariIni = \Carbon\Carbon::now()->translatedFormat('l'); // "Senin", "Selasa", dst
                        @endphp
                        @foreach ($jadkul as $key => $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ ++$key }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->kelas->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->matkul->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->dosen->dsn_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->ruang->gedung->name }}<br>
                                    <span
                                        class="text-gray-500">{{ $item->ruang->name . ' - Lantai ' . $item->ruang->floor }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->days_id }}<br>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->start }} <br>
                                    <span class="text-gray-500">-</span> <br>
                                    {{ $item->ended }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <!-- Action buttons container -->
                                    <div class="flex flex-col space-y-2">
                                        {{-- <a href="{{ route('mahasiswa.home-jadkul-absen', $item->code) }}"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                            <!-- Attendance icon -->
                                            <i class="fas fa-calendar-check mr-1"></i>
                                            Absensi
                                        </a> --}}
                                        @if ($item->days_id == $hariIni)
                                            <button onclick="openModal('feedbackModal{{ $item->code }}')"
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                <!-- Feedback icon -->
                                                <i class="fas fa-star mr-1"></i>
                                                Feedback
                                            </button>
                                        @else
                                            <button disabled
                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-gray-400 cursor-not-allowed transition-colors">
                                                <!-- Feedback icon -->
                                                <i class="fas fa-star mr-1"></i>
                                                Feedback
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Card footer for layout consistency -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            </div>
        </div>
    </div>

    <!-- Feedback modals for each schedule item -->
    @foreach ($jadkul as $item)
        <div id="feedbackModal{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>

                <div
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form action="{{ route('mahasiswa.jadkul.feedback-store', $item->code) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                                        Feedback - {{ $item->matkul->name }}
                                    </h3>

                                    <div class="mt-2 space-y-4">
                                        <div>
                                            <label for="fb_score" class="block text-sm font-medium text-gray-700">Skor
                                                Feedback</label>
                                            <select name="fb_score" id="fb_score"
                                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-gray-900">
                                                <option value="" selected>Pilih Salah Satu</option>
                                                <option value="Tidak Puas">Tidak Puas</option>
                                                <option value="Cukup Puas">Cukup Puas</option>
                                                <option value="Sangat Puas">Sangat Puas</option>
                                            </select>
                                            @error('fb_score')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                            <p class="mt-1 text-sm text-gray-500">Ayo berikan Feedback sebagai anonim</p>
                                        </div>

                                        <div>
                                            <label for="fb_reason" class="block text-sm font-medium text-gray-700">Berikan
                                                Alasan</label>
                                            <textarea name="fb_reason" id="fb_reason" rows="4"
                                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
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
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim
                            </button>
                            <button type="button" onclick="closeModal('feedbackModal{{ $item->code }}')"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                                <i class="fas fa-times mr-2"></i> Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal handling scripts -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            document.querySelectorAll('[id^="feedbackModal"]').forEach(modal => {
                if (event.target === modal) {
                    closeModal(modal.id);
                }
            });
        }
    </script>
@endsection
