@extends('base.base-dash-index')
@section('title')
    Detail Nilai Mahasiswa - {{ $matkul->name }} - Siakad By Internal Developer
@endsection
@section('menu')
    Nilai Mahasiswa
@endsection
@section('submenu')
    Detail {{ $matkul->name }}
@endsection
@section('urlmenu')
    {{ route('dosen.akademik.nilai-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengelola nilai mahasiswa pada mata kuliah {{ $matkul->name }}
@endsection
@section('content')
    <div class="bg-[#F3EFEA] min-h-screen py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto space-y-6">
            <!-- Mata Kuliah Info Card -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-[#0C6E71] px-4 py-5 sm:px-6 border-b border-[#E4E2DE]">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <h1 class="text-xl font-medium leading-6 text-white">
                            Informasi Mata Kuliah
                        </h1>
                        <div class="mt-2 md:mt-0 flex space-x-2">
                            <a href="{{ route('dosen.akademik.nilai-index') }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#2E2E2E] bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Kembali
                            </a>
                            <a href="{{ route('dosen.akademik.nilai-rekap', $matkul->id) }}"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#FF6B35] hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                                Lihat Rekap
                            </a>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Kode Mata Kuliah</h3>
                            <p class="mt-1 text-lg font-semibold text-[#2E2E2E]">{{ $matkul->code }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Nama Mata Kuliah</h3>
                            <p class="mt-1 text-lg font-semibold text-[#2E2E2E]">{{ $matkul->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">SKS</h3>
                            <p class="mt-1 text-lg font-semibold text-[#2E2E2E]">{{ $matkul->sks }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Program Studi</h3>
                            <p class="mt-1 text-lg font-semibold text-[#2E2E2E]">{{ $matkul->pstudi->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Tahun Akademik</h3>
                            <p class="mt-1 text-lg font-semibold text-[#2E2E2E]">{{ $matkul->taka->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Jumlah Tugas</h3>
                            <p class="mt-1 text-lg font-semibold text-[#2E2E2E]">{{ count($tugas) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Mahasiswa dan Input Nilai -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-[#0C6E71] px-4 py-5 sm:px-6 border-b border-[#E4E2DE]">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <h1 class="text-xl font-medium leading-6 text-white">
                            Daftar Mahasiswa dan Input Nilai
                        </h1>
                        <div class="mt-2 md:mt-0 flex space-x-2">
                            @if(!$nilai_dikunci)
                                <form action="{{ route('dosen.akademik.nilai-kunci', $matkul->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengunci nilai? Nilai yang sudah dikunci tidak dapat diubah lagi.')" 
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-0.5 mr-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                        Kunci Nilai
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                @if($mahasiswa->isEmpty())
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada mahasiswa</h3>
                        <p class="mt-1 text-sm text-gray-500">Tidak ada mahasiswa yang mengambil mata kuliah ini.</p>
                    </div>
                @elseif($tugas->isEmpty())
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada tugas</h3>
                        <p class="mt-1 text-sm text-gray-500">Belum ada tugas yang diberikan untuk mata kuliah ini.</p>
                        <div class="mt-6">
                            <a href="{{ route('dosen.akademik.stask-create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0C6E71] hover:bg-[#0A5D60] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Tambah Tugas
                            </a>
                        </div>
                    </div>
                @else
                    <form action="{{ route('dosen.akademik.nilai-simpan') }}" method="POST">
                        @csrf
                        <input type="hidden" name="matkul_id" value="{{ $matkul->id }}">
                        <div class="px-4 py-5 sm:p-6 overflow-x-auto">
                            <table class="min-w-full divide-y divide-[#E4E2DE]">
                                <thead class="bg-[#E4E2DE]">
                                    <tr>
                                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">#</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-[#2E2E2E]">NIM</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-[#2E2E2E]">Nama Mahasiswa</th>
                                        @foreach($tugas as $t)
                                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-[#2E2E2E]">
                                                <div>{{ $t->title }}</div>
                                                <div class="text-xs text-gray-500">Nilai (0-100)</div>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#E4E2DE] bg-white">
                                    @foreach($mahasiswa as $key => $mhs)
                                        <tr class="hover:bg-[#F3EFEA] transition-colors duration-200">
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-center text-[#2E2E2E]">
                                                {{ ++$key }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-left text-[#2E2E2E]">
                                                {{ $mhs->mhs_nim }}</td>
                                            <td class="px-3 py-4 text-sm text-left text-[#2E2E2E]">
                                                {{ $mhs->mhs_name }}</td>
                                            @foreach($tugas as $t)
                                                <td class="whitespace-nowrap px-3 py-4 text-sm text-center">
                                                    <div class="flex flex-col space-y-2">
                                                        <input type="number" name="nilai[{{ $mhs->id }}][{{ $t->id }}]" 
                                                            value="{{ isset($nilai[$mhs->id][$t->id]) ? $nilai[$mhs->id][$t->id]->score : '' }}"
                                                            min="0" max="100" step="1"
                                                            {{ $nilai_dikunci ? 'readonly' : '' }}
                                                            class="w-20 mx-auto px-2 py-1 border border-[#E4E2DE] rounded-md text-center focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent {{ $nilai_dikunci ? 'bg-gray-100' : '' }}">
                                                        <input type="text" name="komentar[{{ $mhs->id }}][{{ $t->id }}]" 
                                                            value="{{ isset($nilai[$mhs->id][$t->id]) ? $nilai[$mhs->id][$t->id]->comment : '' }}"
                                                            placeholder="Komentar"
                                                            {{ $nilai_dikunci ? 'readonly' : '' }}
                                                            class="w-full px-2 py-1 border border-[#E4E2DE] rounded-md text-sm focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent {{ $nilai_dikunci ? 'bg-gray-100' : '' }}">
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        @if(!$nilai_dikunci)
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#0C6E71] hover:bg-[#0A5D60] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#0C6E71]">
                                    Simpan Nilai
                                </button>
                            </div>
                        @else
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <div class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                    </svg>
                                    Nilai Telah Dikunci
                                </div>
                            </div>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection