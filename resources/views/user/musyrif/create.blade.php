@extends('base.base-dash-index')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Isi Mutabaah Harian</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('musyrif.mutabaah.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="author_id" class="block font-semibold text-gray-700 mb-2">Mahasiswa</label>
                    <select name="author_id" id="author_id" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">-- Pilih Mahasiswa --</option>
                        @foreach ($mahasiswas as $mhs)
                            <option value="{{ $mhs->id }}" {{ old('author_id') == $mhs->id ? 'selected' : '' }}>{{ $mhs->mhs_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tanggal" class="block font-semibold text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
                <h2 class="text-lg font-semibold mb-4">Data Mutabaah</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($fields as $field)
                        <div class="bg-gray-50 p-4 rounded-md">
                            <label class="block font-semibold text-gray-700 mb-2">{{ $field->label }}</label>

                            @if ($field->field_type === 'boolean')
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="data[{{ $field->field_name }}]" class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500" value="1" {{ old('data.' . $field->field_name) ? 'checked' : '' }}>
                                    <span class="ml-2">Ya</span>
                                </label>
                            @elseif ($field->field_type === 'text')
                                <input type="text" name="data[{{ $field->field_name }}]" value="{{ old('data.' . $field->field_name) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @elseif ($field->field_type === 'integer')
                                <input type="number" name="data[{{ $field->field_name }}]" value="{{ old('data.' . $field->field_name) }}" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <a href="{{ route('musyrif.mutabaah.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                </a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md transition-colors font-medium">
                    <i class="fa-solid fa-save mr-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
