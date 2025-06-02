<div class="mb-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
        <h3 class="text-xl font-bold text-gray-800">
            <i class="fa-solid fa-chart-line text-[#0C6E71] mr-2"></i>Statistik Sekolah
        </h3>
    </div>

    <!-- Academic Community Statistics -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <!-- Student Card -->
        <a href="{{ route('web-admin.workers.student-index') }}" class="group">
            <div
                class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                <div
                    class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-user-graduate text-xl"></i>
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ \App\Models\Mahasiswa::all()->count() }}</p>
                        <p class="text-sm text-gray-600">Siswa</p>
                    </div>
                </div>
            </div>
        </a>

        <!-- Lecture Card -->
        <a href="{{ route('web-admin.workers.lecture-index') }}" class="group">
            <div
                class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                <div
                    class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-user-tie text-xl"></i>
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ \App\Models\Dosen::all()->count() }}</p>
                        <p class="text-sm text-gray-600">Guru</p>
                    </div>
                </div>
            </div>
        </a>

        <!-- Staff Card -->
        <a href="{{ route('web-admin.workers.staff-index') }}" class="group">
            <div
                class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                <div
                    class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-user-tag text-xl"></i>
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ \App\Models\User::where('type', ['1', '2', '3', '4'])->count() }}</p>
                        <p class="text-sm text-gray-600">Karyawan</p>
                    </div>
                </div>
            </div>
        </a>

        <!-- Schedule Card -->
        <a href="{{ route('web-admin.master.jadkul-index') }}" class="group">
            <div
                class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                <div
                    class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                    <div
                        class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                        <i class="fa-solid fa-book-open-reader text-xl"></i>
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ \App\Models\JadwalKuliah::all()->count() }}</p>
                        <p class="text-sm text-gray-600">Jadwal Pelajaran</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Academic Structure Statistics -->
    <div class="mb-6">
        <h4 class="text-md font-semibold text-gray-700 mb-3">
            <i class="fa-solid fa-sitemap text-[#0C6E71] mr-2"></i>Struktur Akademik
        </h4>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            <!-- Faculty Card -->
            <a href="{{ route('web-admin.master.fakultas-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-building-columns text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\Fakultas::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Fakultas</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Study Program Card -->
            <a href="{{ route('web-admin.master.pstudi-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-graduation-cap text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\ProgramStudi::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Prodi</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Class Card -->
            <a href="{{ route('web-admin.master.kelas-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-building-user text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\Kelas::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Kelas</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Course Card -->
            <a href="{{ route('web-admin.master.matkul-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-book-open text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\MataKuliah::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Mata Kuliah</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Academic Programs -->
    <div class="mb-6">
        <h4 class="text-md font-semibold text-gray-700 mb-3">
            <i class="fa-solid fa-calendar-alt text-[#0C6E71] mr-2"></i>Program Akademik
        </h4>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            <!-- Academic Year Card -->
            <a href="{{ route('web-admin.master.taka-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-calendar text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\Kurikulum::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Tahun Akademik</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Curriculum Card -->
            <a href="{{ route('web-admin.master.kurikulum-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-book text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\Kurikulum::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Kurikulum</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Study Program Card -->
            <a href="{{ route('web-admin.master.proku-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-list-ol text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\ProgramKuliah::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Program Sekolah</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Room Card -->
            <a href="{{ route('web-admin.inventory.ruang-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-house-flag text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\Ruang::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Ruangan</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Financial Overview -->
    <div class="mb-6">
        <h4 class="text-md font-semibold text-gray-700 mb-3">
            <i class="fa-solid fa-chart-pie text-[#0C6E71] mr-2"></i>Ikhtisar Keuangan
        </h4>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
            <div id="financeChart" class="w-full h-64"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            <!-- Balance Card -->
            <a href="{{ route($prefix . 'finance.keuangan-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-wallet text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">IDR
                                {{ number_format($balSekarang, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Sisa Saldo</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Pending Card -->
            <a href="{{ route($prefix . 'finance.keuangan-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#FF6B35]/10 text-[#FF6B35] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#FF6B35] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">IDR
                                {{ number_format($balPending, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Pending</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Income Card -->
            <a href="{{ route($prefix . 'finance.keuangan-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-arrow-down text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">IDR
                                {{ number_format($balIncome, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Income</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Expense Card -->
            <a href="{{ route($prefix . 'finance.keuangan-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#FF6B35]/10 text-[#FF6B35] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#FF6B35] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-arrow-up text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">IDR
                                {{ number_format($balExpense, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">Expenses</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <!-- Bill Card -->
            <a href="{{ route($prefix . 'finance.tagihan-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-file-invoice text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\TagihanKuliah::all()->count() }}</p>
                            <p class="text-sm text-gray-600">Tagihan</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Payment Card -->
            <a href="{{ route($prefix . 'finance.pembayaran-index') }}" class="group">
                <div
                    class="card bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden group-hover:border-[#FF6B35]">
                    <div
                        class="card-body p-4 flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-[#0C6E71]/10 text-[#0C6E71] rounded-full mb-3 sm:mb-0 sm:mr-4 group-hover:bg-[#0C6E71] group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                        </div>
                        <div>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ \App\Models\HistoryTagihan::where('stat', 1)->count() }}</p>
                            <p class="text-sm text-gray-600">Pembayaran</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Finance Chart
        var financeOptions = {
            series: [{
                name: 'Pendapatan',
                data: [31000, 40000, 28000, 51000, 42000, 82000, 56000]
            }, {
                name: 'Pengeluaran',
                data: [11000, 32000, 45000, 32000, 34000, 52000, 41000]
            }],
            chart: {
                height: 250,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'category',
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"]
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            },
            colors: ['#0C6E71', '#FF6B35'] // Primary and Accent colors
        };

        var financeChart = new ApexCharts(document.querySelector("#financeChart"), financeOptions);
        financeChart.render();

        // Gender Charts
        var genderMhsOptions = {
            series: [65, 35], // Example data for male/female students
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
            series: [70, 30], // Example data for male/female lecturers
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
            series: [40, 60], // Example data for male/female staff
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

        // Time Frame Selector
        document.getElementById('statsTimeFrame').addEventListener('change', function() {
            // Here you would typically make an AJAX request to get new data
            // For demo purposes, we'll just show an alert
            alert('Changing time frame to: ' + this.value);
            // In a real implementation, you would update the charts with new data
        });
    </script>
@endpush
