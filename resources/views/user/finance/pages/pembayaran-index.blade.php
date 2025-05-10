@extends('base.base-dash-index')
@section('title')
    Data Riwayat Pembayaran - Siakad By Internal Developer
@endsection
@section('menu')
    Data Riwayat Pembayaran
@endsection
@section('submenu')
    Lihat
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat data riwayat pembayaran
@endsection
@section('content')
    <section class="p-4">
        <div class="grid grid-cols-1 gap-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Statistic Card 1 -->
                <a href="{{ route($prefix . 'finance.tagihan-index') }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 group-hover:shadow-lg">
                        <div class="p-4 flex flex-col md:flex-row items-center justify-between">
                            <div class="text-[#0C6E71] mb-4 md:mb-0">
                                <i class="fa-solid fa-file-invoice text-4xl"></i>
                            </div>
                            <div class="text-center md:text-right">
                                <p class="text-2xl font-bold">{{ \App\Models\TagihanKuliah::all()->count() }}</p>
                                <p class="text-gray-600">Tagihan</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Statistic Card 2 -->
                <a href="{{ route($prefix . 'finance.pembayaran-index') }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 group-hover:shadow-lg">
                        <div class="p-4 flex flex-col md:flex-row items-center justify-between">
                            <div class="text-[#FF6B35] mb-4 md:mb-0">
                                <i class="fa-solid fa-file-invoice-dollar text-4xl"></i>
                            </div>
                            <div class="text-center md:text-right">
                                <p class="text-2xl font-bold">{{ \App\Models\HistoryTagihan::where('stat', 1)->count() }}</p>
                                <p class="text-gray-600">Pembayaran</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Statistic Card 3 -->
                <a href="{{ route('web-admin.workers.student-index') }}" class="group">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 group-hover:shadow-lg">
                        <div class="p-4 flex flex-col md:flex-row items-center justify-between">
                            <div class="text-[#0C6E71] mb-4 md:mb-0">
                                <i class="fa-solid fa-dollar text-4xl"></i>
                            </div>
                            <div class="text-center md:text-right">
                                <p class="text-2xl font-bold">{{ number_format($income, 0, ',', '.') }}</p>
                                <p class="text-gray-600">Income (IDR)</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Payment History Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('menu')</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Pembayaran</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Tagihan</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal Bayar</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Tagihan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($history as $key => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ ++$key }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->users->mhs_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center uppercase">{{ $item->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center uppercase">{{ $item->tagihan_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">Rp. {{ number_format($item->tagihan->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <span class="px-2 py-1 text-sm rounded-full {{ $item->stat === 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $item->stat === 1 ? 'PAID' : 'UN-PAID' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Add any interactive functionality here if needed
    document.addEventListener('DOMContentLoaded', function() {
        // You can add Alpine.js components or vanilla JS here
        // For example, to handle modal interactions if we add them later
    });
</script>
@endpush