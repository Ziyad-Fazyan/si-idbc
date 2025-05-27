@extends('base.base-dash-index')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Mutabaah Harian</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('musyrif.mutabaah.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
            + Isi Mutabaah
        </a>

        @php
            // Ambil key dari data pertama (jika ada), pastikan bentuk array
            $headers = $mutabaahs->first() && is_array($mutabaahs->first()->data)
                ? array_keys($mutabaahs->first()->data)
                : [];
        @endphp

        <table class="w-full table-auto border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Tanggal</th>
                    <th class="border px-4 py-2">Mahasiswa</th>
                    @foreach ($headers as $header)
                        <th class="border px-4 py-2">{{ ucfirst($header) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($mutabaahs as $mutabaah)
                    <tr>
                        <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($mutabaah->tanggal)->format('d M Y') }}</td>
                        <td class="border px-4 py-2">{{ $mutabaah->mahasiswa->mhs_name ?? 'Tidak ditemukan' }}</td>
                        @foreach ($headers as $key)
                            @php $value = $mutabaah->data[$key] ?? null; @endphp
                            <td class="border px-4 py-2 text-center">
                                {{ is_bool($value) ? ($value ? '✅' : '❌') : ($value !== null ? $value : '-') }}
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ 2 + count($headers) }}" class="text-center p-4">Belum ada data mutabaah.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
