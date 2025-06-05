@extends('base.base-dash-index')
@section('title')
    Daftar Tugas Kuliah - Siakad By Internal Developer
@endsection
@section('menu')
    Data Tugas Kuliah
@endsection
@section('submenu')
    Daftar
@endsection
@section('urlmenu')
@endsection
@section('subdesc')
    Halaman untuk melihat daftar Tugas Kuliah
@endsection
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-tasks text-blue-600 mr-2"></i>
                        @yield('menu')
                    </h2>
                    <div class="flex space-x-2">
                        <!-- Add button if needed -->
                        {{-- <a href="{{ route('web-admin.master.tagihan-index') }}" class="btn btn-outline-primary">
                            <i class="fa-solid fa-plus"></i>
                        </a> --}}
                    </div>
                </div>
                <p class="mt-1 text-sm text-gray-500">@yield('subdesc')</p>
            </div>

            <!-- Card Body -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Tugas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dosen</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batas Waktu</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($stask as $key => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ++$key }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->dosen->dsn_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $item->jadkul->matkul->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($item->exp_date)->isoFormat('dddd, D MMMM Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->exp_time)->format('H:i') }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('mahasiswa.akademik.tugas-view', $item->code) }}"
                                   class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    <i class="fa-solid fa-eye mr-1"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Card Footer - Pagination if needed -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                <!-- Pagination would go here -->
            </div>
        </div>
    </div>
@endsection
