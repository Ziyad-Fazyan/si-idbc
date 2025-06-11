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
                                                <button onclick="openModal('updateFakultas{{ $item->code }}')" 
                                                    class="btn bg-blue-500 hover:bg-blue-600 text-white p-2 rounded">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <form id="delete-form-{{ $item->code }}" action="{{ route($prefix . 'finance.keuangan-destroy', $item->code) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="openModal('deleteModal{{ $item->code }}')" 
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
            <div class="hidden fixed inset-0 z-50 overflow-y-auto" id="updateFakultas{{ $item->code }}">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75" onclick="closeModal('updateFakultas{{ $item->code }}')"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                                            Edit Balance - {{ $item->code }}
                                        </h3>
                                        <button type="button" onclick="closeModal('updateFakultas{{ $item->code }}')" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Close</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
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
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Update
                            </button>
                            <button type="button" onclick="closeModal('updateFakultas{{ $item->code }}')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
    <!-- Modal untuk konfirmasi delete -->
    @foreach ($balance as $item)
        <div class="hidden fixed inset-0 z-50 overflow-y-auto" id="deleteModal{{ $item->code }}">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75" onclick="closeModal('deleteModal{{ $item->code }}')"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Konfirmasi Hapus
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <form id="delete-form-{{ $item->code }}" action="{{ route($prefix . 'finance.keuangan-destroy', $item->code) }}" method="POST" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Hapus
                            </button>
                        </form>
                        <button type="button" onclick="closeModal('deleteModal{{ $item->code }}')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('script')
<script>
    // Modal Management
    function handleModal(modalId, action) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        const body = document.body;

        if (action === 'open') {
            modal.classList.remove('hidden');
            body.style.overflow = 'hidden';
        } else {
            modal.classList.add('hidden');
            body.style.overflow = 'auto';
        }
    }

    function openModal(modalId) {
        handleModal(modalId, 'open');
    }

    function closeModal(modalId) {
        handleModal(modalId, 'close');
    }

    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        const isHidden = modal.classList.contains('hidden');
        handleModal(modalId, isHidden ? 'open' : 'close');
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('[id^="updateFakultas"]');
        modals.forEach(modal => {
            if (event.target === modal) {
                handleModal(modal.id, 'close');
            }
        });
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const visibleModal = document.querySelector('[id^="updateFakultas"]:not(.hidden)');
            if (visibleModal) {
                handleModal(visibleModal.id, 'close');
            }
        }
    });

    function deleteData(code) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            document.getElementById('delete-form-' + code).submit();
        }
    }
</script>
@endpush