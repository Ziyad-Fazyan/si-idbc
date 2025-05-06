<div class="sidebar-menu">
    <!-- Home and Profile -->
    <li class="list-none sidebar-item {{ Route::is('dosen.home-index') ? 'active' : '' }}">
        <a href="{{ route('dosen.home-index') }}" class='sidebar-link flex items-center px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 {{ Route::is('dosen.home-index') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}'>
            <i class="fa-solid fa-home w-5 text-center mr-3"></i>
            <span>Home</span>
        </a>
    </li>
    <li class="list-none sidebar-item {{ Route::is('dosen.home-profile*') ? 'active' : '' }}">
        <a href="{{ route('dosen.home-profile') }}" class='sidebar-link flex items-center px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 {{ Route::is('dosen.home-profile*') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}'>
            <i class="fa-solid fa-user-edit w-5 text-center mr-3"></i>
            <span>Profile User</span>
        </a>
    </li>

    <!-- Academic Menu -->
    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3">Menu Akademik</li>
    <li class="list-none sidebar-item {{ Route::is('dosen.akademik.jadwal-*') ? 'active' : '' }}">
        <a href="{{ route('dosen.akademik.jadwal-index') }}" class='sidebar-link flex items-center px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 {{ Route::is('dosen.akademik.jadwal-*') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}'>
            <i class="fa-solid fa-calendar w-5 text-center mr-3"></i>
            <span>Jadwal Perkuliahan</span>
        </a>
    </li>
    <li class="list-none sidebar-item {{ Route::is('dosen.akademik.stask-*') ? 'active' : '' }}">
        <a href="{{ route('dosen.akademik.stask-index') }}" class='sidebar-link flex items-center px-4 py-3 text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 {{ Route::is('dosen.akademik.stask-*') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}'>
            <i class="fa-solid fa-list-check w-5 text-center mr-3"></i>
            <span>Kelola Tugas</span>
        </a>
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
    .sidebar-item.active > .dropdown-toggle,
    .sidebar-item.active > .sidebar-link {
        @apply bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold;
    }

    .submenu-item.active > a {
        @apply bg-green-50 text-green-700 font-semibold;
    }

    /* Hover Effects */
    .sidebar-link:hover, .submenu-link:hover {
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
            const toggle = document.querySelector(`.dropdown-toggle[data-target="${parentDropdown.id}"]`);
            if (toggle) {
                toggle.querySelector('.fa-chevron-down').classList.add('rotate-180');
                toggle.classList.add('active');
                toggle.closest('.sidebar-item').classList.add('active');
            }
        }
    });
});
</script>