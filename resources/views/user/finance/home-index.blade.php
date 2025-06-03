<div class="container mx-auto px-4">
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
                            {{ \App\Models\uAttendance::where('absen_approve', 1)->count() }}<br>
                            Approval
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Example of modal toggle functionality
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>
@endpush
