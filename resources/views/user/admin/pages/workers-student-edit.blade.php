@extends('base.base-dash-index')
@section('title')
    Edit Mahasiswa - {{ $student->mhs_name }}
@endsection
@section('menu')
    Data Pengguna Mahasiswa
@endsection
@section('submenu')
    Edit {{ $student->mhs_name }}
@endsection
@section('urlmenu')
    {{ route($prefix . 'workers.student-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengedit data pengguna {{ $student->mhs_name }}
@endsection
@section('content')
    <div class="max-w-7xl mx-auto">
        <form action="{{ route($prefix . 'workers.student-update', $student->mhs_code) }}" method="POST"
            enctype="multipart/form-data">
            @method('PATCH')
            @csrf

            <!-- Header Actions -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Edit Mahasiswa</h1>
                    <p class="text-sm text-gray-600 mt-1">Update informasi mahasiswa {{ $student->mhs_name }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="@yield('urlmenu')"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Profile Image Section -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Foto Profil</h3>

                            <!-- Image Preview -->
                            <div class="relative mb-6">
                                <img src="{{ asset('storage/images/' . $student->mhs_image) }}"
                                    class="w-full aspect-square object-cover rounded-xl border-2 border-gray-100"
                                    alt="{{ $student->mhs_name }}'s profile" id="imagePreview">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-10 transition-all duration-200 rounded-xl">
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div class="space-y-2">
                                <label for="mhs_image" class="block text-sm font-medium text-gray-700">
                                    Upload Foto Baru
                                </label>
                                <div class="relative">
                                    <input type="file" name="mhs_image" id="mhs_image" accept="image/*"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                                </div>
                                @error('mhs_image')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div x-data="{ activeTab: 'personal' }" class="min-h-full">
                            <!-- Tab Navigation -->
                            <div class="border-b border-gray-200 px-6">
                                <nav class="flex space-x-8">
                                    <button type="button" @click="activeTab = 'personal'"
                                        :class="activeTab === 'personal' ? 'border-blue-500 text-blue-600' :
                                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Personal
                                    </button>
                                    <button type="button" @click="activeTab = 'contact'"
                                        :class="activeTab === 'contact' ? 'border-blue-500 text-blue-600' :
                                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Kontak
                                    </button>
                                    <button type="button" @click="activeTab = 'security'"
                                        :class="activeTab === 'security' ? 'border-blue-500 text-blue-600' :
                                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                        class="py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                        Keamanan
                                    </button>
                                </nav>
                            </div>

                            <!-- Tab Content -->
                            <div class="p-6">
                                <!-- Personal Tab -->
                                <div x-show="activeTab === 'personal'" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="form-group">
                                            <label for="mhs_name" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Lengkap
                                            </label>
                                            <input type="text" name="mhs_name" id="mhs_name"
                                                value="{{ $student->mhs_name }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-100 sm:text-sm"
                                                readonly>
                                            @error('mhs_name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_nim" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nomor NIM
                                            </label>
                                            <input type="text" name="mhs_nim" id="mhs_nim"
                                                value="{{ $student->mhs_nim }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-100 sm:text-sm"
                                                readonly>
                                            @error('mhs_nim')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="year_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                Tahun Masuk
                                            </label>
                                            <input type="text" name="year_id" id="year_id"
                                                value="Angkatan {{ $student->kelas->first() ? $student->kelas->first()->taka->year_start : 'Tidak ada' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-100 sm:text-sm"
                                                readonly>
                                            @error('year_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="faku_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                Fakultas
                                            </label>
                                            <input type="text" name="faku_id" id="faku_id"
                                                value="{{ $student->kelas->first() ? $student->kelas->first()->pstudi->fakultas->name : 'Tidak ada' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-100 sm:text-sm"
                                                readonly>
                                            @error('faku_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="pstudi_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                Program Studi
                                            </label>
                                            <input type="text" name="pstudi_id" id="pstudi_id"
                                                value="{{ $student->kelas->first() ? $student->kelas->first()->pstudi->name . ' - ' . $student->kelas->first()->taka->semester : 'Tidak ada' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-100 sm:text-sm"
                                                readonly>
                                            @error('pstudi_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="class_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                Kelas (Pilih satu atau lebih)
                                            </label>
                                            <select name="class_id[]" id="class_id" multiple
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                @foreach ($kelas as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $student->kelas->contains($item->id) ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-gray-500">Tahan tombol Ctrl (Windows) atau Command (Mac)
                                                untuk memilih beberapa kelas</small>
                                            @error('class_id')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_gend" class="block text-sm font-medium text-gray-700 mb-2">
                                                Jenis Kelamin
                                            </label>
                                            <select name="mhs_gend" id="mhs_gend"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ $student->mhs_gend === 'L' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="P" {{ $student->mhs_gend === 'P' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('mhs_gend')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_birthplace"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                Tempat Lahir
                                            </label>
                                            <input type="text" name="mhs_birthplace" id="mhs_birthplace"
                                                value="{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_birthplace : '' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Masukkan tempat lahir">
                                            @error('mhs_birthplace')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_birthdate"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                Tanggal Lahir
                                            </label>
                                            <input type="date" name="mhs_birthdate" id="mhs_birthdate"
                                                value="{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_birthdate : '' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            @error('mhs_birthdate')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_reli" class="block text-sm font-medium text-gray-700 mb-2">
                                                Agama
                                            </label>
                                            <select name="mhs_reli" id="mhs_reli"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Pilih Agama</option>
                                                <option value="1"
                                                    {{ $student->mahasiswaDetails && $student->mahasiswaDetails->mhs_reli === '1' ? 'selected' : '' }}>
                                                    Agama Islam
                                                </option>
                                                <option value="2"
                                                    {{ $student->mahasiswaDetails && $student->mahasiswaDetails->mhs_reli === '2' ? 'selected' : '' }}>
                                                    Agama Kristen
                                                    Protestan</option>
                                                <option value="3"
                                                    {{ $student->mahasiswaDetails && $student->mahasiswaDetails->mhs_reli === '3' ? 'selected' : '' }}>
                                                    Agama Kriten
                                                    Katholik</option>
                                                <option value="4"
                                                    {{ $student->mahasiswaDetails && $student->mahasiswaDetails->mhs_reli === '4' ? 'selected' : '' }}>
                                                    Agama Hindu
                                                </option>
                                                <option value="5"
                                                    {{ $student->mahasiswaDetails && $student->mahasiswaDetails->mhs_reli === '5' ? 'selected' : '' }}>
                                                    Agama Buddha
                                                </option>
                                                <option value="6"
                                                    {{ $student->mahasiswaDetails && $student->mahasiswaDetails->mhs_reli === '6' ? 'selected' : '' }}>
                                                    Agama Konghuchu
                                                </option>
                                            </select>
                                            @error('mhs_reli')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Tab -->
                                <div x-show="activeTab === 'contact'"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <!-- Phone and Email -->
                                        <div class="form-group">
                                            <label for="mhs_phone"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                                HandPhone</label>
                                            <input type="text" name="mhs_phone" id="mhs_phone"
                                                value="{{ $student->mhs_phone }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Masukkan nomor telepon">
                                            @error('mhs_phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_mail"
                                                class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                                            <input type="email" name="mhs_mail" id="mhs_mail"
                                                value="{{ $student->mhs_mail }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm bg-gray-100 sm:text-sm"
                                                readonly>
                                            @error('mhs_mail')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Father's Information -->
                                        <div class="form-group">
                                            <label for="mhs_parent_father"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nama Ayah</label>
                                            <input type="text" name="mhs_parent_father" id="mhs_parent_father"
                                                value="{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_parent_father : '' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Masukkan nama ayah">
                                            @error('mhs_parent_father')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_parent_father_phone"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon
                                                Ayah</label>
                                            <input type="tel" name="mhs_parent_father_phone"
                                                id="mhs_parent_father_phone"
                                                value="{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_parent_father_phone : '' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Masukkan nomor telepon ayah">
                                            @error('mhs_parent_father_phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Mother's Information -->
                                        <div class="form-group">
                                            <label for="mhs_parent_mother"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nama Ibu</label>
                                            <input type="text" name="mhs_parent_mother" id="mhs_parent_mother"
                                                value="{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_parent_mother : '' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Masukkan nama ibu">
                                            @error('mhs_parent_mother')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_parent_mother_phone"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon
                                                Ibu</label>
                                            <input type="tel" name="mhs_parent_mother_phone"
                                                id="mhs_parent_mother_phone"
                                                value="{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_parent_mother_phone : '' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Masukkan nomor telepon ibu">
                                            @error('mhs_parent_mother_phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Guardian's Information -->
                                        <div class="form-group">
                                            <label for="mhs_wali_name"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nama Wali
                                                Mahasiswa</label>
                                            <input type="text" name="mhs_wali_name" id="mhs_wali_name"
                                                value="{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_wali_name : '' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Masukkan nama wali">
                                            @error('mhs_wali_name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_wali_phone"
                                                class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon
                                                Wali</label>
                                            <input type="tel" name="mhs_wali_phone" id="mhs_wali_phone"
                                                value="{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_wali_phone : '' }}"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                placeholder="Masukkan nomor telepon wali">
                                            @error('mhs_wali_phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Address Section - Improved -->
                                        <div
                                            class="lg:col-span-2 space-y-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">Alamat Domisili</h3>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <!-- Province -->
                                                <div class="form-group">
                                                    <label for="provinsi"
                                                        class="block text-sm font-medium text-gray-700 mb-2">Provinsi <span
                                                            class="text-red-500">*</span></label>
                                                    <select id="provinsi" name="mhs_addr_provinsi" required
                                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('provinsi') border-red-500 @enderror">
                                                        <option value="">Pilih Provinsi</option>
                                                        @foreach ($provinces ?? [] as $province)
                                                            <option value="{{ $province->id }}"
                                                                {{ $student->mahasiswaDetails && $student->mahasiswaDetails->mhs_addr_provinsi == $province->id ? 'selected' : '' }}>
                                                                {{ $province->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" id="provinsi_name"
                                                        name="mhs_addr_provinsi_name" value="{{ old('provinsi_name') }}">
                                                    @error('provinsi')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- City -->
                                                <div class="form-group">
                                                    <label for="kabupaten"
                                                        class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota
                                                        <span class="text-red-500">*</span></label>
                                                    <select id="kabupaten" name="mhs_addr_kota" required
                                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kabupaten') border-red-500 @enderror">
                                                        <option value="">Pilih Kabupaten/Kota</option>
                                                        @if (old('kabupaten') && $cities)
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->id }}"
                                                                    {{ old('kabupaten') == $city->id ? 'selected' : '' }}>
                                                                    {{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" id="kabupaten_name" name="mhs_addr_kota_name"
                                                        value="{{ old('kabupaten_name') }}">
                                                    @error('kabupaten')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- District -->
                                                <div class="form-group">
                                                    <label for="kecamatan"
                                                        class="block text-sm font-medium text-gray-700 mb-2">Kecamatan
                                                        <span class="text-red-500">*</span></label>
                                                    <select id="kecamatan" name="mhs_addr_kecamatan" required
                                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kecamatan') border-red-500 @enderror">
                                                        <option value="">Pilih Kecamatan</option>
                                                        @if (old('kecamatan') && $districts)
                                                            @foreach ($districts as $district)
                                                                <option value="{{ $district->id }}"
                                                                    {{ old('kecamatan') == $district->id ? 'selected' : '' }}>
                                                                    {{ $district->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" id="kecamatan_name"
                                                        name="mhs_addr_kecamatan_name"
                                                        value="{{ old('kecamatan_name') }}">
                                                    @error('kecamatan')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <!-- Village -->
                                                <div class="form-group">
                                                    <label for="kelurahan"
                                                        class="block text-sm font-medium text-gray-700 mb-2">Kelurahan/Desa</label>
                                                    <select id="kelurahan" name="mhs_addr_kelurahan"
                                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('kelurahan') border-red-500 @enderror">
                                                        <option value="">Pilih Kelurahan/Desa</option>
                                                        @if (old('kelurahan') && $villages)
                                                            @foreach ($villages as $village)
                                                                <option value="{{ $village->id }}"
                                                                    {{ old('kelurahan') == $village->id ? 'selected' : '' }}>
                                                                    {{ $village->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <input type="hidden" id="kelurahan_name"
                                                        name="mhs_addr_kelurahan_name"
                                                        value="{{ old('kelurahan_name') }}">
                                                    @error('kelurahan')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Full Address -->
                                            <div class="form-group">
                                                <label for="mhs_addr_domisili"
                                                    class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap
                                                    Domisili <span class="text-red-500">*</span></label>
                                                <textarea name="mhs_addr_domisili" id="mhs_addr_domisili" rows="3"
                                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    placeholder="Masukkan alamat lengkap" required>{{ $student->mahasiswaDetails ? $student->mahasiswaDetails->mhs_addr_domisili : '' }}</textarea>
                                                @error('mhs_addr_domisili')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Tab -->
                                <div x-show="activeTab === 'security'"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="form-group">
                                            <label for="SecurityKey" class="block text-sm font-medium text-gray-700 mb-2">
                                                Security Key
                                            </label>
                                            <div class="relative">
                                                <input type="password" name="mhs_code" id="SecurityKey"
                                                    value="{{ $student->mhs_code }}" disabled
                                                    class="block w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg shadow-sm bg-gray-50 text-gray-500 sm:text-sm">
                                                <button type="button"
                                                    class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password"
                                                    data-target="SecurityKey">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="mhs_stat" class="block text-sm font-medium text-gray-700 mb-2">
                                                Status Mahasiswa
                                            </label>
                                            <select name="mhs_stat" id="mhs_stat"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Pilih Status Mahasiswa</option>
                                                <option value="0"
                                                    {{ $student->raw_mhs_stat === 0 ? 'selected' : '' }}>Calon Mahasiswa
                                                </option>
                                                <option value="1"
                                                    {{ $student->raw_mhs_stat === 1 ? 'selected' : '' }}>Mahasiswa Aktif
                                                </option>
                                                <option value="2"
                                                    {{ $student->raw_mhs_stat === 2 ? 'selected' : '' }}>Mahasiswa
                                                    Non-Aktif</option>
                                                <option value="3"
                                                    {{ $student->raw_mhs_stat === 3 ? 'selected' : '' }}>Mahasiswa Alumni
                                                </option>
                                            </select>
                                            @error('mhs_stat')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-2">
                                                Password Baru
                                            </label>
                                            <div class="relative">
                                                <input type="password" name="password" id="newPassword"
                                                    class="block w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    placeholder="Kosongkan jika tidak ingin mengubah">
                                                <button type="button"
                                                    class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password"
                                                    data-target="newPassword">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            @error('password')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="newPasswordKonfirm"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                Konfirmasi Password
                                            </label>
                                            <div class="relative">
                                                <input type="password" name="password_confirmed" id="newPasswordKonfirm"
                                                    class="block w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                    placeholder="Konfirmasi password baru">
                                                <button type="button"
                                                    class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password"
                                                    data-target="newPasswordKonfirm">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                            </div>
                                            @error('password_confirmed')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview functionality
            const imageInput = document.getElementById('mhs_image');
            const imagePreview = document.getElementById('imagePreview');

            if (imageInput) {
                imageInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Password visibility toggle
            const toggleButtons = document.querySelectorAll('.toggle-password');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    const icon = this.querySelector('svg');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                `;
                    } else {
                        passwordInput.type = 'password';
                        icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
                    }
                });
            });

            // Form validation before submission
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Validate password confirmation
                    const password = document.getElementById('newPassword');
                    const passwordConfirm = document.getElementById('newPasswordKonfirm');

                    if (password && passwordConfirm) {
                        if (password.value !== passwordConfirm.value) {
                            e.preventDefault();
                            alert('Password dan konfirmasi password tidak sama!');
                            passwordConfirm.focus();
                        }
                    }

                    // You can add more validations here as needed
                });
            }

            // Auto format phone numbers
            const phoneInputs = document.querySelectorAll('input[type="tel"]');
            phoneInputs.forEach(input => {
                input.addEventListener('input', function() {
                    // Remove non-digit characters
                    let value = this.value.replace(/\D/g, '');

                    // Format based on length
                    if (value.length > 0) {
                        value = value.match(/.{1,4}/g).join('-');
                    }

                    this.value = value;
                });
            });

            // Show success/error messages from Laravel
            @if (session('success'))
                alert('{{ session('success') }}');
            @endif

            @if (session('error'))
                alert('{{ session('error') }}');
            @endif

            // Initialize cascading address dropdowns
            if (window.initAlamatDropdown) {
                window.initAlamatDropdown({
                    provinsiId: 'provinsi',
                    kabupatenId: 'kabupaten',
                    kecamatanId: 'kecamatan',
                    kelurahanId: 'kelurahan',
                    provinsiNameId: 'provinsi_name',
                    kabupatenNameId: 'kabupaten_name',
                    kecamatanNameId: 'kecamatan_name',
                    kelurahanNameId: 'kelurahan_name',
                    old: {
                        provinsi: "{{ old('provinsi') }}",
                        kabupaten: "{{ old('kabupaten') }}",
                        kecamatan: "{{ old('kecamatan') }}",
                        kelurahan: "{{ old('kelurahan') }}"
                    }
                });
            }
        });
    </script>
@endpush
