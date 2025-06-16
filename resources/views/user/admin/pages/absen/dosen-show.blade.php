@extends('base.base-dash-index')

@section('title')
    Detail Absensi Dosen
@endsection
@section('menu')
    Absensi Dosen
@endsection
@section('submenu')
    Detail Data
@endsection
@section('urlmenu')
    {{ route('web-admin.absensi.dosen.index') }}
@endsection
@section('subdesc')
    Halaman untuk melihat detail data absensi dosen
@endsection

@section('content')
    <div class="p-6">
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold text-gray-800">Detail Absensi Dosen</h3>
                    <p class="text-gray-600">Informasi detail absensi dosen</p>
                </div>
                <div>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2">
                            <li class="inline-flex items-center">
                                <a href="{{ route($prefix . 'home-index') }}"
                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <a href="{{ route($prefix . 'absensi.dosen.index') }}"
                                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Absensi
                                        Dosen</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="mb-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="flex justify-between items-center p-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-800">Informasi Absensi</h4>
                    <a href="{{ route($prefix . 'absensi.dosen.index') }}"
                        class="flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="grid grid-cols-4 items-center">
                                    <label class="text-sm font-medium text-gray-700">Nama Dosen</label>
                                    <p class="col-span-3 text-gray-900">{{ $absensi->dosen->name }}</p>
                                </div>
                                <div class="grid grid-cols-4 items-center">
                                    <label class="text-sm font-medium text-gray-700">Mata Kuliah</label>
                                    <p class="col-span-3 text-gray-900">{{ $absensi->mata_kuliah }}</p>
                                </div>
                                <div class="grid grid-cols-4 items-center">
                                    <label class="text-sm font-medium text-gray-700">Tanggal Absen</label>
                                    <p class="col-span-3 text-gray-900">
                                        {{ \Carbon\Carbon::parse($absensi->absen_date)->format('d-m-Y') }}</p>
                                </div>
                                <div class="grid grid-cols-4 items-center">
                                    <label class="text-sm font-medium text-gray-700">Waktu Absen</label>
                                    <p class="col-span-3 text-gray-900">{{ $absensi->absen_time }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="grid grid-cols-4 items-center">
                                    <label class="text-sm font-medium text-gray-700">Status Absensi</label>
                                    <div class="col-span-3">
                                        @if ($absensi->absen_type == 'H')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Hadir</span>
                                        @elseif($absensi->absen_type == 'I')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Izin</span>
                                        @elseif($absensi->absen_type == 'S')
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Sakit</span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Unknown</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="grid grid-cols-4 items-center">
                                    <label class="text-sm font-medium text-gray-700">Kode Absensi</label>
                                    <p class="col-span-3 text-gray-900">{{ $absensi->code }}</p>
                                </div>
                                <div class="grid grid-cols-4 items-center">
                                    <label class="text-sm font-medium text-gray-700">Keterangan</label>
                                    <p class="col-span-3 text-gray-900">{{ $absensi->absen_desc ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-4 border-b border-gray-200">
                                <h5 class="font-medium text-gray-800">Deskripsi Materi</h5>
                            </div>
                            <div class="p-4">
                                <p class="text-gray-700">{{ $absensi->deskripsi_materi ?? 'Tidak ada deskripsi materi' }}
                                </p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="p-4 border-b border-gray-200">
                                <h5 class="font-medium text-gray-800">Bukti Kehadiran</h5>
                            </div>
                            <div class="p-4 flex justify-center">
                                @if ($absensi->image)
                                    <img src="{{ asset('storage/images/' . $absensi->image) }}" alt="Bukti Kehadiran"
                                        class="max-h-80 object-contain">
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
                <div class="p-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-gray-800">Update Status Absensi</h4>
                </div>
                <div class="p-6">
                    <form action="{{ route($prefix . 'absensi.dosen.update-status', $absensi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="absen_type" class="block text-sm font-medium text-gray-700 mb-1">Status
                                    Absensi</label>
                                <select
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    name="absen_type" id="absen_type" required>
                                    <option value="H" {{ $absensi->rawAbsenType == 'H' ? 'selected' : '' }}>Hadir
                                    </option>
                                    <option value="I" {{ $absensi->rawAbsenType == 'I' ? 'selected' : '' }}>Izin
                                    </option>
                                    <option value="S" {{ $absensi->rawAbsenType == 'S' ? 'selected' : '' }}>Sakit
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="absen_desc"
                                    class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                                <textarea
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                    name="absen_desc" id="absen_desc" rows="3">{{ $absensi->absen_desc }}</textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
