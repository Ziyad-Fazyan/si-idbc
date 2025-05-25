@extends('base.base-dash-index')
@section('title')
    Data Pengguna Admin - SIAKAD PT - Internal Developer
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
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-[#0C6E71] px-4 py-3">
                    <h4 class="text-white font-semibold">Ubah Foto Profile</h4>
                </div>
                <div class="p-4">
                    <form action="{{ route('web-admin.workers.admin-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <img src="{{ asset('storage/images/default/default-profile.jpg') }}" 
                            class="w-full h-auto rounded-lg mb-4" id="profile-preview" alt="Profile Image">
                        <hr class="my-4 border-gray-200">
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto
                                Profile</label>
                            <div class="flex items-center gap-2">
                                <input type="file"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#0C6E71] file:text-white hover:file:bg-[#0a5c5e]"
                                    name="image" id="image">
                                <button type="submit"
                                    class="px-4 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                            @error('image')
                                <small class="text-red-500 text-xs">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
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
                                    id="personal-tab" data-tab-target="#personal" type="button" role="tab">Personal</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 font-medium"
                                    id="contact-tab" data-tab-target="#contact" type="button" role="tab">Kontak</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 font-medium"
                                    id="security-tab" data-tab-target="#security" type="button" role="tab">Keamanan</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content pt-4" id="myTabContent">
                        <!-- Personal Tab -->
                        <div class="tab-pane active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <form action="{{ route('web-admin.workers.admin-store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap</label>
                                        <input type="text" name="name" id="name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama lengkap...">
                                        @error('name')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="user"
                                            class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input type="text" name="user" id="user"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Username...">
                                        @error('user')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                            Kelamin</label>
                                        <select name="gend" id="gend"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="L">Laki Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('gend')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="birth_place" class="block text-sm font-medium text-gray-700 mb-1">Tempat
                                            Lahir</label>
                                        <input type="text" name="birth_place" id="birth_place"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Tempat Lahir...">
                                        @error('birth_place')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="birth_date"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="birth_date" id="birth_date"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                        @error('birth_date')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="reli"
                                            class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                        <select name="reli" id="reli"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Agama</option>
                                            <option value="1">Agama Islam</option>
                                            <option value="2">Agama Kristen Protestan</option>
                                            <option value="3">Agama Kriten Katholik</option>
                                            <option value="4">Agama Hindu</option>
                                            <option value="5">Agama Buddha</option>
                                            <option value="6">Agama Konghuchu</option>
                                        </select>
                                        @error('reli')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="flex justify-end items-center col-span-2">
                                        <button type="submit"
                                            class="px-4 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors">
                                            <i class="fa-solid fa-paper-plane mr-2"></i>Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Contact Tab -->
                        <div class="tab-pane hidden" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <form action="{{ route('web-admin.workers.admin-store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                            HandPhone</label>
                                        <input type="text" name="phone" id="phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nomor telepon...">
                                        @error('phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            Email</label>
                                        <input type="email" name="email" id="email"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan alamat email...">
                                        @error('email')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="contact_name_1"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak Darurat
                                            1</label>
                                        <input type="text" name="contact_name_1" id="contact_name_1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nama kontak darurat...">
                                        @error('contact_name_1')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="contact_phone_1"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Kontak Darurat
                                            1</label>
                                        <input type="text" name="contact_phone_1" id="contact_phone_1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nomor telepon kontak darurat...">
                                        @error('contact_phone_1')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="contact_name_2"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak Darurat
                                            2</label>
                                        <input type="text" name="contact_name_2" id="contact_name_2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nama kontak darurat...">
                                        @error('contact_name_2')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="contact_phone_2"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Kontak Darurat
                                            2</label>
                                        <input type="text" name="contact_phone_2" id="contact_phone_2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nomor telepon kontak darurat...">
                                        @error('contact_phone_2')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="flex justify-end items-center col-span-2">
                                        <button type="submit"
                                            class="px-4 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors">
                                            <i class="fa-solid fa-paper-plane mr-2"></i>Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Security Tab -->
                        <div class="tab-pane hidden" id="security" role="tabpanel" aria-labelledby="security-tab">
                            <form action="{{ route('web-admin.workers.admin-store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type
                                            Users</label>
                                        <select name="type" id="type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Role Users</option>
                                            <option value="0">Web Administrator</option>
                                            <option value="1">Staff Finance</option>
                                            <option value="2">Absen</option>
                                            <option value="3">Staff Akademik</option>
                                            <option value="4">Staff Mutabaah</option>
                                            <option value="5">Staff Sarana dan Prasarana</option>
                                        </select>
                                        @error('type')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status
                                            Member</label>
                                        <select name="status" id="status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                            <optgroup label="Pilih Status Users">
                                                <option value="0">Non-Active</option>
                                                <option value="1">Active</option>
                                            </optgroup>
                                        </select>
                                        @error('status')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="newPassword"
                                            class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                        <div class="relative">
                                            <input type="password" name="password" id="newPassword"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] pr-10"
                                                placeholder="Inputkan password...">
                                            <button type="button"
                                                class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-[#FF6B35] hover:text-[#E85A2A] transition-colors"
                                                data-target="newPassword">
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
                                        <div class="relative">
                                            <input type="password" name="password_confirm" id="newPasswordKonfirm"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] pr-10"
                                                placeholder="Inputkan konfirmasi password...">
                                            <button type="button"
                                                class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-[#FF6B35] hover:text-[#E85A2A] transition-colors"
                                                data-target="newPasswordKonfirm">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('password_confirm')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="flex justify-end items-center col-span-2">
                                        <button type="submit"
                                            class="px-4 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors">
                                            <i class="fa-solid fa-paper-plane mr-2"></i>Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Image preview
        document.getElementById("image").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profile-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };

        // Tab functionality
        document.querySelectorAll('[data-tab-target]').forEach(tab => {
            tab.addEventListener('click', () => {
                // Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                });

                // Remove active class from all tabs
                document.querySelectorAll('[data-tab-target]').forEach(t => {
                    t.classList.remove('border-[#0C6E71]', 'text-[#0C6E71]');
                    t.classList.add('border-transparent');
                });

                // Show selected pane
                const target = document.querySelector(tab.getAttribute('data-tab-target'));
                target.classList.remove('hidden');

                // Add active class to clicked tab
                tab.classList.add('border-[#0C6E71]', 'text-[#0C6E71]');
                tab.classList.remove('border-transparent');
            });
        });

        // Show/hide password functionality
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
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