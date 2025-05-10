@extends('base.base-dash-index')
@section('menu')
    Data Keuangan
@endsection
@section('submenu')
    Data Keuangan Kampus
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Daftar Pemasukan dan Pengeluaran Kampus
@endsection
@section('content')
    <section class="grid grid-cols-1 gap-4">
        <div class="col-span-1">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="col-span-1">
                    <a href="#">
                        <div class="card bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="card-body p-4 flex flex-col md:flex-row items-center justify-center md:justify-between">
                                <div class="icon mb-4 md:mb-0 md:mr-6">
                                    <i class="fa-solid fa-wallet text-4xl text-green-600"></i>
                                </div>
                                <div class="text-center md:text-left">
                                    <p class="text-lg font-semibold">{{ number_format($balSekarang, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-600">Balance (IDR)</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a href="#">
                        <div class="card bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="card-body p-4 flex flex-col md:flex-row items-center justify-center md:justify-between">
                                <div class="icon mb-4 md:mb-0 md:mr-6">
                                    <i class="fa-solid fa-file-invoice-dollar text-4xl text-yellow-600"></i>
                                </div>
                                <div class="text-center md:text-left">
                                    <p class="text-lg font-semibold">{{ number_format($balPending, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-600">Pending (IDR)</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a href="#">
                        <div class="card bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="card-body p-4 flex flex-col md:flex-row items-center justify-center md:justify-between">
                                <div class="icon mb-4 md:mb-0 md:mr-6">
                                    <i class="fa-solid fa-dollar text-4xl text-blue-600"></i>
                                </div>
                                <div class="text-center md:text-left">
                                    <p class="text-lg font-semibold">{{ number_format($balIncome, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-600">Income (IDR)</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-span-1">
                    <a href="#">
                        <div class="card bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="card-body p-4 flex flex-col md:flex-row items-center justify-center md:justify-between">
                                <div class="icon mb-4 md:mb-0 md:mr-6">
                                    <i class="fa-solid fa-dollar text-4xl text-red-600"></i>
                                </div>
                                <div class="text-center md:text-left">
                                    <p class="text-lg font-semibold">{{ number_format($balExpense, 0, ',', '.') }}</p>
                                    <p class="text-sm text-gray-600">Expenses (IDR)</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="col-span-1">
                <form action="{{ route($prefix . 'finance.keuangan-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card bg-white rounded-lg shadow-md">
                        <div class="card-header p-4 border-b flex justify-between items-center">
                            <h5 class="text-lg font-semibold">Tambah @yield('menu')</h5>
                            <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group mb-4">
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type Keuangan</label>
                                <select name="type" id="type" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="" selected>Pilih Type Keuangan</option>
                                    <option value="0">Balance Pending</option>
                                    <option value="1">Balance Income</option>
                                    <option value="2">Balance Expenses</option>
                                </select>
                                @error('type')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Nominal Balance</label>
                                <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    name="value" id="value" placeholder="Inputkan nominal balance...">
                                @error('value')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Balance</label>
                                <textarea name="desc" id="desc" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    rows="4" placeholder="Inputkan deskripsi sumber dana..."></textarea>
                                @error('desc')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="col-span-2">
                <div class="card bg-white rounded-lg shadow-md">
                    <div class="card-header p-4 border-b">
                        <h5 class="text-lg font-semibold">@yield('menu')</h5>
                    </div>
                    <div class="card-body p-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Balance Value</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Balance Type</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Balance Desc</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Button</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($balance as $key => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ ++$key }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if ($item->author_id != 0)
                                                {{ $item->author->name }}
                                            @else
                                                <span class="inline-block bg-red-500 text-white px-2 py-1 rounded text-xs">By Sistem</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->value }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if ($item->raw_type == 0)
                                                <span class="inline-block bg-yellow-500 text-white px-2 py-1 rounded text-xs">{{ $item->type }}</span>
                                            @elseif($item->raw_type == 1)
                                                <span class="inline-block bg-green-500 text-white px-2 py-1 rounded text-xs">{{ $item->type }}</span>
                                            @elseif($item->raw_type == 2)
                                                <span class="inline-block bg-red-500 text-white px-2 py-1 rounded text-xs">{{ $item->type }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->desc }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex justify-center space-x-2">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#updateFakultas{{ $item->code }}" 
                                                    class="btn bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form id="delete-form-{{ $item->code }}" action="{{ route($prefix . 'finance.keuangan-destroy', $item->code) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="deleteData('{{ $item->code }}')" 
                                                        class="btn bg-red-500 hover:bg-red-600 text-white p-2 rounded" 
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @foreach ($balance as $item)
        <form action="{{ route($prefix . 'finance.keuangan-update', $item->code) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="modal fade fixed inset-0 z-50 overflow-y-auto" id="updateFakultas{{ $item->code }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered relative w-auto max-w-3xl mx-auto my-8">
                    <div class="modal-content bg-white rounded-lg shadow-xl">
                        <div class="modal-header flex justify-between items-center p-4 border-b">
                            <h4 class="text-xl font-semibold">Edit Fakultas - {{ $item->name }}</h4>
                            <div class="flex space-x-2">
                                <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <button type="button" class="btn bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded" data-bs-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-body p-6">
                            <div class="form-group mb-4">
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type Keuangan</label>
                                <select name="type" id="type" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="" selected>Pilih Type Keuangan</option>
                                    <option value="0" {{ $item->raw_type == 0 ? 'selected' : '' }}>Balance Pending</option>
                                    <option value="1" {{ $item->raw_type == 1 ? 'selected' : '' }}>Balance Income</option>
                                    <option value="2" {{ $item->raw_type == 2 ? 'selected' : '' }}>Balance Expenses</option>
                                </select>
                                @error('type')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="value" class="block text-sm font-medium text-gray-700 mb-1">Nominal Balance</label>
                                <input type="text" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    name="value" id="value" value="{{ $item->value }}" placeholder="Inputkan nominal balance...">
                                @error('value')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Balance</label>
                                <textarea name="desc" id="desc" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                    rows="4" placeholder="Inputkan deskripsi sumber dana...">{{ $item->desc }}</textarea>
                                @error('desc')
                                    <small class="text-red-500 text-sm">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
@endsection