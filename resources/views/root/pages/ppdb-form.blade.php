@extends('base.base-root-index')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">Form Pendaftaran Siswa Baru</h2>
                <a href="{{ route('ppdb.form') }}"
                    class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded text-sm flex items-center">
                    <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Main Form -->
            <div class="p-6">
                <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Personal Data Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Data Pribadi</h3>

                            <div class="space-y-1">
                                <label for="mhs_name" class="block text-sm font-medium text-gray-700">Nama Lengkap <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="mhs_name" name="mhs_name" value="{{ old('mhs_name') }}" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_name') border-red-500 @enderror">
                                @error('mhs_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="mhs_user" class="block text-sm font-medium text-gray-700">Username <span
                                            class="text-red-500">*</span></label>
                                    <input type="text" id="mhs_user" name="mhs_user" value="{{ old('mhs_user') }}"
                                        required
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_user') border-red-500 @enderror">
                                    @error('mhs_user')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="mhs_nim" class="block text-sm font-medium text-gray-700">NIM</label>
                                    <input type="text" id="mhs_nim" name="mhs_nim" value="{{ old('mhs_nim') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_nim') border-red-500 @enderror">
                                    @error('mhs_nim')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="mhs_birthplace" class="block text-sm font-medium text-gray-700">Tempat
                                        Lahir</label>
                                    <input type="text" id="mhs_birthplace" name="mhs_birthplace"
                                        value="{{ old('mhs_birthplace') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_birthplace') border-red-500 @enderror">
                                    @error('mhs_birthplace')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="mhs_birthdate" class="block text-sm font-medium text-gray-700">Tanggal
                                        Lahir</label>
                                    <input type="date" id="mhs_birthdate" name="mhs_birthdate"
                                        value="{{ old('mhs_birthdate') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_birthdate') border-red-500 @enderror">
                                    @error('mhs_birthdate')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="mhs_gend" class="block text-sm font-medium text-gray-700">Jenis
                                        Kelamin</label>
                                    <select id="mhs_gend" name="mhs_gend"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_gend') border-red-500 @enderror">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('mhs_gend') == 'L' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="P" {{ old('mhs_gend') == 'P' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                    @error('mhs_gend')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="space-y-1">
                                    <label for="mhs_reli" class="block text-sm font-medium text-gray-700">Agama</label>
                                    <select id="mhs_reli" name="mhs_reli"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_reli') border-red-500 @enderror">
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ old('mhs_reli') == 'Islam' ? 'selected' : '' }}>Islam
                                        </option>
                                        <option value="Kristen" {{ old('mhs_reli') == 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="Katolik" {{ old('mhs_reli') == 'Katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Hindu" {{ old('mhs_reli') == 'Hindu' ? 'selected' : '' }}>Hindu
                                        </option>
                                        <option value="Buddha" {{ old('mhs_reli') == 'Buddha' ? 'selected' : '' }}>Buddha
                                        </option>
                                        <option value="Konghucu" {{ old('mhs_reli') == 'Konghucu' ? 'selected' : '' }}>
                                            Konghucu</option>
                                    </select>
                                    @error('mhs_reli')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="class_id" class="block text-sm font-medium text-gray-700">Kelas (Pilih satu atau
                                    lebih)</label>
                                <select id="class_id" name="class_id[]" multiple
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('class_id') border-red-500 @enderror">
                                    @foreach ($kelas ?? [] as $kls)
                                        <option value="{{ $kls->id }}"
                                            {{ is_array(old('class_id')) && in_array($kls->id, old('class_id')) ? 'selected' : '' }}>
                                            {{ $kls->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-gray-500">Tahan tombol Ctrl (Windows) atau Command (Mac) untuk memilih
                                    beberapa kelas</small>
                                @error('class_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="mhs_image" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                                <input type="file" id="mhs_image" name="mhs_image"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('mhs_image') border-red-500 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Format: jpeg, png, jpg, gif, svg. Maks: 8MB</p>
                                @error('mhs_image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact & Address Section -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Kontak & Alamat</h3>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="mhs_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon
                                        <span class="text-red-500">*</span></label>
                                    <input type="tel" id="mhs_phone" name="mhs_phone"
                                        value="{{ old('mhs_phone') }}" required
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_phone') border-red-500 @enderror">
                                    @error('mhs_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="mhs_mail" class="block text-sm font-medium text-gray-700">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" id="mhs_mail" name="mhs_mail" value="{{ old('mhs_mail') }}"
                                        required
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_mail') border-red-500 @enderror">
                                    @error('mhs_mail')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Cascading Address Dropdowns -->
                            <div class="space-y-1">
                                <label for="provinsi" class="block text-sm font-medium text-gray-700">Provinsi <span
                                        class="text-red-500">*</span></label>
                                <select id="provinsi" name="mhs_addr_provinsi" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('provinsi') border-red-500 @enderror">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces ?? [] as $province)
                                        <option value="{{ $province->id }}"
                                            {{ old('provinsi') == $province->id ? 'selected' : '' }}>
                                            {{ $province->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="provinsi_name" name="mhs_addr_provinsi_name"
                                    value="{{ old('provinsi_name') }}">
                                @error('provinsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="kabupaten" class="block text-sm font-medium text-gray-700">Kabupaten/Kota
                                    <span class="text-red-500">*</span></label>
                                <select id="kabupaten" name="mhs_addr_kota" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('kabupaten') border-red-500 @enderror">
                                    <option value="">Pilih Kabupaten/Kota</option>
                                    @if (old('kabupaten') && $cities)
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ old('kabupaten') == $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="hidden" id="kabupaten_name" name="mhs_addr_kota_name"
                                    value="{{ old('kabupaten_name') }}">
                                @error('kabupaten')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan <span
                                        class="text-red-500">*</span></label>
                                <select id="kecamatan" name="mhs_addr_kecamatan" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('kecamatan') border-red-500 @enderror">
                                    <option value="">Pilih Kecamatan</option>
                                    @if (old('kecamatan') && $districts)
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}"
                                                {{ old('kecamatan') == $district->id ? 'selected' : '' }}>
                                                {{ $district->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="hidden" id="kecamatan_name" name="mhs_addr_kecamatan_name"
                                    value="{{ old('kecamatan_name') }}">
                                @error('kecamatan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="kelurahan"
                                    class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                                <select id="kelurahan" name="mhs_addr_kelurahan"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('kelurahan') border-red-500 @enderror">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                    @if (old('kelurahan') && $villages)
                                        @foreach ($villages as $village)
                                            <option value="{{ $village->id }}"
                                                {{ old('kelurahan') == $village->id ? 'selected' : '' }}>
                                                {{ $village->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="hidden" id="kelurahan_name" name="mhs_addr_kelurahan_name"
                                    value="{{ old('kelurahan_name') }}">
                                @error('kelurahan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-1">
                                <label for="mhs_addr_domisili" class="block text-sm font-medium text-gray-700">Alamat
                                    Lengkap (Jalan, No. Rumah, RT/RW) <span class="text-red-500">*</span></label>
                                <textarea id="mhs_addr_domisili" name="mhs_addr_domisili" rows="2" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_addr_domisili') border-red-500 @enderror">{{ old('mhs_addr_domisili') }}</textarea>
                                @error('mhs_addr_domisili')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Parent Data Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Data Orang Tua/Wali</h3>

                            <div class="space-y-1">
                                <label for="mhs_parent_father" class="block text-sm font-medium text-gray-700">Nama
                                    Ayah</label>
                                <input type="text" id="mhs_parent_father" name="mhs_parent_father"
                                    value="{{ old('mhs_parent_father') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_parent_father') border-red-500 @enderror">
                                @error('mhs_parent_father')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="mhs_parent_father_phone"
                                        class="block text-sm font-medium text-gray-700">Nomor Telepon Ayah</label>
                                    <input type="tel" id="mhs_parent_father_phone" name="mhs_parent_father_phone"
                                        value="{{ old('mhs_parent_father_phone') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_parent_father_phone') border-red-500 @enderror">
                                    @error('mhs_parent_father_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="mhs_parent_father_job"
                                        class="block text-sm font-medium text-gray-700">Pekerjaan Ayah</label>
                                    <input type="text" id="mhs_parent_father_job" name="mhs_parent_father_job"
                                        value="{{ old('mhs_parent_father_job') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_parent_father_job') border-red-500 @enderror">
                                    @error('mhs_parent_father_job')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="mhs_parent_mother" class="block text-sm font-medium text-gray-700">Nama
                                    Ibu</label>
                                <input type="text" id="mhs_parent_mother" name="mhs_parent_mother"
                                    value="{{ old('mhs_parent_mother') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_parent_mother') border-red-500 @enderror">
                                @error('mhs_parent_mother')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="mhs_parent_mother_phone"
                                        class="block text-sm font-medium text-gray-700">Nomor Telepon Ibu</label>
                                    <input type="tel" id="mhs_parent_mother_phone" name="mhs_parent_mother_phone"
                                        value="{{ old('mhs_parent_mother_phone') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_parent_mother_phone') border-red-500 @enderror">
                                    @error('mhs_parent_mother_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="mhs_parent_mother_job"
                                        class="block text-sm font-medium text-gray-700">Pekerjaan Ibu</label>
                                    <input type="text" id="mhs_parent_mother_job" name="mhs_parent_mother_job"
                                        value="{{ old('mhs_parent_mother_job') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_parent_mother_job') border-red-500 @enderror">
                                    @error('mhs_parent_mother_job')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="mhs_wali_name" class="block text-sm font-medium text-gray-700">Nama
                                    Wali</label>
                                <input type="text" id="mhs_wali_name" name="mhs_wali_name"
                                    value="{{ old('mhs_wali_name') }}"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_wali_name') border-red-500 @enderror">
                                @error('mhs_wali_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1">
                                    <label for="mhs_wali_phone" class="block text-sm font-medium text-gray-700">Nomor
                                        Telepon Wali</label>
                                    <input type="tel" id="mhs_wali_phone" name="mhs_wali_phone"
                                        value="{{ old('mhs_wali_phone') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_wali_phone') border-red-500 @enderror">
                                    @error('mhs_wali_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-1">
                                    <label for="mhs_wali_hubungan"
                                        class="block text-sm font-medium text-gray-700">Hubungan dengan Wali</label>
                                    <input type="text" id="mhs_wali_hubungan" name="mhs_wali_hubungan"
                                        value="{{ old('mhs_wali_hubungan') }}"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm @error('mhs_wali_hubungan') border-red-500 @enderror">
                                    @error('mhs_wali_hubungan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="reset"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                            Reset
                        </button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
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
            // Base URL API Wilayah Indonesia
            const API_BASE_URL = 'https://www.emsifa.com/api-wilayah-indonesia/api';

            // Element Select
            const provinsiSelect = document.getElementById('provinsi');
            const kabupatenSelect = document.getElementById('kabupaten');
            const kecamatanSelect = document.getElementById('kecamatan');
            const kelurahanSelect = document.getElementById('kelurahan');

            // Fungsi untuk memuat data wilayah dan mengupdate hidden input dengan nama wilayah
            const loadWilayah = async (url, selectElement, placeholder, hiddenInputId = null) => {
                try {
                    selectElement.disabled = true;
                    selectElement.innerHTML = `<option value="">Memuat ${placeholder}...</option>`;

                    const response = await fetch(url);
                    if (!response.ok) throw new Error('Gagal memuat data');

                    const data = await response.json();

                    selectElement.innerHTML = `<option value="">Pilih ${placeholder}</option>`;
                    data.forEach(item => {
                        const option = new Option(item.name, item.id);
                        // Simpan nama wilayah sebagai data attribute
                        option.dataset.name = item.name;
                        selectElement.add(option);
                    });

                    // Set nilai old jika ada (setelah validasi gagal)
                    const oldValue = selectElement.dataset.old;
                    if (oldValue) {
                        selectElement.value = oldValue;
                        // Update hidden input jika ada nilai old
                        if (hiddenInputId) {
                            const selectedOption = selectElement.options[selectElement.selectedIndex];
                            document.getElementById(hiddenInputId).value = selectedOption.dataset.name ||
                            '';
                        }
                    }

                    selectElement.disabled = false;
                    return true;
                } catch (error) {
                    console.error('Error:', error);
                    selectElement.innerHTML = `<option value="">Gagal memuat ${placeholder}</option>`;
                    selectElement.disabled = false;
                    return false;
                }
            };

            // Fungsi untuk update hidden input dengan nama wilayah yang dipilih
            const updateHiddenInput = (selectElement, hiddenInputId) => {
                const selectedOption = selectElement.options[selectElement.selectedIndex];
                document.getElementById(hiddenInputId).value = selectedOption.dataset.name || '';
            };

            // Set nilai old untuk form validation
            if (provinsiSelect) {
                provinsiSelect.dataset.old = "{{ old('provinsi') }}";
                kabupatenSelect.dataset.old = "{{ old('kabupaten') }}";
                kecamatanSelect.dataset.old = "{{ old('kecamatan') }}";
                kelurahanSelect.dataset.old = "{{ old('kelurahan') }}";
            }

            // Inisialisasi: Muat provinsi pertama kali
            loadWilayah(`${API_BASE_URL}/provinces.json`, provinsiSelect, 'Provinsi', 'provinsi_name')
                .then(success => {
                    if (success && provinsiSelect.dataset.old) {
                        // Jika ada provinsi yang dipilih sebelumnya, muat kabupaten
                        loadWilayah(`${API_BASE_URL}/regencies/${provinsiSelect.dataset.old}.json`,
                                kabupatenSelect, 'Kabupaten/Kota', 'kabupaten_name')
                            .then(success => {
                                if (success && kabupatenSelect.dataset.old) {
                                    // Jika ada kabupaten yang dipilih sebelumnya, muat kecamatan
                                    loadWilayah(
                                            `${API_BASE_URL}/districts/${kabupatenSelect.dataset.old}.json`,
                                            kecamatanSelect, 'Kecamatan', 'kecamatan_name')
                                        .then(success => {
                                            if (success && kecamatanSelect.dataset.old) {
                                                // Jika ada kecamatan yang dipilih sebelumnya, muat kelurahan
                                                loadWilayah(
                                                    `${API_BASE_URL}/villages/${kecamatanSelect.dataset.old}.json`,
                                                    kelurahanSelect, 'Kelurahan/Desa',
                                                    'kelurahan_name');
                                            }
                                        });
                                }
                            });
                    }
                });

            // Event listener untuk provinsi
            provinsiSelect.addEventListener('change', function() {
                const provinsiId = this.value;
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                // Reset hidden inputs
                document.getElementById('kabupaten_name').value = '';
                document.getElementById('kecamatan_name').value = '';
                document.getElementById('kelurahan_name').value = '';

                // Update provinsi_name hidden input
                updateHiddenInput(provinsiSelect, 'provinsi_name');

                if (provinsiId) {
                    loadWilayah(`${API_BASE_URL}/regencies/${provinsiId}.json`,
                        kabupatenSelect, 'Kabupaten/Kota', 'kabupaten_name');
                } else {
                    kabupatenSelect.disabled = true;
                    kecamatanSelect.disabled = true;
                    kelurahanSelect.disabled = true;
                }
            });

            // Event listener untuk kabupaten
            kabupatenSelect.addEventListener('change', function() {
                const kabupatenId = this.value;
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                // Reset hidden inputs
                document.getElementById('kecamatan_name').value = '';
                document.getElementById('kelurahan_name').value = '';

                // Update kabupaten_name hidden input
                updateHiddenInput(kabupatenSelect, 'kabupaten_name');

                if (kabupatenId) {
                    loadWilayah(`${API_BASE_URL}/districts/${kabupatenId}.json`,
                        kecamatanSelect, 'Kecamatan', 'kecamatan_name');
                } else {
                    kecamatanSelect.disabled = true;
                    kelurahanSelect.disabled = true;
                }
            });

            // Event listener untuk kecamatan
            kecamatanSelect.addEventListener('change', function() {
                const kecamatanId = this.value;
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';

                // Reset hidden input
                document.getElementById('kelurahan_name').value = '';

                // Update kecamatan_name hidden input
                updateHiddenInput(kecamatanSelect, 'kecamatan_name');

                if (kecamatanId) {
                    loadWilayah(`${API_BASE_URL}/villages/${kecamatanId}.json`,
                        kelurahanSelect, 'Kelurahan/Desa', 'kelurahan_name');
                } else {
                    kelurahanSelect.disabled = true;
                }
            });

            // Event listener untuk kelurahan
            kelurahanSelect.addEventListener('change', function() {
                // Update kelurahan_name hidden input
                updateHiddenInput(kelurahanSelect, 'kelurahan_name');
            });
        });
    </script>
@endpush
