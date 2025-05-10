@extends('base.base-dash-index')
@section('title')
    Data Pengguna Dosen - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Dosen
@endsection
@section('submenu')
    Tambah Dosen
@endsection
@section('urlmenu')
    {{ route('web-admin.workers.lecture-index') }}
@endsection
@section('subdesc')
    Halaman untuk menambah data pengguna Dosen
@endsection
@section('content')
    <form action="{{ route('web-admin.workers.lecture-store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col md:flex-row gap-4">
            <div class="w-full md:w-1/3">

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gray-50 px-4 py-3 flex justify-between items-center border-b">
                        <h4 class="text-lg font-semibold text-gray-800">Ubah Foto Profile</h4>
                        <div class="flex gap-2">
                            <a href="@yield('urlmenu')"
                                class="text-[#FF6B35] hover:text-[#FF6B35]/90 px-3 py-1 rounded border border-[#FF6B35] hover:bg-[#FF6B35]/10 transition">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit"
                                class="bg-[#0C6E71] hover:bg-[#0C6E71]/90 text-white px-3 py-1 rounded transition">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <img src="{{ asset('storage/images/default/default-profile.jpg') }}" class="w-full h-auto rounded"
                            alt="Profile Image" id="profileImage">
                        <hr class="my-4">
                        <div class="mb-4">
                            <label for="dsn_image" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto
                                Profile</label>
                            <div class="flex items-center gap-2">
                                <input type="file"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-[#0C6E71]/10 file:text-[#0C6E71] hover:file:bg-[#0C6E71]/20"
                                    name="dsn_image" id="dsn_image">
                                @error('dsn_image')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-2/3">

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4">

                        <div class="border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px" id="myTab" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 border-[#0C6E71] rounded-t-lg text-[#0C6E71] font-medium active"
                                        id="home-tab" data-tab-target="#home" type="button" role="tab"
                                        aria-controls="home" aria-selected="true">
                                        <i class="fa-solid fa-id-card mr-1"></i> Data Personal
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 font-medium"
                                        id="contact-tab" data-tab-target="#contact" type="button" role="tab"
                                        aria-controls="contact" aria-selected="false">
                                        <i class="fa-solid fa-address-book mr-1"></i> Data Kontak
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 font-medium"
                                        id="profile-tab" data-tab-target="#profile" type="button" role="tab"
                                        aria-controls="profile" aria-selected="false">
                                        <i class="fa-solid fa-user-lock mr-1"></i> Pengaturan Akun
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content mt-4">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <hr class="my-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="dsn_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap</label>
                                        <input type="text" name="dsn_name" id="dsn_name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            placeholder="Nama lengkap...">
                                        @error('dsn_name')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_nidn"
                                            class="block text-sm font-medium text-gray-700 mb-1">NIDN</label>
                                        <input type="text" name="dsn_nidn" id="dsn_nidn"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            placeholder="Username...">
                                        @error('dsn_nidn')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_user"
                                            class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input type="text" name="dsn_user" id="dsn_user"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            placeholder="Username...">
                                        @error('dsn_user')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                            Kelamin</label>
                                        <select name="dsn_gend" id="dsn_gend"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="L">Laki Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('dsn_gend')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_birthplace"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                        <input type="text" name="dsn_birthplace" id="dsn_birthplace"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            placeholder="Tempat Lahir...">
                                        @error('dsn_birthplace')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_birthdate"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="dsn_birthdate" id="dsn_birthdate"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            placeholder="Tanggal Lahir...">
                                        @error('dsn_birthdate')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane hidden" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <hr class="my-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="dsn_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                            HandPhone</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            name="dsn_phone" id="dsn_phone" placeholder="Inputkan nomor telepon...">
                                        @error('dsn_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_mail" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            Email</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                            name="dsn_mail" id="dsn_mail" placeholder="Inputkan alamat email...">
                                        @error('dsn_mail')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <hr class="my-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="dsn_stat" class="block text-sm font-medium text-gray-700 mb-1">Status
                                            Member</label>
                                        <select name="dsn_stat" id="dsn_stat"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <optgroup label="Pilih Status Users">
                                                <option value="0">Non-Active</option>
                                                <option value="1">Active</option>
                                            </optgroup>
                                        </select>
                                        @error('dsn_stat')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4 hidden">
                                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type
                                            Users</label>
                                        <select name="type" id="type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]">
                                            <option value="" selected>Pilih Role Users</option>
                                            <option value="0">Web Administrator</option>
                                            <option value="1">Koordinator Program</option>
                                            <option value="2">Staff Administrasi</option>
                                            <option value="3">Staff Akademik</option>
                                            <option value="4">Staff Sarana dan Prasarana</option>
                                        </select>
                                        @error('type')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="newPassword"
                                            class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#0C6E71] focus:border-[#0C6E71]"
                                                name="password" id="newPassword" placeholder="Inputkan password...">
                                            <button type="button"
                                                class="px-3 py-2 border border-red-500 text-red-500 rounded hover:bg-red-50 transition"
                                                id="showPasswordButton">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
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
                                                class="px-3 py-2 border border-red-500 text-red-500 rounded hover:bg-red-50 transition"
                                                id="showPasswordButtonConfirm">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password_confirm')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
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
@endsection
@section('custom-js')
    <script>
        // Image preview
        document.getElementById("dsn_image").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profileImage');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        // Password toggle
        const showPasswordButtons = document.querySelectorAll('[id^="showPasswordButton"]');
        showPasswordButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                const input = btn.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    btn.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    btn.innerHTML = '<i class="fa-solid fa-eye"></i>';
                }
            });
        });

        // Tab functionality
        const tabs = document.querySelectorAll('[data-tab-target]');
        const tabContents = document.querySelectorAll('.tab-pane');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = document.querySelector(tab.dataset.tabTarget);

                // Remove active classes from all tabs and contents
                tabs.forEach(t => {
                    t.classList.remove('border-[#0C6E71]', 'text-[#0C6E71]');
                    t.classList.add('border-transparent', 'hover:text-gray-600',
                        'hover:border-gray-300');
                });
                tabContents.forEach(content => {
                    content.classList.remove('active');
                    content.classList.add('hidden');
                });

                // Add active classes to current tab and content
                tab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                tab.classList.add('border-[#0C6E71]', 'text-[#0C6E71]');
                target.classList.remove('hidden');
                target.classList.add('active');
            });
        });
    </script>
@endsection
