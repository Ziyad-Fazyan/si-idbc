<!-- Bagian menu untuk pengguna yang telah login -->
{{-- HAK AKSES WEB ADMINISTRATOR --}}
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

<script>
    function toggleSubmenu(element) {
        // Toggle the submenu visibility
        const submenu = element.nextElementSibling;
        const icon = element.querySelector('.fa-chevron-down');

        if (submenu.style.maxHeight === '0px' || submenu.style.maxHeight === '') {
            submenu.style.maxHeight = submenu.scrollHeight + 'px';
            icon.classList.add('rotate-180');
        } else {
            submenu.style.maxHeight = '0px';
            icon.classList.remove('rotate-180');
        }
    }

    // Auto-expand submenu if it contains active item
    document.addEventListener('DOMContentLoaded', function() {
        const activeSubmenuItem = document.querySelector('.submenu .active');
        if (activeSubmenuItem) {
            const parentSubmenu = activeSubmenuItem.closest('ul');
            const parentButton = parentSubmenu.previousElementSibling;
            toggleSubmenu(parentButton);
        }
    });
</script>
