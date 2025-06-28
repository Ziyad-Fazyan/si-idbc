@extends('base.base-dash-index')
@section('title')
    Kelola Tugas - Siakad By Internal Developer
@endsection
@section('menu')
    Kumpulan Tugas Mahasiswa
@endsection
@section('submenu')
    Lihat Daftar Kumpulan Tugas Mahasiswa
@endsection
@section('urlmenu')
    {{ route('dosen.akademik.stask-index') }}
@endsection
@section('subdesc')
    Lihat Daftar Kumpulan Tugas Mahasiswa
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[#0C6E71] px-6 py-4 flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">
                        @yield('menu')
                    </h2>
                    <div class="flex space-x-2">
                        <a href="@yield('urlmenu')"
                            class="bg-white hover:bg-gray-100 text-[#2E2E2E] px-3 py-2 rounded-md flex items-center transition-colors">
                            <i class="fa-solid fa-backward mr-2"></i>
                            <span class="hidden sm:inline">Kembali</span>
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="p-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-[#E4E2DE]">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    #</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Nama Mata Kuliah</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Judul Tugas</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Nama Mahasiswa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Score Tugas</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Waktu Kirim</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-[#3B3B3B] uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($score as $key => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-[#2E2E2E]">{{ ++$key }}</td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">
                                        {{ $item->studentTask->jadkul->matkul->nama_mk }} <br>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">{{ $item->studentTask->title }}</td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">{{ $item->student->mhs_name }}</td>
                                    <td class="px-4 py-4 text-sm font-medium">
                                        @if (isset($item->status))
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full {{ $item->status == 'Sudah dinilai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $item->status }}
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Terkumpul
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-sm font-medium text-[#2E2E2E]">
                                        {{ $item->score != null ? $item->score : '-' }}
                                    </td>
                                    <td class="px-4 py-4 text-sm text-[#2E2E2E]">
                                        {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }} <br>
                                        <span
                                            class="text-gray-500">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('dosen.akademik.stask-view-detail', $item->code) }}"
                                                class="text-white bg-[#0C6E71] hover:bg-teal-800 p-2 rounded-md transition-colors"
                                                title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
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
@endsection
