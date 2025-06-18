@extends('base.base-dash-index')
@section('title')
    Edit Profil Dosen - SIAKAD PT
@endsection
@section('menu')
    Profil
@endsection
@section('submenu')
    Edit Profil
@endsection
@section('urlmenu')
    {{ route('web-admin.home-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengubah profile pengguna
@endsection

@section('content')
    <section class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Profil Dosen</h1>
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2">
                            <li class="inline-flex items-center">
                                <a href="{{ route('web-admin.home-index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-[#0C6E71]">
                                    <i class="fas fa-home mr-2"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                                    <span class="ml-2 text-sm font-medium text-gray-500">Edit Profil</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('dosen.home-profile') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Photo Upload Section -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <div class="bg-[#0C6E71] p-4">
                            <h2 class="text-lg font-semibold text-white">Foto Profil</h2>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('dosen.home-profile-save-image') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                @method('PATCH')

                                <div class="flex flex-col items-center">
                                    <div class="relative w-40 h-40 rounded-full overflow-hidden border-4 border-gray-100 shadow-md mb-4">
                                        <img id="profileImagePreview" src="{{ asset('storage/images/' . Auth::guard('dosen')->user()->dsn_image) }}" 
                                            alt="Profile Photo" class="w-full h-full object-cover"
                                            onerror="this.src='{{ asset('assets/default-profile.png') }}'">
                                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 hover:opacity-100 transition">
                                            <span class="text-white text-sm font-medium">Ubah Foto</span>
                                        </div>
                                    </div>

                                    <div class="w-full space-y-2">
                                        <label for="dsn_image" class="block text-sm font-medium text-gray-700">
                                            Upload Foto Baru
                                            <span class="text-xs text-gray-500">(Max 2MB, Format: JPG/PNG)</span>
                                        </label>
                                        <div class="flex items-center gap-2">
                                            <label class="flex-1">
                                                <input type="file" name="dsn_image" id="dsn_image" accept="image/jpeg,image/png"
                                                    class="hidden" onchange="previewImage(this)">
                                                <div class="w-full px-4 py-2 border border-gray-300 rounded-lg cursor-pointer bg-white hover:bg-gray-50 transition flex items-center justify-between">
                                                    <span class="truncate text-sm" id="fileName">Pilih file</span>
                                                    <i class="fas fa-cloud-upload-alt text-gray-400 ml-2"></i>
                                                </div>
                                            </label>
                                            <button type="submit" class="p-2 rounded-lg bg-[#0C6E71] text-white hover:bg-[#0a5c5e] transition">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                        @error('dsn_image')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                            
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Informasi Akun</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Status Akun</span>
                                        <span class="text-sm font-medium {{ Auth::guard('dosen')->user()->dsn_status === 'Aktif' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ Auth::guard('dosen')->user()->dsn_status }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Terdaftar Pada</span>
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ \Carbon\Carbon::parse(Auth::guard('dosen')->user()->created_at)->format('d M Y') }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Terakhir Diperbarui</span>
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ \Carbon\Carbon::parse(Auth::guard('dosen')->user()->updated_at)->format('d M Y H:i') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Section -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
                        <!-- Tab Navigation -->
                        <div class="border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px" id="profileTabs" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button class="inline-flex items-center p-4 border-b-2 rounded-t-lg border-[#0C6E71] text-[#0C6E71] group"
                                        id="personal-tab" data-tabs-target="#personal" type="button" role="tab"
                                        aria-controls="personal" aria-selected="true">
                                        <i class="fas fa-user-circle mr-2"></i>
                                        Data Pribadi
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-flex items-center p-4 border-b-2 rounded-t-lg border-transparent hover:text-gray-600 hover:border-gray-300 group"
                                        id="contact-tab" data-tabs-target="#contact" type="button" role="tab"
                                        aria-controls="contact" aria-selected="false">
                                        <i class="fas fa-address-book mr-2"></i>
                                        Kontak
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button class="inline-flex items-center p-4 border-b-2 rounded-t-lg border-transparent hover:text-gray-600 hover:border-gray-300 group"
                                        id="security-tab" data-tabs-target="#security" type="button" role="tab"
                                        aria-controls="security" aria-selected="false">
                                        <i class="fas fa-lock mr-2"></i>
                                        Keamanan
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div>
                            <!-- Personal Tab -->
                            <div id="personal" class="tab-content p-6">
                                <form action="{{ route('dosen.home-profile-save-data') }}" method="POST" id="personalDataForm">
                                    @method('PATCH')
                                    @csrf

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Nama Lengkap -->
                                        <div>
                                            <label for="dsn_name" class="block text-sm font-medium text-gray-700 mb-1">
                                                Nama Lengkap <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-user text-gray-400"></i>
                                                </div>
                                                <input type="text" name="dsn_name" id="dsn_name"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5"
                                                    value="{{ old('dsn_name', Auth::guard('dosen')->user()->dsn_name) }}"
                                                    placeholder="Masukkan nama lengkap" required>
                                            </div>
                                            @error('dsn_name')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- NIDN -->
                                        <div>
                                            <label for="dsn_nidn" class="block text-sm font-medium text-gray-700 mb-1">
                                                Nomor NIDN <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-id-card text-gray-400"></i>
                                                </div>
                                                <input type="text" name="dsn_nidn" id="dsn_nidn"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5"
                                                    value="{{ old('dsn_nidn', Auth::guard('dosen')->user()->dsn_nidn) }}"
                                                    placeholder="Masukkan NIDN" required>
                                            </div>
                                            @error('dsn_nidn')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Jenis Kelamin -->
                                        <div>
                                            <label for="dsn_gend" class="block text-sm font-medium text-gray-700 mb-1">
                                                Jenis Kelamin <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-venus-mars text-gray-400"></i>
                                                </div>
                                                <select name="dsn_gend" id="dsn_gend"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5 appearance-none"
                                                    required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="L" {{ old('dsn_gend', Auth::guard('dosen')->user()->dsn_gend) === 'L' ? 'selected' : '' }}>
                                                        Laki-laki
                                                    </option>
                                                    <option value="P" {{ old('dsn_gend', Auth::guard('dosen')->user()->dsn_gend) === 'P' ? 'selected' : '' }}>
                                                        Perempuan
                                                    </option>
                                                </select>
                                            </div>
                                            @error('dsn_gend')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Tempat Lahir -->
                                        <div>
                                            <label for="dsn_birthplace" class="block text-sm font-medium text-gray-700 mb-1">
                                                Tempat Lahir <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-map-marker-alt text-gray-400"></i>
                                                </div>
                                                <input type="text" name="dsn_birthplace" id="dsn_birthplace"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5"
                                                    value="{{ old('dsn_birthplace', Auth::guard('dosen')->user()->dsn_birthplace) }}"
                                                    placeholder="Masukkan tempat lahir" required>
                                            </div>
                                            @error('dsn_birthplace')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Tanggal Lahir -->
                                        <div>
                                            <label for="dsn_birthdate" class="block text-sm font-medium text-gray-700 mb-1">
                                                Tanggal Lahir <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                                </div>
                                                <input type="date" name="dsn_birthdate" id="dsn_birthdate"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5"
                                                    value="{{ old('dsn_birthdate', Auth::guard('dosen')->user()->dsn_birthdate) }}"
                                                    required>
                                            </div>
                                            @error('dsn_birthdate')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="flex justify-end mt-6 pt-6 border-t border-gray-200">
                                        <button type="reset" class="mr-4 px-6 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                            <i class="fas fa-undo mr-2"></i> Reset
                                        </button>
                                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-[#0C6E71] rounded-lg hover:bg-[#0a5c5e] transition">
                                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Contact Tab -->
                            <div class="hidden p-6" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <form action="{{ route('dosen.home-profile-save-kontak') }}" method="POST">
                                    @method('PATCH')
                                    @csrf

                                    <div class="grid grid-cols-1 gap-6 mb-6">
                                        <!-- Phone Number -->
                                        <div>
                                            <label for="dsn_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                                Nomor Handphone
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-phone text-gray-400"></i>
                                                </div>
                                                <input type="text" name="dsn_phone" id="dsn_phone"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5"
                                                    value="{{ old('dsn_phone', Auth::guard('dosen')->user()->dsn_phone) }}"
                                                    placeholder="Masukkan nomor handphone">
                                            </div>
                                            @error('dsn_phone')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label for="dsn_mail" class="block text-sm font-medium text-gray-700 mb-1">
                                                Alamat Email <span class="text-xs text-gray-500">(Tidak dapat diubah)</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-envelope text-gray-400"></i>
                                                </div>
                                                <input type="email" name="dsn_mail" id="dsn_mail" readonly
                                                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5 cursor-not-allowed"
                                                    value="{{ Auth::guard('dosen')->user()->dsn_mail }}">
                                            </div>
                                            @error('dsn_mail')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="flex justify-end pt-6 border-t border-gray-200">
                                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-[#0C6E71] rounded-lg hover:bg-[#0a5c5e] transition">
                                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Security Tab -->
                            <div class="hidden p-6" id="security" role="tabpanel" aria-labelledby="security-tab">
                                <form action="{{ route('dosen.home-profile-save-password') }}" method="POST">
                                    @method('PATCH')
                                    @csrf

                                    <div class="grid grid-cols-1 gap-6 mb-6">
                                        <!-- Security Key -->
                                        <div>
                                            <label for="SecurityKey" class="block text-sm font-medium text-gray-700 mb-1">
                                                Security Key <span class="text-xs text-gray-500">(Tidak dapat diubah)</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-key text-gray-400"></i>
                                                </div>
                                                <input type="password" name="dsn_code" id="SecurityKey" readonly
                                                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5 pr-10 cursor-not-allowed"
                                                    value="{{ Auth::guard('dosen')->user()->dsn_code }}">
                                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password" data-target="SecurityKey">
                                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                                                </button>
                                            </div>
                                            @error('dsn_code')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Old Password -->
                                        <div>
                                            <label for="oldPassword" class="block text-sm font-medium text-gray-700 mb-1">
                                                Password Lama <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-lock text-gray-400"></i>
                                                </div>
                                                <input type="password" name="old_password" id="oldPassword"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5 pr-10"
                                                    placeholder="Masukkan password lama" required>
                                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password" data-target="oldPassword">
                                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                                                </button>
                                            </div>
                                            @error('old_password')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- New Password -->
                                        <div>
                                            <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-1">
                                                Password Baru <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-lock text-gray-400"></i>
                                                </div>
                                                <input type="password" name="new_password" id="newPassword"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5 pr-10"
                                                    placeholder="Masukkan password baru" required>
                                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password" data-target="newPassword">
                                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                                                </button>
                                            </div>
                                            <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter, mengandung huruf besar, kecil, dan angka</p>
                                            @error('new_password')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Confirm New Password -->
                                        <div>
                                            <label for="newPasswordKonfirm" class="block text-sm font-medium text-gray-700 mb-1">
                                                Konfirmasi Password Baru <span class="text-red-500">*</span>
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <i class="fas fa-lock text-gray-400"></i>
                                                </div>
                                                <input type="password" name="new_password_confirmed" id="newPasswordKonfirm"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#0C6E71] focus:border-[#0C6E71] block w-full pl-10 p-2.5 pr-10"
                                                    placeholder="Konfirmasi password baru" required>
                                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3 toggle-password" data-target="newPasswordKonfirm">
                                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600 cursor-pointer"></i>
                                                </button>
                                            </div>
                                            @error('new_password_confirmed')
                                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="flex justify-end pt-6 border-t border-gray-200">
                                        <button type="submit" class="px-6 py-2 text-sm font-medium text-white bg-[#0C6E71] rounded-lg hover:bg-[#0a5c5e] transition">
                                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabs = document.querySelectorAll('[data-tabs-target]');
            const tabContents = document.querySelectorAll('[role="tabpanel"]');

            // Function to switch tabs
            function switchTab(tab) {
                // Hide all tab contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Remove active styles from all tabs
                tabs.forEach(t => {
                    t.classList.remove('border-[#0C6E71]', 'text-[#0C6E71]');
                    t.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                });

                // Show selected tab content
                const target = document.querySelector(tab.getAttribute('data-tabs-target'));
                target.classList.remove('hidden');

                // Add active styles to selected tab
                tab.classList.add('border-[#0C6E71]', 'text-[#0C6E71]');
                tab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
            }

            // Initialize first tab as active
            if (tabs.length > 0) {
                switchTab(tabs[0]);
            }

            // Add click event listeners to tabs
            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    switchTab(tab);
                });
            });

            // Toggle password visibility
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

            // Image preview functionality
            window.previewImage = function(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    const fileNameElement = document.getElementById('fileName');
                    
                    // Update file name display
                    fileNameElement.textContent = input.files[0].name;
                    
                    // Update image preview
                    reader.onload = function(e) {
                        document.getElementById('profileImagePreview').src = e.target.result;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            };

            // Add hover effect to profile image
            const profileImageContainer = document.querySelector('.relative.w-40.h-40');
            if (profileImageContainer) {
                profileImageContainer.addEventListener('mouseenter', function() {
                    this.querySelector('div').classList.remove('opacity-0');
                });
                
                profileImageContainer.addEventListener('mouseleave', function() {
                    this.querySelector('div').classList.add('opacity-0');
                });
                
                // Click to trigger file input
                profileImageContainer.addEventListener('click', function() {
                    document.getElementById('dsn_image').click();
                });
            }
        });
    </script>
@endpush