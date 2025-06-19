@extends('base.base-dash-index')
@section('title')
    Dashboard Admin - Internal Developer
@endsection
@section('menu')
    Dashboard
@endsection
@section('submenu')
    Dashboard Admin
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman dashboard admin untuk monitoring sistem
@endsection
@section('content')
    <section class="section">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Main Content Area (75% width) -->
            <div class="w-full lg:w-3/4 space-y-6">
                <!-- Role-Specific Dashboard Content -->
                <div class="card bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="card-body p-6">
                        @if (Auth::user()->raw_type == 0)
                            @include('user.admin.home-index')
                        @elseif(Auth::user()->raw_type == 1)
                            @include('user.finance.home-index')
                        @elseif(Auth::user()->raw_type == 2)
                            @include('user.absen.home-index')
                        @elseif(Auth::user()->raw_type == 3)
                            @include('user.academic.home-index')
                        @elseif(Auth::user()->raw_type == 4)
                            @include('user.musyrif.home-index')
                        @elseif(Auth::user()->raw_type == 5)
                            @include('user.support.home-index')
                        @elseif(Auth::user()->raw_type == 6)
                            @include('user.sitemanager.home-index')
                        @endif
                    </div>
                </div>
                
                <!-- Additional Content Cards Can Be Added Here -->
            </div>

            <!-- Sidebar (25% width) -->
            <div class="w-full lg:w-1/4 space-y-6">
                <!-- User Profile Card -->
                <div class="card bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="card-body p-6">
                        <div class="flex flex-col items-center text-center mb-4">
                            <div class="w-20 h-20 rounded-full bg-[#0C6E71]/10 flex items-center justify-center mb-3">
                                <i class="fa-solid fa-user text-[#0C6E71] text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-800">{{ Auth::user()->name }}</h4>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                            <div class="mt-2 px-3 py-1 bg-[#0C6E71]/10 text-[#0C6E71] text-xs font-medium rounded-full">
                                Administrator
                            </div>
                        </div>
                        <div class="border-t border-gray-200 pt-4 space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Last Login</span>
                                <span class="text-sm font-medium text-gray-800">{{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Status</span>
                                <span class="text-sm font-medium text-[#0C6E71]">Active</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gender Distribution Card -->
                <div class="card bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="card-header p-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800">Distribusi Gender</h4>
                    </div>
                    <div class="card-body p-4 space-y-4">
                        <!-- Student Gender Chart -->
                        <div>
                            <div id="genderMhsChart" class="w-full h-40"></div>
                            <p class="text-center text-xs text-gray-500 mt-2">Presentasi Gender Mahasiswa</p>
                        </div>

                        <hr class="border-gray-200">

                        <!-- Lecturer Gender Chart -->
                        <div>
                            <div id="genderDsnChart" class="w-full h-40"></div>
                            <p class="text-center text-xs text-gray-500 mt-2">Presentasi Gender Dosen</p>
                        </div>

                        <hr class="border-gray-200">

                        <!-- Staff Gender Chart -->
                        <div>
                            <div id="genderStaffChart" class="w-full h-40"></div>
                            <p class="text-center text-xs text-gray-500 mt-2">Presentasi Gender Karyawan</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Card -->
                <div class="card bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="card-header p-4 border-b border-gray-200">
                        <h4 class="text-lg font-semibold text-gray-800">Statistik Cepat</h4>
                    </div>
                    <div class="card-body p-4">
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600">Total Pengguna</span>
                                <span class="text-sm font-medium text-gray-800 bg-gray-100 px-2 py-1 rounded">{{ \App\Models\User::all()->count() }}</span>
                            </li>
                            <li class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600">Total Admin</span>
                                <span class="text-sm font-medium text-gray-800 bg-gray-100 px-2 py-1 rounded">{{ \App\Models\User::where('type', '0')->count() }}</span>
                            </li>
                            <li class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600">Total Mahasiswa</span>
                                <span class="text-sm font-medium text-gray-800 bg-gray-100 px-2 py-1 rounded">{{ \App\Models\Mahasiswa::where('mhs_stat', '1')->count() }}</span>
                            </li>
                            <li class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600">Total Dosen</span>
                                <span class="text-sm font-medium text-gray-800 bg-gray-100 px-2 py-1 rounded">{{ \App\Models\Dosen::where('dsn_stat', '1')->count() }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Initialize charts with data passed from backend
        var genderMhsOptions = {
            series: [{{ $male }}, {{ $female }}],
            chart: {
                type: 'donut',
                height: 200
            },
            labels: ['Laki-laki', 'Perempuan'],
            colors: ['#0C6E71', '#FF6B35'],
            legend: {
                position: 'bottom'
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

        var genderDsnOptions = {
            series: [{{ $dmale }}, {{ $dfemale }}],
            chart: {
                type: 'donut',
                height: 200
            },
            labels: ['Laki-laki', 'Perempuan'],
            colors: ['#0C6E71', '#FF6B35'],
            legend: {
                position: 'bottom'
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

        var genderStaffOptions = {
            series: [{{ $umale }}, {{ $ufemale }}],
            chart: {
                type: 'donut',
                height: 200
            },
            labels: ['Laki-laki', 'Perempuan'],
            colors: ['#0C6E71', '#FF6B35'],
            legend: {
                position: 'bottom'
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

        var genderMhsChart = new ApexCharts(document.querySelector("#genderMhsChart"), genderMhsOptions);
        genderMhsChart.render();

        var genderDsnChart = new ApexCharts(document.querySelector("#genderDsnChart"), genderDsnOptions);
        genderDsnChart.render();

        var genderStaffChart = new ApexCharts(document.querySelector("#genderStaffChart"), genderStaffOptions);
        genderStaffChart.render();
    </script>
@endpush
