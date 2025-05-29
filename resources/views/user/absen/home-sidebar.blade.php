<li
    class="list-none {{ Route::is($prefix . 'daftar-wajah-index') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
    <a href="{{ route($prefix . 'daftar-wajah-index') }}"
        class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
        <i class="fa-solid fa-users-viewfinder w-5 text-center mr-3"></i>
        <span>Daftar Wajah</span>
    </a>
</li>
<li
    class="list-none {{ Route::is($prefix . 'absen-wajah-index') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
    <a href="{{ route($prefix . 'absen-wajah-index') }}"
        class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
        <i class="fa-solid fa-face-smile-beam w-5 text-center mr-3"></i>
        <span>Absen Wajah</span>
    </a>
</li>
