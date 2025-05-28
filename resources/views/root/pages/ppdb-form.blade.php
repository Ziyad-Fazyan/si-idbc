@extends('base.base-root-index')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-white">Form Pendaftaran Siswa Baru</h2>
            <a href="{{ route('ppdb.form') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
        
        <div class="p-6">
            <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Data Pribadi -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Data Pribadi</h3>
                        
                        <div>
                            <label for="mhs_name" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="mhs_name" name="mhs_name" value="{{ old('mhs_name') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_name') border-red-500 @enderror">
                            @error('mhs_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="mhs_user" class="block text-sm font-medium text-gray-700">Username <span class="text-red-500">*</span></label>
                                <input type="text" id="mhs_user" name="mhs_user" value="{{ old('mhs_user') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_user') border-red-500 @enderror">
                                @error('mhs_user')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="mhs_nim" class="block text-sm font-medium text-gray-700">NIM</label>
                                <input type="text" id="mhs_nim" name="mhs_nim" value="{{ old('mhs_nim') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_nim') border-red-500 @enderror">
                                @error('mhs_nim')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="mhs_birthplace" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                <input type="text" id="mhs_birthplace" name="mhs_birthplace" value="{{ old('mhs_birthplace') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_birthplace') border-red-500 @enderror">
                                @error('mhs_birthplace')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="mhs_birthdate" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" id="mhs_birthdate" name="mhs_birthdate" value="{{ old('mhs_birthdate') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_birthdate') border-red-500 @enderror">
                                @error('mhs_birthdate')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="mhs_gend" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select id="mhs_gend" name="mhs_gend"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_gend') border-red-500 @enderror">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('mhs_gend') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('mhs_gend') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('mhs_gend')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="mhs_reli" class="block text-sm font-medium text-gray-700">Agama</label>
                                <select id="mhs_reli" name="mhs_reli"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_reli') border-red-500 @enderror">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('mhs_reli') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('mhs_reli') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('mhs_reli') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('mhs_reli') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('mhs_reli') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('mhs_reli') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('mhs_reli')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="class_id" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select id="class_id" name="class_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('class_id') border-red-500 @enderror">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas ?? [] as $kls)
                                    <option value="{{ $kls->id }}" {{ old('class_id') == $kls->id ? 'selected' : '' }}>{{ $kls->class_name }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="mhs_image" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                            <div class="mt-1 flex items-center">
                                <input type="file" id="mhs_image" name="mhs_image"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('mhs_image') border-red-500 @enderror">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Format: jpeg, png, jpg, gif, svg. Maks: 8MB</p>
                            @error('mhs_image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Kontak & Alamat -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Kontak & Alamat</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="mhs_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon <span class="text-red-500">*</span></label>
                                <input type="tel" id="mhs_phone" name="mhs_phone" value="{{ old('mhs_phone') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_phone') border-red-500 @enderror">
                                @error('mhs_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="mhs_mail" class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="mhs_mail" name="mhs_mail" value="{{ old('mhs_mail') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_mail') border-red-500 @enderror">
                                @error('mhs_mail')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Cascading Address Dropdowns -->
                        <div>
                            <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi <span class="text-red-500">*</span></label>
                            <select id="provinsi" name="provinsi" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('provinsi') border-red-500 @enderror">
                                <option value="">Pilih Provinsi</option>
                                @foreach($provinces ?? [] as $province)
                                    <option value="{{ $province->id }}" {{ old('provinsi') == $province->id ? 'selected' : '' }}>
                                        {{ $province->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('provinsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten/Kota <span class="text-red-500">*</span></label>
                            <select id="kabupaten" name="kabupaten" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kabupaten') border-red-500 @enderror">
                                <option value="">Pilih Kabupaten/Kota</option>
                                @if(old('kabupaten') && $cities)
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('kabupaten') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kabupaten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan <span class="text-red-500">*</span></label>
                            <select id="kecamatan" name="kecamatan" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kecamatan') border-red-500 @enderror">
                                <option value="">Pilih Kecamatan</option>
                                @if(old('kecamatan') && $districts)
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ old('kecamatan') == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kecamatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                            <select id="kelurahan" name="kelurahan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('kelurahan') border-red-500 @enderror">
                                <option value="">Pilih Kelurahan/Desa</option>
                                @if(old('kelurahan') && $villages)
                                    @foreach($villages as $village)
                                        <option value="{{ $village->id }}" {{ old('kelurahan') == $village->id ? 'selected' : '' }}>
                                            {{ $village->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('kelurahan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="mhs_addr_domisili" class="block text-sm font-medium text-gray-700">Alamat Lengkap (Jalan, No. Rumah, RT/RW) <span class="text-red-500">*</span></label>
                            <textarea id="mhs_addr_domisili" name="mhs_addr_domisili" rows="2" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_addr_domisili') border-red-500 @enderror">{{ old('mhs_addr_domisili') }}</textarea>
                            @error('mhs_addr_domisili')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="mhs_addr_kodepos" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                            <input type="text" id="mhs_addr_kodepos" name="mhs_addr_kodepos" value="{{ old('mhs_addr_kodepos') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_addr_kodepos') border-red-500 @enderror">
                            @error('mhs_addr_kodepos')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <!-- Data Orang Tua/Wali & Akun -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Data Orang Tua/Wali -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Data Orang Tua/Wali</h3>
                        
                        <div>
                            <label for="mhs_parent_father" class="block text-sm font-medium text-gray-700">Nama Ayah</label>
                            <input type="text" id="mhs_parent_father" name="mhs_parent_father" value="{{ old('mhs_parent_father') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_parent_father') border-red-500 @enderror">
                            @error('mhs_parent_father')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="mhs_parent_father_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon Ayah</label>
                                <input type="tel" id="mhs_parent_father_phone" name="mhs_parent_father_phone" value="{{ old('mhs_parent_father_phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_parent_father_phone') border-red-500 @enderror">
                                @error('mhs_parent_father_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="mhs_parent_father_job" class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                                <input type="text" id="mhs_parent_father_job" name="mhs_parent_father_job" value="{{ old('mhs_parent_father_job') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_parent_father_job') border-red-500 @enderror">
                                @error('mhs_parent_father_job')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="mhs_parent_mother" class="block text-sm font-medium text-gray-700">Nama Ibu</label>
                            <input type="text" id="mhs_parent_mother" name="mhs_parent_mother" value="{{ old('mhs_parent_mother') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_parent_mother') border-red-500 @enderror">
                            @error('mhs_parent_mother')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="mhs_parent_mother_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon Ibu</label>
                                <input type="tel" id="mhs_parent_mother_phone" name="mhs_parent_mother_phone" value="{{ old('mhs_parent_mother_phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_parent_mother_phone') border-red-500 @enderror">
                                @error('mhs_parent_mother_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="mhs_parent_mother_job" class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                                <input type="text" id="mhs_parent_mother_job" name="mhs_parent_mother_job" value="{{ old('mhs_parent_mother_job') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_parent_mother_job') border-red-500 @enderror">
                                @error('mhs_parent_mother_job')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="mhs_wali_name" class="block text-sm font-medium text-gray-700">Nama Wali</label>
                            <input type="text" id="mhs_wali_name" name="mhs_wali_name" value="{{ old('mhs_wali_name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_wali_name') border-red-500 @enderror">
                            @error('mhs_wali_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="mhs_wali_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon Wali</label>
                                <input type="tel" id="mhs_wali_phone" name="mhs_wali_phone" value="{{ old('mhs_wali_phone') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_wali_phone') border-red-500 @enderror">
                                @error('mhs_wali_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="mhs_wali_hubungan" class="block text-sm font-medium text-gray-700">Hubungan dengan Wali</label>
                                <input type="text" id="mhs_wali_hubungan" name="mhs_wali_hubungan" value="{{ old('mhs_wali_hubungan') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('mhs_wali_hubungan') border-red-500 @enderror">
                                @error('mhs_wali_hubungan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Akun -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Akun</h3>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter, mengandung huruf dan angka</p>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="password_confirm" class="block text-sm font-medium text-gray-700">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="password" id="password_confirm" name="password_confirm" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('password_confirm') border-red-500 @enderror">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password_confirm')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="agreeTerms" name="agreeTerms" type="checkbox" required
                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="agreeTerms" class="font-medium text-gray-700">Saya menyatakan bahwa data yang diisi adalah benar dan dapat dipertanggungjawabkan.</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="reset" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                        Reset
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Simpan Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('svg');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                }
            });
        });
        
        // Cascading address dropdowns
        const provinsiSelect = document.getElementById('provinsi');
        const kabupatenSelect = document.getElementById('kabupaten');
        const kecamatanSelect = document.getElementById('kecamatan');
        const kelurahanSelect = document.getElementById('kelurahan');
        
        if (provinsiSelect) {
            provinsiSelect.addEventListener('change', function() {
                const provinceId = this.value;
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                
                if (provinceId) {
                    fetch(`/api/cities/${provinceId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(city => {
                                const option = document.createElement('option');
                                option.value = city.id;
                                option.textContent = city.name;
                                kabupatenSelect.appendChild(option);
                            });
                        });
                }
            });
        }
        
        if (kabupatenSelect) {
            kabupatenSelect.addEventListener('change', function() {
                const cityId = this.value;
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                
                if (cityId) {
                    fetch(`/api/districts/${cityId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(district => {
                                const option = document.createElement('option');
                                option.value = district.id;
                                option.textContent = district.name;
                                kecamatanSelect.appendChild(option);
                            });
                        });
                }
            });
        }
        
        if (kecamatanSelect) {
            kecamatanSelect.addEventListener('change', function() {
                const districtId = this.value;
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                
                if (districtId) {
                    fetch(`/api/villages/${districtId}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(village => {
                                const option = document.createElement('option');
                                option.value = village.id;
                                option.textContent = village.name;
                                kelurahanSelect.appendChild(option);
                            });
                        });
                }
            });
        }
        
        // Form validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (!document.getElementById('agreeTerms').checked) {
                    e.preventDefault();
                    alert('Anda harus menyetujui persyaratan terlebih dahulu');
                    return false;
                }
                
                if (document.getElementById('password').value !== document.getElementById('password_confirm').value) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak sama');
                    return false;
                }
                
                return true;
            });
        }
    });
</script>
@endpush