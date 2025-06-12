<div class="bg-white shadow-md rounded-lg mb-4" id="filterSection">
    <div class="p-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h6 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-filter mr-2"></i>Filter Data Komoditas
            </h6>
            <button type="button" class="text-gray-600 hover:text-gray-900 focus:outline-none" id="toggleFilter">
                <i class="fas fa-chevron-up" id="filterIcon"></i>
            </button>
        </div>
    </div>

    <div class="p-4" id="filterBody">
        <form method="GET" action="{{ route($prefix . 'inventory.barang-index') }}" id="filterForm">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text"
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Nama, Kode...">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                    <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="ruang_id">
                        <option value="">Semua Lokasi</option>
                        @foreach($ruangs as $ruang)
                            <option value="{{ $ruang->id }}"
                                    {{ request('ruang_id') == $ruang->id ? 'selected' : '' }}>
                                {{ $ruang->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cara Akuisisi</label>
                    <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="commodity_acquisition_id">
                        <option value="">Semua Akuisisi</option>
                        @foreach($commodityAcquisitions as $acquisition)
                            <option value="{{ $acquisition->id }}"
                                    {{ request('commodity_acquisition_id') == $acquisition->id ? 'selected' : '' }}>
                                {{ $acquisition->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                    <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="condition">
                        <option value="">Semua Kondisi</option>
                        @foreach($filterOptions['conditions'] as $key => $condition)
                            <option value="{{ $key }}"
                                    {{ request('condition') == $key ? 'selected' : '' }}>
                                {{ $condition }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tahun</label>
                    <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="year_from">
                        <option value="">Semua Tahun</option>
                        @foreach($filterOptions['years'] as $year)
                            <option value="{{ $year }}"
                                    {{ request('year_from') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tahun</label>
                    <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="year_to">
                        <option value="">Semua Tahun</option>
                        @foreach($filterOptions['years'] as $year)
                            <option value="{{ $year }}"
                                    {{ request('year_to') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutkan Berdasarkan</label>
                    <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="sort_by">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Tanggal Input</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama</option>
                        <option value="item_code" {{ request('sort_by') == 'item_code' ? 'selected' : '' }}>Kode Item</option>
                        <option value="year_of_purchase" {{ request('sort_by') == 'year_of_purchase' ? 'selected' : '' }}>Tahun Beli</option>
                        <option value="condition" {{ request('sort_by') == 'condition' ? 'selected' : '' }}>Kondisi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <select class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="sort_order">
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Turun</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Naik</option>
                    </select>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex flex-wrap gap-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-search mr-1"></i>Terapkan Filter
                    </button>
                    <a href="{{ route($prefix . 'inventory.barang-index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-times mr-1"></i>Reset Filter
                    </a>
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" id="exportBtn">
                        <i class="fas fa-download mr-1"></i>Export Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@if(request()->anyFilled(['search', 'ruang_id', 'commodity_acquisition_id', 'condition', 'brand', 'material', 'year_from', 'year_to', 'price_from', 'price_to', 'quantity_from', 'quantity_to']))
<div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
    <div class="flex justify-between items-center">
        <div>
            <i class="fas fa-info-circle mr-2"></i>
            <strong class="font-bold">Filter Aktif:</strong>
            @if(request('search'))
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500 text-white mr-1">Pencarian: {{ request('search') }}</span>
            @endif
            @if(request('ruang_id'))
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-500 text-white mr-1">Lokasi: {{ $ruangs->find(request('ruang_id'))->name ?? '' }}</span>
            @endif
            @if(request('condition'))
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-500 text-white mr-1">Kondisi: {{ $filterOptions['conditions'][request('condition')] ?? '' }}</span>
            @endif
            @if(request('brand'))
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-500 text-white mr-1">Brand: {{ request('brand') }}</span>
            @endif
            </div>
        <a href="{{ route($prefix . 'inventory.barang-index') }}" class="text-blue-700 hover:text-blue-900 focus:outline-none">
            <i class="fas fa-times"></i>
        </a>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle filter visibility
    const toggleBtn = document.getElementById('toggleFilter');
    const filterBody = document.getElementById('filterBody');
    const filterIcon = document.getElementById('filterIcon');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function() {
            // Toggle hidden class to show/hide the filter body
            filterBody.classList.toggle('hidden');

            // Change icon based on visibility
            if (filterBody.classList.contains('hidden')) {
                filterIcon.className = 'fas fa-chevron-down';
            } else {
                filterIcon.className = 'fas fa-chevron-up';
            }
        });

        // Set initial state based on filterBody visibility
        // If filterBody is hidden by default (e.g., via a 'hidden' class from PHP or initial state)
        // ensure the icon reflects that. For this example, we assume it's initially visible.
        // If you want it hidden by default, add `hidden` class to filterBody in HTML:
        // <div class="p-4 hidden" id="filterBody">
        if (filterBody.classList.contains('hidden')) {
            filterIcon.className = 'fas fa-chevron-down';
        } else {
            filterIcon.className = 'fas fa-chevron-up';
        }
    }

    // Get filter form
    const filterForm = document.getElementById('filterForm');

    // Export functionality
    const exportBtn = document.getElementById('exportBtn');
    if (exportBtn) {
        exportBtn.addEventListener('click', function() {
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            // Create export URL with current filters
            const exportUrl = '{{ route($prefix . "inventory.barang-export") }}?' + params.toString();
            window.open(exportUrl, '_blank');
        });
    }
});
</script>
