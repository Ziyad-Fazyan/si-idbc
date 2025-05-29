@extends('base.base-dash-index')
@section('title')
    Edit Karyawan - {{ $admin->name }}
@endsection
@section('menu')
    Data Pengguna Karyawan
@endsection
@section('submenu')
    Edit {{ $admin->name }}
@endsection
@section('urlmenu')
    {{ route('web-admin.workers.staff-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengedit data pengguna {{ $admin->name }}
@endsection
@section('content')
    <div class="max-w-7xl mx-auto">
        <form action="{{ route('web-admin.workers.staff-update', $admin->code) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @method('PATCH')
            @csrf

            <!-- Header Actions -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Edit Karyawan</h1>
                    <p class="text-sm text-gray-600 mt-1">Update informasi karyawan {{ $admin->name }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="@yield('urlmenu')"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Profile Image Section -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Foto Profil</h3>

                            <!-- Image Preview -->
                            <div class="relative mb-6">
                                <img src="{{ asset('storage/images/' . $admin->image) }}"
                                     class="w-full aspect-square object-cover rounded-xl border-2 border-gray-100"
                                     alt="{{ $admin->name }}'s profile"
                                     id="imagePreview">
                                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-10 transition-all duration-200 rounded-xl"></div>
                            </div>

                            <!-- File Upload -->
                            <div class="space-y-2">
                                <label for="image" class="block text-sm font-medium text-gray-700">
                                    Upload Foto Baru
                                </label>
                                <div class="relative">
                                    <input type="file"
                                           name="image"
                                           id="image"
                                           accept="image/*"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                                </div>
                                @error('image')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Content -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div x-data="{ activeTab: 'personal' }" class="min-h-full">
                            <!-- Tab Navigation -->
                            <div class="border-b border-gray-200 px-6">
                                <nav class="flex space-x-8">
                                    <button type="button"
                                            @click="activeTab = 'personal'"
                                            :class="activeTab === 'personal' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                            class="py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        Personal
                                    </button>
                                    <button type="button"
                                            @click="activeTab = 'contact'"
                                            :class="activeTab === 'contact' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                            class="py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        Kontak
                                    </button>
                                    <button type="button"
                                            @click="activeTab = 'security'"
                                            :class="activeTab === 'security' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                            class="py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                        </svg>
                                        Keamanan
                                    </button>
                                </nav>
                            </div>

                            <!-- Tab Content -->
                            <div class="p-6">
                                <!-- Personal Tab -->
                                <div x-show="activeTab === 'personal'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="form-group">
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Lengkap
                                            </label>
                                            <input type="text"
                                                   name="name"
                                                   id="name"
                                                   value="{{ $admin->name }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan nama lengkap">
                                            @error('name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="user" class="block text-sm font-medium text-gray-700 mb-2">
                                                Username
                                            </label>
                                            <input type="text"
                                                   name="user"
                                                   id="user"
                                                   value="{{ $admin->user }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan username">
                                            @error('user')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="gend" class="block text-sm font-medium text-gray-700 mb-2">
                                                Jenis Kelamin
                                            </label>
                                            <select name="gend"
                                                    id="gend"
                                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L" {{ $admin->gend === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ $admin->gend === 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('gend')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="birth_place" class="block text-sm font-medium text-gray-700 mb-2">
                                                Tempat Lahir
                                            </label>
                                            <input type="text"
                                                   name="birth_place"
                                                   id="birth_place"
                                                   value="{{ $admin->birth_place }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan tempat lahir">
                                            @error('birth_place')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                                                Tanggal Lahir
                                            </label>
                                            <input type="date"
                                                   name="birth_date"
                                                   id="birth_date"
                                                   value="{{ $admin->birth_date }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            @error('birth_date')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="reli" class="block text-sm font-medium text-gray-700 mb-2">
                                                Agama
                                            </label>
                                            <select name="reli"
                                                    id="reli"
                                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Pilih Agama</option>
                                                <option value="1" {{ $admin->raw_reli === '1' ? 'selected' : '' }}>Islam</option>
                                                <option value="2" {{ $admin->raw_reli === '2' ? 'selected' : '' }}>Kristen Protestan</option>
                                                <option value="3" {{ $admin->raw_reli === '3' ? 'selected' : '' }}>Kristen Katolik</option>
                                                <option value="4" {{ $admin->raw_reli === '4' ? 'selected' : '' }}>Hindu</option>
                                                <option value="5" {{ $admin->raw_reli === '5' ? 'selected' : '' }}>Buddha</option>
                                                <option value="6" {{ $admin->raw_reli === '6' ? 'selected' : '' }}>Konghuchu</option>
                                            </select>
                                            @error('reli')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Tab -->
                                <div x-show="activeTab === 'contact'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="form-group">
                                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nomor HandPhone
                                            </label>
                                            <input type="tel"
                                                   name="phone"
                                                   id="phone"
                                                   value="{{ $admin->phone }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan nomor telepon">
                                            @error('phone')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                                Alamat Email
                                            </label>
                                            <input type="email"
                                                   name="email"
                                                   id="email"
                                                   value="{{ $admin->email }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan alamat email">
                                            @error('email')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="contact_name_1" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Kontak Darurat 1
                                            </label>
                                            <input type="text"
                                                   name="contact_name_1"
                                                   id="contact_name_1"
                                                   value="{{ $admin->contact_name_1 }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan nama kontak">
                                            @error('contact_name_1')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="contact_phone_1" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nomor Kontak Darurat 1
                                            </label>
                                            <input type="tel"
                                                   name="contact_phone_1"
                                                   id="contact_phone_1"
                                                   value="{{ $admin->contact_phone_1 }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan nomor telepon">
                                            @error('contact_phone_1')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="contact_name_2" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Kontak Darurat 2
                                            </label>
                                            <input type="text"
                                                   name="contact_name_2"
                                                   id="contact_name_2"
                                                   value="{{ $admin->contact_name_2 }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan nama kontak">
                                            @error('contact_name_2')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="contact_phone_2" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nomor Kontak Darurat 2
                                            </label>
                                            <input type="tel"
                                                   name="contact_phone_2"
                                                   id="contact_phone_2"
                                                   value="{{ $admin->contact_phone_2 }}"
                                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                   placeholder="Masukkan nomor telepon">
                                            @error('contact_phone_2')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Tab -->
                                <div x-show="activeTab === 'security'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="form-group">
                                            <label for="SecurityKey" class="block text-sm font-medium text-gray-700 mb-2">
                                                Security Key
                                            </label>
                                            <div class="relative">
                                                <input type="password"
                                                       name="code"
                                                       id="SecurityKey"
                                                       value="{{ $admin->code }}"
                                                       disabled
                                                       class="block w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg shadow-sm bg-gray-50 text-gray-500 sm:text-sm">
                                                <button type="button"
                                                        class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password"
                                                        data-target="SecurityKey">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                                Role Pengguna
                                            </label>
                                            <select name="type"
                                                    id="type"
                                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="">Pilih Role</option>
                                                <option value="0" {{ $admin->raw_type === 0 ? 'selected' : '' }}>Web Administrator</option>
                                                <option value="1" {{ $admin->raw_type === 1 ? 'selected' : '' }}>Staff Finance</option>
                                                <option value="2" {{ $admin->raw_type === 2 ? 'selected' : '' }}>Staff Absen</option>
                                                <option value="3" {{ $admin->raw_type === 3 ? 'selected' : '' }}>Staff Akademik</option>
                                                <option value="4" {{ $admin->raw_type === 4 ? 'selected' : '' }}>Staff Mutabaah</option>
                                                <option value="5" {{ $admin->raw_type === 5 ? 'selected' : '' }}>Staff Sarana dan Prasarana</option>
                                                <option value="6" {{ $admin->raw_type === 6 ? 'selected' : '' }}>Staff Site Manager</option>
                                            </select>
                                            @error('type')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                                Status Akun
                                            </label>
                                            <select name="status"
                                                    id="status"
                                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                <option value="0" {{ $admin->status == '0' ? 'selected' : '' }}>Non-Aktif</option>
                                                <option value="1" {{ $admin->status == '1' ? 'selected' : '' }}>Aktif</option>
                                            </select>
                                            @error('status')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="newPassword" class="block text-sm font-medium text-gray-700 mb-2">
                                                Password Baru
                                            </label>
                                            <div class="relative">
                                                <input type="password"
                                                       name="password"
                                                       id="newPassword"
                                                       class="block w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                       placeholder="Kosongkan jika tidak ingin mengubah">
                                                <button type="button"
                                                        class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password"
                                                        data-target="newPassword">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            @error('password')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="newPasswordKonfirm" class="block text-sm font-medium text-gray-700 mb-2">
                                                Konfirmasi Password
                                            </label>
                                            <div class="relative">
                                                <input type="password"
                                                       name="password_confirm"
                                                       id="newPasswordKonfirm"
                                                       class="block w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                                       placeholder="Konfirmasi password baru">
                                                <button type="button"
                                                        class="absolute inset-y-0 right-0 pr-3 flex items-center toggle-password"
                                                        data-target="newPasswordKonfirm">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                            @error('password_confirm')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
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
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    if (imageInput) {
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Password visibility toggle
    const toggleButtons = document.querySelectorAll('.toggle-password');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const passwordInput = document.getElementById(targetId);
            const icon = this.querySelector('svg');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                `;
            } else {
                passwordInput.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        });
    });
});
</script>
@endpush
