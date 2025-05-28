@extends('base.base-dash-index')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Isi Mutabaah Hari Ini</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('musyrif.mutabaah.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="author_id" class="block font-semibold">Mahasiswa</label>
            <select name="author_id" id="author_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">-- Pilih Mahasiswa --</option>
                @foreach ($mahasiswas as $mhs)
                    <option value="{{ $mhs->id }}" {{ old('author_id') == $mhs->id ? 'selected' : '' }}>{{ $mhs->mhs_name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="tanggal" class="block font-semibold">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        @foreach ($fields as $field)
    <div>
        <label class="block font-semibold">{{ $field->label }}</label>

        @if ($field->field_type === 'boolean')
            <input type="checkbox" name="data[{{ $field->field_name }}]" class="mr-2" value="1"> Ya
        @elseif ($field->field_type === 'text')
            <input type="text" name="data[{{ $field->field_name }}]" value="{{ old('data.' . $field->field_name) }}" class="w-full border px-3 py-2 rounded">
        @elseif ($field->field_type === 'integer')
            <input type="number" name="data[{{ $field->field_name }}]" value="{{ old('data.' . $field->field_name) }}" class="w-full border px-3 py-2 rounded">
        @endif
    </div>
@endforeach


        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('musyrif.mutabaah.index') }}" class="text-blue-600 underline ml-3">Kembali</a>
        </div>
    </form>
</div>
@endsection
