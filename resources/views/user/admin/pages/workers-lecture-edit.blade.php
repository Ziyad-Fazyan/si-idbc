@extends('base.base-dash-index')
@section('title')
    Data Pengguna Dosen - Siakad By Internal Developer
@endsection
@section('menu')
    Data Pengguna Dosen
@endsection
@section('submenu')
    Edit {{ $dosen->dsn_name }}
@endsection
@section('urlmenu')
    {{ route('web-admin.workers.lecture-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengubah data pengguna Dosen
@endsection
@section('content')
    <form action="{{ route('web-admin.workers.lecture-update', $dosen->dsn_code) }}" method="POST"
        enctype="multipart/form-data" class="w-full">
        @method('PATCH')
        @csrf

        <div class="flex flex-col lg:flex-row gap-4 w-full">
            <div class="w-full lg:w-1/3">

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-[#0C6E71] text-white px-4 py-3 flex items-center justify-between">
                        <h4 class="text-lg font-semibold">Ubah Foto Profile</h4>
                        <div class="flex gap-2">
                            <a href="@yield('urlmenu')"
                                class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded flex items-center gap-1">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit"
                                class="bg-[#0C6E71] hover:bg-[#0a5a5d] text-white px-3 py-1 rounded flex items-center gap-1">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <img src="{{ asset('storage/images/' . $dosen->dsn_image) }}" class="w-full h-auto rounded mb-4"
                            alt="">
                        <hr class="my-4">
                        <div class="mb-4">
                            <label for="dsn_image" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto
                                Profile</label>
                            <div class="flex items-center gap-2">
                                <input type="file"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                    name="dsn_image" id="dsn_image">
                                @error('dsn_image')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-2/3">

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-4">

                        <div class="border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px" id="myTab" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 border-[#0C6E71] text-[#0C6E71] font-medium active"
                                        id="home-tab" data-tab-target="#home" type="button"
                                        role="tab">Personal</button>
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
                                        role="tab">Keamanan</button>
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
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                            placeholder="Nama lengkap..." value="{{ $dosen->dsn_name }}">
                                        @error('dsn_name')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_nidn"
                                            class="block text-sm font-medium text-gray-700 mb-1">NIDN</label>
                                        <input type="text" name="dsn_nidn" id="dsn_nidn"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100"
                                            placeholder="Username..." readonly value="{{ $dosen->dsn_nidn }}">
                                        @error('dsn_nidn')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_user"
                                            class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input type="text" name="dsn_user" id="dsn_user"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                            placeholder="Username..." value="{{ $dosen->dsn_user }}">
                                        @error('dsn_user')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                            Kelamin</label>
                                        <select name="dsn_gend" id="dsn_gend"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="L" {{ $dosen->dsn_gend === 'L' ? 'selected' : '' }}>Laki
                                                Laki</option>
                                            <option value="P" {{ $dosen->dsn_gend === 'P' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('dsn_gend')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_birthplace"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                        <input type="text" name="dsn_birthplace" id="dsn_birthplace"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                            placeholder="Tempat Lahir..." value="{{ $dosen->dsn_birthplace }}">
                                        @error('dsn_birthplace')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_birthdate"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="dsn_birthdate" id="dsn_birthdate"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                            placeholder="Tanggal Lahir..." value="{{ $dosen->dsn_birthdate }}">
                                        @error('dsn_birthdate')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
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
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                            name="dsn_phone" id="dsn_phone" placeholder="Inputkan nomor telepon..."
                                            value="{{ $dosen->dsn_phone }}">
                                        @error('dsn_phone')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_mail" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            Email</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                            name="dsn_mail" id="dsn_mail" placeholder="Inputkan alamat email..."
                                            value="{{ $dosen->dsn_mail }}">
                                        @error('dsn_mail')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane hidden" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <hr class="my-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="SecurityKey"
                                            class="block text-sm font-medium text-gray-700 mb-1">Security Key</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100"
                                                name="dsn_code" id="SecurityKey" value="{{ $dosen->dsn_code }}"
                                                disabled>
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm flex items-center gap-1 show-password">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            @error('dsn_code')
                                                <small class="text-red-500 text-sm">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="dsn_stat" class="block text-sm font-medium text-gray-700 mb-1">Status
                                            Member</label>
                                        <select name="dsn_stat" id="dsn_stat"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]">
                                            <optgroup label="Pilih Status Users">
                                                <option value="0"
                                                    {{ $dosen->raw_dsn_stat == '0' ? 'selected' : '' }}>Non-Active</option>
                                                <option value="1"
                                                    {{ $dosen->raw_dsn_stat == '1' ? 'selected' : '' }}>Active</option>
                                            </optgroup>
                                        </select>
                                        @error('dsn_stat')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="hidden mb-4">
                                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type
                                            Users</label>
                                        <select name="type" id="type"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Role Users</option>
                                            <option value="0" {{ $dosen->dsn_raw_type === 0 ? 'selected' : '' }}>Web
                                                Administrator</option>
                                            <option value="1" {{ $dosen->dsn_raw_type === 1 ? 'selected' : '' }}>
                                                Koordinator Program</option>
                                            <option value="2" {{ $dosen->dsn_raw_type === 2 ? 'selected' : '' }}>
                                                Staff Administrasi</option>
                                            <option value="3" {{ $dosen->dsn_raw_type === 3 ? 'selected' : '' }}>
                                                Staff Akademik</option>
                                            <option value="4" {{ $dosen->dsn_raw_type === 4 ? 'selected' : '' }}>
                                                Staff Sarana dan Prasarana</option>
                                        </select>
                                        @error('type')
                                            <small class="text-red-500 text-sm">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="newPassword"
                                            class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                        <div class="flex items-center gap-2">
                                            <input type="password"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                                name="password" id="newPassword" placeholder="Inputkan password...">
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm flex items-center gap-1 show-password">
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
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71]"
                                                name="password_confirm" id="newPasswordKonfirm"
                                                placeholder="Inputkan konfirmasi password...">
                                            <button type="button"
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm flex items-center gap-1 show-password">
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
        </div>
    </form>
@endsection

@section('custom-js')
    <script>
        // Image preview
        document.getElementById("dsn_image").onchange = function(event) {
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
                const target = document.querySelector(tab.dataset.tabTarget);
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.add('hidden');
                });
                document.querySelectorAll('[data-tab-target]').forEach(t => {
                    t.classList.remove('border-[#0C6E71]', 'text-[#0C6E71]');
                    t.classList.add('border-transparent');
                });
                target.classList.remove('hidden');
                tab.classList.add('border-[#0C6E71]', 'text-[#0C6E71]');
                tab.classList.remove('border-transparent');
            });
        });

        // Show password functionality
        document.querySelectorAll('.show-password').forEach(button => {
            button.addEventListener('click', () => {
                const input = button.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    button.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
                } else {
                    input.type = 'password';
                    button.innerHTML = '<i class="fa-solid fa-eye"></i>';
                }
            });
        });
    </script>
@endsection
