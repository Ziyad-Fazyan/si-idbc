@extends('base.base-dash-index')
@section('title')
    Data Pengguna Karyawan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Karyawan
@endsection
@section('submenu')
    Edit {{ $admin->name }}
@endsection
@section('urlmenu')
    {{-- KONDISIONAL BACK BUTTON --}}
    {{ route('web-admin.workers.staff-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengedit data pengguna {{ $admin->name }}
@endsection
@section('content')
    <form action="{{ route('web-admin.workers.staff-update', $admin->code) }}" method="POST" enctype="multipart/form-data"
        class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @method('PATCH')
        @csrf

        <div class="flex flex-col md:flex-row gap-6 mt-6">
            <div class="w-full md:w-1/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-[#0C6E71] text-white px-6 py-4 flex justify-between items-center">
                        <h4 class="text-lg font-semibold">Ubah Foto Profile</h4>
                        <div class="flex gap-2">
                            <a href="@yield('urlmenu')"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded flex items-center gap-1">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit"
                                class="bg-[#0C6E71] hover:bg-[#0a5c5f] text-white px-3 py-1 rounded flex items-center gap-1">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <img src="{{ asset('storage/images/' . $admin->image) }}" class="w-full h-auto rounded mb-4"
                            alt="">
                        <hr class="my-4">
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto
                                Profile</label>
                            <div class="flex items-center gap-2">
                                <input type="file"
                                    class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-[#0C6E71] file:text-white
                                    hover:file:bg-[#0a5c5f]"
                                    name="image" id="image">
                                @error('image')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-2/3">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="border-b border-gray-200">
                            <nav class="flex -mb-px">
                                <button type="button" data-tab="personal"
                                    class="tab-button active py-4 px-6 border-b-2 font-medium text-sm border-[#0C6E71] text-[#0C6E71]">
                                    Personal
                                </button>
                                <button type="button" data-tab="contact"
                                    class="tab-button py-4 px-6 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                    Kontak
                                </button>
                                <button type="button" data-tab="security"
                                    class="tab-button py-4 px-6 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                    Keamanan
                                </button>
                            </nav>
                        </div>

                        <div id="personal" class="tab-content active py-4">
                            <hr class="my-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" id="name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        placeholder="Nama lengkap..." value="{{ $admin->name }}">
                                    @error('name')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="user"
                                        class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text" name="user" id="user"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        placeholder="Username..." value="{{ $admin->user }}">
                                    @error('user')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                        Kelamin</label>
                                    <select name="gend" id="gend"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                        <option value="" selected>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ $admin->gend === 'L' ? 'selected' : '' }}>Laki Laki
                                        </option>
                                        <option value="P" {{ $admin->gend === 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('gend')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="birth_place" class="block text-sm font-medium text-gray-700 mb-1">Tempat
                                        Lahir</label>
                                    <input type="text" name="birth_place" id="birth_place"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        placeholder="Tempat Lahir..." value="{{ $admin->birth_place }}">
                                    @error('birth_place')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                        Lahir</label>
                                    <input type="date" name="birth_date" id="birth_date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        placeholder="Tanggal Lahir..." value="{{ $admin->birth_date }}">
                                    @error('birth_date')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="reli"
                                        class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                    <select name="reli" id="reli"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                        <option value="" selected>Pilih Agama</option>
                                        <option value="1" {{ $admin->raw_reli === '1' ? 'selected' : '' }}>Agama
                                            Islam</option>
                                        <option value="2" {{ $admin->raw_reli === '2' ? 'selected' : '' }}>Agama
                                            Kristen Protestan</option>
                                        <option value="3" {{ $admin->raw_reli === '3' ? 'selected' : '' }}>Agama
                                            Kriten Katholik</option>
                                        <option value="4" {{ $admin->raw_reli === '4' ? 'selected' : '' }}>Agama
                                            Hindu</option>
                                        <option value="5" {{ $admin->raw_reli === '5' ? 'selected' : '' }}>Agama
                                            Buddha</option>
                                        <option value="6" {{ $admin->raw_reli === '6' ? 'selected' : '' }}>Agama
                                            Konghuchu</option>
                                    </select>
                                    @error('reli')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="contact" class="tab-content hidden py-4">
                            <hr class="my-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                        HandPhone</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        name="phone" id="phone" placeholder="Inputkan nomor telepon..."
                                        value="{{ $admin->phone }}">
                                    @error('phone')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                        Email</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        name="email" id="email" placeholder="Inputkan alamat email..."
                                        value="{{ $admin->email }}">
                                    @error('email')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="contact_name_1" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Kontak Darurat 1</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        name="contact_name_1" id="contact_name_1" placeholder="Inputkan nomor telepon..."
                                        value="{{ $admin->contact_name_1 }}">
                                    @error('contact_name_1')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="contact_phone_1"
                                        class="block text-sm font-medium text-gray-700 mb-1">Nomor Kontak Darurat 1</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        name="contact_phone_1" id="contact_phone_1"
                                        placeholder="Inputkan nomor telepon..." value="{{ $admin->contact_phone_1 }}">
                                    @error('contact_phone_1')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="contact_name_2" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Kontak Darurat 2</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        name="contact_name_2" id="contact_name_2" placeholder="Inputkan nomor telepon..."
                                        value="{{ $admin->contact_name_2 }}">
                                    @error('contact_name_2')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="contact_phone_2"
                                        class="block text-sm font-medium text-gray-700 mb-1">Nomor Kontak Darurat 2</label>
                                    <input type="text"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                        name="contact_phone_2" id="contact_phone_2"
                                        placeholder="Inputkan nomor telepon..." value="{{ $admin->contact_phone_2 }}">
                                    @error('contact_phone_2')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="security" class="tab-content hidden py-4">
                            <hr class="my-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="SecurityKey" class="block text-sm font-medium text-gray-700 mb-1">Security
                                        Key</label>
                                    <div class="flex items-center gap-2">
                                        <input type="password"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            name="code" id="SecurityKey" value="{{ $admin->code }}" disabled>
                                        <button type="button"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                            id="showPasswordButton">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                        @error('code')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4 hidden">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status
                                        Member</label>
                                    <select name="status" id="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                        <optgroup label="Pilih Status Users">
                                            <option value="0" {{ $admin->status == '0' ? 'selected' : '' }}>
                                                Non-Active</option>
                                            <option value="1" {{ $admin->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                        </optgroup>
                                    </select>
                                    @error('status')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type
                                        Users</label>
                                    <select name="type" id="type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                        <option value="" selected>Pilih Role Users</option>
                                        <option value="0" {{ $admin->raw_type === 0 ? 'selected' : '' }}>Web
                                            Administrator</option>
                                        <option value="1" {{ $admin->raw_type === 1 ? 'selected' : '' }}>Staff
                                            Finance</option>
                                        <option value="2" {{ $admin->raw_type === 2 ? 'selected' : '' }}>Staff
                                            Absen</option>
                                        <option value="3" {{ $admin->raw_type === 3 ? 'selected' : '' }}>Staff
                                            Akademik</option>
                                        <option value="4" {{ $admin->raw_type === 4 ? 'selected' : '' }}>Staff
                                            Mutabaah</option>
                                        <option value="5" {{ $admin->raw_type === 5 ? 'selected' : '' }}>Staff Sarana
                                            dan Prasarana</option>
                                        <option value="6" {{ $admin->raw_type === 6 ? 'selected' : '' }}>Staff Site
                                            Manager</option>
                                    </select>
                                    @error('type')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status
                                        Member</label>
                                    <select name="status" id="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                        <optgroup label="Pilih Status Users">
                                            <option value="0" {{ $admin->status == '0' ? 'selected' : '' }}>
                                                Non-Active</option>
                                            <option value="1" {{ $admin->status == '1' ? 'selected' : '' }}>Active
                                            </option>
                                        </optgroup>
                                    </select>
                                    @error('status')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">Password
                                        Baru</label>
                                    <div class="flex items-center gap-2">
                                        <input type="password"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            name="password" id="newPassword" placeholder="Inputkan password...">
                                        <button type="button"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                            id="showNewPasswordButton">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="newPasswordKonfirm"
                                        class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password
                                        Baru</label>
                                    <div class="flex items-center gap-2">
                                        <input type="password"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            name="password_confirm" id="newPasswordKonfirm"
                                            placeholder="Inputkan konfirmasi password...">
                                        <button type="button"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm"
                                            id="showConfirmPasswordButton">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password_confirm')
                                        <small class="text-red-500 text-sm">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('custom-js')
    <script>
        // Image preview functionality
        document.getElementById("image").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('.card-img-top');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        // Tab switching functionality
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', () => {
                // Remove active classes from all buttons and content
                document.querySelectorAll('.tab-button').forEach(btn => {
                    btn.classList.remove('active', 'border-[#0C6E71]', 'text-[#0C6E71]');
                    btn.classList.add('border-transparent', 'text-gray-500');
                });

                // Hide all tab content
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });

                // Add active class to clicked button
                button.classList.add('active', 'border-[#0C6E71]', 'text-[#0C6E71]');
                button.classList.remove('border-transparent', 'text-gray-500');

                // Show corresponding content
                const tabId = button.getAttribute('data-tab');
                document.getElementById(tabId).classList.remove('hidden');
            });
        });

        // Password visibility toggle
        document.getElementById('showPasswordButton').addEventListener('click', function() {
            const passwordInput = document.getElementById('SecurityKey');
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

        // New password visibility toggle
        document.getElementById('showNewPasswordButton').addEventListener('click', function() {
            const passwordInput = document.getElementById('newPassword');
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

        // Confirm password visibility toggle
        document.getElementById('showConfirmPasswordButton').addEventListener('click', function() {
            const passwordInput = document.getElementById('newPasswordKonfirm');
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
    </script>
@endsection
