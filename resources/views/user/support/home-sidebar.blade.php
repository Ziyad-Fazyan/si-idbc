<div class="sidebar-menu">
    <!-- Support Department Section -->
    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3">Support Departement</li>

    <!-- Inventory Dropdown -->
    <li class="list-none sidebar-item has-sub {{ Route::is($prefix . 'inventory.*') ? 'active' : '' }}">
        <div class="dropdown-toggle flex items-center justify-between px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 cursor-pointer {{ Route::is($prefix . 'inventory.*') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}"
            data-target="dropdown-inventory">
            <div class="flex items-center sidebar-link">
                <i class="fa-solid fa-school w-5 text-center mr-3"></i>
                <span>Master Inventaris</span>
            </div>
            <i class="fa-solid fa-chevron-down transition-transform duration-200"></i>
        </div>
        <ul id="dropdown-inventory"
            class="submenu pl-12 mt-1 space-y-1 {{ Route::is($prefix . 'inventory.*') ? '' : 'hidden' }}">
            <li
                class="{{ Route::is($prefix . 'inventory.perolehan-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'inventory.perolehan-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Perolehan</a>
            </li>
            <li
                class="{{ Route::is($prefix . 'inventory.lokasi-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'inventory.lokasi-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Lokasi</a>
            </li>
            <li
                class="{{ Route::is($prefix . 'inventory.lokasi-*') ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
                <a href="{{ route($prefix . 'inventory.barang-index') }}"
                    class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Data
                    Barang</a>
            </li>
        </ul>
    </li>
</div>

<style>
    /* Dropdown Animation Styles */
    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        padding-left: 0.5rem;
    }

    .submenu:not(.hidden) {
        max-height: 500px;
        transition: max-height 0.3s ease-in;
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
        const activeDropdownItems = document.querySelectorAll('.submenu-item.active');

        activeDropdownItems.forEach(item => {
            const parentDropdown = item.closest('.submenu');
            if (parentDropdown) {
                parentDropdown.classList.remove('hidden');
                const toggle = document.querySelector(
                    `.dropdown-toggle[data-target="${parentDropdown.id}"]`);
                if (toggle) {
                    toggle.querySelector('.fa-chevron-down').classList.add('rotate-180');
                    toggle.classList.add('active');
                    toggle.closest('.sidebar-item').classList.add('active');
                }
            }
        });
    });
</script>
