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
    {{ route('web-admin.home-index') }}
@endsection
@section('subdesc')
    Halaman untuk mengubah profile pengguna
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] py-8 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto">
            <h1 class="text-2xl font-bold text-[#2E2E2E] mb-6">Profile Mahasiswa</h1>

            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Photo Upload Section -->
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-[#0C6E71] p-4">
                            <h2 class="text-lg font-semibold text-white">Ubah Foto Profile</h2>
                        </div>
                        <div class="p-4">
                            <form action="{{ route('mahasiswa.home-profile-save-image') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="flex flex-col items-center mb-4">
                                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-[#E4E2DE] mb-4">
                                        <img src="{{ asset('storage/images/' . Auth::guard('mahasiswa')->user()->mhs_image) }}"
                                            alt="Profile Photo" class="w-full h-full object-cover"
                                            onerror="this.src='https://via.placeholder.com/150'">
                                    </div>

                                    <div class="w-full">
                                        <label for="mhs_image" class="block text-sm font-medium text-[#2E2E2E] mb-2">Upload
                                            Foto Profile</label>
                                        <div class="flex items-center gap-2">
                                            <input type="file" name="mhs_image" id="mhs_image"
                                                class="block w-full text-sm text-gray-500
                                                      file:mr-4 file:py-2 file:px-4
                                                      file:rounded-md file:border-0
                                                      file:text-sm file:font-semibold
                                                      file:bg-[#0C6E71] file:text-white
                                                      hover:file:bg-[#0C5A5D]">
                                            <button type="submit"
                                                class="p-2 rounded-md bg-[#FF6B35] text-white hover:bg-[#E05A2B] transition">
                                                <i class="fa-solid fa-paper-plane"></i>
                                            </button>
                                        </div>
                                        @error('mhs_image')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content Section -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Tab Navigation -->
                        <div class="border-b border-[#E4E2DE]">
                            <ul class="flex flex-wrap -mb-px" id="profileTabs" role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button class="inline-block p-4 border-b-2 rounded-t-lg active" id="personal-tab"
                                        data-tabs-target="#personal" type="button" role="tab" aria-controls="personal"
                                        aria-selected="true">
                                        Personal
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#2E2E2E] hover:border-[#E4E2DE]"
                                        id="contact-tab" data-tabs-target="#contact" type="button" role="tab"
                                        aria-controls="contact" aria-selected="false">
                                        Kontak
                                    </button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-[#2E2E2E] hover:border-[#E4E2DE]"
                                        id="security-tab" data-tabs-target="#security" type="button" role="tab"
                                        aria-controls="security" aria-selected="false">
                                        Security
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div class="p-4">
                            <!-- Personal Tab -->
                            <div class="hidden p-4 rounded-lg" id="personal" role="tabpanel"
                                aria-labelledby="personal-tab">
                                <form action="{{ route('mahasiswa.home-profile-save-data') }}" method="POST">
                                    @method('PATCH')
                                    @csrf

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                        <!-- Personal Information Fields -->
                                        <div class="space-y-4">
                                            <div>
                                                <label for="mhs_name"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nama
                                                    Lengkap</label>
                                                <input type="text" name="mhs_name" id="mhs_name"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-100"
                                                    readonly value="{{ Auth::guard('mahasiswa')->user()->mhs_name }}">
                                                @error('mhs_name')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="mhs_nim"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nomor NIM</label>
                                                <input type="text" name="mhs_nim" id="mhs_nim"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-100"
                                                    readonly value="{{ Auth::guard('mahasiswa')->user()->mhs_nim }}">
                                                @error('mhs_nim')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="year_id"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Tahun
                                                    Masuk</label>
                                                <input type="text" name="year_id" id="year_id"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-100"
                                                    readonly
                                                    value="Angkatan {{ Auth::guard('mahasiswa')->user()->kelas()->first()->taka->year_start }}">
                                                @error('year_id')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="faku_id"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Fakultas</label>
                                                <input type="text" name="faku_id" id="faku_id"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-100"
                                                    readonly
                                                    value="{{ Auth::guard('mahasiswa')->user()->kelas()->first()->pstudi->fakultas->name }}">
                                                @error('faku_id')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label for="program_studi"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Program
                                                    Studi</label>
                                                <div
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-100">
                                                    @foreach (Auth::guard('mahasiswa')->user()->kelas as $kelas)
                                                        <div class="mb-1">
                                                            {{ $kelas->pstudi->name . ' - ' . $kelas->taka->semester }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div>
                                                <label for="kelas_list"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Kelas</label>
                                                <div
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-100">
                                                    @foreach (Auth::guard('mahasiswa')->user()->kelas as $kelas)
                                                        <div class="mb-1">{{ $kelas->code }} / {{ $kelas->name }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div>
                                                <label for="mhs_gend"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Jenis
                                                    Kelamin</label>
                                                <select name="mhs_gend" id="mhs_gend"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md">
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="L"
                                                        {{ Auth::guard('mahasiswa')->user()->mhs_gend === 'L' ? 'selected' : '' }}>
                                                        Laki Laki</option>
                                                    <option value="P"
                                                        {{ Auth::guard('mahasiswa')->user()->mhs_gend === 'P' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                </select>
                                                @error('mhs_gend')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Additional Personal Information -->
                                        <div class="space-y-4">
                                            <div>
                                                <label for="mhs_birthplace"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Tempat
                                                    Lahir</label>
                                                <input type="text" name="mhs_birthplace" id="mhs_birthplace"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_birthplace : '' }}">
                                                @error('mhs_birthplace')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="mhs_birthdate"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Tanggal
                                                    Lahir</label>
                                                <input type="date" name="mhs_birthdate" id="mhs_birthdate"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_birthdate : '' }}">
                                                @error('mhs_birthdate')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label for="mhs_reli"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Agama</label>
                                                <select name="mhs_reli" id="mhs_reli"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md">
                                                    <option value="">Pilih Agama</option>
                                                    <option value="1"
                                                        {{ Auth::guard('mahasiswa')->user()->mahasiswaDetails->raw_mhs_reli === '1' ? 'selected' : '' }}>
                                                        Agama Islam</option>
                                                    <option value="2"
                                                        {{ Auth::guard('mahasiswa')->user()->mahasiswaDetails->raw_mhs_reli === '2' ? 'selected' : '' }}>
                                                        Agama Kristen Protestan</option>
                                                    <option value="3"
                                                        {{ Auth::guard('mahasiswa')->user()->mahasiswaDetails->raw_mhs_reli === '3' ? 'selected' : '' }}>
                                                        Agama Kriten Katholik</option>
                                                    <option value="4"
                                                        {{ Auth::guard('mahasiswa')->user()->mahasiswaDetails->raw_mhs_reli === '4' ? 'selected' : '' }}>
                                                        Agama Hindu</option>
                                                    <option value="5"
                                                        {{ Auth::guard('mahasiswa')->user()->mahasiswaDetails->raw_mhs_reli === '5' ? 'selected' : '' }}>
                                                        Agama Buddha</option>
                                                    <option value="6"
                                                        {{ Auth::guard('mahasiswa')->user()->mahasiswaDetails->raw_mhs_reli === '6' ? 'selected' : '' }}>
                                                        Agama Konghuchu</option>
                                                </select>
                                                @error('mhs_reli')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#FF6B35] text-white rounded-md hover:bg-[#E05A2B] transition">
                                            <i class="fa-solid fa-save mr-2"></i>Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Contact Tab -->
                            <div class="hidden p-4 rounded-lg" id="contact" role="tabpanel"
                                aria-labelledby="contact-tab">
                                <form action="{{ route('mahasiswa.home-profile-save-kontak') }}" method="POST">
                                    @method('PATCH')
                                    @csrf

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                        <!-- Contact Information -->
                                        <div class="space-y-4">
                                            <div>
                                                <label for="mhs_phone"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nomor
                                                    HandPhone</label>
                                                <input type="text" name="mhs_phone" id="mhs_phone"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mhs_phone }}">
                                                @error('mhs_phone')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="mhs_mail"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Alamat
                                                    Email</label>
                                                <input type="text" name="mhs_mail" id="mhs_mail"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-100"
                                                    readonly value="{{ Auth::guard('mahasiswa')->user()->mhs_mail }}">
                                                @error('mhs_mail')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Parent Information -->
                                        <div class="space-y-4">
                                            <div>
                                                <label for="mhs_parent_father"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nama Ayah</label>
                                                <input type="text" name="mhs_parent_father" id="mhs_parent_father"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_parent_father : '' }}">
                                                @error('mhs_parent_father')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="mhs_parent_father_phone"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nomor Telepon
                                                    Ayah</label>
                                                <input type="text" name="mhs_parent_father_phone"
                                                    id="mhs_parent_father_phone"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_parent_father_phone : '' }}">
                                                @error('mhs_parent_father_phone')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <label for="mhs_parent_mother"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nama Ibu</label>
                                                <input type="text" name="mhs_parent_mother" id="mhs_parent_mother"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_parent_mother : '' }}">
                                                @error('mhs_parent_mother')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="mhs_parent_mother_phone"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nomor Telepon
                                                    Ibu</label>
                                                <input type="text" name="mhs_parent_mother_phone"
                                                    id="mhs_parent_mother_phone"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_parent_mother_phone : '' }}">
                                                @error('mhs_parent_mother_phone')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Guardian Information -->
                                        <div class="space-y-4">
                                            <div>
                                                <label for="mhs_wali_name"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nama Wali
                                                    Mahasiswa</label>
                                                <input type="text" name="mhs_wali_name" id="mhs_wali_name"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_wali_name : '' }}">
                                                @error('mhs_wali_name')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="mhs_wali_phone"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Nomor Telepon
                                                    Wali</label>
                                                <input type="text" name="mhs_wali_phone" id="mhs_wali_phone"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                    value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_wali_phone : '' }}">
                                                @error('mhs_wali_phone')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Address Information -->
                                        <div class="md:col-span-2 space-y-4">
                                            <div>
                                                <label for="mhs_addr_domisili"
                                                    class="block text-sm font-medium text-[#2E2E2E] mb-1">Alamat Lengkap
                                                    Domisili</label>
                                                <textarea name="mhs_addr_domisili" id="mhs_addr_domisili" rows="3"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md">{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails && Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_addr_domisili ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_addr_domisili : 'inputkan alamat lengkap / domisili' }}</textarea>
                                                @error('mhs_addr_domisili')
                                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label for="mhs_addr_kelurahan"
                                                        class="block text-sm font-medium text-[#2E2E2E] mb-1">Kelurahan</label>
                                                    <input type="text" name="mhs_addr_kelurahan"
                                                        id="mhs_addr_kelurahan"
                                                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                        value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_addr_kelurahan : '' }}">
                                                    @error('mhs_addr_kelurahan')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label for="mhs_addr_kecamatan"
                                                        class="block text-sm font-medium text-[#2E2E2E] mb-1">Kecamatan</label>
                                                    <input type="text" name="mhs_addr_kecamatan"
                                                        id="mhs_addr_kecamatan"
                                                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                        value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_addr_kecamatan : '' }}">
                                                    @error('mhs_addr_kecamatan')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label for="mhs_addr_kota"
                                                        class="block text-sm font-medium text-[#2E2E2E] mb-1">Kota</label>
                                                    <input type="text" name="mhs_addr_kota" id="mhs_addr_kota"
                                                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                        value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_addr_kota : '' }}">
                                                    @error('mhs_addr_kota')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div>
                                                    <label for="mhs_addr_provinsi"
                                                        class="block text-sm font-medium text-[#2E2E2E] mb-1">Provinsi</label>
                                                    <input type="text" name="mhs_addr_provinsi" id="mhs_addr_provinsi"
                                                        class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md"
                                                        value="{{ Auth::guard('mahasiswa')->user()->mahasiswaDetails ? Auth::guard('mahasiswa')->user()->mahasiswaDetails->mhs_addr_provinsi : '' }}">
                                                    @error('mhs_addr_provinsi')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#FF6B35] text-white rounded-md hover:bg-[#E05A2B] transition">
                                            <i class="fa-solid fa-save mr-2"></i>Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Security Tab -->
                            <div class="hidden p-4 rounded-lg" id="security" role="tabpanel"
                                aria-labelledby="security-tab">
                                <form action="{{ route('mahasiswa.home-profile-save-password') }}" method="POST">
                                    @method('PATCH')
                                    @csrf

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                        <div>
                                            <label for="SecurityKey"
                                                class="block text-sm font-medium text-[#2E2E2E] mb-1">Security Key</label>
                                            <div class="flex items-center">
                                                <input type="password" name="mhs_code" id="SecurityKey"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md bg-gray-100"
                                                    disabled value="{{ Auth::guard('mahasiswa')->user()->mhs_code }}">
                                                <button type="button"
                                                    class="ml-2 p-2 text-[#0C6E71] hover:text-[#0C5A5D] toggle-password"
                                                    data-target="SecurityKey">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('mhs_code')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="oldPassword"
                                                class="block text-sm font-medium text-[#2E2E2E] mb-1">Password Lama</label>
                                            <div class="flex items-center">
                                                <input type="password" name="old_password" id="oldPassword"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md">
                                                <button type="button"
                                                    class="ml-2 p-2 text-[#0C6E71] hover:text-[#0C5A5D] toggle-password"
                                                    data-target="oldPassword">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('old_password')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="newPassword"
                                                class="block text-sm font-medium text-[#2E2E2E] mb-1">Password Baru</label>
                                            <div class="flex items-center">
                                                <input type="password" name="new_password" id="newPassword"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md">
                                                <button type="button"
                                                    class="ml-2 p-2 text-[#0C6E71] hover:text-[#0C5A5D] toggle-password"
                                                    data-target="newPassword">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('new_password')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="newPasswordKonfirm"
                                                class="block text-sm font-medium text-[#2E2E2E] mb-1">Konfirmasi Password
                                                Baru</label>
                                            <div class="flex items-center">
                                                <input type="password" name="new_password_confirmed"
                                                    id="newPasswordKonfirm"
                                                    class="w-full px-3 py-2 border border-[#E4E2DE] rounded-md">
                                                <button type="button"
                                                    class="ml-2 p-2 text-[#0C6E71] hover:text-[#0C5A5D] toggle-password"
                                                    data-target="newPasswordKonfirm">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                            @error('new_password_confirmed')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#FF6B35] text-white rounded-md hover:bg-[#E05A2B] transition">
                                            <i class="fa-solid fa-save mr-2"></i>Simpan Perubahan
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

    <!-- JavaScript for Tab Functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabs = document.querySelectorAll('[data-tabs-target]');
            const tabContents = document.querySelectorAll('[role="tabpanel"]');

            // Show first tab by default
            if (tabs.length > 0 && tabContents.length > 0) {
                document.querySelector(tabs[0].getAttribute('data-tabs-target')).classList.remove('hidden');
                tabs[0].classList.add('border-[#FF6B35]', 'text-[#FF6B35]');
                tabs[0].classList.remove('hover:text-[#2E2E2E]', 'hover:border-[#E4E2DE]');

                tabs.forEach(tab => {
                    tab.addEventListener('click', () => {
                        const target = document.querySelector(tab.getAttribute('data-tabs-target'));

                        // Hide all tab contents
                        tabContents.forEach(content => {
                            content.classList.add('hidden');
                        });

                        // Remove active styles from all tabs
                        tabs.forEach(t => {
                            t.classList.remove('border-[#FF6B35]', 'text-[#FF6B35]');
                            t.classList.add('hover:text-[#2E2E2E]',
                                'hover:border-[#E4E2DE]');
                        });

                        // Show selected tab content
                        target.classList.remove('hidden');

                        // Add active styles to selected tab
                        tab.classList.add('border-[#FF6B35]', 'text-[#FF6B35]');
                        tab.classList.remove('hover:text-[#2E2E2E]', 'hover:border-[#E4E2DE]');
                    });
                });
            }

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
        });
    </script>
@endsection
@section('custom-js')
    <script>
        document.getElementById("mhs_image").onchange = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.querySelector('.card-img-top');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script>
        const showPasswordButtons = document.querySelectorAll('.btn-outline-danger');
        showPasswordButtons.forEach((btn, index) => {
            const passwordInput = btn.previousElementSibling;
            btn.addEventListener('click', () => {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text'; // Show password
                    btn.innerHTML = '<i class="fa-solid fa-eye-slash"></i>'; // Change icon to eye-slash
                } else {
                    passwordInput.type = 'password'; // Hide password
                    btn.innerHTML = '<i class="fa-solid fa-eye"></i>'; // Change icon back to eye
                }
            });
        });
    </script>
@endsection
