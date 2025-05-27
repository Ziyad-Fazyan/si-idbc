@extends('base.base-dash-index')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Daftar Field Mutabaah</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('musyrif.mutabaah-fields.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah Field</a>

    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Field Name</th>
                <th class="border px-4 py-2">Label</th>
                <th class="border px-4 py-2">Field Type</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fields as $field)
                <tr>
                    <td class="border px-4 py-2">{{ $field->field_name }}</td>
                    <td class="border px-4 py-2">{{ $field->label }}</td>
                    <td class="border px-4 py-2">{{ $field->field_type }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('musyrif.mutabaah-fields.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center p-4">Belum ada field mutabaah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
