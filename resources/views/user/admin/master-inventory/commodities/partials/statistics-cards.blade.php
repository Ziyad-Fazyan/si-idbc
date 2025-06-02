<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Barang Card -->
    <div class="group relative bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl border border-blue-200/50 overflow-hidden hover:shadow-lg hover:shadow-blue-500/10 transition-all duration-300 hover:-translate-y-1">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-transparent"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-blue-500/10 rounded-lg group-hover:bg-blue-500/20 transition-colors duration-300">
                            <i class="fas fa-boxes text-lg text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wider">Total Barang</h4>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalItems }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-blue-500/5 rounded-full flex items-center justify-center group-hover:bg-blue-500/10 transition-colors duration-300">
                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kondisi Baik Card -->
    <div class="group relative bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-xl border border-emerald-200/50 overflow-hidden hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-300 hover:-translate-y-1">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-transparent"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-emerald-500/10 rounded-lg group-hover:bg-emerald-500/20 transition-colors duration-300">
                            <i class="fas fa-check-circle text-lg text-emerald-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wider">Kondisi Baik</h4>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $goodCondition }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-emerald-500/5 rounded-full flex items-center justify-center group-hover:bg-emerald-500/10 transition-colors duration-300">
                    <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kondisi Rusak Ringan Card -->
    <div class="group relative bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-xl border border-amber-200/50 overflow-hidden hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-300 hover:-translate-y-1">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-amber-500/10 rounded-lg group-hover:bg-amber-500/20 transition-colors duration-300">
                            <i class="fas fa-exclamation-circle text-lg text-amber-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wider">Rusak Ringan</h4>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $minorDamage }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-amber-500/5 rounded-full flex items-center justify-center group-hover:bg-amber-500/10 transition-colors duration-300">
                    <div class="w-2 h-2 bg-amber-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kondisi Rusak Berat Card -->
    <div class="group relative bg-gradient-to-br from-red-50 to-red-100/50 rounded-xl border border-red-200/50 overflow-hidden hover:shadow-lg hover:shadow-red-500/10 transition-all duration-300 hover:-translate-y-1">
        <div class="absolute inset-0 bg-gradient-to-br from-red-500/5 to-transparent"></div>
        <div class="relative p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-3">
                        <div class="p-2.5 bg-red-500/10 rounded-lg group-hover:bg-red-500/20 transition-colors duration-300">
                            <i class="fas fa-times-circle text-lg text-red-600"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-600 uppercase tracking-wider">Rusak Berat</h4>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $heavyDamage }}</p>
                        </div>
                    </div>
                </div>
                <div class="w-12 h-12 bg-red-500/5 rounded-full flex items-center justify-center group-hover:bg-red-500/10 transition-colors duration-300">
                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>
</div>
