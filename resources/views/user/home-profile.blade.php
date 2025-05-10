@extends('base.base-dash-index')
@section('title')
    SIAKAD PT - Internal Developer
@endsection
@section('menu')
    Profile
@endsection
@section('submenu')
    Edit Profile
@endsection
@section('urlmenu')
    {{ route($prefix . 'home-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengubah profile pengguna
@endsection
@section('content')
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-[#0C6E71] px-4 py-3">
                    <h4 class="text-white font-semibold">Ubah Foto Profile</h4>
                </div>
                <div class="p-4">
                    <form action="{{ route($prefix . 'home-profile-save-image') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <img src="{{ asset('storage/images/' . Auth::user()->image) }}" class="w-full h-auto rounded-lg mb-4"
                            alt="Profile Image">
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
                                    id="home-tab" data-tab-target="#home" type="button" role="tab">Personal</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 font-medium"
                                    id="contact-tab" data-tab-target="#contact" type="button"
                                    role="tab">Kontak</button>
                            </li>
                            <li class="mr-2" role="presentation">
                                <button
                                    class="inline-block p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 font-medium"
                                    id="profile-tab" data-tab-target="#profile" type="button"
                                    role="tab">Security</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content pt-4" id="myTabContent">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <form action="{{ route($prefix . 'home-profile-save-data') }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap</label>
                                        <input type="text" name="name" id="name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama lengkap..." value="{{ Auth::user()->name }}">
                                        @error('name')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="user"
                                            class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input type="text" name="user" id="user"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Username..." value="{{ Auth::user()->user }}">
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
                                            <option value="L" {{ Auth::user()->gend === 'L' ? 'selected' : '' }}>Laki
                                                Laki</option>
                                            <option value="P" {{ Auth::user()->gend === 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
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
                                            placeholder="Tempat Lahir..." value="{{ Auth::user()->birth_place }}">
                                        @error('birth_place')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="birth_date"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="birth_date" id="birth_date"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Tanggal Lahir..." value="{{ Auth::user()->birth_date }}">
                                        @error('birth_date')
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
                        <div class="tab-pane hidden" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <form action="{{ route($prefix . 'home-profile-save-kontak') }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                            HandPhone</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed"
                                            name="phone" id="phone" value="{{ Auth::user()->phone }}" disabled>
                                        @error('phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            Email</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed"
                                            name="email" id="email" value="{{ Auth::user()->email }}" disabled>
                                        @error('email')
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
                        <div class="tab-pane hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <form action="{{ route($prefix . 'home-profile-save-password') }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="SecurityKey"
                                            class="block text-sm font-medium text-gray-700 mb-1">Security Key</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed"
                                                name="code" id="SecurityKey" value="{{ Auth::user()->code }}"
                                                disabled>
                                            <button type="button"
                                                class="px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors show-password">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('code')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="oldPassword"
                                            class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                                name="old_password" id="oldPassword"
                                                placeholder="Inputkan password lama...">
                                            <button type="button"
                                                class="px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors show-password">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('old_password')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="newPassword"
                                            class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                                name="new_password" id="newPassword"
                                                placeholder="Inputkan password baru...">
                                            <button type="button"
                                                class="px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors show-password">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('new_password')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="newPasswordKonfirm"
                                            class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password
                                            Baru</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                                name="new_password_confirmed" id="newPasswordKonfirm"
                                                placeholder="Konfirmasi password baru...">
                                            <button type="button"
                                                class="px-3 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-500 hover:text-white transition-colors show-password">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </div>
                                        @error('new_password_confirmed')
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
                var output = document.querySelector('.card-img-top');
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
