@extends('base.base-dash-index')
@section('title')
    Data Pengguna Karyawan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Karyawan
@endsection
@section('submenu')
    Tambah Data
@endsection
@section('urlmenu')
    {{-- KONDISIONAL BACK BUTTON --}}
    {{ route('web-admin.workers.staff-index') }}
@endsection
@section('subdesc')
    Halaman untuk menambah data karyawan baru
@endsection
@section('content')
    <form action="{{ route('web-admin.workers.staff-store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 col-span-full">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between border-b">
                        <h4 class="font-semibold text-lg">Ubah Foto Profile</h4>
                        <div class="flex space-x-2">
                            <a href="@yield('urlmenu')" class="border border-amber-500 text-amber-500 hover:bg-amber-500 hover:text-white transition duration-300 rounded px-3 py-2">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit" class="border border-[#0C6E71] text-[#0C6E71] hover:bg-[#0C6E71] hover:text-white transition duration-300 rounded px-3 py-2">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-6">
                        <img src="{{ asset('storage/images/default/default-profile.jpg') }}" class="w-full h-auto rounded-lg" alt="Profile Photo" id="preview-image">
                        <div class="border-t my-4"></div>
                        <div class="mb-4">
                            <label for="image" class="block text-gray-700 font-medium mb-2">Upload Foto Profile</label>
                            <div class="flex items-center">
                                <input type="file" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="image" id="image">
                            </div>
                            @error('image')
                                <small class="text-red-500">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 col-span-full">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <!-- Tabs navigation -->
                        <div class="border-b">
                            <nav class="flex space-x-2" id="tab-navigation">
                                <button type="button" class="px-4 py-2 border-b-2 border-[#0C6E71] text-[#0C6E71] font-medium tab-button" data-tab="personal">
                                    Personal
                                </button>
                                <button type="button" class="px-4 py-2 hover:text-[#0C6E71] tab-button" data-tab="contact">
                                    Kontak
                                </button>
                                <button type="button" class="px-4 py-2 hover:text-[#0C6E71] tab-button" data-tab="security">
                                    Keamanan
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="py-4" id="tab-content">
                            <!-- Personal Tab -->
                            <div class="tab-pane" id="personal">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                        <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" placeholder="Nama lengkap...">
                                        @error('name')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="user" class="block text-gray-700 font-medium mb-2">Username</label>
                                        <input type="text" name="user" id="user" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" placeholder="Username...">
                                        @error('user')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="gend" class="block text-gray-700 font-medium mb-2">Jenis Kelamin</label>
                                        <select name="gend" id="gend" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71] appearance-none bg-white">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="L">Laki Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('gend')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="birth_place" class="block text-gray-700 font-medium mb-2">Tempat Lahir</label>
                                        <input type="text" name="birth_place" id="birth_place" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" placeholder="Tempat Lahir...">
                                        @error('birth_place')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="birth_date" class="block text-gray-700 font-medium mb-2">Tanggal Lahir</label>
                                        <input type="date" name="birth_date" id="birth_date" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]">
                                        @error('birth_date')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="reli" class="block text-gray-700 font-medium mb-2">Agama</label>
                                        <select name="reli" id="reli" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71] appearance-none bg-white">
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

                            <!-- Contact Tab -->
                            <div class="tab-pane hidden" id="contact">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="phone" class="block text-gray-700 font-medium mb-2">Nomor HandPhone</label>
                                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="phone" id="phone" placeholder="Inputkan nomor telepon...">
                                        @error('phone')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-gray-700 font-medium mb-2">Alamat Email</label>
                                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="email" id="email" placeholder="Inputkan alamat email...">
                                        @error('email')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_name_1" class="block text-gray-700 font-medium mb-2">Nama Kontak Darurat 1</label>
                                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="contact_name_1" id="contact_name_1" placeholder="Inputkan nama kontak darurat...">
                                        @error('contact_name_1')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_phone_1" class="block text-gray-700 font-medium mb-2">Nomor Kontak Darurat 1</label>
                                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="contact_phone_1" id="contact_phone_1" placeholder="Inputkan nomor telepon kontak darurat...">
                                        @error('contact_phone_1')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_name_2" class="block text-gray-700 font-medium mb-2">Nama Kontak Darurat 2</label>
                                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="contact_name_2" id="contact_name_2" placeholder="Inputkan nama kontak darurat...">
                                        @error('contact_name_2')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_phone_2" class="block text-gray-700 font-medium mb-2">Nomor Kontak Darurat 2</label>
                                        <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="contact_phone_2" id="contact_phone_2" placeholder="Inputkan nomor telepon kontak darurat...">
                                        @error('contact_phone_2')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Security Tab -->
                            <div class="tab-pane hidden" id="security">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="type" class="block text-gray-700 font-medium mb-2">Type Users</label>
                                        <select name="type" id="type" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71] appearance-none bg-white">
                                            <option value="" selected>Pilih Role Users</option>
                                            <option value="0">Web Administrator</option>
                                            <option value="1">Departement Finance</option>
                                            <option value="2">Departement Officer</option>
                                            <option value="3">Departement Academic</option>
                                            <option value="4">Departement Admin</option>
                                            <option value="5">Departement Support</option>
                                        </select>
                                        @error('type')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="status" class="block text-gray-700 font-medium mb-2">Status Member</label>
                                        <select name="status" id="status" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71] appearance-none bg-white">
                                            <option value="0">Non-Active</option>
                                            <option value="1">Active</option>
                                        </select>
                                        @error('status')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="newPassword" class="block text-gray-700 font-medium mb-2">Password Baru</label>
                                        <div class="flex">
                                            <input type="password" class="w-full px-3 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="password" id="newPassword" placeholder="Inputkan password...">
                                            <button type="button" class="px-3 py-2 bg-white border border-l-0 rounded-r-lg text-red-500 hover:bg-red-50 toggle-password" data-target="newPassword">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <small class="text-red-500">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="newPasswordKonfirm" class="block text-gray-700 font-medium mb-2">Konfirmasi Password Baru</label>
                                        <div class="flex">
                                            <input type="password" class="w-full px-3 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-[#0C6E71]" name="password_confirm" id="newPasswordKonfirm" placeholder="Inputkan konfirmasi password...">
                                            <button type="button" class="px-3 py-2 bg-white border border-l-0 rounded-r-lg text-red-500 hover:bg-red-50 toggle-password" data-target="newPasswordKonfirm">
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
        </section>
    </form>
