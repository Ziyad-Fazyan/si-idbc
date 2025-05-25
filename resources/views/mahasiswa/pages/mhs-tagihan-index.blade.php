@extends('base.base-dash-index')
@section('title')
    Data Tagihan Perkuliahan - Siakad By Internal Developer
@endsection
@section('menu')
    Data Tagihan Perkuliahan
@endsection
@section('submenu')
    Daftar Tagihan
@endsection
@section('urlmenu')
@endsection
@section('subdesc')
    Halaman untuk melihat Tagihan Perkuliahan
@endsection
@section('custom-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
@section('content')
    <section class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ activeTab: 'tagihan' }">

            <!-- Navigation Tabs -->
            <div class="mb-8">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <button @click="activeTab = 'tagihan'"
                            :class="activeTab === 'tagihan' ? 'border-[#0C6E71] text-[#0C6E71]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Daftar Tagihan
                    </button>
                    <button @click="activeTab = 'history'"
                            :class="activeTab === 'history' ? 'border-[#0C6E71] text-[#0C6E71]' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors duration-200">
                        Riwayat Tagihan
                    </button>
                </nav>
            </div>

            <!-- Tagihan Content -->
            <div x-show="activeTab === 'tagihan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-[#0C6E71] to-[#0a5a5d]">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-white">@yield('menu')</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Mobile Cards View -->
                        <div class="block md:hidden space-y-4">
                            @foreach ($tagihan as $key => $item)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-start">
                                            <span class="text-sm font-medium text-gray-500">Kode Tagihan</span>
                                            <span class="text-sm font-semibold text-gray-900 uppercase">{{ $item->code }}</span>
                                        </div>
                                        <div class="flex justify-between items-start">
                                            <span class="text-sm font-medium text-gray-500">Nama Tagihan</span>
                                            <span class="text-sm text-gray-900 text-right">{{ $item->name }}</span>
                                        </div>
                                        <div class="flex justify-between items-start">
                                            <span class="text-sm font-medium text-gray-500">Nominal</span>
                                            <span class="text-sm font-semibold text-gray-900">Rp. {{ number_format($item->price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm font-medium text-gray-500">Status</span>
                                            @php
                                                $status = $history
                                                    ->where('tagihan_code', $item->code)
                                                    ->where('users_id', Auth::guard('mahasiswa')->user()->id)
                                                    ->where('stat', 1)
                                                    ->first();
                                            @endphp
                                            @if ($status)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">PAID</span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">UN-PAID</span>
                                            @endif
                                        </div>
                                        <div class="pt-2">
                                            <a href="{{ route('mahasiswa.home-tagihan-view', $item->code) }}"
                                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-[#0C6E71] hover:bg-[#0a5a5d] text-white text-sm font-medium rounded-md transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                                Bayar Sekarang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Tagihan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tagihan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal Tagihan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($tagihan as $key => $item)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ ++$key }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center uppercase">{{ $item->code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $item->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-semibold">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @php
                                                    $status = $history
                                                        ->where('tagihan_code', $item->code)
                                                        ->where('users_id', Auth::guard('mahasiswa')->user()->id)
                                                        ->where('stat', 1)
                                                        ->first();
                                                @endphp
                                                @if ($status)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">PAID</span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">UN-PAID</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <a href="{{ route('mahasiswa.home-tagihan-view', $item->code) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-[#0C6E71] hover:bg-[#0a5a5d] text-white text-sm font-medium rounded-md transition-colors duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                    </svg>
                                                    Bayar Sekarang
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- History Content -->
            <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mt-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-[#FF6B35] to-[#e55a2b]">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold text-white">Riwayat Tagihan</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Mobile Cards View -->
                        <div class="block md:hidden space-y-4">
                            @foreach ($history as $key => $item)
                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-start">
                                            <span class="text-sm font-medium text-gray-500">Kode Pembayaran</span>
                                            <span class="text-sm font-semibold text-gray-900 uppercase">{{ $item->code }}</span>
                                        </div>
                                        <div class="flex justify-between items-start">
                                            <span class="text-sm font-medium text-gray-500">Kode Tagihan</span>
                                            <span class="text-sm font-semibold text-gray-900 uppercase">{{ $item->tagihan_code }}</span>
                                        </div>
                                        <div class="flex justify-between items-start">
                                            <span class="text-sm font-medium text-gray-500">Nominal Bayar</span>
                                            <span class="text-sm font-semibold text-gray-900">Rp. {{ number_format($item->tagihan->price, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="pt-2">
                                            <a href="{{ route('mahasiswa.home-tagihan-invoice', $item->code) }}"
                                               class="w-full inline-flex items-center justify-center px-4 py-2 {{ $item->stat === 1 ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} text-white text-sm font-medium rounded-md transition-colors duration-200">
                                                {{ $item->stat === 1 ? 'PAID' : 'UN-PAID' }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Pembayaran</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Tagihan</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal Bayar</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($history as $key => $item)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ ++$key }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center uppercase">{{ $item->code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center uppercase">{{ $item->tagihan_code }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-semibold">Rp. {{ number_format($item->tagihan->price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <a href="{{ route('mahasiswa.home-tagihan-invoice', $item->code) }}"
                                                   class="inline-flex items-center px-4 py-2 {{ $item->stat === 1 ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} text-white text-sm font-medium rounded-md transition-colors duration-200">
                                                    {{ $item->stat === 1 ? 'PAID' : 'UN-PAID' }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('custom-js')
    <script>
        // Fungsi untuk memperbarui tabel dengan data terbaru
        function updateTable() {
            // Kirim permintaan AJAX ke endpoint yang sesuai dengan menggunakan nama rute
            fetch('/mahasiswa/ajax/getTagihan')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Mengonversi respons menjadi JSON
                })
                .then(data => {
                    // Update logic would need to be adapted for the new structure
                    console.log('Data updated:', data);
                    // Implementation would depend on how you want to handle the dynamic updates
                    // with the new tab-based structure
                })
                .catch(error => console.error('Error:', error));
        }

        // Jalankan fungsi updateTable secara berkala setiap beberapa detik (misalnya, setiap 30 detik)
        // Increased interval to reduce server load
        setInterval(updateTable, 30000); // 30000 milidetik = 30 detik

        // Enhanced user experience with loading states
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading state for payment buttons
            const paymentButtons = document.querySelectorAll('a[href*="tagihan-view"]');
            paymentButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const originalText = this.innerHTML;
                    this.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    `;
                    this.classList.add('opacity-75', 'cursor-not-allowed');

                    // Reset button state if user navigates back
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.classList.remove('opacity-75', 'cursor-not-allowed');
                    }, 5000);
                });
            });
        });
    </script>
@endsection
