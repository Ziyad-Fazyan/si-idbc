@php
    $prefix = $prefix ?? 'academic.';
@endphp

<div class="sidebar-menu">
    <!-- Academic Menu Section -->
    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">Menu Akademik</li>

    <!-- Student Data -->
    <li class="list-none sidebar-item {{ Route::is($prefix . 'workers.student-*') ? 'active' : '' }}">
        <a href="{{ route($prefix . 'workers.student-index') }}"
            class='sidebar-link flex items-center px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 {{ Route::is($prefix . 'workers.student-*') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}'>
            <i class="fa-solid fa-users w-5 text-center mr-3"></i>
            <span>Data Mahasiswa</span>
        </a>
    </li>

    <!-- Academic Data Dropdown -->
    @php
        $akademikActive =
            Route::is('academic.master.taka-*') ||
            Route::is('academic.master.fakultas-*') ||
            Route::is('academic.mahasiswa-health*') ||
            Route::is('academic.master.pstudi-*');
    @endphp
    <li class="list-none sidebar-item has-sub {{ $akademikActive ? 'active' : '' }} mt-1">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $akademikActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-akademik">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data Akademik</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-akademik" class="submenu pl-12 mt-1 space-y-1 {{ $akademikActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is('academic.master.taka-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.master.taka-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Tahun Akademik</a>
            </li>
            <li class="submenu-item {{ Route::is('academic.master.fakultas-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.master.fakultas-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Fakultas</a>
            </li>
            <li class="submenu-item {{ Route::is('academic.master.pstudi-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.master.pstudi-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Program Studi</a>
            </li>
            <li class="submenu-item {{ Route::is('academic.mahasiswa-health*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.mahasiswa-health.index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Detail Mahasiswa</a>
            </li>
        </ul>
    </li>

    <!-- PMB Data Dropdown -->
    @php $pmbActive = Route::is('academic.master.proku-*'); @endphp
    <li class="list-none sidebar-item has-sub {{ $pmbActive ? 'active' : '' }} mt-1">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $pmbActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-pmb">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data PMB</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-pmb" class="submenu pl-12 mt-1 space-y-1 {{ $pmbActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is('academic.master.proku-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.master.proku-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Program Kuliah</a>
            </li>
        </ul>
    </li>

    <!-- KBM Data Dropdown -->
    @php
        $kbmActive =
            Route::is('academic.master.kurikulum-*') ||
            Route::is('academic.master.kelas-*') ||
            Route::is('academic.master.matkul-*') ||
            Route::is('academic.master.jadkul-*');
    @endphp
    <li class="list-none sidebar-item has-sub {{ $kbmActive ? 'active' : '' }} mt-1">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ $kbmActive ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-kbm">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Data KBM</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-kbm" class="submenu pl-12 mt-1 space-y-1 {{ $kbmActive ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is('academic.master.kurikulum-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.master.kurikulum-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Kurikulum</a>
            </li>
            <li class="submenu-item {{ Route::is('academic.master.kelas-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.master.kelas-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Kelas</a>
            </li>
            <li class="submenu-item {{ Route::is('academic.master.matkul-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.master.matkul-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Mata Kuliah</a>
            </li>
            <li class="submenu-item {{ Route::is('academic.master.jadkul-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route('academic.master.jadkul-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Jadwal Kuliah</a>
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
        padding-left: 0.5rem;
    }

    .submenu.open {
        max-height: 500px;
        opacity: 1;
        transition: max-height 0.5s ease-in, opacity 0.3s ease-in;
    }

    /* Dropdown Toggle Icon Animation */
    .dropdown-toggle .fa-chevron-down {
        transition: transform 0.3s ease;
    }

    .dropdown-toggle.active .fa-chevron-down {
        transform: rotate(180deg);
    }

    /* Active State Styling */
    .sidebar-item.active>.dropdown-toggle,
    .sidebar-item.active>.sidebar-link {
        @apply bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold;
    }

    .submenu-item.active>a {
        @apply bg-green-50 text-green-700 font-semibold;
    }

    /* Hover Effects */
    .sidebar-link:hover,
    .submenu-link:hover {
        @apply text-green-700;
    }

    .submenu-item:hover {
        @apply bg-green-100;
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
