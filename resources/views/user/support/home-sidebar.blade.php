<div class="sidebar-menu">
    <!-- Support Department Section -->
    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">Support Departement</li>

    <!-- Inventory Dropdown -->
    <li class="list-none sidebar-item has-sub {{ Route::is($prefix . 'inventory.*') ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ Route::is($prefix . 'inventory.*') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-inventory">
            <div class="flex items-center">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Master Inventaris</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-inventory"
            class="submenu pl-12 mt-1 space-y-1 {{ Route::is($prefix . 'inventory.*') ? 'open' : 'hidden' }}">
            <li class="submenu-item {{ Route::is($prefix . 'inventory.gedung-*') ? 'active' : '' }}">
                <a href="{{ route($prefix . 'inventory.gedung-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200 {{ Route::is($prefix . 'inventory.gedung-*') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600' }}">Data
                    Gedung</a>
            </li>
            <li class="submenu-item {{ Route::is($prefix . 'inventory.ruang-*') ? 'active' : '' }}">
                <a href="{{ route($prefix . 'inventory.ruang-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200 {{ Route::is($prefix . 'inventory.ruang-*') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600' }}">Data
                    Ruangan</a>
            </li>
            <li class="submenu-item {{ Route::is($prefix . 'inventory.perolehan-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'inventory.perolehan-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Perolehan</a>
            </li>
            <li class="submenu-item {{ Route::is($prefix . 'inventory.lokasi-*') ? 'active bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'inventory.barang-index') }}"
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
    .sidebar-item.active>.dropdown-toggle {
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
