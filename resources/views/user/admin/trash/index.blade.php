@extends('base.base-dash-index')
@section('title')
    Manajemen Data Terhapus - Siakad By Internal Developer
@endsection
@section('menu')
    Manajemen Data Terhapus
@endsection
@section('submenu')
    Daftar Model
@endsection
@section('urlmenu')
    {{ route('web-admin.trash.index') }}
@endsection
@section('subdesc')
    Halaman untuk mengelola data yang telah dihapus (soft delete)
@endsection
@section('content')
    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
        <h2 class="text-xl font-semibold mb-6 text-gray-800">Daftar Model dengan Soft Delete</h2>

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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($models as $modelKey => $modelName)
                <div class="border rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200">
                    <h3 class="text-lg font-medium mb-2">{{ $modelName }}</h3>
                    <a href="{{ route('web-admin.trash.show', $modelKey) }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-eye mr-2"></i> Lihat Data Terhapus
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection