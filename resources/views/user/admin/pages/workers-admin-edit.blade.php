@extends('base.base-dash-index')
@section('title')
    Data Pengguna Admin - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Admin
@endsection
@section('submenu')
    Edit {{ $admin->name }}
@endsection
@section('urlmenu')
    {{ route('web-admin.workers.admin-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengedit data pengguna {{ $admin->name }}
@endsection
@section('content')
    <form action="{{ route('web-admin.workers.admin-update', $admin->code) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <section class="py-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-4 col-span-12">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                            <h4 class="text-lg font-medium text-gray-800">Ubah Foto Profile</h4>
                            <div class="flex gap-2">
                                <a href="@yield('urlmenu')"
                                    class="px-3 py-2 border border-yellow-500 text-yellow-500 rounded hover:bg-yellow-500 hover:text-white transition-colors">
                                    <i class="fa-solid fa-backward"></i>
                                </a>
                                <button type="submit"
                                    class="px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded hover:bg-[#0C6E71] hover:text-white transition-colors">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <img src="{{ asset('storage/images/' . $admin->image) }}" class="w-full h-auto rounded-lg"
                                alt="{{ $admin->name }}'s profile">
                            <div class="border-t border-gray-200 my-4"></div>
                            <div class="mb-4">
                                <label for="image" class="block text-gray-700 mb-2">Upload Foto Profile</label>
                                <div class="flex justify-between items-center">
                                    <input type="file"
                                        class="block w-full px-3 py-2 text-sm text-gray-700 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                        name="image" id="image">
                                </div>
                                @error('image')
                                    <small class="text-red-500">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-8 col-span-12">
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <div x-data="{ activeTab: 'personal' }">
                                <div class="border-b border-gray-200">
                                    <nav class="-mb-px flex space-x-6">
                                        <a @click.prevent="activeTab = 'personal'"
                                            :class="{ 'text-[#0C6E71] border-b-2 border-[#0C6E71]': activeTab === 'personal', 'text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'personal' }"
                                            class="py-4 px-1 font-medium text-sm cursor-pointer">
                                            Personal
                                        </a>
                                        <a @click.prevent="activeTab = 'contact'"
                                            :class="{ 'text-[#0C6E71] border-b-2 border-[#0C6E71]': activeTab === 'contact', 'text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'contact' }"
                                            class="py-4 px-1 font-medium text-sm cursor-pointer">
                                            Kontak
                                        </a>
                                        <a @click.prevent="activeTab = 'security'"
                                            :class="{ 'text-[#0C6E71] border-b-2 border-[#0C6E71]': activeTab === 'security', 'text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'security' }"
                                            class="py-4 px-1 font-medium text-sm cursor-pointer">
                                            Keamanan
                                        </a>
                                    </nav>
                                </div>

                                <div class="py-4">
                                    <!-- Personal Tab -->
                                    <div x-show="activeTab === 'personal'">
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label for="name" class="block text-gray-700 mb-2">Nama Lengkap</label>
                                                <input type="text" name="name" id="name"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    placeholder="Nama lengkap..." value="{{ $admin->name }}">
                                                @error('name')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="user" class="block text-gray-700 mb-2">Username</label>
                                                <input type="text" name="user" id="user"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    placeholder="Username..." value="{{ $admin->user }}">
                                                @error('user')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="gend" class="block text-gray-700 mb-2">Jenis Kelamin</label>
                                                <select name="gend" id="gend"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                                    <option value="" selected>Pilih Jenis Kelamin</option>
                                                    <option value="L" {{ $admin->gend === 'L' ? 'selected' : '' }}>
                                                        Laki Laki</option>
                                                    <option value="P" {{ $admin->gend === 'P' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                                @error('gend')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="birth_place" class="block text-gray-700 mb-2">Tempat
                                                    Lahir</label>
                                                <input type="text" name="birth_place" id="birth_place"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    placeholder="Tempat Lahir..." value="{{ $admin->birth_place }}">
                                                @error('birth_place')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="birth_date" class="block text-gray-700 mb-2">Tanggal
                                                    Lahir</label>
                                                <input type="date" name="birth_date" id="birth_date"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    placeholder="Tanggal Lahir..." value="{{ $admin->birth_date }}">
                                                @error('birth_date')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="reli" class="block text-gray-700 mb-2">Agama</label>
                                                <select name="reli" id="reli"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                                    <option value="" selected>Pilih Agama</option>
                                                    <option value="1"
                                                        {{ $admin->raw_reli === '1' ? 'selected' : '' }}>Agama Islam
                                                    </option>
                                                    <option value="2"
                                                        {{ $admin->raw_reli === '2' ? 'selected' : '' }}>Agama Kristen
                                                        Protestan</option>
                                                    <option value="3"
                                                        {{ $admin->raw_reli === '3' ? 'selected' : '' }}>Agama Kriten
                                                        Katholik</option>
                                                    <option value="4"
                                                        {{ $admin->raw_reli === '4' ? 'selected' : '' }}>Agama Hindu
                                                    </option>
                                                    <option value="5"
                                                        {{ $admin->raw_reli === '5' ? 'selected' : '' }}>Agama Buddha
                                                    </option>
                                                    <option value="6"
                                                        {{ $admin->raw_reli === '6' ? 'selected' : '' }}>Agama Konghuchu
                                                    </option>
                                                </select>
                                                @error('reli')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contact Tab -->
                                    <div x-show="activeTab === 'contact'" style="display: none;">
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label for="phone" class="block text-gray-700 mb-2">Nomor
                                                    HandPhone</label>
                                                <input type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    name="phone" id="phone" placeholder="Inputkan nomor telepon..."
                                                    value="{{ $admin->phone }}">
                                                @error('phone')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="email" class="block text-gray-700 mb-2">Alamat
                                                    Email</label>
                                                <input type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    name="email" id="email" placeholder="Inputkan alamat email..."
                                                    value="{{ $admin->email }}">
                                                @error('email')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="contact_name_1" class="block text-gray-700 mb-2">Nama Kontak
                                                    Darurat 1</label>
                                                <input type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    name="contact_name_1" id="contact_name_1"
                                                    placeholder="Inputkan nama kontak..."
                                                    value="{{ $admin->contact_name_1 }}">
                                                @error('contact_name_1')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="contact_phone_1" class="block text-gray-700 mb-2">Nomor Kontak
                                                    Darurat 1</label>
                                                <input type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    name="contact_phone_1" id="contact_phone_1"
                                                    placeholder="Inputkan nomor telepon..."
                                                    value="{{ $admin->contact_phone_1 }}">
                                                @error('contact_phone_1')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="contact_name_2" class="block text-gray-700 mb-2">Nama Kontak
                                                    Darurat 2</label>
                                                <input type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    name="contact_name_2" id="contact_name_2"
                                                    placeholder="Inputkan nama kontak..."
                                                    value="{{ $admin->contact_name_2 }}">
                                                @error('contact_name_2')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="contact_phone_2" class="block text-gray-700 mb-2">Nomor Kontak
                                                    Darurat 2</label>
                                                <input type="text"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                    name="contact_phone_2" id="contact_phone_2"
                                                    placeholder="Inputkan nomor telepon..."
                                                    value="{{ $admin->contact_phone_2 }}">
                                                @error('contact_phone_2')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Security Tab -->
                                    <div x-show="activeTab === 'security'" style="display: none;">
                                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                            <div class="mb-4">
                                                <label for="SecurityKey" class="block text-gray-700 mb-2">Security
                                                    Key</label>
                                                <div class="flex">
                                                    <input type="password"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                        name="code" id="SecurityKey" value="{{ $admin->code }}"
                                                        disabled>
                                                    <button type="button"
                                                        class="toggle-password px-3 py-2 bg-red-500 text-white rounded-r hover:bg-red-600 transition-colors"
                                                        data-target="SecurityKey">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </div>
                                                @error('code')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="type" class="block text-gray-700 mb-2">Type Users</label>
                                                <select name="type" id="type"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                                    <option value="" selected>Pilih Role Users</option>
                                                    <option value="0" {{ $admin->raw_type === 0 ? 'selected' : '' }}>
                                                        Web Administrator</option>
                                                    <option value="1" {{ $admin->raw_type === 1 ? 'selected' : '' }}>
                                                        Koordinator Program</option>
                                                    <option value="2" {{ $admin->raw_type === 2 ? 'selected' : '' }}>
                                                        Staff Administrasi</option>
                                                    <option value="3" {{ $admin->raw_type === 3 ? 'selected' : '' }}>
                                                        Staff Akademik</option>
                                                    <option value="4" {{ $admin->raw_type === 4 ? 'selected' : '' }}>
                                                        Staff Sarana dan Prasarana</option>
                                                </select>
                                                @error('type')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="status" class="block text-gray-700 mb-2">Status
                                                    Member</label>
                                                <select name="status" id="status"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                                    <option value="0" {{ $admin->status == '0' ? 'selected' : '' }}>
                                                        Non-Active</option>
                                                    <option value="1" {{ $admin->status == '1' ? 'selected' : '' }}>
                                                        Active</option>
                                                </select>
                                                @error('status')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="newPassword" class="block text-gray-700 mb-2">Password
                                                    Baru</label>
                                                <div class="flex">
                                                    <input type="password"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                        name="password" id="newPassword"
                                                        placeholder="Inputkan password...">
                                                    <button type="button"
                                                        class="toggle-password px-3 py-2 bg-red-500 text-white rounded-r hover:bg-red-600 transition-colors"
                                                        data-target="newPassword">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="newPasswordKonfirm"
                                                    class="block text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                                <div class="flex">
                                                    <input type="password"
                                                        class="w-full px-3 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                                        name="password_confirm" id="newPasswordKonfirm"
                                                        placeholder="Inputkan konfirmasi password...">
                                                    <button type="button"
                                                        class="toggle-password px-3 py-2 bg-red-500 text-white rounded-r hover:bg-red-600 transition-colors"
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
            </div>
        </section>
    </form>
@endsection

@push('styles')
    <style>
        /* Custom styles for focus states */
        .focus-ring {
            @apply ring-2 ring-[#0C6E71] ring-opacity-50;
        }

        /* Custom transition effects */
        .btn-transition {
            @apply transition-all duration-300 ease-in-out;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Preview image before upload
        document.getElementById("image").onchange = function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.querySelector('.card-img-top') || document.querySelector('img');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        // Toggle password visibility
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-password');

            toggleButtons.forEach(btn => {
                btn.addEventListener('click', function() {
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
        });
    </script>
@endpush
