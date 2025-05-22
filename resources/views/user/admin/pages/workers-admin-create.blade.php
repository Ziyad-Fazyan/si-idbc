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
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-[#0C6E71] px-4 py-3 flex items-center justify-between">
                    <h4 class="text-white font-semibold text-lg">Foto Profil</h4>
                    <a href="@yield('urlmenu')"
                        class="px-3 py-2 border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded transition-colors flex items-center space-x-2">
                        <i class="fa-solid fa-backward"></i>
                        <span>Kembali</span>
                    </a>
                </div>
                <div class="p-4">
                    <div class="mb-4">
                        <img src="{{ asset('storage/images/default/default-profile.jpg') }}"
                            class="w-full h-auto rounded-lg mb-4" alt="Profile Image" id="profileImage">
                    </div>
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto
                            Profile</label>
                        <input type="file"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#0C6E71] file:text-white hover:file:bg-[#0a5c5e]"
                            name="image" id="image" required>
                        @error('image')
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
                                    id="security-tab" data-tab-target="#security" type="button" role="tab" disabled>Pengaturan
                                    Akun</button>
                            </li>
                        </ul>
                    </div>

                    <form action="{{ route('web-admin.workers.admin-store') }}" method="POST"
                        enctype="multipart/form-data" id="multiStepForm">
                        @csrf
                        <div class="tab-content pt-4" id="myTabContent">
                            <!-- Tab Data Personal -->
                            <div class="tab-pane active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap</label>
                                        <input type="text" name="name" id="name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama lengkap..." value="{{ old('name') }}" required>
                                        @error('name')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="user" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input type="text" name="user" id="user"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Username..." value="{{ old('user') }}" required>
                                        @error('user')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                            Kelamin</label>
                                        <select name="gend" id="gend"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                            <option value="L" {{ old('gend') == 'L' ? 'selected' : '' }}>Laki Laki</option>
                                            <option value="P" {{ old('gend') == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                            placeholder="Tempat Lahir..." value="{{ old('birth_place') }}" required>
                                        @error('birth_place')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                            Lahir</label>
                                        <input type="date" name="birth_date" id="birth_date"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            value="{{ old('birth_date') }}" required>
                                        @error('birth_date')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="reli" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                        <select name="reli" id="reli"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                            <option value="" selected disabled>Pilih Agama</option>
                                            <option value="1" {{ old('reli') == '1' ? 'selected' : '' }}>Agama Islam</option>
                                            <option value="2" {{ old('reli') == '2' ? 'selected' : '' }}>Agama Kristen Protestan</option>
                                            <option value="3" {{ old('reli') == '3' ? 'selected' : '' }}>Agama Kriten Katholik</option>
                                            <option value="4" {{ old('reli') == '4' ? 'selected' : '' }}>Agama Hindu</option>
                                            <option value="5" {{ old('reli') == '5' ? 'selected' : '' }}>Agama Buddha</option>
                                            <option value="6" {{ old('reli') == '6' ? 'selected' : '' }}>Agama Konghuchu</option>
                                        </select>
                                        @error('reli')
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
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                            HandPhone</label>
                                        <input type="text" name="phone" id="phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nomor telepon..." value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            Email</label>
                                        <input type="email" name="email" id="email"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan alamat email..." value="{{ old('email') }}" required>
                                        @error('email')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_name_1" class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak Darurat
                                            1</label>
                                        <input type="text" name="contact_name_1" id="contact_name_1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nama kontak darurat..." value="{{ old('contact_name_1') }}" required>
                                        @error('contact_name_1')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_phone_1" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kontak Darurat
                                            1</label>
                                        <input type="text" name="contact_phone_1" id="contact_phone_1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nomor telepon kontak darurat..." value="{{ old('contact_phone_1') }}" required>
                                        @error('contact_phone_1')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_name_2" class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak Darurat
                                            2</label>
                                        <input type="text" name="contact_name_2" id="contact_name_2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nama kontak darurat..." value="{{ old('contact_name_2') }}">
                                        @error('contact_name_2')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="contact_phone_2" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kontak Darurat
                                            2</label>
                                        <input type="text" name="contact_phone_2" id="contact_phone_2"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Inputkan nomor telepon kontak darurat..." value="{{ old('contact_phone_2') }}">
                                        @error('contact_phone_2')
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
                                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type
                                            Users</label>
                                        <select name="type" id="type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                            <option value="" selected disabled>Pilih Role Users</option>
                                            <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Web Administrator</option>
                                            <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Koordinator Program</option>
                                            <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Staff Administrasi</option>
                                            <option value="3" {{ old('type') == '3' ? 'selected' : '' }}>Staff Akademik</option>
                                            <option value="4" {{ old('type') == '4' ? 'selected' : '' }}>Staff Sarana dan Prasarana</option>
                                        </select>
                                        @error('type')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status
                                            Member</label>
                                        <select name="status" id="status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                            <optgroup label="Pilih Status Users">
                                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non-Active</option>
                                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                            </optgroup>
                                        </select>
                                        @error('status')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password" name="password" id="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                                placeholder="Inputkan password..." required>
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
                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi
                                            Password</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
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
        document.getElementById("image").onchange = function(event) {
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
