@extends('base.base-dash-index')
@section('title')
    Data Pengguna Mahasiswa - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Mahasiswa
@endsection
@section('submenu')
    Tambah Data
@endsection
@section('urlmenu')
    {{-- KONDISIONAL BACK BUTTON --}}
    {{ route($prefix . 'workers.student-index') }}
@endsection
@section('subdesc')
    Halaman untuk menambah data Mahasiswa baru
@endsection
@section('content')
    <form action="{{ route($prefix . 'workers.student-store') }}" method="POST" enctype="multipart/form-data" class="w-full">
        @csrf
        <section class="flex flex-wrap -mx-2">

            <div class="w-full lg:w-1/3 px-2 mb-4">
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
                        <img id="profile-preview" src="{{ asset('storage/images/default/default-profile.jpg') }}"
                            class="w-full h-auto rounded-lg mb-4" alt="Profile Picture">
                        <hr class="my-4 border-gray-200">
                        <div class="mb-4">
                            <label for="mhs_image" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Profile</label>
                            <div class="flex items-center">
                                <input type="file"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#0C6E71] file:text-white hover:file:bg-[#0A5A5C] focus:outline-none"
                                    name="mhs_image" id="mhs_image">
                                <button type="submit" class="ml-2 px-3 py-2 bg-[#0C6E71] text-white rounded hover:bg-[#0A5A5C] transition-colors">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                            @error('mhs_image')
                                <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-2/3 px-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4">
                        <div x-data="{ activeTab: 'personal' }">
                            <div class="border-b border-gray-200">
                                <nav class="-mb-px flex space-x-6">
                                    <button type="button"
                                        @click="activeTab = 'personal'"
                                        :class="{ 'border-b-2 border-[#0C6E71] text-[#0C6E71]': activeTab === 'personal', 'text-gray-500 hover:text-gray-700': activeTab !== 'personal' }"
                                        class="py-4 px-1 font-medium text-sm">
                                        Personal
                                    </button>
                                    <button type="button"
                                        @click="activeTab = 'contact'"
                                        :class="{ 'border-b-2 border-[#0C6E71] text-[#0C6E71]': activeTab === 'contact', 'text-gray-500 hover:text-gray-700': activeTab !== 'contact' }"
                                        class="py-4 px-1 font-medium text-sm">
                                        Kontak
                                    </button>
                                    <button type="button"
                                        @click="activeTab = 'security'"
                                        :class="{ 'border-b-2 border-[#0C6E71] text-[#0C6E71]': activeTab === 'security', 'text-gray-500 hover:text-gray-700': activeTab !== 'security' }"
                                        class="py-4 px-1 font-medium text-sm">
                                        Keamanan
                                    </button>
                                </nav>
                            </div>

                            <!-- Personal Tab -->
                            <div x-show="activeTab === 'personal'" class="py-4">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label for="mhs_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                        <input type="text" name="mhs_name" id="mhs_name"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nama lengkap...">
                                        @error('mhs_name')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_nim" class="block text-sm font-medium text-gray-700 mb-1">Nomor NIM</label>
                                        <input type="text" name="mhs_nim" id="mhs_nim"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nomor NIM...">
                                        @error('mhs_nim')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="class_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                        <select name="class_id" id="class_id"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20">
                                            <option value="" selected>Pilih Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                        <select name="mhs_gend" id="mhs_gend"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="L">Laki Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('mhs_gend')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_birthplace" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                        <input type="text" name="mhs_birthplace" id="mhs_birthplace"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Tempat Lahir...">
                                        @error('mhs_birthplace')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_birthdate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="mhs_birthdate" id="mhs_birthdate"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Tanggal Lahir...">
                                        @error('mhs_birthdate')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_reli" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                        <select name="mhs_reli" id="mhs_reli"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20">
                                            <option value="" selected>Pilih Agama</option>
                                            <option value="1">Agama Islam</option>
                                            <option value="2">Agama Kristen Protestan</option>
                                            <option value="3">Agama Kriten Katholik</option>
                                            <option value="4">Agama Hindu</option>
                                            <option value="5">Agama Buddha</option>
                                            <option value="6">Agama Konghuchu</option>
                                        </select>
                                        @error('mhs_reli')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Tab -->
                            <div x-show="activeTab === 'contact'" class="py-4" style="display: none;">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label for="mhs_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HandPhone</label>
                                        <input type="text" name="mhs_phone" id="mhs_phone"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nomor handphone...">
                                        @error('mhs_phone')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_mail" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                        <input type="email" name="mhs_mail" id="mhs_mail"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Email...">
                                        @error('mhs_mail')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_parent_father" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                                        <input type="text" name="mhs_parent_father" id="mhs_parent_father"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nama ayah...">
                                        @error('mhs_parent_father')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_parent_father_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ayah</label>
                                        <input type="text" name="mhs_parent_father_phone" id="mhs_parent_father_phone"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nomor telepon ayah...">
                                        @error('mhs_parent_father_phone')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_parent_mother" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                                        <input type="text" name="mhs_parent_mother" id="mhs_parent_mother"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nama ibu...">
                                        @error('mhs_parent_mother')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_parent_mother_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ibu</label>
                                        <input type="text" name="mhs_parent_mother_phone" id="mhs_parent_mother_phone"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nomor telepon ibu...">
                                        @error('mhs_parent_mother_phone')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_wali_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Wali Mahasiswa</label>
                                        <input type="text" name="mhs_wali_name" id="mhs_wali_name"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nama wali...">
                                        @error('mhs_wali_name')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_wali_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Wali</label>
                                        <input type="text" name="mhs_wali_phone" id="mhs_wali_phone"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nomor telepon wali...">
                                        @error('mhs_wali_phone')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label for="mhs_addr_domisili" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Domisili / Tempat Tinggal</label>
                                        <textarea cols="15" rows="4" name="mhs_addr_domisili" id="mhs_addr_domisili"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Alamat lengkap domisili / tempat tinggal..."></textarea>
                                        @error('mhs_addr_domisili')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_addr_kelurahan" class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                                        <input type="text" name="mhs_addr_kelurahan" id="mhs_addr_kelurahan"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nama kelurahan...">
                                        @error('mhs_addr_kelurahan')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_addr_kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <input type="text" name="mhs_addr_kecamatan" id="mhs_addr_kecamatan"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nama kecamatan...">
                                        @error('mhs_addr_kecamatan')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_addr_kota" class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                        <input type="text" name="mhs_addr_kota" id="mhs_addr_kota"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nama kota...">
                                        @error('mhs_addr_kota')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_addr_provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                        <input type="text" name="mhs_addr_provinsi" id="mhs_addr_provinsi"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Nama provinsi...">
                                        @error('mhs_addr_provinsi')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Security Tab -->
                            <div x-show="activeTab === 'security'" class="py-4" style="display: none;">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label for="mhs_user" class="block text-sm font-medium text-gray-700 mb-1">Username Mahasiswa</label>
                                        <input type="text" name="mhs_user" id="mhs_user"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20"
                                            placeholder="Username...">
                                        @error('mhs_user')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="mhs_stat" class="block text-sm font-medium text-gray-700 mb-1">Pilih Status Mahasiswa</label>
                                        <select name="mhs_stat" id="mhs_stat"
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20">
                                            <option value="" selected>Pilih Status Mahasiswa</option>
                                            <option value="0">Calon Mahasiswa</option>
                                            <option value="1">Mahasiswa Aktif</option>
                                            <option value="2">Mahasiswa Non-Aktif</option>
                                            <option value="3">Mahasiswa Alumni</option>
                                        </select>
                                        @error('mhs_stat')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                        <div class="relative">
                                            <input type="password" name="new_password" id="newPassword"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20 pr-10"
                                                placeholder="Password baru...">
                                            <button type="button"
                                                class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-[#FF6B35] hover:text-[#E85A2A] transition-colors"
                                                data-target="newPassword">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('new_password')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="newPasswordKonfirm" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                                        <div class="relative">
                                            <input type="password" name="new_password_confirmed" id="newPasswordKonfirm"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#0C6E71] focus:ring focus:ring-[#0C6E71] focus:ring-opacity-20 pr-10"
                                                placeholder="Konfirmasi password baru...">
                                            <button type="button"
                                                class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-[#FF6B35] hover:text-[#E85A2A] transition-colors"
                                                data-target="newPasswordKonfirm">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('new_password_confirmed')
                                            <small class="text-red-500 text-xs mt-1">{{ $message }}</small>
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

@push('styles')
<style>
    /* Additional custom styles */
    .focus-within\:ring-2:focus-within {
        --tw-ring-opacity: 1;
        --tw-ring-color: rgba(12, 110, 113, var(--tw-ring-opacity));
    }

    /* Transition effects */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 150ms;
    }
</style>
@endpush

@section('custom-js')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
<script>
    // Profile image preview
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('mhs_image');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        document.getElementById('profile-preview').src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Toggle password visibility
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);

                if (input.type === 'password') {
                    input.type = 'text';
                    this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    this.innerHTML = '<i class="fa-solid fa-eye"></i>';
                }
            });
        });
    });
</script>
@endsection
