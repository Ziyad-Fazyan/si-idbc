@extends('base.base-dash-index')
@section('title')
    SIAKAD PT - Internal Developer
@endsection
@section('menu')
    Contoh Menu
@endsection
@section('submenu')
    Contoh SubMenu
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Contoh Deskripsi Menu
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
                /* Mengatur margin-left menjadi 0 */
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="min-h-screen p-4 bg-gray-50">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Cards Section -->
                <div class="w-full lg:w-3/4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Tagihan Card -->
                    <a href="{{ route('mahasiswa.home-tagihan-index') }}" class="group">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-green-100 group-hover:border-teal-700 transition-all duration-300">
                            <div class="p-4 flex items-center">
                                <div class="bg-teal-100 p-3 rounded-full text-teal-700 mr-4">
                                    <i class="fa-solid fa-file-invoice-dollar text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-medium text-lg">{{ number_format($sisatagihan, 0, ',', '.') }}</p>
                                    <p class="text-gray-600 text-sm">Tagihan (IDR)</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Pembayaran Card -->
                    <a href="{{ route('mahasiswa.home-tagihan-index') }}" class="group">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-green-100 group-hover:border-teal-700 transition-all duration-300">
                            <div class="p-4 flex items-center">
                                <div class="bg-orange-100 p-3 rounded-full text-orange-600 mr-4">
                                    <i class="fa-solid fa-money-bill-transfer text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-medium text-lg">{{ number_format($history, 0, ',', '.') }}</p>
                                    <p class="text-gray-600 text-sm">Pembayaran (IDR)</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Absen Card -->
                    <a href="{{ route('mahasiswa.home-jadkul-index') }}" class="group">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-green-100 group-hover:border-teal-700 transition-all duration-300">
                            <div class="p-4 flex items-center">
                                <div class="bg-blue-100 p-3 rounded-full text-blue-600 mr-4">
                                    <i class="fa-solid fa-user-check text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-medium text-lg">{{ $habsen }}</p>
                                    <p class="text-gray-600 text-sm">Absen Kehadiran</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Jadwal Card -->
                    <a href="{{ route('mahasiswa.home-jadkul-index') }}" class="group">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-green-100 group-hover:border-teal-700 transition-all duration-300">
                            <div class="p-4 flex items-center">
                                <div class="bg-purple-100 p-3 rounded-full text-purple-600 mr-4">
                                    <i class="fa-solid fa-book-open-reader text-2xl"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 font-medium text-lg">{{ $jadkul }}</p>
                                    <p class="text-gray-600 text-sm">Jadwal Perkuliahan</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Pengumuman Section -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-teal-700 px-4 py-3">
                            <h3 class="text-white font-semibold">Pengumuman - {{ \Carbon\Carbon::now()->format('d M Y') }}</h3>
                        </div>
                        <div class="p-4">
                            @forelse ($notify as $item)
                                <div class="mb-3 pb-3 border-b border-gray-100 last:border-0 last:mb-0 last:pb-0">
                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y - H.i') }}
                                    </p>
                                    <button onclick="openModal('{{ $item->code }}')" 
                                            class="text-teal-700 hover:text-orange-600 font-medium mt-1 transition-colors duration-200">
                                        {{ $item->name }}
                                    </button>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">Tidak ada pengumuman hari ini</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Template -->
    @foreach ($notify as $item)
        <div id="modal-{{ $item->code }}" 
             class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-800">Notifikasi - {{ $item->name }}</h3>
                    <button onclick="closeModal('{{ $item->code }}')" 
                            class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="mb-4 text-center">
                        <h4 class="font-bold text-gray-800 mb-2">{{ $item->name }}</h4>
                        <div class="text-gray-700 text-left prose max-w-none">
                            {!! $item->desc !!}
                        </div>
                    </div>
                </div>
                <div class="flex justify-end px-6 py-4 border-t border-gray-200">
                    <button onclick="closeModal('{{ $item->code }}')" 
                            class="px-4 py-2 bg-teal-700 text-white rounded hover:bg-teal-800 transition-colors duration-200">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function openModal(code) {
            const modal = document.getElementById(modal-${code});
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(code) {
            const modal = document.getElementById(modal-${code});
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[id^="modal-"]').forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        const code = modal.id.split('-')[1];
                        closeModal(code);
                    }
                });
            });
        });
    </script>
@endsection
