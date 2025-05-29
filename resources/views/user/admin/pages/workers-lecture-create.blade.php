@extends('base.base-dash-index')
@section('title')
    Data Pengguna Dosen - SIAKAD PT - Internal Developer
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
                        <label for="dsn_image" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto Profil</label>
                        <input type="file"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-medium file:bg-[#0C6E71] file:text-white hover:file:bg-[#0a5c5e]"
                               name="dsn_image"
                               id="dsn_image"
                               accept="image/*"
                               required>
                        @error('dsn_image')
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
                                    id="home-tab"
                                    data-tab-target="#home"
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
                                    id="profile-tab"
                                    data-tab-target="#profile"
                                    type="button"
                                    role="tab"
                                    disabled>
                                Akun
                            </button>
                        </li>
                    </ul>
                </div>

                <form action="{{ route('web-admin.workers.lecture-store') }}" method="POST" enctype="multipart/form-data" id="multiStepForm">
                    @csrf
                    <div class="p-4">
                        <!-- Tab Data Personal -->
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="dsn_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text"
                                           name="dsn_name"
                                           id="dsn_name"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           placeholder="Nama lengkap..."
                                           value="{{ old('dsn_name') }}"
                                           required>
                                    @error('dsn_name')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="dsn_nidn" class="block text-sm font-medium text-gray-700 mb-1">NIDN</label>
                                    <input type="text"
                                           name="dsn_nidn"
                                           id="dsn_nidn"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           placeholder="NIDN..."
                                           value="{{ old('dsn_nidn') }}"
                                           required>
                                    @error('dsn_nidn')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="dsn_user" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                    <input type="text"
                                           name="dsn_user"
                                           id="dsn_user"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           placeholder="Username..."
                                           value="{{ old('dsn_user') }}"
                                           required>
                                    @error('dsn_user')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="dsn_gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                    <select name="dsn_gend"
                                            id="dsn_gend"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                        <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('dsn_gend') == 'L' ? 'selected' : '' }}>Laki Laki</option>
                                        <option value="P" {{ old('dsn_gend') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('dsn_gend')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="dsn_birthplace" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                    <input type="text"
                                           name="dsn_birthplace"
                                           id="dsn_birthplace"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           placeholder="Tempat Lahir..."
                                           value="{{ old('dsn_birthplace') }}"
                                           required>
                                    @error('dsn_birthplace')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="dsn_birthdate" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <input type="date"
                                           name="dsn_birthdate"
                                           id="dsn_birthdate"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           value="{{ old('dsn_birthdate') }}"
                                           required>
                                    @error('dsn_birthdate')
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
                                    <label for="dsn_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor HandPhone</label>
                                    <input type="text"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           name="dsn_phone"
                                           id="dsn_phone"
                                           placeholder="Nomor telepon..."
                                           value="{{ old('dsn_phone') }}"
                                           required>
                                    @error('dsn_phone')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="dsn_mail" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                                    <input type="email"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                           name="dsn_mail"
                                           id="dsn_mail"
                                           placeholder="Alamat email..."
                                           value="{{ old('dsn_mail') }}"
                                           required>
                                    @error('dsn_mail')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex justify-between mt-6">
                                <button type="button"
                                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors prev-tab"
                                        data-prev-tab="home-tab">
                                    <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                                </button>
                                <button type="button"
                                        class="px-4 py-2 bg-[#0C6E71] text-white rounded-md hover:bg-[#0a5c5e] transition-colors next-tab"
                                        data-next-tab="profile-tab">
                                    Selanjutnya <i class="fa-solid fa-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tab Pengaturan Akun -->
                        <div class="tab-pane hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="dsn_stat" class="block text-sm font-medium text-gray-700 mb-1">Status Member</label>
                                    <select name="dsn_stat"
                                            id="dsn_stat"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            required>
                                        <option value="0" {{ old('dsn_stat') == '0' ? 'selected' : '' }}>Non-Active</option>
                                        <option value="1" {{ old('dsn_stat') == '1' ? 'selected' : '' }}>Active</option>
                                    </select>
                                    @error('dsn_stat')
                                        <small class="text-red-500 text-xs">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4 hidden">
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type Users</label>
                                    <select name="type"
                                            id="type"
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
        document.getElementById("dsn_image").addEventListener("change", function(event) {
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
