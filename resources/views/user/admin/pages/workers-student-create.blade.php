@extends('base.base-dash-index')
@section('title')
    Data Pengguna Mahasiswa - SIAKAD PT - Internal Developer
@endsection
@section('menu')
    Data Pengguna Mahasiswa
@endsection
@section('submenu')
    Tambah Data
@endsection
@section('urlmenu')
    {{ route($prefix . 'workers.student-index') }}
@endsection
@section('subdesc')
    Halaman untuk menambah data Mahasiswa baru
@endsection
@section('content')
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-[#0C6E71] px-4 py-3">
                    <h4 class="text-white font-semibold">Ubah Foto Profile</h4>
                </div>
                <div class="p-4">
                    <form action="{{ route($prefix . 'workers.student-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <img id="profile-preview" src="{{ asset('storage/images/default/default-profile.jpg') }}" 
                            class="w-full h-auto rounded-lg mb-4" alt="Profile Picture">
                        <hr class="my-4 border-gray-200">
                        <div class="mb-4">
                            <label for="mhs_image" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto
                                Profile</label>
                            <div class="flex items-center gap-2">
                                <input type="file"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#0C6E71] file:text-white hover:file:bg-[#0a5c5e]"
                                    name="mhs_image" id="mhs_image">
                                <button type="submit"
                                    class="px-4 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors">
                                    <i class="fa-solid fa-paper-plane"></i>
                                </button>
                            </div>
                            @error('mhs_image')
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
                            <form action="{{ route($prefix . 'workers.student-store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="mhs_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap</label>
                                        <input type="text" name="mhs_name" id="mhs_name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama lengkap...">
                                        @error('mhs_name')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_nim" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                            NIM</label>
                                        <input type="text" name="mhs_nim" id="mhs_nim"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor NIM...">
                                        @error('mhs_nim')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="class_id"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                        <select name="class_id" id="class_id"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_gend" class="block text-sm font-medium text-gray-700 mb-1">Jenis
                                            Kelamin</label>
                                        <select name="mhs_gend" id="mhs_gend"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Jenis Kelamin</option>
                                            <option value="L">Laki Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        @error('mhs_gend')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_birthplace"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                                        <input type="text" name="mhs_birthplace" id="mhs_birthplace"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Tempat Lahir...">
                                        @error('mhs_birthplace')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_birthdate"
                                            class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                        <input type="date" name="mhs_birthdate" id="mhs_birthdate"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Tanggal Lahir...">
                                        @error('mhs_birthdate')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_reli"
                                            class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                        <select name="mhs_reli" id="mhs_reli"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Agama</option>
                                            <option value="1">Agama Islam</option>
                                            <option value="2">Agama Kristen Protestan</option>
                                            <option value="3">Agama Kriten Katholik</option>
                                            <option value="4">Agama Hindu</option>
                                            <option value="5">Agama Buddha</option>
                                            <option value="6">Agama Konghuchu</option>
                                        </select>
                                        @error('mhs_reli')
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
                            <form action="{{ route($prefix . 'workers.student-store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="mhs_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                            HandPhone</label>
                                        <input type="text" name="mhs_phone" id="mhs_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor handphone...">
                                        @error('mhs_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_mail" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            Email</label>
                                        <input type="email" name="mhs_mail" id="mhs_mail"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Email...">
                                        @error('mhs_mail')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_parent_father"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                                        <input type="text" name="mhs_parent_father" id="mhs_parent_father"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama ayah...">
                                        @error('mhs_parent_father')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_parent_father_phone"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ayah</label>
                                        <input type="text" name="mhs_parent_father_phone" id="mhs_parent_father_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor telepon ayah...">
                                        @error('mhs_parent_father_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_parent_mother"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                                        <input type="text" name="mhs_parent_mother" id="mhs_parent_mother"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama ibu...">
                                        @error('mhs_parent_mother')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_parent_mother_phone"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Ibu</label>
                                        <input type="text" name="mhs_parent_mother_phone" id="mhs_parent_mother_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor telepon ibu...">
                                        @error('mhs_parent_mother_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_wali_name"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nama Wali
                                            Mahasiswa</label>
                                        <input type="text" name="mhs_wali_name" id="mhs_wali_name"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama wali...">
                                        @error('mhs_wali_name')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_wali_phone"
                                            class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon Wali</label>
                                        <input type="text" name="mhs_wali_phone" id="mhs_wali_phone"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nomor telepon wali...">
                                        @error('mhs_wali_phone')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4 md:col-span-2">
                                        <label for="mhs_addr_domisili"
                                            class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap Domisili /
                                            Tempat Tinggal</label>
                                        <textarea name="mhs_addr_domisili" id="mhs_addr_domisili" rows="4"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Alamat lengkap domisili / tempat tinggal..."></textarea>
                                        @error('mhs_addr_domisili')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_addr_kelurahan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kelurahan</label>
                                        <input type="text" name="mhs_addr_kelurahan" id="mhs_addr_kelurahan"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama kelurahan...">
                                        @error('mhs_addr_kelurahan')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_addr_kecamatan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                        <input type="text" name="mhs_addr_kecamatan" id="mhs_addr_kecamatan"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama kecamatan...">
                                        @error('mhs_addr_kecamatan')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_addr_kota"
                                            class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                                        <input type="text" name="mhs_addr_kota" id="mhs_addr_kota"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama kota...">
                                        @error('mhs_addr_kota')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_addr_provinsi"
                                            class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                        <input type="text" name="mhs_addr_provinsi" id="mhs_addr_provinsi"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Nama provinsi...">
                                        @error('mhs_addr_provinsi')
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
                            <form action="{{ route($prefix . 'workers.student-store') }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-4">
                                        <label for="mhs_user"
                                            class="block text-sm font-medium text-gray-700 mb-1">Username Mahasiswa</label>
                                        <input type="text" name="mhs_user" id="mhs_user"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]"
                                            placeholder="Username...">
                                        @error('mhs_user')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_stat" class="block text-sm font-medium text-gray-700 mb-1">Pilih
                                            Status Mahasiswa</label>
                                        <select name="mhs_stat" id="mhs_stat"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71]">
                                            <option value="" selected>Pilih Status Mahasiswa</option>
                                            <option value="0">Calon Mahasiswa</option>
                                            <option value="1">Mahasiswa Aktif</option>
                                            <option value="2">Mahasiswa Non-Aktif</option>
                                            <option value="3">Mahasiswa Alumni</option>
                                        </select>
                                        @error('mhs_stat')
                                            <small class="text-red-500 text-xs">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="newPassword"
                                            class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                        <div class="relative">
                                            <input type="password" name="new_password" id="newPassword"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] pr-10"
                                                placeholder="Password baru...">
                                            <button type="button"
                                                class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-[#FF6B35] hover:text-[#E85A2A] transition-colors"
                                                data-target="newPassword">
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
                                        <div class="relative">
                                            <input type="password" name="new_password_confirmed" id="newPasswordKonfirm"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-[#0C6E71] pr-10"
                                                placeholder="Konfirmasi password baru...">
                                            <button type="button"
                                                class="toggle-password absolute inset-y-0 right-0 px-3 flex items-center text-[#FF6B35] hover:text-[#E85A2A] transition-colors"
                                                data-target="newPasswordKonfirm">
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
        document.getElementById("mhs_image").onchange = function(event) {
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