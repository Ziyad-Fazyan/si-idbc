@extends('base.base-dash-index')
@section('title')
    Data Tagihan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Tagihan
@endsection
@section('submenu')
    Lihat
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat data tagihan
@endsection
@section('custom-css')
    <style>
        @media (max-width: 768px) {
            .card-body {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .icon {
                margin: 10px 0;
            }

            .text-putih {
                margin-left: 0px !important;
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
@endsection
@section('content')
<section class="px-4 py-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        <a href="{{ route($prefix . 'finance.tagihan-index') }}" class="bg-white border border-[#0C6E71] rounded-lg shadow p-4 hover:bg-[#0C6E71] hover:text-white transition">
            <div class="flex items-center justify-around">
                <span class="text-4xl text-[#0C6E71] group-hover:text-white"><i class="fa-solid fa-file-invoice"></i></span>
                <span class="text-center text-base font-medium">{{ \App\Models\TagihanKuliah::all()->count() }}<br>Tagihan</span>
            </div>
        </a>
        <a href="{{ route($prefix . 'finance.pembayaran-index') }}" class="bg-white border border-[#0C6E71] rounded-lg shadow p-4 hover:bg-[#0C6E71] hover:text-white transition">
            <div class="flex items-center justify-around">
                <span class="text-4xl text-[#0C6E71] group-hover:text-white"><i class="fa-solid fa-file-invoice-dollar"></i></span>
                <span class="text-center text-base font-medium">{{ \App\Models\HistoryTagihan::where('stat', 1)->count() }}<br>Pembayaran</span>
            </div>
        </a>
        <a href="{{ route($prefix . 'finance.keuangan-index') }}" class="bg-white border border-[#0C6E71] rounded-lg shadow p-4 hover:bg-[#0C6E71] hover:text-white transition">
            <div class="flex items-center justify-around">
                <span class="text-4xl text-[#0C6E71] group-hover:text-white"><i class="fa-solid fa-dollar"></i></span>
                <span class="text-center text-base font-medium">{{ number_format($income, 0, ',', '.') }}<br>Income (IDR)</span>
            </div>
        </a>
    </div>

    <div class="bg-white shadow rounded-lg mt-6">
        <div class="flex justify-between items-center p-4 border-b">
            <h2 class="text-xl font-semibold">@yield('menu')</h2>
            <a href="{{ route($prefix . 'finance.tagihan-create') }}" class="bg-[#0C6E71] text-white px-4 py-2 rounded hover:bg-[#0b5f63] transition">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        <div class="p-4 overflow-x-auto">
            <table class="min-w-full text-sm text-center">
                <thead>
                    <tr class="bg-[#0C6E71] text-white">
                        <th class="p-2">#</th>
                        <th class="p-2">Kode Tagihan</th>
                        <th class="p-2">Nama Tagihan</th>
                        <th class="p-2">Type Tagihan</th>
                        <th class="p-2">Tagihan</th>
                        <th class="p-2">Nominal</th>
                        <th class="p-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tagihan as $key => $item)
                        <tr class="border-t">
                            <td class="p-2">{{ ++$key }}</td>
                            <td class="p-2 uppercase">{{ $item->code }}</td>
                            <td class="p-2">{{ $item->name }}</td>
                            <td class="p-2">
                                @if ($item->proku_id > 0)
                                    Type Global
                                @elseif($item->prodi_id > 0 || $item->users_id > 0)
                                    Type Pribadi
                                @endif
                            </td>
                            <td class="p-2">
                                @if ($item->proku_id !== 0 && $item->prokuu)
                                    Program Kuliah<br>{{ $item->prokuu->name }}
                                @elseif($item->prodi_id !== 0 && $item->prodi)
                                    Program Studi<br>{{ $item->prodi->name }}
                                @elseif($item->users_id !== 0 && $item->mahasiswa)
                                    Mahasiswa<br>{{ $item->mahasiswa->mhs_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="p-2">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="p-2 flex justify-center space-x-2">
                                <button onclick="document.getElementById('modal-{{ $item->code }}').classList.remove('hidden')" class="bg-blue-500 text-white px-2 py-1 rounded"><i class="fas fa-edit"></i></button>
                                <form id="delete-form-{{ $item->code }}" action="{{ route($prefix . 'finance.tagihan-destroy', $item->code) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div id="modal-{{ $item->code }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                            <div class="bg-white rounded-lg w-11/12 max-w-3xl p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-semibold">Edit Tagihan - {{ $item->name }}</h3>
                                    <button onclick="document.getElementById('modal-{{ $item->code }}').classList.add('hidden')" class="text-red-500 text-xl">&times;</button>
                                </div>
                                <form action="{{ route($prefix . 'finance.tagihan-update', $item->code) }}" method="POST">
                                    @method('patch')
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block mb-1">Nama Tagihan</label>
                                            <input type="text" name="name" value="{{ $item->name }}" class="w-full border rounded px-3 py-2">
                                        </div>
                                        <div>
                                            <label class="block mb-1">Nominal Tagihan</label>
                                            <input type="text" name="price" value="{{ $item->price }}" class="w-full border rounded px-3 py-2">
                                        </div>
                                        <div>
                                            <label class="block mb-1">Tagihan Mahasiswa</label>
                                            <select name="users_id" class="w-full border rounded px-3 py-2">
                                                <option value="0">Pilih Mahasiswa</option>
                                                @foreach ($mahasiswa as $mhs)
                                                    <option value="{{ $mhs->id }}" {{ $item->users_id == $mhs->id ? 'selected' : '' }}>{{ $mhs->mhs_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block mb-1">Tagihan Program Studi</label>
                                            <select name="prodi_id" class="w-full border rounded px-3 py-2">
                                                <option value="0">Pilih Program Studi</option>
                                                @foreach ($prodi as $prd)
                                                    <option value="{{ $prd->id }}" {{ $item->prodi_id == $prd->id ? 'selected' : '' }}>{{ $prd->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block mb-1">Tagihan Program Kuliah</label>
                                            <select name="proku_id" class="w-full border rounded px-3 py-2">
                                                <option value="0">Pilih Program Kuliah</option>
                                                @foreach ($proku as $prk)
                                                    <option value="{{ $prk->id }}" {{ $item->proku_id == $prk->id ? 'selected' : '' }}>{{ $prk->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mt-4 flex justify-end space-x-2">
                                        <button type="submit" class="bg-[#0C6E71] text-white px-4 py-2 rounded">Update</button>
                                        <button type="button" onclick="document.getElementById('modal-{{ $item->code }}').classList.add('hidden')" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
