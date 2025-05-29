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
        <!-- Profile Image Section -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                <div class="bg-[#0C6E71] px-4 py-3">
                    <h4 class="text-white font-medium">Foto Profil</h4>
                </div>
                <div class="p-4">
                    <div class="mb-4 flex justify-center">
                        <img src="{{ asset('storage/images/default/default-profile.jpg') }}"
                             class="w-48 h-48 rounded-full object-cover border-4 border-gray-100"
                             alt="Profile Image"
                             id="profileImage">
                    </div>
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Profil</label>
                        <input type="file"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-[#0C6E71] file:text-white hover:file:bg-[#0a5c5e]"
                               name="image"
                               id="image"
                               accept="image/*">
                        @error('image')
                            <small class="text-red-500 text-xs">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                <div class="border-b border-gray-200">
                    <ul class="flex" id="myTab" role="tablist">
                        <li class="flex-1" role="presentation">
                            <button class="w-full py-3 border-b-2 border-[#0C6E71] text-[#0C6E71] font-medium active"
                                    id="personal-tab"
                                    data-tab-target="#personal"
                                    type="button"
                                    role="tab">
                                Data Personal
                            </button>
                        </li>
                        <li class="flex-1" role="presentation">
                            <button class="w-full py-3 border-b-2 border-transparent text-gray-500 font-medium disabled-tab"
                                    id="contact-tab"
                                    data-tab-target="#contact"
                                    type="button"
                                    role="tab"
                                    disabled>
                                Data Kontak
                            </button>
                        </li>
                        <li class="flex-1" role="presentation">
                            <button class="w-full py-3 border-b-2 border-transparent text-gray-500 font-medium disabled-tab"
                                    id="security-tab"
                                    data-tab-target="#security"
                                    type="button"
                                    role="tab"
                                    disabled>
                                Keamanan
                            </button>
                        </li>
                    </ul>
                </div>

                <form action="{{ route('web-admin.workers.admin-store') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
                    @csrf
                    <div class="p-4">
                        <!-- Tab Data Personal -->
                        <div class="tab-pane active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           placeholder="Nama lengkap..."
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="user" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text"
                                           name="user"
                                           id="user"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           placeholder="Username..."
                                           value="{{ old('user') }}"
                                           required>
                                    @error('user')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                    <select name="gend"
                                            id="gend"
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
                                    <label for="birth_place" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                    <input type="text"
                                           name="birth_place"
                                           id="birth_place"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           placeholder="Tempat Lahir..."
                                           value="{{ old('birth_place') }}"
                                           required>
                                    @error('birth_place')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <input type="date"
                                           name="birth_date"
                                           id="birth_date"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           value="{{ old('birth_date') }}"
                                           required>
                                    @error('birth_date')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="reli" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                    <select name="reli"
                                            id="reli"
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
                            <div class="flex justify-end mt-6">
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
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HandPhone</label>
                                    <input type="text"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           name="phone"
                                           id="phone"
                                           placeholder="Nomor telepon..."
                                           value="{{ old('phone') }}"
                                           required>
                                    @error('phone')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                    <input type="email"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           name="email"
                                           id="email"
                                           placeholder="Alamat email..."
                                           value="{{ old('email') }}"
                                           required>
                                    @error('email')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="contact_name_1" class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak Darurat 1</label>
                                    <input type="text"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           name="contact_name_1"
                                           id="contact_name_1"
                                           placeholder="Nama kontak darurat..."
                                           value="{{ old('contact_name_1') }}">
                                    @error('contact_name_1')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="contact_phone_1" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kontak Darurat 1</label>
                                    <input type="text"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           name="contact_phone_1"
                                           id="contact_phone_1"
                                           placeholder="Nomor telepon kontak darurat..."
                                           value="{{ old('contact_phone_1') }}">
                                    @error('contact_phone_1')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="contact_name_2" class="block text-sm font-medium text-gray-700 mb-1">Nama Kontak Darurat 2</label>
                                    <input type="text"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           name="contact_name_2"
                                           id="contact_name_2"
                                           placeholder="Nama kontak darurat..."
                                           value="{{ old('contact_name_2') }}">
                                    @error('contact_name_2')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="contact_phone_2" class="block text-sm font-medium text-gray-700 mb-1">Nomor Kontak Darurat 2</label>
                                    <input type="text"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           name="contact_phone_2"
                                           id="contact_phone_2"
                                           placeholder="Nomor telepon kontak darurat..."
                                           value="{{ old('contact_phone_2') }}">
                                    @error('contact_phone_2')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-between mt-6">
                                <button type="button"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors prev-tab"
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

                        <!-- Tab Keamanan -->
                        <div class="tab-pane hidden" id="security" role="tabpanel" aria-labelledby="security-tab">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type Users</label>
                                    <select name="type"
                                            id="type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                        <option value="" selected disabled>Pilih Role Users</option>
                                        <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Web Administrator</option>
                                        <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Staff Finance</option>
                                        <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Absen</option>
                                        <option value="3" {{ old('type') == '3' ? 'selected' : '' }}>Staff Akademik</option>
                                        <option value="4" {{ old('type') == '4' ? 'selected' : '' }}>Staff Musyrif</option>
                                        <option value="5" {{ old('type') == '5' ? 'selected' : '' }}>Staff Sarana dan Prasarana</option>
                                        <option value="6" {{ old('type') == '6' ? 'selected' : '' }}>Staff Site Manager</option>
                                    </select>
                                    @error('type')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Member</label>
                                    <select name="status"
                                            id="status"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non-Active</option>
                                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    </select>
                                    @error('status')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <div class="relative">
                                        <input type="password"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                               name="password"
                                               id="password"
                                               placeholder="Password..."
                                               required>
                                        <button type="button"
                                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-[#0C6E71] show-password">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                    <div class="relative">
                                        <input type="password"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                               name="password_confirmation"
                                               id="password_confirmation"
                                               placeholder="Konfirmasi password..."
                                               required>
                                        <button type="button"
                                                class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-500 hover:text-[#0C6E71] show-password">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password_confirmation')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-between mt-6">
                                <button type="button"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors prev-tab"
                                        data-prev-tab="contact-tab">
                                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <button type="submit"
                                        class="px-4 py-2 bg-[#0C6E71] text-white rounded-md hover:bg-[#0a5c5e] transition-colors">
                                    <i class="fa-solid fa-save mr-2"></i> Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Image preview
        document.getElementById("image").addEventListener("change", function(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('profileImage').src = reader.result;
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        });

        // Tab navigation
        document.addEventListener('DOMContentLoaded', function() {
            // Next tab button
            document.querySelectorAll('.next-tab').forEach(button => {
                button.addEventListener('click', function() {
                    const nextTabId = this.getAttribute('data-next-tab');
                    const currentTabPane = this.closest('.tab-pane');

                    // Validate current tab
                    const inputs = currentTabPane.querySelectorAll('[required]');
                    let isValid = true;

                    inputs.forEach(input => {
                        if (!input.value.trim()) {
                            input.classList.add('border-red-500');
                            isValid = false;
                        } else {
                            input.classList.remove('border-red-500');
                        }
                    });

                    if (!isValid) {
                        alert('Harap lengkapi semua field yang wajib diisi sebelum melanjutkan.');
                        return;
                    }

                    // Switch to next tab
                    switchTab(nextTabId);
                });
            });

            // Previous tab button
            document.querySelectorAll('.prev-tab').forEach(button => {
                button.addEventListener('click', function() {
                    const prevTabId = this.getAttribute('data-prev-tab');
                    switchTab(prevTabId);
                });
            });

            // Tab switching function
            function switchTab(tabId) {
                const tab = document.getElementById(tabId);
                const tabPane = document.querySelector(tab.getAttribute('data-tab-target'));

                // Hide all tab panes
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                    pane.classList.remove('active');
                });

                // Update tab styles
                document.querySelectorAll('[data-tab-target]').forEach(t => {
                    t.classList.remove('border-[#0C6E71]', 'text-[#0C6E71]');
                    t.classList.add('border-transparent', 'text-gray-500');
                });

                // Show target pane and activate tab
                tabPane.classList.remove('hidden');
                tabPane.classList.add('active');
                tab.classList.add('border-[#0C6E71]', 'text-[#0C6E71]');
                tab.classList.remove('border-transparent', 'text-gray-500', 'disabled-tab');
                tab.removeAttribute('disabled');
            }

            // Show/hide password
            document.querySelectorAll('.show-password').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('fa-eye', 'fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('fa-eye-slash', 'fa-eye');
                    }
                });
            });
        });
    </script>
@endpush
