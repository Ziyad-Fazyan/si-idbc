<li class="list-none text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">Menu Publikasi</li>
<li
    class="list-none {{ Route::is($prefix . 'system.notify-index', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
    <a href="{{ route($prefix . 'system.notify-index') }}"
        class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
        <i class="fa-solid fa-bell w-5 text-center mr-3"></i>
        <span>Data Pemberitahuan</span>
    </a>
</li>

<li
    class="list-none {{ Route::is($prefix . 'landing-page.index', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 text-green-700 font-semibold' : '' }}">
    <a href="{{ route($prefix . 'landing-page.index') }}"
        class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
        <i class="fa-solid fa-globe w-5 text-center mr-3"></i>
        <span>Pengaturan Landing Page</span>
    </a>
</li>

<!-- Dropdown Menu -->
<li class="list-none {{ Route::is($prefix . 'news.*', request()->path()) ? 'border-l-3 border-green-600' : '' }}">
    <button type="button"
        class="flex items-center justify-between w-full px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200 focus:outline-none"
        onclick="toggleSubmenu(this)">
        <div class="flex items-center">
            <i class="fa-solid fa-newspaper w-5 text-center mr-3"></i>
            <span>Data Berita</span>
        </div>
        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"></i>
    </button>
    <ul class="pl-12 mt-1 space-y-1 max-h-0 overflow-hidden transition-all duration-300">
        <li
            class="{{ Route::is($prefix . 'news.post-*', request()->path()) ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
            <a href="{{ route($prefix . 'news.post-index') }}"
                class="block py-2 pl-3 pr-4 text-sm rounded-md hover:bg-green-100 hover:text-green-700 transition-colors duration-200">Berita</a>
        </li>
        <li
            class="{{ Route::is($prefix . 'news.category-*', request()->path()) ? 'bg-green-50 text-green-700 font-semibold rounded-md' : '' }}">
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
