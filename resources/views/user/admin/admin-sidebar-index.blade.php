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
    <li class="list-none sidebar-item has-sub {{ Route::is($prefix . 'news.*', request()->path()) ? 'active border-l-3 border-green-600' : '' }}">
        <button type="button"
            class="flex items-center justify-between w-full px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 focus:outline-none"
            onclick="toggleSubmenu(this)">
            <div class="flex items-center">
                <i class="fa-solid fa-newspaper w-5 text-center mr-3"></i>
                <span>Data Berita</span>
            </div>
            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
        </button>
        <ul class="submenu pl-12 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
            <li class="submenu-item {{ Route::is($prefix . 'news.post-*', request()->path()) ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'news.post-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Berita</a>
            </li>
            <li class="submenu-item {{ Route::is($prefix . 'news.category-*', request()->path()) ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
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
    <li class="list-none sidebar-item has-sub {{ $financeActive ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $financeActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-finance">
            <div class="flex items-center">
                <i class="fa-solid fa-vault w-5 text-center mr-3"></i>
                <span>Data Keuangan</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-finance" class="submenu pl-12 mt-1 space-y-1 {{ $financeActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is('web-admin.finance.tagihan-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.finance.tagihan-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Tagihan</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.finance.pembayaran-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.finance.pembayaran-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Pembayaran</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.finance.keuangan-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
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
    <li class="list-none sidebar-item has-sub mt-1 {{ $approvalActive ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $approvalActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-approval">
            <div class="flex items-center">
                <i class="fa-solid fa-file-signature w-5 text-center mr-3"></i>
                <span>Data Approval</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-approval" class="submenu pl-12 mt-1 space-y-1 {{ $approvalActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is($prefix . 'approval.absen-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
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
    <li class="list-none sidebar-item has-sub {{ $penggunaActive ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $penggunaActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-pengguna">
            <div class="flex items-center">
                <i class="fa-solid fa-users w-5 text-center mr-3"></i>
                <span>Data Pengguna</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-pengguna" class="submenu pl-12 mt-1 space-y-1 {{ $penggunaActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is('web-admin.workers.admin-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.workers.admin-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Admin</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.workers.staff-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.workers.staff-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Pegawai</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.workers.lecture-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.workers.lecture-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Dosen</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.workers.student-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
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
            Route::is('web-admin.mahasiswa-health*') ||
            Route::is('web-admin.master.pstudi-*');
    @endphp
    <li class="list-none sidebar-item has-sub mt-1 {{ $akademikActive ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $akademikActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-akademik">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data Akademik</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-akademik" class="submenu pl-12 mt-1 space-y-1 {{ $akademikActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is('web-admin.master.taka-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.taka-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Tahun Akademik</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.master.fakultas-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.fakultas-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Fakultas</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.master.pstudi-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.pstudi-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Program Studi</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.mahasiswa-health*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.mahasiswa-health.index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Detail Mahasiswa</a>
            </li>
        </ul>
    </li>

    <!-- PMB Data Dropdown -->
    @php $pmbActive = Route::is('web-admin.master.proku-*'); @endphp
    <li class="list-none sidebar-item has-sub mt-1 {{ $pmbActive ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $pmbActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-pmb">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data PMB</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-pmb" class="submenu pl-12 mt-1 space-y-1 {{ $pmbActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is('web-admin.master.proku-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
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
    <li class="list-none sidebar-item has-sub mt-1 {{ $kbmActive ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $kbmActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-kbm">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data KBM</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-kbm" class="submenu pl-12 mt-1 space-y-1 {{ $kbmActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is('web-admin.master.kurikulum-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.kurikulum-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Kurikulum</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.master.kelas-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.kelas-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Kelas</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.master.matkul-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.matkul-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Mata Kuliah</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.master.jadkul-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.master.jadkul-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Jadwal Kuliah</a>
            </li>
        </ul>
    </li>

    <!-- Inventory Data Dropdown -->
    @php $inventoryActive = Str::startsWith(request()->path(), 'web-admin/inventory'); @endphp
    <li class="list-none sidebar-item has-sub mt-1 {{ $inventoryActive ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $inventoryActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-inventory">
            <div class="flex items-center">
                <i class="fa-solid fa-boxes-stacked w-5 text-center mr-3"></i>
                <span>Data Inventaris</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-inventory"
            class="submenu pl-12 mt-1 space-y-1 {{ $inventoryActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is($prefix . 'inventory.gedung-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'inventory.gedung-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Gedung</a>
            </li>
            <li class="submenu-item {{ Route::is($prefix . 'inventory.ruang-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'inventory.ruang-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Ruangan</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.inventory.perolehan-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.inventory.perolehan-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Perolehan</a>
            </li>
            <li class="submenu-item {{ Route::is('web-admin.inventory.barang-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('web-admin.inventory.barang-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Barang</a>
            </li>
        </ul>
    </li>
</div>

<style>
    /* Sidebar Menu Styles */
    .sidebar-menu {
        @apply w-full;
    }
    
    /* Dropdown Animation Styles */
    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out, opacity 0.2s ease-out;
        opacity: 0;
    }

    .submenu.open {
        max-height: 500px;
        opacity: 1;
        transition: max-height 0.5s ease-in, opacity 0.3s ease-in;
    }

    .dropdown-toggle .fa-chevron-down {
        transition: transform 0.3s ease;
    }

    .dropdown-toggle.active .fa-chevron-down {
        transform: rotate(180deg);
    }

    /* Active state for dropdown parent when child is active */
    .sidebar-item.active > .dropdown-toggle {
        @apply bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold;
    }
    
    /* Hover effects */
    .sidebar-item:hover .fa-chevron-down {
        @apply text-green-600;
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
                const parentItem = this.closest('.sidebar-item');

                // Toggle dropdown visibility with smooth animation
                if (!targetDropdown.classList.contains('open')) {
                    // Close all other open dropdowns first
                    document.querySelectorAll('.submenu.open').forEach(openMenu => {
                        if (openMenu.id !== targetId) {
                            const menuToggle = document.querySelector(`.dropdown-toggle[data-target="${openMenu.id}"]`);
                            const menuIcon = menuToggle?.querySelector('.fa-chevron-down');
                            const menuParent = menuToggle?.closest('.sidebar-item');
                            
                            openMenu.style.maxHeight = '0px';
                            openMenu.classList.remove('open');
                            setTimeout(() => { openMenu.classList.add('hidden'); }, 300);
                            
                            if (menuIcon) menuIcon.classList.remove('rotate-180');
                            if (menuToggle) menuToggle.classList.remove('active');
                            if (menuParent && !menuParent.querySelector('.submenu-item.active')) {
                                menuParent.classList.remove('active');
                            }
                        }
                    });
                    
                    // Open this dropdown
                    targetDropdown.classList.add('open');
                    targetDropdown.classList.remove('hidden');
                    targetDropdown.style.maxHeight = targetDropdown.scrollHeight + 'px';
                    icon.classList.add('rotate-180');
                    this.classList.add('active');
                    if (parentItem) parentItem.classList.add('active');
                } else {
                    // Close this dropdown
                    targetDropdown.style.maxHeight = '0px';
                    icon.classList.remove('rotate-180');
                    this.classList.remove('active');
                    setTimeout(() => {
                        targetDropdown.classList.remove('open');
                        targetDropdown.classList.add('hidden');
                    }, 300);
                    
                    // Only remove active class from parent if no active items inside
                    if (parentItem && !parentItem.querySelector('.submenu-item.active')) {
                        parentItem.classList.remove('active');
                    }
                }
            });
        });

        // Auto-expand dropdown if it contains active item
        const activeDropdownItems = document.querySelectorAll('.submenu-item.active, .submenu .bg-green-50');

        activeDropdownItems.forEach(item => {
            const parentDropdown = item.closest('.submenu');
            if (parentDropdown) {
                parentDropdown.classList.remove('hidden');
                parentDropdown.classList.add('open');
                parentDropdown.style.maxHeight = parentDropdown.scrollHeight + 'px';
                
                const toggle = document.querySelector(`.dropdown-toggle[data-target="${parentDropdown.id}"]`);
                if (toggle) {
                    toggle.querySelector('.fa-chevron-down').classList.add('rotate-180');
                    toggle.classList.add('active');
                    const parentItem = toggle.closest('.sidebar-item');
                    if (parentItem) parentItem.classList.add('active');
                }
            }
        });
    });
</script>
