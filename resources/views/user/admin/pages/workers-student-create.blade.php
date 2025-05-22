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
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-[#0C6E71] px-4 py-3 flex items-center justify-between">
                    <h4 class="text-white font-semibold text-lg">Foto Profil</h4>
                    <a href="{{ route($prefix . 'workers.student-index') }}"
                        class="px-3 py-2 border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded transition-colors flex items-center space-x-2">
                        <i class="fa-solid fa-backward"></i>
                        <span>Kembali</span> </a>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <img src="{{ asset('storage/images/default/default-profile.jpg') }}"
                            class="w-full h-auto rounded-lg mb-4" alt="Profile Image" id="profileImage">
                    </div>
                    <div class="mb-4">
                        <label for="mhs_image" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto
                            Profile</label>
                        <input type="file"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#0C6E71] file:text-white hover:file:bg-[#0a5c5e]"
                            name="mhs_image" id="mhs_image">
                        @error('mhs_image')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4">
                    <div class="border-b border-gray-200">
                        <ul class="flex flex-wrap -mb-px" id="myTab" role="tablist">
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-[#0C6E71] text-[#0C6E71] font-medium active"
                                    id="personal-tab" data-tab-target="#personal" type="button" role="tab">Data
                                    Personal</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 font-medium disabled-tab"
                                    id="contact-tab" data-tab-target="#contact" type="button" role="tab" disabled>Data
                                    Kontak</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 font-medium disabled-tab"
                                    id="security-tab" data-tab-target="#security" type="button" role="tab" disabled>Pengaturan Akun</button>
                            </li>
                        </ul>
                    </div>

                    <!-- Form Tunggal untuk semua data -->
                    <form action="{{ route($prefix . 'workers.student-store') }}" method="POST"
                        enctype="multipart/form-data" id="multiStepForm">
                        @csrf
                        <div class="tab-content pt-4" id="myTabContent">
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
                                        <label for="class_id"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                        <select name="class_id" id="class_id"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                            <option value="" selected disabled>Pilih Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}" {{ old('class_id') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                            <option value="L" {{ old('mhs_gend') == 'L' ? 'selected' : '' }}>Laki Laki</option>
                                            <option value="P" {{ old('mhs_gend') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('mhs_gend')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_birthplace"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
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
                                            placeholder="Tanggal Lahir..." value="{{ old('mhs_birthdate') }}" required>
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
                                            <option value="1" {{ old('mhs_reli') == '1' ? 'selected' : '' }}>Agama Islam</option>
                                            <option value="2" {{ old('mhs_reli') == '2' ? 'selected' : '' }}>Agama Kristen Protestan</option>
                                            <option value="3" {{ old('mhs_reli') == '3' ? 'selected' : '' }}>Agama Kriten Katholik</option>
                                            <option value="4" {{ old('mhs_reli') == '4' ? 'selected' : '' }}>Agama Hindu</option>
                                            <option value="5" {{ old('mhs_reli') == '5' ? 'selected' : '' }}>Agama Buddha</option>
                                            <option value="6" {{ old('mhs_reli') == '6' ? 'selected' : '' }}>Agama Konghuchu</option>
                                        </select>
                                        @error('mhs_reli')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-end items-center mt-6">
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
                                    <div class="mb-4">
                                        <label for="mhs_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                            HandPhone</label>
                                        <input type="text" name="mhs_phone" id="mhs_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor handphone..." value="{{ old('mhs_phone') }}" required>
                                        @error('mhs_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_mail" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            Email</label>
                                        <input type="email" name="mhs_mail" id="mhs_mail"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Email..." value="{{ old('mhs_mail') }}" required>
                                        @error('mhs_mail')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_parent_father"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                                        <input type="text" name="mhs_parent_father" id="mhs_parent_father"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama ayah..." value="{{ old('mhs_parent_father') }}" required>
                                        @error('mhs_parent_father')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_parent_father_phone"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ayah</label>
                                        <input type="text" name="mhs_parent_father_phone" id="mhs_parent_father_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor telepon ayah..." value="{{ old('mhs_parent_father_phone') }}" required>
                                        @error('mhs_parent_father_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_parent_mother"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                                        <input type="text" name="mhs_parent_mother" id="mhs_parent_mother"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama ibu..." value="{{ old('mhs_parent_mother') }}" required>
                                        @error('mhs_parent_mother')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_parent_mother_phone"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ibu</label>
                                        <input type="text" name="mhs_parent_mother_phone" id="mhs_parent_mother_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor telepon ibu..." value="{{ old('mhs_parent_mother_phone') }}" required>
                                        @error('mhs_parent_mother_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_wali_name"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nama Wali
                                            Mahasiswa</label>
                                        <input type="text" name="mhs_wali_name" id="mhs_wali_name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama wali..." value="{{ old('mhs_wali_name') }}">
                                        @error('mhs_wali_name')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_wali_phone"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Wali</label>
                                        <input type="text" name="mhs_wali_phone" id="mhs_wali_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor telepon wali..." value="{{ old('mhs_wali_phone') }}">
                                        @error('mhs_wali_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4 md:col-span-2">
                                        <label for="mhs_addr_domisili"
                                            class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Domisili /
                                            Tempat Tinggal</label>
                                        <textarea name="mhs_addr_domisili" id="mhs_addr_domisili" rows="4"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Alamat lengkap domisili / tempat tinggal..." required>{{ old('mhs_addr_domisili') }}</textarea>
                                        @error('mhs_addr_domisili')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_addr_kelurahan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                                        <input type="text" name="mhs_addr_kelurahan" id="mhs_addr_kelurahan"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama kelurahan..." value="{{ old('mhs_addr_kelurahan') }}" required>
                                        @error('mhs_addr_kelurahan')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_addr_kecamatan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <input type="text" name="mhs_addr_kecamatan" id="mhs_addr_kecamatan"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama kecamatan..." value="{{ old('mhs_addr_kecamatan') }}" required>
                                        @error('mhs_addr_kecamatan')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_addr_kota"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                        <input type="text" name="mhs_addr_kota" id="mhs_addr_kota"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama kota..." value="{{ old('mhs_addr_kota') }}" required>
                                        @error('mhs_addr_kota')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="mhs_addr_provinsi"
                                            class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                        <input type="text" name="mhs_addr_provinsi" id="mhs_addr_provinsi"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama provinsi..." value="{{ old('mhs_addr_provinsi') }}" required>
                                        @error('mhs_addr_provinsi')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-6">
                                    <button type="button"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 transition-colors prev-tab"
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
                                        <label for="mhs_user"
                                            class="block text-sm font-medium text-gray-700 mb-1">Username Mahasiswa</label>
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
                                            <option value="0" {{ old('mhs_stat') == '0' ? 'selected' : '' }}>Calon Mahasiswa</option>
                                            <option value="1" {{ old('mhs_stat') == '1' ? 'selected' : '' }}>Mahasiswa Aktif</option>
                                            <option value="2" {{ old('mhs_stat') == '2' ? 'selected' : '' }}>Mahasiswa Non-Aktif</option>
                                            <option value="3" {{ old('mhs_stat') == '3' ? 'selected' : '' }}>Mahasiswa Alumni</option>
                                        </select>
                                        @error('mhs_stat')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password"
                                            class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                                name="password" id="password" placeholder="Inputkan password..."
                                                required>
                                            <button type="button"
                                                class="px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors show-password">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                                            Password</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                                name="password_confirmation" id="password_confirmation"
                                                placeholder="Inputkan konfirmasi password..." required>
                                            <button type="button"
                                                class="px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors show-password">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password_confirmation')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-6">
                                    <button type="button"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 transition-colors prev-tab"
                                        data-prev-tab="contact-tab">
                                        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-[#0C6E71] text-white rounded-md hover:bg-[#0a5c5e] transition-colors">
                                        <i class="fa-solid fa-paper-plane mr-2"></i> Simpan Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Image preview
        document.getElementById("mhs_image").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profileImage');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        // Tab navigation with validation
        document.querySelectorAll('.next-tab').forEach(button => {
            button.addEventListener('click', function() {
                const nextTabId = this.getAttribute('data-next-tab');
                const currentTabPane = this.closest('.tab-pane');
                const inputs = currentTabPane.querySelectorAll(
                    'input[required], select[required], textarea[required]');
                let isValid = true;

                // Validate all required fields in current tab
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('border-red-500');
                        isValid = false;
                    } else {
                        input.classList.remove('border-red-500');
                    }
                });

                if (isValid) {
                    // Switch to next tab
                    const nextTab = document.getElementById(nextTabId);
                    const nextTabPane = document.querySelector(nextTab.getAttribute('data-tab-target'));

                    // Hide all tab panes
                    document.querySelectorAll('.tab-pane').forEach(pane => {
                        pane.classList.add('hidden');
                    });

                    // Remove active class from all tabs
                    document.querySelectorAll('[data-tab-target]').forEach(t => {
                        t.classList.remove('border-[#0C6E71]', 'text-[#0C6E71]');
                        t.classList.add('border-transparent');
                    });

                    // Show next pane
                    nextTabPane.classList.remove('hidden');

                    // Activate next tab
                    nextTab.classList.add('border-[#0C6E71]', 'text-[#0C6E71]');
                    nextTab.classList.remove('border-transparent', 'disabled-tab');

                    // Enable the next tab button
                    nextTab.removeAttribute('disabled');
                } else {
                    alert('Harap lengkapi semua field yang wajib diisi sebelum melanjutkan.');
                }
            });
        });

        // Previous tab button
        document.querySelectorAll('.prev-tab').forEach(button => {
            button.addEventListener('click', function() {
                const prevTabId = this.getAttribute('data-prev-tab');
                const prevTab = document.getElementById(prevTabId);
                const prevTabPane = document.querySelector(prevTab.getAttribute('data-tab-target'));

                // Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                });

                // Remove active class from all tabs
                document.querySelectorAll('[data-tab-target]').forEach(t => {
                    t.classList.remove('border-[#0C6E71]', 'text-[#0C6E71]');
                    t.classList.add('border-transparent');
                });

                // Show previous pane
                prevTabPane.classList.remove('hidden');

                // Activate previous tab
                prevTab.classList.add('border-[#0C6E71]', 'text-[#0C6E71]');
                prevTab.classList.remove('border-transparent');
            });
        });

        // Disable tab switching by clicking on tabs
        document.querySelectorAll('[data-tab-target]').forEach(tab => {
            tab.addEventListener('click', function(e) {
                if (this.classList.contains('disabled-tab') || this.hasAttribute('disabled')) {
                    e.preventDefault();
                    alert('Harap lengkapi tab sebelumnya terlebih dahulu.');
                }
            });
        });

        // Show/hide password functionality
        document.querySelectorAll('.show-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
@endpush
