@extends('base.base-dash-index')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Tambah Field Mutabaah</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mutabaah-fields.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="field_name" class="block font-semibold">Field Name</label>
            <input type="text" name="field_name" id="field_name" value="{{ old('field_name') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label for="label" class="block font-semibold">Label</label>
            <input type="text" name="label" id="label" value="{{ old('label') }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label for="field_type" class="block font-semibold">Field Type</label>
            <select name="field_type" id="field_type" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="boolean" {{ old('field_type') == 'boolean' ? 'selected' : '' }}>Boolean (Ya/Tidak)</option>
                <option value="text" {{ old('field_type') == 'text' ? 'selected' : '' }}>Text</option>
                <option value="integer" {{ old('field_type') == 'integer' ? 'selected' : '' }}>Angka</option>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.mutabaah-fields.index') }}" class="text-blue-600 underline ml-3">Kembali</a>
        </div>
    </form>
</div>
@endsection
