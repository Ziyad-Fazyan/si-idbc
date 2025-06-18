@extends('base.base-dash-index')
@section('menu')
    FeedBack Perkuliahan
@endsection
@section('submenu')
    Lihat Semua FeedBack
@endsection
@section('urlmenu')
    {{ route('dosen.akademik.jadwal-index') }}
@endsection
@section('subdesc')
    Halaman untuk melihat semua feedback dari mahasiswa
@endsection
@section('title')
    @yield('submenu') - @yield('menu') - Siakad By Internal Developer
@endsection
@section('content')
    <div class="bg-gray-50 min-h-screen py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="mb-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">@yield('menu')</h1>
                        <p class="mt-1 text-sm text-gray-600">@yield('submenu')</p>
                    </div>
                    <a href="@yield('urlmenu')" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Satisfaction Chart Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 text-center">Presentasi Kepuasan Mengajar</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div id="grafikChart" class="h-64"></div>
                        <p class="mt-2 text-xs text-gray-500 text-center">Grafik Presentasi Kepuasan Mengajar</p>
                    </div>
                </div>

                <!-- Feedback List Card -->
                <div class="bg-white overflow-hidden shadow rounded-lg lg:col-span-2">
                    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Daftar Feedback Mahasiswa</h3>
                    </div>
                    <div class="px-4 py-5 sm:p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Skor Feedback</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan Feedback</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($feedback as $key => $item)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ ++$key }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if($item->fb_score <= 2)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Tidak Puas ({{ $item->fb_score }})
                                                </span>
                                            @elseif($item->fb_score <= 3)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Cukup Puas ({{ $item->fb_score }})
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Sangat Puas ({{ $item->fb_score }})
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $item->fb_reason }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var ajaxRunning = false;

        $(document).ready(function() {
            // Fungsi untuk melakukan permintaan AJAX
            function fetchData() {
                if (ajaxRunning) return;
                ajaxRunning = true;

                $.ajax({
                    url: '{{ route('dosen.services.ajax.graphic.kepuasan-mengajar', $code) }}',
                    method: 'GET',
                    success: function(response) {
                        var options = {
                            chart: {
                                type: 'pie',
                                height: '100%',
                                animations: {
                                    enabled: true,
                                    easing: 'easeinout',
                                    speed: 800
                                }
                            },
                            series: [response.tidakpuas, response.cukuppuas, response.sangatpuas],
                            labels: ['Tidak Puas', 'Cukup Puas', 'Sangat Puas'],
                            colors: ['#EF4444', '#F59E0B', '#10B981'],
                            legend: {
                                position: 'bottom',
                                markers: {
                                    width: 12,
                                    height: 12,
                                    strokeWidth: 0,
                                    strokeColor: '#fff',
                                    radius: 12,
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                style: {
                                    fontSize: '12px',
                                    fontFamily: 'Inter, sans-serif'
                                },
                                dropShadow: {
                                    enabled: false
                                }
                            },
                            tooltip: {
                                enabled: true,
                                y: {
                                    formatter: function(value) {
                                        return value + ' mahasiswa';
                                    }
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 200
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }]
                        };

                        var chart = new ApexCharts(document.querySelector('#grafikChart'), options);
                        chart.render();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                    complete: function() {
                        ajaxRunning = false;
                    }
                });
            }

            fetchData();
        });
    </script>
@endpush