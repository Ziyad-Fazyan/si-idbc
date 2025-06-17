@extends('base.base-dash-index')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Mutabaah Harian</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <div class="flex flex-col sm:flex-row gap-2">
                <a href="{{ route('musyrif.mutabaah.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-flex items-center transition-colors">
                    <i class="fa-solid fa-plus mr-2"></i> Isi Mutabaah
                </a>
                <a href="#" onclick="document.getElementById('batchEntryModal').classList.remove('hidden')" 
                   class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded inline-flex items-center transition-colors">
                    <i class="fa-solid fa-users mr-2"></i> Isi Mutabaah Massal
                </a>
            </div>
            
            <div class="w-full md:w-auto">
                <form action="{{ route('musyrif.mutabaah.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                    <select name="mahasiswa" class="border rounded px-3 py-2">
                        <option value="">Semua Mahasiswa</option>
                        @foreach ($mahasiswa as $mhs)
                            <option value="{{ $mhs->id }}" {{ request('mahasiswa') == $mhs->id ? 'selected' : '' }}>{{ $mhs->mhs_name }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border rounded px-3 py-2">
                    <button type="submit" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded transition-colors">Filter</button>
                    @if(request('mahasiswa') || request('tanggal'))
                        <a href="{{ route('musyrif.mutabaah.index') }}" class="bg-red-100 hover:bg-red-200 text-red-600 px-4 py-2 rounded transition-colors">Reset</a>
                    @endif
                </form>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="border-b px-4 py-3 text-left">Tanggal</th>
                            <th class="border-b px-4 py-3 text-left">Mahasiswa</th>
                            @foreach ($headers as $header)
                                <th class="border-b px-4 py-3 text-center">{{ ucfirst($header) }}</th>
                            @endforeach
                            <th class="border-b px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mutabaahs as $mutabaah)
                            <tr class="hover:bg-gray-50">
                                <td class="border-b px-4 py-3">{{ \Carbon\Carbon::parse($mutabaah->tanggal)->format('d M Y') }}</td>
                                <td class="border-b px-4 py-3">{{ $mutabaah->mahasiswa->mhs_name ?? 'Tidak ditemukan' }}</td>
                                @foreach ($headers as $key)
                                    @php $value = $mutabaah->data[$key] ?? null; @endphp
                                    <td class="border-b px-4 py-3 text-center">
                                        {{ is_bool($value) ? ($value ? '✅' : '❌') : ($value !== null ? $value : '-') }}
                                    </td>
                                @endforeach
                                <td class="border-b px-4 py-3 text-center">
                                    <form action="{{ route('musyrif.mutabaah.delete', $mutabaah->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 3 + count($headers) }}" class="text-center p-4 text-gray-500">Belum ada data mutabaah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Isi Mutabaah Massal -->
    <div id="batchEntryModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-lg max-w-4xl w-full max-h-screen overflow-y-auto">
            <div class="p-4 border-b flex justify-between items-center">
                <h3 class="text-lg font-semibold">Isi Mutabaah Massal</h3>
                <button onclick="document.getElementById('batchEntryModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <form action="{{ route('musyrif.mutabaah.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-semibold mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full border px-3 py-2 rounded" required>
                    </div>
                    
                    <div>
                        <label class="block font-semibold mb-1">Pilih Mahasiswa</label>
                        <div class="max-h-60 overflow-y-auto border rounded p-2">
                            @foreach ($mahasiswas as $mhs)
                                <div class="p-2 hover:bg-gray-50">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="mahasiswa_ids[]" value="{{ $mhs->id }}" class="mr-2">
                                        {{ $mhs->mhs_name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <h4 class="font-semibold mb-3">Data Mutabaah</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($fields as $field)
                                <div>
                                    <label class="block font-medium">{{ $field->label }}</label>
                                    @if ($field->field_type === 'boolean')
                                        <label class="inline-flex items-center mt-1">
                                            <input type="checkbox" name="data[{{ $field->field_name }}]" value="1" class="mr-2">
                                            <span>Ya</span>
                                        </label>
                                    @elseif ($field->field_type === 'text')
                                        <input type="text" name="data[{{ $field->field_name }}]" class="w-full border px-3 py-2 rounded mt-1">
                                    @elseif ($field->field_type === 'integer')
                                        <input type="number" name="data[{{ $field->field_name }}]" class="w-full border px-3 py-2 rounded mt-1">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-2 pt-2 border-t">
                        <button type="button" onclick="document.getElementById('batchEntryModal').classList.add('hidden')" class="px-4 py-2 border rounded hover:bg-gray-100 transition-colors">Batal</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors">Simpan Semua</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
