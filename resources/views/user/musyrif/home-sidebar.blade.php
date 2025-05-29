<li
    class="list-none {{ Route::is($prefix . 'mutabaah.index') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
    <a href="{{ route($prefix . 'mutabaah.index') }}"
        class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
        <i class="fa-solid fa-list-check w-5 text-center mr-3"></i>
        <span>Data Mutabaah</span>
    </a>
</li>
<li
    class="list-none {{ Route::is($prefix . 'mutabaah-fields.index') ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
    <a href="{{ route($prefix . 'mutabaah-fields.index') }}"
        class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
        <i class="fa-solid fa-table-columns w-5 text-center mr-3"></i>
        <span>Data Kolom Mutabaah</span>
    </a>
</li>