@endsection

@section('custom-js')
<script>
    // Image preview functionality
    document.getElementById("image").onchange = function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };

    // Tab functionality
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabPanes = document.querySelectorAll('.tab-pane');

        // Initialize tabs
        function showTab(tabId) {
            // Hide all tab panes
            tabPanes.forEach(pane => {
                pane.classList.add('hidden');
            });

            // Remove active class from all buttons
            tabButtons.forEach(btn => {
                btn.classList.remove('border-b-2', 'border-[#0C6E71]', 'text-[#0C6E71]');
                btn.classList.add('hover:text-[#0C6E71]');
            });

            // Show the selected tab
            const selectedTab = document.getElementById(tabId);
            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }

            // Add active class to clicked button
            const activeButton = document.querySelector(`.tab-button[data-tab="${tabId}"]`);
            if (activeButton) {
                activeButton.classList.add('border-b-2', 'border-[#0C6E71]', 'text-[#0C6E71]');
                activeButton.classList.remove('hover:text-[#0C6E71]');
            }
        }

        // Add click event to tab buttons
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');
                showTab(tabId);
            });
        });

        // Show the first tab by default
        showTab('personal');
    });

    // Password toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggle-password');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
                } else {
                    passwordInput.type = 'password';
                    this.innerHTML = '<i class="fa-solid fa-eye"></i>';
                }
            });
        });
    });
</script>
@endsection
