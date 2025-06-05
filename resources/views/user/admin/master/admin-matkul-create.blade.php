@extends('base.base-dash-index')
@section('title')
    Data Master Mata Kuliah - Siakad By Internal Developer
@endsection
@section('menu')
    Data Master Mata Kuliah
@endsection
@section('submenu')
    Tambah Data Mata Kuliah
@endsection
@section('submenu0')
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Data Mata Kuliah
@endsection
@section('content')
    <section class="p-4">
        <div class="w-full">
            <form action="{{ route($prefix . 'master.matkul-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                    <div class="flex items-center justify-between p-4 border-b border-gray-200">
                        <h5 class="text-lg font-semibold text-gray-800">@yield('submenu')</h5>
                        <div class="flex space-x-2">
                            <a href="{{ route($prefix . 'master.matkul-index') }}"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#FF6B35] text-[#FF6B35] rounded-md hover:bg-[#FF6B35] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-backward"></i>
                            </a>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-3 py-2 border border-[#0C6E71] text-[#0C6E71] rounded-md hover:bg-[#0C6E71] hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Mata
                                    Kuliah</label>
                                <input type="text" name="name" id="name"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                    placeholder="Inputkan nama matakuliah...">
                                @error('name')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="code" class="block text-sm font-medium text-gray-700">Kode Mata
                                    Kuliah</label>
                                <input type="text" name="code" id="code"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                    placeholder="Inputkan kode matakuliah...">
                                @error('code')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="requ_id" class="block text-sm font-medium text-gray-700">Persyaratan Mata
                                    Kuliah</label>
                                <select name="requ_id" id="requ_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Pilih Persyaratan Mata Kuliah</option>
                                    @foreach ($matkul as $item_r)
                                        <option value="{{ $item_r->id }}">{{ $item_r->name }}</option>
                                    @endforeach
                                </select>
                                @error('requ_id')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="kuri_id" class="block text-sm font-medium text-gray-700">Kurikulum</label>
                                <select name="kuri_id" id="kuri_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Pilih Kurikulum</option>
                                    @foreach ($kuri as $item_k)
                                        <option value="{{ $item_k->id }}">{{ $item_k->name }}</option>
                                    @endforeach
                                </select>
                                @error('kuri_id')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="taka_id" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                                <select name="taka_id" id="taka_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Pilih Tahun Akademik</option>
                                    @foreach ($taka as $item_t)
                                        <option value="{{ $item_t->id }}">
                                            {{ $item_t->name . ' - ' . $item_t->semester }}</option>
                                    @endforeach
                                </select>
                                @error('taka_id')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="pstudi_id" class="block text-sm font-medium text-gray-700">Program Studi</label>
                                <select name="pstudi_id" id="pstudi_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Pilih Program Studi</option>
                                    @foreach ($pstudi as $item_p)
                                        <option value="{{ $item_p->id }}">{{ $item_p->name }}</option>
                                    @endforeach
                                </select>
                                @error('pstudi_id')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="dosen_1" class="block text-sm font-medium text-gray-700">Dosen Pengampu</label>
                                <select name="dosen_1" id="dosen_1"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Pilih Dosen Pengampu</option>
                                    @foreach ($dosen as $item_d1)
                                        <option value="{{ $item_d1->id }}">{{ $item_d1->dsn_name }}</option>
                                    @endforeach
                                </select>
                                @error('dosen_1')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="dosen_2" class="block text-sm font-medium text-gray-700">Dosen Cadangan
                                    1</label>
                                <select name="dosen_2" id="dosen_2"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Pilih Dosen Cadangan 1</option>
                                    @foreach ($dosen as $item_d2)
                                        <option value="{{ $item_d2->id }}">{{ $item_d2->dsn_name }}</option>
                                    @endforeach
                                </select>
                                @error('dosen_2')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="dosen_3" class="block text-sm font-medium text-gray-700">Dosen Cadangan
                                    2</label>
                                <select name="dosen_3" id="dosen_3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent">
                                    <option value="" selected>Pilih Dosen Cadangan 2</option>
                                    @foreach ($dosen as $item_d3)
                                        <option value="{{ $item_d3->id }}">{{ $item_d3->dsn_name }}</option>
                                    @endforeach
                                </select>
                                @error('dosen_3')
                                    <small class="text-[#FF6B35]">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-4 space-y-2">
                            <label for="desc" class="block text-sm font-medium text-gray-700">Deskripsi Mata
                                Kuliah</label>
                            <textarea name="desc" id="dark"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:border-transparent"
                                rows="5" placeholder="isikan deskripsi matakuliah ...."></textarea>
                            @error('desc')
                                <small class="text-[#FF6B35]">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('custom-js')
@endsection
