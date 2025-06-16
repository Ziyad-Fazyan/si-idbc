@extends('base.base-dash-index')

@section('title', 'Detail Absensi Mahasiswa')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="mb-4 md:mb-0">
                <h3 class="text-2xl font-bold">Detail Absensi Mahasiswa</h3>
                <p class="text-gray-600">Informasi detail absensi mahasiswa</p>
            </div>
            <nav class="flex" aria-label="breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route($prefix . 'home-index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <a href="{{ route($prefix . 'mahasiswa.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Absensi Mahasiswa</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="mb-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h4 class="text-lg font-semibold">Informasi Absensi</h4>
                <a href="{{ route($prefix . 'mahasiswa.index') }}" class="flex items-center text-sm bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md transition">
                    <i class="bi bi-arrow-left mr-2"></i> Kembali
                </a>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <div class="grid grid-cols-5 gap-4 mb-4">
                            <label class="col-span-2 text-gray-700">Nama Mahasiswa</label>
                            <p class="col-span-3">{{ $absensi->mahasiswa->name }}</p>
                        </div>
                        <div class="grid grid-cols-5 gap-4 mb-4">
                            <label class="col-span-2 text-gray-700">NIM</label>
                            <p class="col-span-3">{{ $absensi->mahasiswa->nim }}</p>
                        </div>
                        <div class="grid grid-cols-5 gap-4 mb-4">
                            <label class="col-span-2 text-gray-700">Mata Kuliah</label>
                            <p class="col-span-3">{{ $absensi->jadkul->matkul->name ?? 'Tidak ada data' }}</p>
                        </div>
                        <div class="grid grid-cols-5 gap-4 mb-4">
                            <label class="col-span-2 text-gray-700">Dosen</label>
                            <p class="col-span-3">{{ $absensi->jadkul->dosen->name ?? 'Tidak ada data' }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-cols-5 gap-4 mb-4">
                            <label class="col-span-2 text-gray-700">Tanggal Absen</label>
                            <p class="col-span-3">{{ \Carbon\Carbon::parse($absensi->absen_date)->format('d-m-Y') }}</p>
                        </div>
                        <div class="grid grid-cols-5 gap-4 mb-4">
                            <label class="col-span-2 text-gray-700">Waktu Absen</label>
                            <p class="col-span-3">{{ $absensi->absen_time }}</p>
                        </div>
                        <div class="grid grid-cols-5 gap-4 mb-4">
                            <label class="col-span-2 text-gray-700">Status Absensi</label>
                            <div class="col-span-3">
                                @if($absensi->absen_type == 'H')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Hadir</span>
                                @elseif($absensi->absen_type == 'I')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Izin</span>
                                @elseif($absensi->absen_type == 'S')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Sakit</span>
                                @elseif($absensi->absen_type == 'A')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Tidak Hadir</span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Unknown</span>
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-5 gap-4 mb-4">
                            <label class="col-span-2 text-gray-700">Kode Absensi</label>
                            <p class="col-span-3">{{ $absensi->code }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-medium">Keterangan</h5>
                        </div>
                        <div class="p-4">
                            <p>{{ $absensi->absen_desc ?? 'Tidak ada keterangan' }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-4 py-3 border-b border-gray-200">
                            <h5 class="font-medium">Bukti Kehadiran</h5>
                        </div>
                        <div class="p-4 flex justify-center">
                            @if($absensi->image)
                            <img src="{{ asset('storage/images/' . $absensi->image) }}" alt="Bukti Kehadiran" class="max-h-80">
                            @else
                            <p class="text-gray-500">Tidak ada bukti kehadiran</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h4 class="text-lg font-semibold">Update Status Absensi</h4>
            </div>
            <div class="p-6">
                <form action="{{ route($prefix . 'mahasiswa.update-status', $absensi->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="absen_type" class="block text-sm font-medium text-gray-700 mb-1">Status Absensi</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="absen_type" id="absen_type" required>
                                <option value="H" {{ $absensi->rawAbsenType == 'H' ? 'selected' : '' }}>Hadir</option>
                                <option value="I" {{ $absensi->rawAbsenType == 'I' ? 'selected' : '' }}>Izin</option>
                                <option value="S" {{ $absensi->rawAbsenType == 'S' ? 'selected' : '' }}>Sakit</option>
                                <option value="A" {{ $absensi->rawAbsenType == 'A' ? 'selected' : '' }}>Tidak Hadir</option>
                            </select>
                        </div>
                        <div>
                            <label for="absen_desc" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="absen_desc" id="absen_desc" rows="3">{{ $absensi->absen_desc }}</textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection