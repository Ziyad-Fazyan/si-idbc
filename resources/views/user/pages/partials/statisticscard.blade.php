        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Hadir Card -->
            <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="block">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 card-hover">
                    <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-between">
                        <div class="text-[#0C6E71] mb-4 sm:mb-0">
                            <i class="fa-solid fa-clock text-4xl"></i>
                        </div>
                        <div class="text-center sm:text-right">
                            <div class="text-2xl font-bold text-gray-800">{{ $hadir->count() }}</div>
                            <div class="text-sm text-gray-600">Hadir</div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Izin & Cuti Card -->
            <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="block">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 card-hover">
                    <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-between">
                        <div class="text-[#FF6B35] mb-4 sm:mb-0">
                            <i class="fa-solid fa-clock text-4xl"></i>
                        </div>
                        <div class="text-center sm:text-right">
                            <div class="text-2xl font-bold text-gray-800">{{ $izin->count() }}</div>
                            <div class="text-sm text-gray-600">Izin & Cuti</div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Terlambat Card -->
            <a href="{{ route($prefix . 'presensi.absen-harian') }}" class="block">
                <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 card-hover">
                    <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-between">
                        <div class="text-red-500 mb-4 sm:mb-0">
                            <i class="fa-solid fa-clock text-4xl"></i>
                        </div>
                        <div class="text-center sm:text-right">
                            <div class="text-2xl font-bold text-gray-800">{{ $terlambat->count() }}</div>
                            <div class="text-sm text-gray-600">Terlambat</div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Total Absensi Card -->
            <div class="bg-[#0C6E71] rounded-lg shadow-md p-6 card-hover">
                <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-between">
                    <div class="text-white mb-4 sm:mb-0">
                        <i class="fa-solid fa-chart-bar text-4xl"></i>
                    </div>
                    <div class="text-center sm:text-right text-white">
                        <div class="text-2xl font-bold">{{ $hadir->count() + $izin->count() + $terlambat->count() }}</div>
                        <div class="text-sm opacity-90">Total Absensi</div>
                    </div>
                </div>
            </div>
        </div>
