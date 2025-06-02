<div class="sidebar-menu">
    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">Menu Publikasi</li>
    <li
        class="list-none {{ Route::is($prefix . 'system.notify-index', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
        <a href="{{ route($prefix . 'system.notify-index') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
            <i class="fa-solid fa-bell w-5 text-center mr-3"></i>
            <span>Data Pemberitahuan</span>
        </a>
    </li>

    <!-- Dropdown Menu -->
    <li class="list-none {{ Route::is($prefix . 'news.*', request()->path()) ? 'border-l-3 border-green-600' : '' }}">
        <button type="button"
            class="flex items-center justify-between w-full px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 focus:outline-none"
            onclick="toggleSubmenu(this)">
            <div class="flex items-center">
                <i class="fa-solid fa-newspaper w-5 text-center mr-3"></i>
                <span>Data Berita</span>
            </div>
            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
        </button>
        <ul class="pl-12 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
            <li
                class="{{ Route::is($prefix . 'news.post-*', request()->path()) ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'news.post-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Berita</a>
            </li>
            <li
                class="{{ Route::is($prefix . 'news.category-*', request()->path()) ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'news.category-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Kategori
                    Berita</a>
            </li>
        </ul>
    </li>

    <li
        class="list-none {{ Route::is($prefix . 'publish.album-index', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
        <a href="{{ route($prefix . 'publish.album-index') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
            <i class="fa-solid fa-images w-5 text-center mr-3"></i>
            <span>Data Album Foto</span>
        </a>
    </li>
    <li
        class="list-none {{ Route::is($prefix . 'document-index', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
        <a href="{{ route($prefix . 'document-index') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
            <i class="fa-solid fa-file-pdf w-5 text-center mr-3"></i>
            <span>Data Document</span>
        </a>
    </li>

    <!-- Financial Menu Section -->
    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">Menu Finansial
    </li>

    <!-- Financial Data Dropdown -->
    @php
        $financeActive = Str::startsWith(request()->path(), 'web-admin/finance');
    @endphp
    <li class="list-none">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $financeActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-finance">
            <div class="flex items-center">
                <i class="fa-solid fa-vault w-5 text-center mr-3"></i>
                <span>Data Keuangan</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-finance" class="dropdown-menu pl-12 mt-1 space-y-1 {{ $financeActive ? '' : 'hidden' }}">
            <li
                class="{{ Route::is('web-admin.finance.tagihan-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.finance.tagihan-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Tagihan</a>
            </li>
            <li
                class="{{ Route::is('web-admin.finance.pembayaran-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.finance.pembayaran-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Pembayaran</a>
            </li>
            <li
                class="{{ Route::is('web-admin.finance.keuangan-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.finance.keuangan-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Keuangan</a>
            </li>
        </ul>
    </li>

    <!-- Approval Data Dropdown -->
    @php
        $approvalActive = Str::startsWith(request()->path(), 'web-admin/approval');
    @endphp
    <li class="list-none mt-1">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $approvalActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-approval">
            <div class="flex items-center">
                <i class="fa-solid fa-file-signature w-5 text-center mr-3"></i>
                <span>Data Approval</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-approval" class="dropdown-menu pl-12 mt-1 space-y-1 {{ $approvalActive ? '' : 'hidden' }}">
            <li
                class="{{ Route::is($prefix . 'approval.absen-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'approval.absen-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Approval
                    Absensi</a>
            </li>
        </ul>
    </li>

    <!-- Information Center Menu Section -->
    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">Menu Pusat
        Informasi</li>

    <!-- User Data Dropdown -->
    @php
        $penggunaActive = Str::startsWith(request()->path(), 'web-admin/workers');
    @endphp
    <li class="list-none">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $penggunaActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-pengguna">
            <div class="flex items-center">
                <i class="fa-solid fa-users w-5 text-center mr-3"></i>
                <span>Data Pengguna</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-pengguna" class="dropdown-menu pl-12 mt-1 space-y-1 {{ $penggunaActive ? '' : 'hidden' }}">
            <li
                class="{{ Route::is('web-admin.workers.admin-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.workers.admin-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Admin</a>
            </li>
            <li
                class="{{ Route::is('web-admin.workers.staff-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.workers.staff-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Pegawai</a>
            </li>
            <li
                class="{{ Route::is('web-admin.workers.lecture-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.workers.lecture-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Dosen</a>
            </li>
            <li
                class="{{ Route::is('web-admin.workers.student-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.workers.student-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Mahasiswa</a>
            </li>
        </ul>
    </li>

    <!-- Academic Data Dropdown -->
    @php
        $akademikActive =
            Route::is('web-admin.master.taka-*') ||
            Route::is('web-admin.master.fakultas-*') ||
            Route::is('web-admin.master.pstudi-*');
    @endphp
    <li class="list-none mt-1">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $akademikActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-akademik">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data Akademik</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-akademik" class="dropdown-menu pl-12 mt-1 space-y-1 {{ $akademikActive ? '' : 'hidden' }}">
            <li
                class="{{ Route::is('web-admin.master.taka-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.taka-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Tahun Akademik</a>
            </li>
            <li
                class="{{ Route::is('web-admin.master.fakultas-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.fakultas-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Fakultas</a>
            </li>
            <li
                class="{{ Route::is('web-admin.master.pstudi-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.pstudi-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Program Studi</a>
            </li>
        </ul>
    </li>

    <!-- PMB Data Dropdown -->
    @php $pmbActive = Route::is('web-admin.master.proku-*'); @endphp
    <li class="list-none mt-1">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $pmbActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-pmb">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data PMB</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-pmb" class="dropdown-menu pl-12 mt-1 space-y-1 {{ $pmbActive ? '' : 'hidden' }}">
            <li
                class="{{ Route::is('web-admin.master.proku-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.proku-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Program Kuliah</a>
            </li>
        </ul>
    </li>

    <!-- KBM Data Dropdown -->
    @php
        $kbmActive =
            Route::is('web-admin.master.kurikulum-*') ||
            Route::is('web-admin.master.kelas-*') ||
            Route::is('web-admin.master.matkul-*') ||
            Route::is('web-admin.master.jadkul-*');
    @endphp
    <li class="list-none mt-1">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $kbmActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-kbm">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data KBM</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-kbm" class="dropdown-menu pl-12 mt-1 space-y-1 {{ $kbmActive ? '' : 'hidden' }}">
            <li
                class="{{ Route::is('web-admin.master.kurikulum-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.kurikulum-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Kurikulum</a>
            </li>
            <li
                class="{{ Route::is('web-admin.master.kelas-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.kelas-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Kelas</a>
            </li>
            <li
                class="{{ Route::is('web-admin.master.matkul-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.matkul-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Mata Kuliah</a>
            </li>
            <li
                class="{{ Route::is('web-admin.master.jadkul-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.jadkul-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Jadwal Kuliah</a>
            </li>
        </ul>
    </li>

    <!-- Inventory Data Dropdown -->
    @php $inventoryActive = Str::startsWith(request()->path(), 'web-admin/inventory'); @endphp
    <li class="list-none mt-1">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $inventoryActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-inventory">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data Inventaris</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-inventory"
            class="dropdown-menu pl-12 mt-1 space-y-1 {{ $inventoryActive ? '' : 'hidden' }}">
            <li
                class="{{ Route::is('web-admin.inventory.gedung-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.inventory.gedung-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Gedung</a>
            </li>
            <li
                class="{{ Route::is('web-admin.inventory.ruang-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.inventory.ruang-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Ruangan</a>
            </li>
            <li
                class="{{ Route::is('web-admin.inventory.perolehan-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.inventory.perolehan-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Perolehan</a>
            </li>
            <li
                class="{{ Route::is('web-admin.inventory.lokasi-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.inventory.lokasi-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Lokasi</a>
            </li>
        </ul>
    </li>
