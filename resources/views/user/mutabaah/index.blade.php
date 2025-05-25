@extends('base.base-dash-index')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Mutabaah Harian</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.mutabaah.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Isi Mutabaah</a>

    <table class="w-full table-auto border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Tanggal</th>
                <th class="border px-4 py-2">Mahasiswa</th>
                <th class="border px-4 py-2">Data</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($mutabaahs as $mutabaah)
                <tr>
                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($mutabaah->tanggal)->format('d M Y') }}</td>
                    <td class="border px-4 py-2">{{ $mutabaah->mahasiswa->mhs_name ?? 'Tidak ditemukan' }}</td>
                    <td class="border px-4 py-2 whitespace-pre-wrap text-sm">
                        @foreach ($mutabaah->data as $key => $value)
                            <div><strong>{{ $key }}:</strong> {{ is_bool($value) ? ($value ? '✅' : '❌') : $value }}</div>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center p-4">Belum ada data mutabaah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
