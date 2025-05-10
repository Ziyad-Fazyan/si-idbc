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

            .text-white {
                margin-left: 0px !important;
                /* Mengatur margin-left menjadi 0 */
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="min-h-screen bg-[#F3EFEA] p-4 md:p-6">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Left Column - Cards -->
                <div class="w-full lg:w-3/4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Jadwal Mengajar Card -->
                        <a href="{{ route('dosen.akademik.jadwal-index') }}" class="group">
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 transform group-hover:scale-[1.02] border border-[#0C6E71] hover:border-[#FF6B35]">
                                <div class="p-4 flex items-center justify-between">
                                    <div
                                        class="w-12 h-12 flex items-center justify-center rounded-full bg-[#0C6E71] text-white group-hover:bg-[#FF6B35] transition-colors duration-300">
                                        <i class="fa-solid fa-calendar text-2xl"></i>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[#2E2E2E] font-medium">Jadwal Mengajar</p>
                                        <p class="text-[#0C6E71] font-bold text-xl">
                                            {{ \App\Models\JadwalKuliah::where('dosen_id', Auth::guard('dosen')->user()->id)->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Feedback Card -->
                        <a href="{{ route('dosen.akademik.jadwal-index') }}" class="group">
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 transform group-hover:scale-[1.02] border border-[#0C6E71] hover:border-[#FF6B35]">
                                <div class="p-4 flex items-center justify-between">
                                    <div
                                        class="w-12 h-12 flex items-center justify-center rounded-full bg-[#0C6E71] text-white group-hover:bg-[#FF6B35] transition-colors duration-300">
                                        <i class="fa-solid fa-star text-2xl"></i>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[#2E2E2E] font-medium">FeedBack</p>
                                        <p class="text-[#0C6E71] font-bold text-xl">{{ $feedback->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Right Column - Announcements -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-[#0C6E71] px-4 py-3">
                            <h3 class="text-white font-semibold">Pengumuman - {{ \Carbon\Carbon::now()->format('d M Y') }}
                            </h3>
                        </div>
                        <div class="p-4">
                            @forelse ($notify as $item)
                                <div class="mb-3 pb-3 border-b border-[#E4E2DE] last:border-0 last:mb-0 last:pb-0">
                                    <p class="text-sm text-[#3B3B3B]">
                                        {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y - H.i') }}
                                    </p>
                                    <a href="#"
                                        class="text-[#0C6E71] hover:text-[#FF6B35] font-medium transition-colors duration-200"
                                        onclick="openModal('modal-{{ $item->code }}')">
                                        {{ $item->name }}
                                    </a>
                                </div>
                            @empty
                                <p class="text-[#3B3B3B] italic">Tidak Ada Pengumuman Hari Ini</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Satisfaction Chart -->
            <div class="mt-6 w-full lg:w-2/5">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-[#0C6E71] px-4 py-3">
                        <h3 class="text-white font-semibold text-center">Presentasi Kepuasan Mengajar</h3>
                    </div>
                    <div class="p-4">
                        <div id="grafikChart" class="h-64"></div>
                        <p class="text-center text-sm text-[#3B3B3B] mt-2">
                            Grafik Presentasi Kepuasan Mengajar
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals -->
        @foreach ($notify as $item)
            <div id="modal-{{ $item->code }}" class="fixed inset-0 z-50 hidden overflow-y-auto"
                aria-labelledby="modal-title-{{ $item->code }}" aria-modal="true" role="dialog">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- Background overlay -->
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                        onclick="closeModal('modal-{{ $item->code }}')"></div>

                    <!-- Modal panel -->
                    <div
                        class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-[#0C6E71] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" class="text-white hover:text-[#FF6B35] focus:outline-none"
                                onclick="closeModal('modal-{{ $item->code }}')">
                                <i class="fas fa-times"></i>
                            </button>
                            <h3 class="text-lg leading-6 font-medium text-white mr-4" id="modal-title-{{ $item->code }}">
                                Notifikasi - {{ $item->name }}
                            </h3>
                        </div>
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h4 class="text-lg font-medium text-[#2E2E2E] text-center mb-4">{{ $item->name }}
                                    </h4>
                                    <div class="mt-2 text-[#3B3B3B] prose max-w-none">
                                        {!! $item->desc !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-[#E4E2DE] px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-[#0C6E71] shadow-sm px-4 py-2 bg-white text-[#0C6E71] font-medium hover:bg-[#0C6E71] hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF6B35] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200"
                                onclick="closeModal('modal-{{ $item->code }}')">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <script>
        // Modal handling with pure JavaScript
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside content
        document.addEventListener('DOMContentLoaded', function() {
            const modals = document.querySelectorAll('[aria-modal="true"]');
            modals.forEach(modal => {
                modal.addEventListener('click', function(e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }
                });
            });
        });
    </script>
@endsection
@section('custom-js')
    <script>
        var ajaxRunning = false;

        $(document).ready(function() {
            // Fungsi untuk melakukan permintaan AJAX
            function fetchData() {
                // Jika sedang berjalan, hentikan fungsi
                if (ajaxRunning) {
                    return;
                }

                ajaxRunning = true;

                $.ajax({
                    url: '{{ route('dosen.services.ajax.graphic.kepuasan-mengajar-dosen') }}',
                    method: 'GET',
                    success: function(response) {
                        var tidakPuasCount = response.tidakpuas;
                        var cukupPuasCount = response.cukuppuas;
                        var sangatPuasCount = response.sangatpuas;

                        var options = {
                            chart: {
                                type: 'pie',
                            },
                            series: [tidakPuasCount, cukupPuasCount, sangatPuasCount],
                            labels: ['Tidak Puas', 'Cukup Puas', 'Sangat Puas'],
                            legend: {
                                position: 'bottom'
                            }
                        };

                        var chart = new ApexCharts(document.querySelector('#grafikChart'), options);
                        chart.render();

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                    complete: function() {
                        ajaxRunning = false; // Setelah permintaan selesai, set status menjadi false
                    }
                });
            }

            // Panggil fungsi untuk pertama kalinya
            fetchData();
        });
    </script>
@endsection