</div>

<style>
    /* Dropdown Animation Styles */
    .dropdown-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        padding-left: 0.5rem;
    }

    .dropdown-menu:not(.hidden) {
        max-height: 500px;
        transition: max-height 0.3s ease-in;
    }

    .dropdown-toggle .fa-chevron-down {
        transition: transform 0.3s ease;
    }

    .dropdown-toggle.active .fa-chevron-down {
        transform: rotate(180deg);
    }

    /* Active state for dropdown parent when child is active */
    .list-none.active {
        border-left: 3px solid #059669;
        background-color: #f0fdf4;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle dropdown toggle clicks
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetDropdown = document.getElementById(targetId);
                const icon = this.querySelector('.fa-chevron-down');

                // Toggle dropdown visibility
                targetDropdown.classList.toggle('hidden');

                // Toggle icon rotation
                if (targetDropdown.classList.contains('hidden')) {
                    icon.classList.remove('rotate-180');
                    this.classList.remove('active');
                } else {
                    icon.classList.add('rotate-180');
                    this.classList.add('active');
                }
            });
        });

        // Auto-expand dropdown if it contains active item
        const activeDropdownItems = document.querySelectorAll('.dropdown-menu li.bg-green-50');

        activeDropdownItems.forEach(item => {
            const parentDropdown = item.closest('.dropdown-menu');
            if (parentDropdown) {
                parentDropdown.classList.remove('hidden');
                const toggle = document.querySelector(
                    `.dropdown-toggle[data-target="${parentDropdown.id}"]`);
                if (toggle) {
                    toggle.querySelector('.fa-chevron-down').classList.add('rotate-180');
                    toggle.classList.add('active');
                }
            }
        });
    });
</script>
