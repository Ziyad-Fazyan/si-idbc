<!-- Filter Section -->
<div class="card mb-4" id="filterSection">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="mb-0">
                <i class="fas fa-filter me-2"></i>Filter Data Komoditas
            </h6>
            <button type="button" class="btn btn-sm btn-outline-secondary" id="toggleFilter">
                <i class="fas fa-chevron-up" id="filterIcon"></i>
            </button>
        </div>
    </div>

    <div class="card-body" id="filterBody">
        <form method="GET" action="{{ route('admin.commodities.index') }}" id="filterForm">
            <div class="row g-3">
                <!-- Search -->
                <div class="col-md-6 col-lg-4">
                    <label class="form-label">Pencarian</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text"
                               class="form-control"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Nama, Kode, Brand, Material...">
                    </div>
                </div>

                <!-- Location Filter -->
                <div class="col-md-6 col-lg-4">
                    <label class="form-label">Lokasi</label>
                    <select class="form-select" name="commodity_location_id">
                        <option value="">Semua Lokasi</option>
                        @foreach($commodityLocations as $location)
                            <option value="{{ $location->id }}"
                                    {{ request('commodity_location_id') == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Acquisition Filter -->
                <div class="col-md-6 col-lg-4">
                    <label class="form-label">Cara Akuisisi</label>
                    <select class="form-select" name="commodity_acquisition_id">
                        <option value="">Semua Akuisisi</option>
                        @foreach($commodityAcquisitions as $acquisition)
                            <option value="{{ $acquisition->id }}"
                                    {{ request('commodity_acquisition_id') == $acquisition->id ? 'selected' : '' }}>
                                {{ $acquisition->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Condition Filter -->
                <div class="col-md-6 col-lg-4">
                    <label class="form-label">Kondisi</label>
                    <select class="form-select" name="condition">
                        <option value="">Semua Kondisi</option>
                        @foreach($filterOptions['conditions'] as $key => $condition)
                            <option value="{{ $key }}"
                                    {{ request('condition') == $key ? 'selected' : '' }}>
                                {{ $condition }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Brand Filter -->
                <div class="col-md-6 col-lg-4">
                    <label class="form-label">Brand</label>
                    <select class="form-select" name="brand">
                        <option value="">Semua Brand</option>
                        @foreach($filterOptions['brands'] as $brand)
                            <option value="{{ $brand }}"
                                    {{ request('brand') == $brand ? 'selected' : '' }}>
                                {{ $brand }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Material Filter -->
                <div class="col-md-6 col-lg-4">
                    <label class="form-label">Material</label>
                    <select class="form-select" name="material">
                        <option value="">Semua Material</option>
                        @foreach($filterOptions['materials'] as $material)
                            <option value="{{ $material }}"
                                    {{ request('material') == $material ? 'selected' : '' }}>
                                {{ $material }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Advanced Filters (Collapsible) -->
            <div class="mt-3">
                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="collapse" data-bs-target="#advancedFilters">
                    <i class="fas fa-cog me-1"></i>Filter Lanjutan
                </button>
            </div>

            <div class="collapse mt-3" id="advancedFilters">
                <div class="row g-3">
                    <!-- Year Range -->
                    <div class="col-md-6">
                        <label class="form-label">Tahun Pembelian</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <select class="form-select form-select-sm" name="year_from">
                                    <option value="">Dari Tahun</option>
                                    @foreach($filterOptions['years'] as $year)
                                        <option value="{{ $year }}"
                                                {{ request('year_from') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select form-select-sm" name="year_to">
                                    <option value="">Sampai Tahun</option>
                                    @foreach($filterOptions['years'] as $year)
                                        <option value="{{ $year }}"
                                                {{ request('year_to') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="col-md-6">
                        <label class="form-label">Range Harga</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number"
                                       class="form-control form-control-sm"
                                       name="price_from"
                                       value="{{ request('price_from') }}"
                                       placeholder="Harga Min">
                            </div>
                            <div class="col-6">
                                <input type="number"
                                       class="form-control form-control-sm"
                                       name="price_to"
                                       value="{{ request('price_to') }}"
                                       placeholder="Harga Max">
                            </div>
                        </div>
                    </div>

                    <!-- Quantity Range -->
                    <div class="col-md-6">
                        <label class="form-label">Range Kuantitas</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="number"
                                       class="form-control form-control-sm"
                                       name="quantity_from"
                                       value="{{ request('quantity_from') }}"
                                       placeholder="Qty Min">
                            </div>
                            <div class="col-6">
                                <input type="number"
                                       class="form-control form-control-sm"
                                       name="quantity_to"
                                       value="{{ request('quantity_to') }}"
                                       placeholder="Qty Max">
                            </div>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="col-md-6">
                        <label class="form-label">Urutkan Berdasarkan</label>
                        <div class="row g-2">
                            <div class="col-8">
                                <select class="form-select form-select-sm" name="sort_by">
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Tanggal Input</option>
                                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama</option>
                                    <option value="item_code" {{ request('sort_by') == 'item_code' ? 'selected' : '' }}>Kode Item</option>
                                    <option value="brand" {{ request('sort_by') == 'brand' ? 'selected' : '' }}>Brand</option>
                                    <option value="year_of_purchase" {{ request('sort_by') == 'year_of_purchase' ? 'selected' : '' }}>Tahun Beli</option>
                                    <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
                                    <option value="quantity" {{ request('sort_by') == 'quantity' ? 'selected' : '' }}>Kuantitas</option>
                                    <option value="condition" {{ request('sort_by') == 'condition' ? 'selected' : '' }}>Kondisi</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-select form-select-sm" name="sort_order">
                                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Turun</option>
                                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Naik</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter Actions -->
            <div class="mt-3 pt-3 border-top">
                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search me-1"></i>Terapkan Filter
                    </button>
                    <a href="{{ route($prefix . 'inventory.barang-index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-times me-1"></i>Reset Filter
                    </a>
                    <button type="button" class="btn btn-outline-success btn-sm" id="exportBtn">
                        <i class="fas fa-download me-1"></i>Export Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Filter Summary (if filters are active) -->
@if(request()->anyFilled(['search', 'commodity_location_id', 'commodity_acquisition_id', 'condition', 'brand', 'material', 'year_from', 'year_to', 'price_from', 'price_to', 'quantity_from', 'quantity_to']))
<div class="alert alert-info">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-info-circle me-2"></i>
            <strong>Filter Aktif:</strong>
            @if(request('search'))
                <span class="badge bg-primary me-1">Pencarian: {{ request('search') }}</span>
            @endif
            @if(request('commodity_location_id'))
                <span class="badge bg-success me-1">Lokasi: {{ $commodityLocations->find(request('commodity_location_id'))->name ?? '' }}</span>
            @endif
            @if(request('condition'))
                <span class="badge bg-warning me-1">Kondisi: {{ $filterOptions['conditions'][request('condition')] ?? '' }}</span>
            @endif
            @if(request('brand'))
                <span class="badge bg-info me-1">Brand: {{ request('brand') }}</span>
            @endif
            <!-- Add more active filter badges as needed -->
        </div>
        <a href="{{ route('admin.commodities.index') }}" class="btn btn-sm btn-outline-secondary">
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
            if (filterBody.style.display === 'none') {
                filterBody.style.display = 'block';
                filterIcon.className = 'fas fa-chevron-up';
            } else {
                filterBody.style.display = 'none';
                filterIcon.className = 'fas fa-chevron-down';
            }
        });
    }

    // Auto submit form on filter change (optional)
    const filterForm = document.getElementById('filterForm');
    const autoSubmitElements = filterForm.querySelectorAll('select[name="commodity_location_id"], select[name="commodity_acquisition_id"], select[name="condition"]');

    autoSubmitElements.forEach(element => {
        element.addEventListener('change', function() {
            // Add small delay to prevent multiple rapid submissions
            setTimeout(() => {
                filterForm.submit();
            }, 100);
        });
    });

    // Export functionality
    const exportBtn = document.getElementById('exportBtn');
    if (exportBtn) {
        exportBtn.addEventListener('click', function() {
            const form = document.getElementById('filterForm');
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);

            // Create export URL with current filters
            const exportUrl = '{{ route("admin.commodities.export") }}?' + params.toString();
            window.open(exportUrl, '_blank');
        });
    }
});
</script>
