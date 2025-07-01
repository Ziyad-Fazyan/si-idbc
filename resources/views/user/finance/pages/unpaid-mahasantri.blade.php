@extends('base.base-dash-index')
@section('title')
    Mahasantri Belum Bayar Bulanan - Siakad By Internal Developer
@endsection
@section('menu')
    Mahasantri Belum Bayar Bulanan
@endsection
@section('submenu')
    Lihat
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat daftar mahasantri yang belum membayar biaya bulanan
@endsection
@section('content')
    <section class="p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800">@yield('menu')</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                Tagihan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                                Mahasantri</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode Tagihan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nominal Tagihan</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($unpaidTagihan as $key => $item)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ ++$key }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">{{ $item->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ $item->mahasiswa->mhs_name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center uppercase">{{ $item->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">Rp.
                                    {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-2 py-1 text-sm rounded-full bg-red-100 text-red-800">
                                        UNPAID
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        @if ($unpaidTagihan->isEmpty())
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">Tidak ada
                                    mahasantri yang belum membayar bulanan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
