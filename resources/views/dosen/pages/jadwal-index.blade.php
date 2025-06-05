@extends('base.base-dash-index')
@section('title')
    Jadwal Mengajar - Siakad By Internal Developer
@endsection
@section('menu')
    Jadwal Mengajar
@endsection
@section('submenu')
    Lihat Data
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat Jadwal Mengajar
@endsection
@section('content')
    <div class="bg-[#F3EFEA] min-h-screen py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[#0C6E71] px-4 py-5 sm:px-6 border-b border-[#E4E2DE]">
                    <h1 class="text-xl font-medium leading-6 text-white">
                        @yield('menu')
                    </h1>
                </div>

                <!-- Card Body -->
                <div class="px-4 py-5 sm:p-6">
                    <!-- Table for Desktop -->
                    <div class="overflow-x-auto hidden md:block">
                        <table class="min-w-full divide-y divide-[#E4E2DE]">
                            <thead class="bg-[#E4E2DE]">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">#
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                        Nama Kelas</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                        Nama Mata Kuliah</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                        Dosen Pengajar</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                        Metode Perkuliahan</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                        Lokasi Perkuliahan</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                        Tanggal Perkuliahan</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                        Waktu Perkuliahan</th>
                                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#E4E2DE] bg-white">
                                @foreach ($jadkul as $key => $item)
                                    <tr class="hover:bg-[#F3EFEA] transition-colors duration-200">
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                            {{ ++$key }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                            {{ $item->kelas->code }}</td>
                                        <td class="px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                            <div>{{ $item->matkul->name }}</div>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                            {{ $item->dosen->dsn_name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                        <td class="px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                            <div>{{ $item->ruang->gedung->name }}</div>
                                            <div class="text-[#3B3B3B] text-xs">
                                                {{ $item->ruang->name . ' - Lantai ' . $item->ruang->floor }}</div>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                            <div>{{ $item->days_id }}</div>
                                            <div class="text-[#3B3B3B] text-xs">
                                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</div>
                                        </td>
                                        <td class="px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                            <div>{{ $item->start }}</div>
                                            <div class="text-xs">-</div>
                                            <div>{{ $item->ended }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="{{ route('dosen.akademik.jadwal-view-absen', $item->code) }}"
                                                    class="inline-flex items-center justify-center p-2 rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                                <a href="{{ route('dosen.akademik.jadwal-view-feedback', $item->code) }}"
                                                    class="inline-flex items-center justify-center p-2 rounded-md text-white bg-[#FF6B35] hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile View Cards -->
                    <div class="md:hidden space-y-4">
                        @foreach ($jadkul as $key => $item)
                            <div class="bg-white border border-[#E4E2DE] rounded-lg shadow-sm overflow-hidden">
                                <div
                                    class="bg-[#0C6E71] px-4 py-2 text-white font-medium flex justify-between items-center">
                                    <span>{{ $item->kelas->code }}</span>
                                    <span>#{{ ++$key }}</span>
                                </div>
                                <div class="p-4 space-y-3 text-[#2E2E2E]">
                                    <div>
                                        <div class="text-xs font-medium uppercase text-[#3B3B3B]">Mata Kuliah</div>
                                        <div class="font-medium">{{ $item->matkul->name }}</div>
                                        <div class="text-xs text-[#3B3B3B]">
                                    </div>

                                    <div>
                                        <div class="text-xs font-medium uppercase text-[#3B3B3B]">Dosen Pengajar</div>
                                        <div>{{ $item->dosen->dsn_name }}</div>
                                    </div>

                                    <div>
                                        <div class="text-xs font-medium uppercase text-[#3B3B3B]">Metode Perkuliahan</div>
                                    </div>

                                    <div>
                                        <div class="text-xs font-medium uppercase text-[#3B3B3B]">Lokasi Perkuliahan</div>
                                        <div>{{ $item->ruang->gedung->name }}</div>
                                        <div class="text-xs text-[#3B3B3B]">
                                            {{ $item->ruang->name . ' - Lantai ' . $item->ruang->floor }}</div>
                                    </div>

                                    <div>
                                        <div class="text-xs font-medium uppercase text-[#3B3B3B]">Tanggal Perkuliahan</div>
                                        <div>{{ $item->days_id }}</div>
                                        <div class="text-xs text-[#3B3B3B]">
                                            {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</div>
                                    </div>

                                    <div>
                                        <div class="text-xs font-medium uppercase text-[#3B3B3B]">Waktu Perkuliahan</div>
                                        <div>{{ $item->start }} - {{ $item->ended }}</div>
                                    </div>

                                    <div class="pt-2 flex justify-center space-x-3">
                                        <a href="{{ route('dosen.akademik.jadwal-view-absen', $item->code) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Absensi
                                        </a>
                                        <a href="{{ route('dosen.akademik.jadwal-view-feedback', $item->code) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 rounded-md text-white bg-[#FF6B35] hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            Feedback
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- JavaScript for table interactivity -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Add any interactive functionality here
                            const tableRows = document.querySelectorAll('tbody tr');

                            tableRows.forEach(row => {
                                row.addEventListener('click', function(e) {
                                    // Prevent triggering on button clicks
                                    if (e.target.tagName === 'A' || e.target.closest('a')) {
                                        return;
                                    }

                                    // Toggle highlighting of selected row
                                    tableRows.forEach(r => r.classList.remove('bg-[#F3EFEA]'));
                                    this.classList.add('bg-[#F3EFEA]');
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
