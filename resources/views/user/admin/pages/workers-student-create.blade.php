@extends('base.base-dash-index')
@section('title')
    Data Pengguna Mahasiswa - SIAKAD PT - Internal Developer
@endsection
@section('menu')
    Data Pengguna Mahasiswa
@endsection
@section('submenu')
    Tambah Data
@endsection
@section('urlmenu')
    {{ route($prefix . 'workers.student-index') }}
@endsection
@section('subdesc')
    Halaman untuk menambah data Mahasiswa baru
@endsection
@section('content')
    <form action="{{ route($prefix . 'workers.student-store') }}" method="POST" enctype="multipart/form-data"
        id="multiStepForm">
        @csrf
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Image Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                    <div class="bg-[#0C6E71] px-4 py-3 flex justify-between items-center">
                        <h4 class="text-white font-medium">Foto Profil</h4>
                        <a href="{{ route($prefix . 'workers.student-index') }}" class="text-white hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="p-4">
                        <div class="mb-4 flex justify-center">
                            <img src="{{ asset('storage/images/default/default-profile.jpg') }}"
                                class="w-48 h-48 rounded-full object-cover border-4 border-gray-100" alt="Profile Image"
                                id="profileImage">
                        </div>
                        <div>
                            <label for="mhs_image" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto
                                Profil</label>
                            <input type="file"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-[#0C6E71] file:text-white hover:file:bg-[#0a5c5e]"
                                name="mhs_image" id="mhs_image" accept="image/*">
                            @error('mhs_image')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                    <div class="border-b border-gray-200">
                        <ul class="flex" id="myTab" role="tablist">
                            <li class="flex-1" role="presentation">
                                <button class="w-full py-3 border-b-2 border-[#0C6E71] text-[#0C6E71] font-medium active"
                                    id="personal-tab" data-tab-target="#personal" type="button" role="tab">
                                    Data Personal
                                </button>
                            </li>
                            <li class="flex-1" role="presentation">
                                <button
                                    class="w-full py-3 border-b-2 border-transparent text-gray-500 font-medium disabled-tab"
                                    id="contact-tab" data-tab-target="#contact" type="button" role="tab" disabled>
                                    Data Kontak
                                </button>
                            </li>
                            <li class="flex-1" role="presentation">
                                <button
                                    class="w-full py-3 border-b-2 border-transparent text-gray-500 font-medium disabled-tab"
                                    id="security-tab" data-tab-target="#security" type="button" role="tab" disabled>
                                    Pengaturan Akun
                                </button>
                            </li>
                        </ul>
                    </div>


                    <div class="p-4">
                        <!-- Tab Data Personal -->
                        <div class="tab-pane active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="mhs_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Lengkap</label>
                                    <input type="text" name="mhs_name" id="mhs_name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        placeholder="Nama lengkap..." value="{{ old('mhs_name') }}" required>
                                    @error('mhs_name')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_nim" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                        NIM</label>
                                    <input type="text" name="mhs_nim" id="mhs_nim"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        placeholder="Nomor NIM..." value="{{ old('mhs_nim') }}" required>
                                    @error('mhs_nim')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="class_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas (Pilih
                                        satu atau lebih)</label>
                                    <select name="class_id[]" id="class_id" multiple
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        required>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->id }}"
                                                {{ is_array(old('class_id')) && in_array($item->id, old('class_id')) ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-gray-500">Tahan tombol Ctrl (Windows) atau Command (Mac) untuk
                                        memilih beberapa kelas</small>
                                    @error('class_id')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                        Kelamin</label>
                                    <select name="mhs_gend" id="mhs_gend"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        required>
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('mhs_gend') == 'L' ? 'selected' : '' }}>Laki Laki
                                        </option>
                                        <option value="P" {{ old('mhs_gend') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('mhs_gend')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_birthplace"
                                        class="block text-sm font-medium text-gray-700 mb-1">Tempat
                                        Lahir</label>
                                    <input type="text" name="mhs_birthplace" id="mhs_birthplace"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        placeholder="Tempat Lahir..." value="{{ old('mhs_birthplace') }}" required>
                                    @error('mhs_birthplace')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_birthdate"
                                        class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <input type="date" name="mhs_birthdate" id="mhs_birthdate"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        value="{{ old('mhs_birthdate') }}" required>
                                    @error('mhs_birthdate')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_reli"
                                        class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                    <select name="mhs_reli" id="mhs_reli"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        required>
                                        <option value="" selected disabled>Pilih Agama</option>
                                        <option value="1" {{ old('mhs_reli') == '1' ? 'selected' : '' }}>Agama Islam
                                        </option>
                                        <option value="2" {{ old('mhs_reli') == '2' ? 'selected' : '' }}>Agama
                                            Kristen Protestan</option>
                                        <option value="3" {{ old('mhs_reli') == '3' ? 'selected' : '' }}>Agama Kriten
                                            Katholik</option>
                                        <option value="4" {{ old('mhs_reli') == '4' ? 'selected' : '' }}>Agama Hindu
                                        </option>
                                        <option value="5" {{ old('mhs_reli') == '5' ? 'selected' : '' }}>Agama Buddha
                                        </option>
                                        <option value="6" {{ old('mhs_reli') == '6' ? 'selected' : '' }}>Agama
                                            Konghuchu</option>
                                    </select>
                                    @error('mhs_reli')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <button type="button"
                                    class="px-4 py-2 bg-[#0C6E71] text-white rounded-md hover:bg-[#0a5c5e] transition-colors next-tab"
                                    data-next-tab="contact-tab">
                                    Selanjutnya <i class="fa-solid fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tab Data Kontak -->
                        <div class="tab-pane hidden" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Phone and Email -->
                                <div class="mb-4">
                                    <label for="mhs_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                        HandPhone</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        name="mhs_phone" id="mhs_phone" placeholder="Nomor telepon..."
                                        value="{{ old('mhs_phone') }}" required>
                                    @error('mhs_phone')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_mail" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                        Email</label>
                                    <input type="email"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        name="mhs_mail" id="mhs_mail" placeholder="Alamat email..."
                                        value="{{ old('mhs_mail') }}" required>
                                    @error('mhs_mail')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Father's Information -->
                                <div class="mb-4">
                                    <label for="mhs_parent_father"
                                        class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        name="mhs_parent_father" id="mhs_parent_father" placeholder="Nama ayah..."
                                        value="{{ old('mhs_parent_father') }}" required>
                                    @error('mhs_parent_father')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_parent_father_phone"
                                        class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ayah</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        name="mhs_parent_father_phone" id="mhs_parent_father_phone"
                                        placeholder="Nomor telepon ayah..." value="{{ old('mhs_parent_father_phone') }}"
                                        required>
                                    @error('mhs_parent_father_phone')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Mother's Information -->
                                <div class="mb-4">
                                    <label for="mhs_parent_mother"
                                        class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        name="mhs_parent_mother" id="mhs_parent_mother" placeholder="Nama ibu..."
                                        value="{{ old('mhs_parent_mother') }}" required>
                                    @error('mhs_parent_mother')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_parent_mother_phone"
                                        class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ibu</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        name="mhs_parent_mother_phone" id="mhs_parent_mother_phone"
                                        placeholder="Nomor telepon ibu..." value="{{ old('mhs_parent_mother_phone') }}"
                                        required>
                                    @error('mhs_parent_mother_phone')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Guardian's Information -->
                                <div class="mb-4">
                                    <label for="mhs_wali_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Wali Mahasiswa</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        name="mhs_wali_name" id="mhs_wali_name" placeholder="Nama wali..."
                                        value="{{ old('mhs_wali_name') }}">
                                    @error('mhs_wali_name')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_wali_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                        Telepon Wali</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        name="mhs_wali_phone" id="mhs_wali_phone" placeholder="Nomor telepon wali..."
                                        value="{{ old('mhs_wali_phone') }}">
                                    @error('mhs_wali_phone')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Address Section - Improved -->
                                <div class="md:col-span-2 space-y-4 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Alamat Domisili</h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!-- Province -->
                                        <div>
                                            <label for="provinsi"
                                                class="block text-sm font-medium text-gray-700 mb-1">Provinsi <span
                                                    class="text-red-500">*</span></label>
                                            <select id="provinsi" name="mhs_addr_provinsi" required
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] @error('provinsi') border-red-500 @enderror">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($provinces ?? [] as $province)
                                                    <option value="{{ $province->id }}"
                                                        {{ old('provinsi') == $province->id ? 'selected' : '' }}>
                                                        {{ $province->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="hidden" id="provinsi_name" name="mhs_addr_provinsi_name"
                                                value="{{ old('provinsi_name') }}">
                                            @error('provinsi')
                                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- City -->
                                        <div>
                                            <label for="kabupaten"
                                                class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota <span
                                                    class="text-red-500">*</span></label>
                                            <select id="kabupaten" name="mhs_addr_kota" required
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] @error('kabupaten') border-red-500 @enderror">
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
                                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- District -->
                                        <div>
                                            <label for="kecamatan"
                                                class="block text-sm font-medium text-gray-700 mb-1">Kecamatan <span
                                                    class="text-red-500">*</span></label>
                                            <select id="kecamatan" name="mhs_addr_kecamatan" required
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] @error('kecamatan') border-red-500 @enderror">
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
                                            <input type="hidden" id="kecamatan_name" name="mhs_addr_kecamatan_name"
                                                value="{{ old('kecamatan_name') }}">
                                            @error('kecamatan')
                                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Village -->
                                        <div>
                                            <label for="kelurahan"
                                                class="block text-sm font-medium text-gray-700 mb-1">Kelurahan/Desa</label>
                                            <select id="kelurahan" name="mhs_addr_kelurahan"
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] @error('kelurahan') border-red-500 @enderror">
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
                                            <input type="hidden" id="kelurahan_name" name="mhs_addr_kelurahan_name"
                                                value="{{ old('kelurahan_name') }}">
                                            @error('kelurahan')
                                                <small class="text-red-500 text-xs">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Full Address -->
                                    <div>
                                        <label for="mhs_addr_domisili"
                                            class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Domisili /
                                            Tempat Tinggal <span class="text-red-500">*</span></label>
                                        <textarea name="mhs_addr_domisili" id="mhs_addr_domisili" rows="3"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Alamat lengkap domisili / tempat tinggal..." required>{{ old('mhs_addr_domisili') }}</textarea>
                                        @error('mhs_addr_domisili')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between mt-6">
                                <button type="button"
                                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors prev-tab"
                                    data-prev-tab="personal-tab">
                                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <button type="button"
                                    class="px-4 py-2 bg-[#0C6E71] text-white rounded-md hover:bg-[#0a5c5e] transition-colors next-tab"
                                    data-next-tab="security-tab">
                                    Selanjutnya <i class="fa-solid fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tab Pengaturan Akun -->
                        <div class="tab-pane hidden" id="security" role="tabpanel" aria-labelledby="security-tab">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="mhs_user" class="block text-sm font-medium text-gray-700 mb-1">Username
                                        Mahasiswa</label>
                                    <input type="text" name="mhs_user" id="mhs_user"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        placeholder="Username..." value="{{ old('mhs_user') }}" required>
                                    @error('mhs_user')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mhs_stat" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                        Status Mahasiswa</label>
                                    <select name="mhs_stat" id="mhs_stat"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                        required>
                                        <option value="" selected disabled>Pilih Status Mahasiswa</option>
                                        <option value="0" {{ old('mhs_stat') == '0' ? 'selected' : '' }}>Calon
                                            Mahasiswa</option>
                                        <option value="1" {{ old('mhs_stat') == '1' ? 'selected' : '' }}>Mahasiswa
                                            Aktif</option>
                                        <option value="2" {{ old('mhs_stat') == '2' ? 'selected' : '' }}>Mahasiswa
                                            Non-Aktif</option>
                                        <option value="3" {{ old('mhs_stat') == '3' ? 'selected' : '' }}>Mahasiswa
                                            Alumni</option>
                                    </select>
                                    @error('mhs_stat')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password"
                                        class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <div class="relative">
                                        <input type="password"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            name="password" id="password" placeholder="Password..." required>
                                        <button type="button"
                                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-[#0C6E71] show-password">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                    <div class="relative">
                                        <input type="password"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            name="password_confirmation" id="password_confirmation"
                                            placeholder="Konfirmasi password..." required>
                                        <button type="button"
                                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-[#0C6E71] show-password">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password_confirmation')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-between mt-6">
                                <button type="button"
                                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors prev-tab"
                                    data-prev-tab="contact-tab">
                                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-[#0C6E71] text-white rounded-md hover:bg-[#0a5c5e] transition-colors">
                                    <i class="fa-solid fa-save mr-2"></i> Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@push('scripts')
    <script>
        // Image preview
        document.getElementById("mhs_image").addEventListener("change", function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profileImage').src = reader.result;
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        });

        // Tab navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Next tab button
            document.querySelectorAll('.next-tab').forEach(button => {
                button.addEventListener('click', function() {
                    const nextTabId = this.getAttribute('data-next-tab');
                    const currentTabPane = this.closest('.tab-pane');

                    // Validate current tab
                    const inputs = currentTabPane.querySelectorAll('[required]');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            input.classList.add('border-red-500');
                            isValid = false;
                        } else {
                            input.classList.remove('border-red-500');
                        }
                    });

                    if (!isValid) {
                        alert('Harap lengkapi semua field yang wajib diisi sebelum melanjutkan.');
                        return;
                    }

                    // Switch to next tab
                    switchTab(nextTabId);
                });
            });

            // Previous tab button
            document.querySelectorAll('.prev-tab').forEach(button => {
                button.addEventListener('click', function() {
                    const prevTabId = this.getAttribute('data-prev-tab');
                    switchTab(prevTabId);
                });
            });

            // Tab switching function
            function switchTab(tabId) {
                const tab = document.getElementById(tabId);
                const tabPane = document.querySelector(tab.getAttribute('data-tab-target'));

                // Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                    pane.classList.remove('active');
                });

                // Update tab styles
                document.querySelectorAll('[data-tab-target]').forEach(t => {
                    t.classList.remove('border-[#0C6E71]', 'text-[#0C6E71]');
                    t.classList.add('border-transparent', 'text-gray-500');
                });

                // Show target pane and activate tab
                tabPane.classList.remove('hidden');
                tabPane.classList.add('active');
                tab.classList.add('border-[#0C6E71]', 'text-[#0C6E71]');
                tab.classList.remove('border-transparent', 'text-gray-500', 'disabled-tab');
                tab.removeAttribute('disabled');
            }

            // Show/hide password
            document.querySelectorAll('.show-password').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('fa-eye', 'fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('fa-eye-slash', 'fa-eye');
                    }
                });
            });

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
