@extends('base.base-dash-index')
@section('title')
    Data Pengguna Mahasiswa - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Mahasiswa
@endsection
@section('submenu')
    Edit {{ $student->mhs_name }}
@endsection
@section('urlmenu')
    {{-- KONDISIONAL BACK BUTTON --}}
    {{ route($prefix . 'workers.student-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengedit data pengguna {{ $student->mhs_name }}
@endsection
@section('content')
    <form action="{{ route($prefix . 'workers.student-update', $student->mhs_code) }}" method="POST"
        enctype="multipart/form-data" id="mainForm">
        @method('PATCH')
        @csrf
        <section class="flex flex-wrap">
            <div class="w-full lg:w-1/3 px-2 mb-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800">Ubah Foto Profile</h4>
                        <div class="flex space-x-2">
                            <a href="@yield('urlmenu')" class="px-3 py-2 border border-yellow-500 text-yellow-500 rounded hover:bg-yellow-500 hover:text-white transition-colors">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit" class="px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded hover:bg-[#0C6E71] hover:text-white transition-colors">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('mahasiswa.home-profile-save-image') }}" method="POST"
                            enctype="multipart/form-data" id="imageForm">
                            @csrf
                            @method('PATCH')

                            <img src="{{ asset('storage/images/' . $student->mhs_image) }}" class="w-full h-auto rounded-md" id="profileImage" alt="Profile Photo">
                            <hr class="my-4 border-gray-200">
                            <div class="mb-4">
                                <label for="mhs_image" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Profile</label>
                                <div class="flex items-center">
                                    <input type="file" class="flex-1 border border-gray-300 rounded-md p-2 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-[#0C6E71] file:text-white hover:file:bg-[#0A5E61]" name="mhs_image" id="mhs_image">
                                    @error('mhs_image')
                                        <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                    <button type="submit" class="ml-2 px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded hover:bg-[#0C6E71] hover:text-white transition-colors">
                                        <i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-2/3 px-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4">
                        <div class="border-b border-gray-200" x-data="{ activeTab: 'personal' }">
                            <ul class="flex flex-wrap -mb-px">
                                <li class="mr-2">
                                    <button @click="activeTab = 'personal'" :class="{ 'text-[#0C6E71] border-b-2 border-[#0C6E71]': activeTab === 'personal', 'text-gray-500 hover:text-gray-700': activeTab !== 'personal' }" class="inline-block px-4 py-2 font-medium">
                                        Personal
                                    </button>
                                </li>
                                <li class="mr-2">
                                    <button @click="activeTab = 'contact'" :class="{ 'text-[#0C6E71] border-b-2 border-[#0C6E71]': activeTab === 'contact', 'text-gray-500 hover:text-gray-700': activeTab !== 'contact' }" class="inline-block px-4 py-2 font-medium">
                                        Kontak
                                    </button>
                                </li>
                                <li class="mr-2">
                                    <button @click="activeTab = 'security'" :class="{ 'text-[#0C6E71] border-b-2 border-[#0C6E71]': activeTab === 'security', 'text-gray-500 hover:text-gray-700': activeTab !== 'security' }" class="inline-block px-4 py-2 font-medium">
                                        Keamanan
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="py-4" x-data="{ activeTab: 'personal' }">
                            <!-- Personal Tab -->
                            <div x-show="activeTab === 'personal'" class="space-y-4">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label for="mhs_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                        <input type="text" name="mhs_name" id="mhs_name" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100"
                                            placeholder="Nama lengkap..." readonly value="{{ $student->mhs_name }}">
                                        @error('mhs_name')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_nim" class="block text-sm font-medium text-gray-700 mb-1">Nomor NIM</label>
                                        <input type="text" name="mhs_nim" id="mhs_nim" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100"
                                            placeholder="Nomor NIM..." readonly value="{{ $student->mhs_nim }}">
                                        @error('mhs_nim')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="years_id" class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk</label>
                                        <input type="text" name="years_id" id="years_id" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100"
                                            placeholder="Nama Program Studi..." readonly value="Angkatan {{ $student->kelas->taka->year_start }}">
                                        @error('years_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="faku_id" class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
                                        <input type="text" name="faku_id" id="faku_id" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100"
                                            placeholder="Nama Program Studi..." readonly value="{{ $student->kelas->pstudi->fakultas->name }}">
                                        @error('faku_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="pstudi_id" class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                                        <input type="text" name="pstudi_id" id="pstudi_id" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100"
                                            placeholder="Nama Program Studi..." readonly value="{{ $student->kelas->pstudi->name . ' - ' . $student->kelas->taka->semester }}">
                                        @error('pstudi_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="class_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                        <select name="class_id" id="class_id" class="w-full border border-gray-300 rounded-md p-2">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}" {{ $item->id === $student->class_id ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                        <select name="mhs_gend" id="mhs_gend" class="w-full border border-gray-300 rounded-md p-2">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="L" {{ $student->mhs_gend === 'L' ? 'selected' : '' }}>Laki Laki</option>
                                            <option value="P" {{ $student->mhs_gend === 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('mhs_gend')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_birthplace" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                        <input type="text" name="mhs_birthplace" id="mhs_birthplace" class="w-full border border-gray-300 rounded-md p-2"
                                            placeholder="Tempat Lahir..." value="{{ $student->mhs_birthplace }}">
                                        @error('mhs_birthplace')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_birthdate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="mhs_birthdate" id="mhs_birthdate" class="w-full border border-gray-300 rounded-md p-2"
                                            placeholder="Tanggal Lahir..." value="{{ $student->mhs_birthdate }}">
                                        @error('mhs_birthdate')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_reli" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                        <select name="mhs_reli" id="mhs_reli" class="w-full border border-gray-300 rounded-md p-2">
                                            <option value="" selected>Pilih Agama</option>
                                            <option value="1" {{ $student->raw_mhs_reli === '1' ? 'selected' : '' }}>Agama Islam</option>
                                            <option value="2" {{ $student->raw_mhs_reli === '2' ? 'selected' : '' }}>Agama Kristen Protestan</option>
                                            <option value="3" {{ $student->raw_mhs_reli === '3' ? 'selected' : '' }}>Agama Kriten Katholik</option>
                                            <option value="4" {{ $student->raw_mhs_reli === '4' ? 'selected' : '' }}>Agama Hindu</option>
                                            <option value="5" {{ $student->raw_mhs_reli === '5' ? 'selected' : '' }}>Agama Buddha</option>
                                            <option value="6" {{ $student->raw_mhs_reli === '6' ? 'selected' : '' }}>Agama Konghuchu</option>
                                        </select>
                                        @error('mhs_reli')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Tab -->
                            <div x-show="activeTab === 'contact'" class="space-y-4">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label for="mhs_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HandPhone</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_phone" id="mhs_phone"
                                            value="{{ $student->mhs_phone }}">
                                        @error('mhs_phone')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_mail" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100" name="mhs_mail" id="mhs_mail"
                                            readonly value="{{ $student->mhs_mail }}">
                                        @error('mhs_mail')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_parent_father" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_parent_father"
                                            id="mhs_parent_father" placeholder="nama ayah..." value="{{ $student->mhs_parent_father }}">
                                        @error('mhs_parent_father')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_parent_father_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ayah</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_parent_father_phone"
                                            id="mhs_parent_father_phone" placeholder="nomor telepon ayah..." value="{{ $student->mhs_parent_father_phone }}">
                                        @error('mhs_parent_father_phone')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_parent_mother" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_parent_mother"
                                            id="mhs_parent_mother" placeholder="nama ibu..." value="{{ $student->mhs_parent_mother }}">
                                        @error('mhs_parent_mother')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_parent_mother_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ibu</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_parent_mother_phone"
                                            id="mhs_parent_mother_phone" placeholder="nomor telepon ibu..." value="{{ $student->mhs_parent_mother_phone }}">
                                        @error('mhs_parent_mother_phone')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_wali_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Wali Mahasiswa</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_wali_name"
                                            id="mhs_wali_name" placeholder="nama wali..." value="{{ $student->mhs_wali_name }}">
                                        @error('mhs_wali_name')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_wali_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Wali</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_wali_phone"
                                            id="mhs_wali_phone" placeholder="nomor telepon wali..." value="{{ $student->mhs_wali_phone }}">
                                        @error('mhs_wali_phone')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="lg:col-span-2">
                                        <label for="mhs_addr_domisili" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Domisili / Tempat Tinggal</label>
                                        <textarea cols="15" rows="4" class="w-full border border-gray-300 rounded-md p-2" name="mhs_addr_domisili" id="mhs_addr_domisili"
                                            placeholder="alamat lengkap domisili / tempat tinggal...">{{ $student->mhs_addr_domisili == null ? '' : $student->mhs_addr_domisili }}</textarea>
                                        @error('mhs_addr_domisili')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_addr_kelurahan" class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_addr_kelurahan"
                                            id="mhs_addr_kelurahan" placeholder="nama kelurahan..." value="{{ $student->mhs_addr_kelurahan }}">
                                        @error('mhs_addr_kelurahan')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_addr_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_addr_kecamatan"
                                            id="mhs_addr_kecamatan" placeholder="nama kecamatan..." value="{{ $student->mhs_addr_kecamatan }}">
                                        @error('mhs_addr_kecamatan')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_addr_kota" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_addr_kota"
                                            id="mhs_addr_kota" placeholder="nama kota..." value="{{ $student->mhs_addr_kota }}">
                                        @error('mhs_addr_kota')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_addr_provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                        <input type="text" class="w-full border border-gray-300 rounded-md p-2" name="mhs_addr_provinsi"
                                            id="mhs_addr_provinsi" placeholder="nama provinsi..." value="{{ $student->mhs_addr_provinsi }}">
                                        @error('mhs_addr_provinsi')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Security Tab -->
                            <div x-show="activeTab === 'security'" class="space-y-4">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label for="SecurityKey" class="block text-sm font-medium text-gray-700 mb-1">Security Key</label>
                                        <div class="flex items-center">
                                            <input type="password" class="flex-1 border border-gray-300 rounded-md p-2 bg-gray-100" name="mhs_code" id="SecurityKey"
                                                value="{{ $student->mhs_code }}" disabled>
                                            <button type="button" class="ml-2 px-3 py-2 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition-colors toggle-password" data-target="SecurityKey">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('mhs_code')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="mhs_stat" class="block text-sm font-medium text-gray-700 mb-1">Pilih Status Mahasiswa</label>
                                        <select name="mhs_stat" id="mhs_stat" class="w-full border border-gray-300 rounded-md p-2">
                                            <option value="" selected>Pilih Status Mahasiswa</option>
                                            <option value="0" {{ $student->raw_mhs_stat === 0 ? 'selected' : '' }}>Calon Mahasiswa</option>
                                            <option value="1" {{ $student->raw_mhs_stat === 1 ? 'selected' : '' }}>Mahasiswa Aktif</option>
                                            <option value="2" {{ $student->raw_mhs_stat === 2 ? 'selected' : '' }}>Mahasiswa Non-Aktif</option>
                                            <option value="3" {{ $student->raw_mhs_stat === 3 ? 'selected' : '' }}>Mahasiswa Alumni</option>
                                        </select>
                                        @error('old_password')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                        <div class="flex items-center">
                                            <input type="password" class="flex-1 border border-gray-300 rounded-md p-2" name="password"
                                                id="newPassword">
                                            <button type="button" class="ml-2 px-3 py-2 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition-colors toggle-password" data-target="newPassword">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="newPasswordKonfirm" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                                        <div class="flex items-center">
                                            <input type="password" class="flex-1 border border-gray-300 rounded-md p-2" name="password_confirmed"
                                                id="newPasswordKonfirm">
                                            <button type="button" class="ml-2 px-3 py-2 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition-colors toggle-password" data-target="newPasswordKonfirm">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password_confirmed')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    // Image preview functionality
    document.getElementById("mhs_image").onchange = function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
@endpush
