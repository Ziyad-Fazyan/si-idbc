@extends('base.base-dash-index')
@section('title')
    Data Pengguna Admin - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Admin
@endsection
@section('submenu')
    Tambah Data
@endsection
@section('urlmenu')
    {{ route('web-admin.workers.admin-index') }}
@endsection
@section('subdesc')
    Halaman untuk menambah data admin baru
@endsection
@section('content')
    <form action="{{ route('web-admin.workers.admin-store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <section class="w-full py-4">
            <div class="flex flex-col lg:flex-row gap-6">
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                            <h4 class="text-lg font-semibold text-gray-700">Ubah Foto Profile</h4>
                            <div class="flex space-x-2">
                                <a href="@yield('urlmenu')" class="px-3 py-2 border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded transition-colors">
                                    <i class="fa-solid fa-backward"></i>
                                </a>
                                <button type="submit" class="px-3 py-2 border border-[#0C6E71] text-[#0C6E71] hover:bg-[#0C6E71] hover:text-white rounded transition-colors">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <img src="{{ asset('storage/images/default/default-profile.jpg') }}"
                                class="w-full h-auto rounded-lg object-cover"
                                id="profile-preview"
                                alt="Profile Image">
                            <div class="border-t border-gray-200 my-4"></div>
                            <div class="space-y-2">
                                <label for="image" class="text-sm font-medium text-gray-700 block">Upload Foto Profile</label>
                                <div class="flex items-center">
                                    <input type="file"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        name="image"
                                        id="image">
                                </div>
                                @error('image')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="border-b border-gray-200" x-data="{ activeTab: 'personal' }">
                                <ul class="flex flex-wrap -mb-px">
                                    <li class="mr-2">
                                        <button type="button"
                                            @click="activeTab = 'personal'"
                                            :class="{'border-b-2 border-[#0C6E71] text-[#0C6E71]': activeTab === 'personal', 'text-gray-500 hover:text-gray-700': activeTab !== 'personal'}"
                                            class="inline-block py-4 px-4 font-medium">
                                            Personal
                                        </button>
                                    </li>
                                    <li class="mr-2">
                                        <button type="button"
                                            @click="activeTab = 'contact'"
                                            :class="{'border-b-2 border-[#0C6E71] text-[#0C6E71]': activeTab === 'contact', 'text-gray-500 hover:text-gray-700': activeTab !== 'contact'}"
                                            class="inline-block py-4 px-4 font-medium">
                                            Kontak
                                        </button>
                                    </li>
                                    <li class="mr-2">
                                        <button type="button"
                                            @click="activeTab = 'security'"
                                            :class="{'border-b-2 border-[#0C6E71] text-[#0C6E71]': activeTab === 'security', 'text-gray-500 hover:text-gray-700': activeTab !== 'security'}"
                                            class="inline-block py-4 px-4 font-medium">
                                            Keamanan
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <div class="py-4" x-data="{ activeTab: 'personal' }">
                                <!-- Personal Information Tab -->
                                <div x-show="activeTab === 'personal'" class="space-y-6">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label for="name" class="text-sm font-medium text-gray-700 block">Nama Lengkap</label>
                                            <input type="text"
                                                name="name"
                                                id="name"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Nama lengkap...">
                                            @error('name')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="user" class="text-sm font-medium text-gray-700 block">Username</label>
                                            <input type="text"
                                                name="user"
                                                id="user"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Username...">
                                            @error('user')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="gend" class="text-sm font-medium text-gray-700 block">Jenis Kelamin</label>
                                            <select name="gend"
                                                id="gend"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                                <option value="" selected>Pilih Jenis Kelamin</option>
                                                <option value="L">Laki Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                            @error('gend')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="birth_place" class="text-sm font-medium text-gray-700 block">Tempat Lahir</label>
                                            <input type="text"
                                                name="birth_place"
                                                id="birth_place"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Tempat Lahir...">
                                            @error('birth_place')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="birth_date" class="text-sm font-medium text-gray-700 block">Tanggal Lahir</label>
                                            <input type="date"
                                                name="birth_date"
                                                id="birth_date"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            @error('birth_date')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="reli" class="text-sm font-medium text-gray-700 block">Agama</label>
                                            <select name="reli"
                                                id="reli"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                                <option value="" selected>Pilih Agama</option>
                                                <option value="1">Agama Islam</option>
                                                <option value="2">Agama Kristen Protestan</option>
                                                <option value="3">Agama Kriten Katholik</option>
                                                <option value="4">Agama Hindu</option>
                                                <option value="5">Agama Buddha</option>
                                                <option value="6">Agama Konghuchu</option>
                                            </select>
                                            @error('reli')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information Tab -->
                                <div x-show="activeTab === 'contact'" class="space-y-6">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label for="phone" class="text-sm font-medium text-gray-700 block">Nomor HandPhone</label>
                                            <input type="text"
                                                name="phone"
                                                id="phone"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Inputkan nomor telepon...">
                                            @error('phone')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="email" class="text-sm font-medium text-gray-700 block">Alamat Email</label>
                                            <input type="email"
                                                name="email"
                                                id="email"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Inputkan alamat email...">
                                            @error('email')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="contact_name_1" class="text-sm font-medium text-gray-700 block">Nama Kontak Darurat 1</label>
                                            <input type="text"
                                                name="contact_name_1"
                                                id="contact_name_1"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Inputkan nama kontak darurat...">
                                            @error('contact_name_1')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="contact_phone_1" class="text-sm font-medium text-gray-700 block">Nomor Kontak Darurat 1</label>
                                            <input type="text"
                                                name="contact_phone_1"
                                                id="contact_phone_1"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Inputkan nomor telepon kontak darurat...">
                                            @error('contact_phone_1')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="contact_name_2" class="text-sm font-medium text-gray-700 block">Nama Kontak Darurat 2</label>
                                            <input type="text"
                                                name="contact_name_2"
                                                id="contact_name_2"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Inputkan nama kontak darurat...">
                                            @error('contact_name_2')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="contact_phone_2" class="text-sm font-medium text-gray-700 block">Nomor Kontak Darurat 2</label>
                                            <input type="text"
                                                name="contact_phone_2"
                                                id="contact_phone_2"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                placeholder="Inputkan nomor telepon kontak darurat...">
                                            @error('contact_phone_2')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Information Tab -->
                                <div x-show="activeTab === 'security'" class="space-y-6">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label for="type" class="text-sm font-medium text-gray-700 block">Type Users</label>
                                            <select name="type"
                                                id="type"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                                <option value="" selected>Pilih Role Users</option>
                                                <option value="0">Web Administrator</option>
                                                <option value="1">Koordinator Program</option>
                                                <option value="2">Staff Administrasi</option>
                                                <option value="3">Staff Akademik</option>
                                                <option value="4">Staff Sarana dan Prasarana</option>
                                            </select>
                                            @error('type')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="status" class="text-sm font-medium text-gray-700 block">Status Member</label>
                                            <select name="status"
                                                id="status"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                                <optgroup label="Pilih Status Users">
                                                    <option value="0">Non-Active</option>
                                                    <option value="1">Active</option>
                                                </optgroup>
                                            </select>
                                            @error('status')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="newPassword" class="text-sm font-medium text-gray-700 block">Password Baru</label>
                                            <div class="flex">
                                                <input type="password"
                                                    name="password"
                                                    id="newPassword"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                    placeholder="Inputkan password...">
                                                <button type="button"
                                                    class="px-3 py-2 bg-white border border-gray-300 border-l-0 rounded-r-md text-[#FF6B35] hover:bg-gray-50 toggle-password"
                                                    data-target="newPassword">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label for="newPasswordKonfirm" class="text-sm font-medium text-gray-700 block">Konfirmasi Password Baru</label>
                                            <div class="flex">
                                                <input type="password"
                                                    name="password_confirm"
                                                    id="newPasswordKonfirm"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                    placeholder="Inputkan konfirmasi password...">
                                                <button type="button"
                                                    class="px-3 py-2 bg-white border border-gray-300 border-l-0 rounded-r-md text-[#FF6B35] hover:bg-gray-50 toggle-password"
                                                    data-target="newPasswordKonfirm">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('password_confirm')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
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
<script>
    // Profile image preview
    document.getElementById("image").onchange = function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profile-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    // Password toggle visibility
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

<!-- Alpine.js - include this if not already in your layout -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
