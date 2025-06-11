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

    /* Active state for dropdown parent when child is active */
    .sidebar-item.active > button {
        @apply bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold;
    }
    
    /* Hover effects */
    .sidebar-item:hover .fa-chevron-down {
        @apply text-green-600;
    }
</style>

<script>
    function toggleSubmenu(button) {
        const submenu = button.nextElementSibling;
        const icon = button.querySelector('.fa-chevron-down');
        const parentItem = button.closest('.sidebar-item');

        // Toggle submenu visibility with smooth animation
        if (!submenu.classList.contains('open')) {
            // Close all other open submenus first
            document.querySelectorAll('.submenu.open').forEach(openMenu => {
                if (openMenu !== submenu) {
                    const menuButton = openMenu.previousElementSibling;
                    const menuIcon = menuButton?.querySelector('.fa-chevron-down');
                    const menuParent = menuButton?.closest('.sidebar-item');
                    
                    openMenu.style.maxHeight = '0px';
                    openMenu.classList.remove('open');
                    setTimeout(() => { openMenu.classList.add('hidden'); }, 300);
                    
                    if (menuIcon) menuIcon.classList.remove('rotate-180');
                    if (menuButton) menuButton.classList.remove('active');
                    if (menuParent && !menuParent.querySelector('.submenu-item.active')) {
                        menuParent.classList.remove('active');
                    }
                }
            });
            
            // Open this submenu
            submenu.classList.add('open');
            submenu.classList.remove('hidden');
            submenu.style.maxHeight = submenu.scrollHeight + 'px';
            icon.classList.add('rotate-180');
            button.classList.add('active');
            if (parentItem) parentItem.classList.add('active');
        } else {
            // Close this submenu
            submenu.style.maxHeight = '0px';
            icon.classList.remove('rotate-180');
            button.classList.remove('active');
            setTimeout(() => {
                submenu.classList.remove('open');
                submenu.classList.add('hidden');
            }, 300);
            
            // Only remove active class from parent if no active items inside
            if (parentItem && !parentItem.querySelector('.submenu-item.active')) {
                parentItem.classList.remove('active');
            }
        }
    }

    // Auto-expand submenu if it contains active item
    document.addEventListener('DOMContentLoaded', function() {
        const activeItems = document.querySelectorAll('.submenu-item.active, .submenu .bg-green-50');
        activeItems.forEach(item => {
            const submenu = item.closest('.submenu');
            if (submenu) {
                submenu.classList.remove('hidden');
                submenu.classList.add('open');
                submenu.style.maxHeight = submenu.scrollHeight + 'px';
                
                const button = submenu.previousElementSibling;
                if (button && button.tagName === 'BUTTON') {
                    const icon = button.querySelector('.fa-chevron-down');
                    if (icon) icon.classList.add('rotate-180');
                    button.classList.add('active');
                    
                    const parentItem = button.closest('.sidebar-item');
                    if (parentItem) parentItem.classList.add('active');
                }
            }
        });
    });
</script>
