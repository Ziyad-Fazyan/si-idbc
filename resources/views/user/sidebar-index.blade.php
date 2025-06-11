<!-- Bagian menu untuk pengguna yang telah login -->
{{-- HAK AKSES WEB ADMINISTRATOR --}}
<div class="sidebar-menu">
    <li
        class="list-none {{ Route::is($prefix . 'home-index', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
        <a href="{{ route($prefix . 'home-index') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
            <i class="fa-solid fa-home w-5 text-center mr-3"></i>
            <span>Home</span>
        </a>
    </li>
    <li
        class="list-none {{ Route::is($prefix . 'home-profile', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
        <a href="{{ route($prefix . 'home-profile') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
            <i class="fa-solid fa-user-edit w-5 text-center mr-3"></i>
            <span>Profile User</span>
        </a>
    </li>

    <li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">Menu Rutinitas</li>
    <li
        class="list-none {{ Route::is($prefix . 'presensi.absen-harian', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
        <a href="{{ route($prefix . 'presensi.absen-harian') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
            <i class="fa-solid fa-calendar-check w-5 text-center mr-3"></i>
            <span>Absen Harian</span>
        </a>
    </li>
    <li
        class="list-none {{ Route::is($prefix . 'presensi.absen-izin-cuti', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
        <a href="{{ route($prefix . 'presensi.absen-izin-cuti') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
            <i class="fa-solid fa-calendar-xmark w-5 text-center mr-3"></i>
            <span>Absen Izin & Cuti</span>
        </a>
    </li>
    <li
        class="list-none {{ Route::is($prefix . 'support.ticket-index', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
        <a href="{{ route($prefix . 'support.ticket-index') }}"
            class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
            <i class="fa-solid fa-ticket w-5 text-center mr-3"></i>
            <span>Support Ticket</span>
        </a>
    </li>
</div>

<script>
    function toggleSubmenu(element) {
        // Toggle the submenu visibility
        const submenu = element.nextElementSibling;
        const icon = element.querySelector('.fa-chevron-down');

        // Toggle active class on the button
        element.classList.toggle('active');
        
        // Toggle submenu visibility with smooth animation
        if (!submenu.classList.contains('open')) {
            submenu.classList.add('open');
            submenu.classList.remove('hidden');
            submenu.style.maxHeight = submenu.scrollHeight + 'px';
            icon.classList.add('rotate-180');
        } else {
            submenu.style.maxHeight = '0px';
            icon.classList.remove('rotate-180');
            setTimeout(() => {
                submenu.classList.remove('open');
                submenu.classList.add('hidden');
            }, 300); // Match this with the CSS transition duration
        }
    }

    // Auto-expand submenu if it contains active item
    document.addEventListener('DOMContentLoaded', function() {
        const activeSubmenuItems = document.querySelectorAll('.submenu .active, .submenu .bg-green-50');
        
        activeSubmenuItems.forEach(item => {
            const parentSubmenu = item.closest('.submenu');
            if (parentSubmenu) {
                const parentButton = parentSubmenu.previousElementSibling;
                if (parentButton && parentButton.getAttribute('onclick')?.includes('toggleSubmenu')) {
                    // Manually trigger the toggle
                    parentSubmenu.classList.add('open');
                    parentSubmenu.classList.remove('hidden');
                    parentSubmenu.style.maxHeight = parentSubmenu.scrollHeight + 'px';
                    parentButton.classList.add('active');
                    const icon = parentButton.querySelector('.fa-chevron-down');
                    if (icon) icon.classList.add('rotate-180');
                }
            }
        });
    });
</script>
