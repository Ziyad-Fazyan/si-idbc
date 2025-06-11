<div class="sidebar-menu">
    <!-- Musyrif Menu Section -->
    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">Menu Musyrif</li>
    
    <li class="list-none sidebar-item {{ Route::is($prefix . 'mutabaah.index') ? 'active' : '' }}">
        <a href="{{ route($prefix . 'mutabaah.index') }}"
            class="sidebar-link flex items-center px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 {{ Route::is($prefix . 'mutabaah.index') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
            <i class="fa-solid fa-list-check w-5 text-center mr-3"></i>
            <span>Data Mutabaah</span>
        </a>
    </li>
    <li class="list-none sidebar-item {{ Route::is($prefix . 'mutabaah-fields.index') ? 'active' : '' }}">
        <a href="{{ route($prefix . 'mutabaah-fields.index') }}"
            class="sidebar-link flex items-center px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 {{ Route::is($prefix . 'mutabaah-fields.index') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
            <i class="fa-solid fa-table-columns w-5 text-center mr-3"></i>
            <span>Data Kolom Mutabaah</span>
        </a>
    </li>
</div>

<style>
    /* Sidebar Menu Styles */
    .sidebar-menu {
        @apply w-full;
    }
    
    /* Active State Styling */
    .sidebar-item.active>.sidebar-link {
        @apply bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold;
    }
    
    /* Hover Effects */
    .sidebar-link:hover {
        @apply text-green-700;
    }
</style>
