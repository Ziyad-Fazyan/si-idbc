@extends('base.base-dash-index')

@section('title', 'Edit Data Kesehatan Mahasiswa')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <ol class="flex items-center space-x-2 text-sm">
                            <li><a href="{{ route($prefix . 'home-index') }}"
                                    class="text-blue-600 hover:text-blue-800">Dashboard</a></li>
                            <li class="text-gray-500">/</li>
                            <li><a href="{{ route($prefix . 'mahasiswa-health.index') }}"
                                    class="text-blue-600 hover:text-blue-800">Data Kesehatan Mahasiswa</a></li>
                            <li class="text-gray-500">/</li>
                            <li class="text-gray-700">Edit Data</li>
                        </ol>
                        <h4 class="text-2xl font-semibold text-gray-900 mt-1">Edit Data Kesehatan Mahasiswa</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap -mx-4">
            <div class="w-full px-4">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-6">
                        <div class="mb-6">
                            <h4 class="text-xl font-medium text-gray-900">{{ $student->mhs_name }}</h4>
                            <p class="text-gray-500">Kode: {{ $student->mhs_code }}</p>
                        </div>

                        <form action="{{ route($prefix . 'mahasiswa-health.update', $student->mhs_code) }}" method="POST"
                            class="needs-validation" novalidate>
                            @csrf
                            @method('PATCH')

                            <div class="flex flex-wrap -mx-4">
                                <div class="w-full md:w-1/2 px-4">
                                    <div class="mb-4">
                                        <label for="mhs_biometric" class="block text-sm font-medium text-gray-700 mb-1">Data
                                            Biometrik</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            id="mhs_biometric" name="mhs_biometric"
                                            value="{{ $student->mahasiswaDetails->mhs_biometric ?? '' }}"
                                            placeholder="Link atau path data biometrik">
                                        <p class="mt-1 text-sm text-gray-500">Masukkan link atau path ke data biometrik
                                            mahasiswa</p>
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_iq"
                                            class="block text-sm font-medium text-gray-700 mb-1">IQ</label>
                                        <input type="number"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            id="mhs_iq" name="mhs_iq"
                                            value="{{ $student->mahasiswaDetails->mhs_iq ?? '' }}" placeholder="Nilai IQ">
                                        <p class="mt-1 text-sm text-gray-500">Masukkan nilai IQ dalam angka</p>
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_logic" class="block text-sm font-medium text-gray-700 mb-1">Nilai
                                            Tes Logika</label>
                                        <input type="number"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            id="mhs_logic" name="mhs_logic"
                                            value="{{ $student->mahasiswaDetails->mhs_logic ?? '' }}"
                                            placeholder="Nilai tes logika">
                                        <p class="mt-1 text-sm text-gray-500">Masukkan nilai tes logika dalam angka</p>
                                    </div>
                                </div>

                                <div class="w-full md:w-1/2 px-4">
                                    <div class="mb-4">
                                        <label for="mhs_riwayat_kesehatan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Riwayat Kesehatan</label>
                                        <textarea
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            id="mhs_riwayat_kesehatan" name="mhs_riwayat_kesehatan" rows="3" placeholder="Keterangan riwayat kesehatan">{{ $student->mahasiswaDetails->mhs_riwayat_kesehatan ?? '' }}</textarea>
                                        <p class="mt-1 text-sm text-gray-500">Masukkan keterangan riwayat kesehatan
                                            mahasiswa</p>
                                    </div>

                                    <div class="mb-4">
                                        <label for="mhs_goldar"
                                            class="block text-sm font-medium text-gray-700 mb-1">Golongan Darah</label>
                                        <select
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            id="mhs_goldar" name="mhs_goldar">
                                            <option value=""
                                                {{ ($student->mahasiswaDetails->mhs_goldar ?? '') == '' ? 'selected' : '' }}>
                                                Pilih Golongan Darah</option>
                                            <option value="A"
                                                {{ ($student->mahasiswaDetails->mhs_goldar ?? '') == 'A' ? 'selected' : '' }}>
                                                A</option>
                                            <option value="B"
                                                {{ ($student->mahasiswaDetails->mhs_goldar ?? '') == 'B' ? 'selected' : '' }}>
                                                B</option>
                                            <option value="AB"
                                                {{ ($student->mahasiswaDetails->mhs_goldar ?? '') == 'AB' ? 'selected' : '' }}>
                                                AB</option>
                                            <option value="O"
                                                {{ ($student->mahasiswaDetails->mhs_goldar ?? '') == 'O' ? 'selected' : '' }}>
                                                O</option>
                                        </select>
                                    </div>

                                    <div class="flex flex-wrap -mx-2">
                                        <div class="w-full md:w-1/2 px-2">
                                            <div class="mb-4">
                                                <label for="mhs_tinggi_badan"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Tinggi Badan
                                                    (cm)</label>
                                                <input type="number" step="0.1"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                    id="mhs_tinggi_badan" name="mhs_tinggi_badan"
                                                    value="{{ $student->mahasiswaDetails->mhs_tinggi_badan ?? '' }}"
                                                    placeholder="Tinggi badan dalam cm">
                                            </div>
                                        </div>
                                        <div class="w-full md:w-1/2 px-2">
                                            <div class="mb-4">
                                                <label for="mhs_berat_badan"
                                                    class="block text-sm font-medium text-gray-700 mb-1">Berat Badan
                                                    (kg)</label>
                                                <input type="number" step="0.1"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                    id="mhs_berat_badan" name="mhs_berat_badan"
                                                    value="{{ $student->mahasiswaDetails->mhs_berat_badan ?? '' }}"
                                                    placeholder="Berat badan dalam kg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap -mx-4 mt-6">
                                <div class="w-full px-4 text-right">
                                    <a href="{{ route($prefix . 'mahasiswa-health.index') }}"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Form validation script
        (function() {
            'use strict'

            // Fetch all forms with validation needs
            const forms = document.querySelectorAll('.needs-validation')

            // Add validation to each form
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    // Add Tailwind invalid state classes
                    const inputs = form.querySelectorAll('input, select, textarea')
                    inputs.forEach(input => {
                        if (!input.checkValidity()) {
                            input.classList.add('border-red-500')
                            input.nextElementSibling?.classList.add('text-red-500')
                        } else {
                            input.classList.remove('border-red-500')
                            input.nextElementSibling?.classList.remove('text-red-500')
                        }
                    })

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
