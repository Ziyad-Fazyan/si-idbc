@extends('base.base-dash-index')
@section('title')
    Nilai Mahasiswa - Siakad By Internal Developer
@endsection
@section('menu')
    Nilai Mahasiswa
@endsection
@section('submenu')
    Daftar Mata Kuliah
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat daftar mata kuliah yang diampu
@endsection
@section('content')
    <div class="bg-[#F3EFEA] min-h-screen py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[#0C6E71] px-4 py-5 sm:px-6 border-b border-[#E4E2DE]">
                    <h1 class="text-xl font-medium leading-6 text-white">
                        Daftar Mata Kuliah Yang Diampu
                    </h1>
                </div>

                <!-- Card Body -->
                <div class="px-4 py-5 sm:p-6">
                    @if($jadkul->isEmpty())
                        <div class="text-center py-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada mata kuliah</h3>
                            <p class="mt-1 text-sm text-gray-500">Anda belum memiliki jadwal mengajar mata kuliah.</p>
                        </div>
                    @else
                        <!-- Table for Desktop -->
                        <div class="overflow-x-auto hidden md:block">
                            <table class="min-w-full divide-y divide-[#E4E2DE]">
                                <thead class="bg-[#E4E2DE]">
                                    <tr>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">#</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">Kode</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">Nama Mata Kuliah</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">Program Studi</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">Kelas</th>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#E4E2DE] bg-white">
                                    @foreach ($jadkul as $key => $item)
                                        <tr class="hover:bg-[#F3EFEA] transition-colors duration-200">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                                {{ ++$key }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                                {{ $item->matkul->code }}</td>
                                            <td class="px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                                <div>{{ $item->matkul->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $item->matkul->sks }} SKS</div>
                                            </td>
                                            <td class="px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                                {{ $item->matkul->pstudi->name }}</td>
                                            <td class="px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                                {{ $item->kelas->name }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('dosen.akademik.nilai-mata-kuliah-detail', $item->matkul->id) }}"
                                                        class="inline-flex items-center justify-center p-2 rounded-md text-white bg-[#0C6E71] hover:bg-[#0A5D60] focus:outline-none focus:ring-2 focus:ring-[#0C6E71] transition-colors duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </a>
                                                    <a href="{{ route('dosen.akademik.nilai-rekap', $item->matkul->id) }}"
                                                        class="inline-flex items-center justify-center p-2 rounded-md text-white bg-[#FF6B35] hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Cards for Mobile -->
                        <div class="grid grid-cols-1 gap-4 md:hidden">
                            @foreach ($jadkul as $key => $item)
                                <div class="bg-white p-4 rounded-lg shadow-md border border-[#E4E2DE]">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-medium text-[#2E2E2E]">{{ $item->matkul->name }}</h3>
                                            <p class="text-sm text-gray-500">{{ $item->matkul->code }} - {{ $item->matkul->sks }} SKS</p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#0C6E71] text-white">
                                            {{ ++$key }}
                                        </span>
                                    </div>
                                    
                                    <div class="mt-3 grid grid-cols-2 gap-2 text-sm">
                                        <div>
                                            <span class="text-gray-500">Program Studi:</span>
                                            <p class="font-medium text-[#2E2E2E]">{{ $item->matkul->pstudi->name }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Kelas:</span>
                                            <p class="font-medium text-[#2E2E2E]">{{ $item->kelas->name }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <a href="{{ route('dosen.akademik.nilai-mata-kuliah-detail', $item->matkul->id) }}"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#0C6E71] hover:bg-[#0A5D60] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('dosen.akademik.nilai-rekap', $item->matkul->id) }}"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#FF6B35] hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                            </svg>
                                            Rekap
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection