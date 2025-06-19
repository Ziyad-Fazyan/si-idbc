<div class="container mx-auto px-4">
    <h4 class="text-md font-semibold text-gray-700 mb-3">
        <i class="fa-solid fa-chart-pie text-[#0C6E71] mr-2"></i>Ikhtisar Keuangan
    </h4>
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-4">
        <div id="financeChart" class="w-full h-64"></div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="mb-4">
            <a href="{{ route($prefix . 'finance.keuangan-index') }}">
                <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                            <i class="fa-solid fa-wallet"></i>
                        </span>
                        <span class="text-[#0C6E71] text-sm text-right">
                            {{ number_format($balSekarang, 0, ',', '.') }}<br>
                            Sisa Saldo <br>( IDR )
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="mb-4">
            <a href="{{ route($prefix . 'finance.keuangan-index') }}">
                <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </span>
                        <span class="text-[#0C6E71] text-sm text-right">
                            {{ number_format($balPending, 0, ',', '.') }}<br>
                            Pending <br>( IDR )
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="mb-4">
            <a href="{{ route($prefix . 'finance.keuangan-index') }}">
                <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                            <i class="fa-solid fa-dollar"></i>
                        </span>
                        <span class="text-[#0C6E71] text-sm text-right">
                            {{ number_format($balIncome, 0, ',', '.') }}<br>
                            Income <br>( IDR )
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="mb-4">
            <a href="{{ route($prefix . 'finance.keuangan-index') }}">
                <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                            <i class="fa-solid fa-dollar"></i>
                        </span>
                        <span class="text-[#0C6E71] text-sm text-right">
                            {{ number_format($balExpense, 0, ',', '.') }}<br>
                            Expenses <br>( IDR )
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="mb-4">
            <a href="{{ route($prefix . 'finance.tagihan-index') }}">
                <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                            <i class="fa-solid fa-file-invoice"></i>
                        </span>
                        <span class="text-[#0C6E71] text-sm text-right">
                            {{ \App\Models\TagihanKuliah::all()->count() }}<br>
                            Tagihan
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="mb-4">
            <a href="{{ route($prefix . 'finance.pembayaran-index') }}">
                <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </span>
                        <span class="text-[#0C6E71] text-sm text-right">
                            {{ \App\Models\HistoryTagihan::where('stat', 1)->count() }}<br>
                            Pembayaran
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="mb-4">
            <a href="{{ route($prefix . 'finance.pembayaran-index') }}">
                <div class="card bg-white border border-[#0C6E71] rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <span class="icon text-[#0C6E71]" style="font-size: 42px;">
                            <i class="fa-solid fa-person-circle-question"></i>
                        </span>
                        <span class="text-[#0C6E71] text-sm text-right">
                            {{ \App\Models\UAttendance::where('absen_approve', 1)->count() }}<br>
                            Approval
                        </span>
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
                data: @json($financeIncome)
            }, {
                name: 'Pengeluaran',
                data: @json($financeExpense)
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
                categories: @json($financeMonths)
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
        // Example of modal toggle functionality
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
@endpush
