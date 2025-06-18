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
    Halaman untuk melihat Jadwal Mengajar Anda
@endsection
@section('content')
    <div class="bg-gray-50 min-h-screen py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Jadwal Mengajar</h1>
                <p class="mt-2 text-sm text-gray-600">Berikut adalah daftar jadwal mengajar Anda untuk semester ini</p>
                
                <!-- Filters -->
                <div class="mt-4 flex flex-col sm:flex-row gap-4">
                    <div class="w-full sm:w-64">
                        <label for="filter-day" class="block text-sm font-medium text-gray-700">Filter Hari</label>
                        <select id="filter-day" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Semua Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div class="w-full sm:w-64">
                        <label for="filter-class" class="block text-sm font-medium text-gray-700">Filter Kelas</label>
                        <select id="filter-class" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Semua Kelas</option>
                            @foreach($jadkul->unique('kelas_id') as $item)
                                <option value="{{ $item->kelas_id }}">{{ $item->kelas->code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block bg-white shadow rounded-lg overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-indigo-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Kelas</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Mata Kuliah</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Hari/Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Waktu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Ruangan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-indigo-800 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-indigo-800 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($jadkul as $key => $item)
                            @php
                                $isPast = \Carbon\Carbon::parse($item->date)->isPast();
                                $isToday = \Carbon\Carbon::parse($item->date)->isToday();
                            @endphp
                            <tr data-class-id="{{ $item->kelas_id }}" class="{{ $isPast ? 'bg-gray-50' : ($isToday ? 'bg-blue-50' : 'hover:bg-gray-50') }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ ++$key }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->kelas->code }}</div>
                                    {{-- <div class="text-xs text-gray-500">{{ $item->kelas->prodi->name }}</div> --}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->matkul->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->matkul->code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->days_id }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($item->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->ended)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->ruang->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->ruang->gedung->name }} (Lantai {{ $item->ruang->floor }})</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($isPast)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Selesai
                                        </span>
                                    @elseif($isToday)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Hari Ini
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Akan Datang
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        @php
                                            $currentDay = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd');
                                        @endphp
                                        @if($item->days_id === $currentDay)
                                            <a href="{{ route('dosen.akademik.jadwal-view-absen', $item->code) }}" class="text-indigo-600 hover:text-indigo-900 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Absen
                                            </a>
                                        @else
                                            <span class="text-gray-400 flex items-center cursor-not-allowed" title="Absen hanya bisa dilakukan pada hari jadwal">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Absen
                                            </span>
                                        @endif
                                        <a href="{{ route('dosen.akademik.jadwal-view-feedback', $item->code) }}" class="text-yellow-600 hover:text-yellow-900 flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                            Feedback
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Menampilkan
                                <span class="font-medium">1</span>
                                sampai
                                <span class="font-medium">10</span>
                                dari
                                <span class="font-medium">{{ $jadkul->total() }}</span>
                                hasil
                            </p>
                        </div>
                        <div>
                            {{ $jadkul->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @foreach ($jadkul as $key => $item)
                @php
                    $isPast = \Carbon\Carbon::parse($item->date)->isPast();
                    $isToday = \Carbon\Carbon::parse($item->date)->isToday();
                @endphp
                <div data-class-id="{{ $item->kelas_id }}" class="bg-white shadow overflow-hidden rounded-lg border {{ $isPast ? 'border-gray-200' : ($isToday ? 'border-blue-200' : 'border-gray-200 hover:border-indigo-300') }}">
                    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r {{ $isPast ? 'from-gray-50 to-gray-100' : ($isToday ? 'from-blue-50 to-blue-100' : 'from-white to-indigo-50') }} border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                {{ $item->matkul->name }}
                            </h3>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $isPast ? 'bg-gray-200 text-gray-800' : ($isToday ? 'bg-blue-200 text-blue-800' : 'bg-indigo-100 text-indigo-800') }}">
                                {{ $isPast ? 'Selesai' : ($isToday ? 'Hari Ini' : 'Akan Datang') }}
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $item->matkul->code }} • {{ $item->kelas->code }}
                        </p>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Hari/Tanggal</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $item->days_id }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Waktu</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($item->start)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->ended)->format('H:i') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Ruangan</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $item->ruang->name }} ({{ $item->ruang->gedung->name }})
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Lantai</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $item->ruang->floor }}
                                </dd>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-center space-x-4">
                            @php
                                $currentDay = \Carbon\Carbon::now()->locale('id')->isoFormat('dddd');
                            @endphp
                            @if($item->days_id === $currentDay)
                                <a href="{{ route('dosen.akademik.jadwal-view-absen', $item->code) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Absensi
                                </a>
                            @else
                                <span class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-400 bg-white cursor-not-allowed" title="Absen hanya bisa dilakukan pada hari jadwal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Absensi
                                </span>
                            @endif
                            <a href="{{ route('dosen.akademik.jadwal-view-feedback', $item->code) }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                                Feedback
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const dayFilter = document.getElementById('filter-day');
            const classFilter = document.getElementById('filter-class');
            
            function applyFilters() {
                const dayValue = dayFilter.value.toLowerCase();
                const classValue = classFilter.value;
                
                document.querySelectorAll('tbody tr, .md\\:hidden > div').forEach(row => {
                    const dayText = row.querySelector('td:nth-child(4) div:first-child, [class*="md:hidden"] div > div:nth-child(1) dd').textContent.toLowerCase();
                    const classId = row.getAttribute('data-class-id') || '';
                    
                    const dayMatch = dayValue === '' || dayText.includes(dayValue);
                    const classMatch = classValue === '' || classId === classValue;
                    
                    if (dayMatch && classMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            dayFilter.addEventListener('change', applyFilters);
            classFilter.addEventListener('change', applyFilters);
        });
    </script>
@endsection