@extends('base.base-dash-index')
@section('title')
    Data Terhapus {{ $modelName }} - Siakad By Internal Developer
@endsection
@section('menu')
    Manajemen Data Terhapus
@endsection
@section('submenu')
    {{ $modelName }}
@endsection
@section('urlmenu')
    {{ route('web-admin.trash.index') }}
@endsection
@section('subdesc')
    Halaman untuk mengelola data {{ $modelName }} yang telah dihapus (soft delete)
@endsection
@section('content')
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Data Terhapus - {{ $modelName }}</h2>
            <div class="flex space-x-2">
                <a href="{{ route('web-admin.trash.restore-all', $model) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors duration-200"
                   onclick="return confirm('Apakah Anda yakin ingin memulihkan semua data {{ $modelName }}?')">
                    <i class="fas fa-trash-restore mr-2"></i> Pulihkan Semua
                </a>
                <a href="{{ route('web-admin.trash.empty', $model) }}" 
                   class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors duration-200"
                   onclick="return confirm('PERHATIAN! Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus permanen semua data {{ $modelName }}?')">
                    <i class="fas fa-trash-alt mr-2"></i> Hapus Permanen Semua
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if($items->isEmpty())
            <div class="bg-gray-100 p-6 rounded-lg text-center">
                <p class="text-gray-600">Tidak ada data {{ $modelName }} yang dihapus.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Nama/Kode</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Dihapus Pada</th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($items as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-500">{{ $item->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-800">
                                    @if(isset($item->name))
                                        {{ $item->name }}
                                    @elseif(isset($item->code))
                                        {{ $item->code }}
                                    @elseif(isset($item->title))
                                        {{ $item->title }}
                                    @elseif(isset($item->mhs_name))
                                        {{ $item->mhs_name }}
                                    @elseif(isset($item->dsn_name))
                                        {{ $item->dsn_name }}
                                    @else
                                        ID: {{ $item->id }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 text-gray-500">{{ $item->deleted_at->format('d M Y H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm leading-5 font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('web-admin.trash.restore', [$model, $item->id]) }}" 
                                           class="text-green-600 hover:text-green-900 transition-colors duration-200"
                                           onclick="return confirm('Apakah Anda yakin ingin memulihkan data ini?')">
                                            <i class="fas fa-trash-restore"></i> Pulihkan
                                        </a>
                                        <a href="{{ route('web-admin.trash.force-delete', [$model, $item->id]) }}" 
                                           class="text-red-600 hover:text-red-900 transition-colors duration-200"
                                           onclick="return confirm('PERHATIAN! Tindakan ini tidak dapat dibatalkan. Apakah Anda yakin ingin menghapus permanen data ini?')">
                                            <i class="fas fa-trash-alt"></i> Hapus Permanen
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('web-admin.trash.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Model
            </a>
        </div>
    </div>
@endsection