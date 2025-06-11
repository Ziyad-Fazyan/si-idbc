<div class="sidebar-container h-full overflow-y-auto overflow-x-hidden transition-all duration-300 ease-in-out">
    @guest
        <!-- Bagian menu ini akan disembunyikan ketika pengguna adalah "guest" -->
    @else
        <!-- User Menu Section -->
        <div class="py-1">
            <div class="text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">MENU UTAMA</div>
            @include('user.sidebar-index')
        </div>

        <!-- Role-based Menu Sections -->
        @if (Auth::user()->raw_type === 0)
            <div class="py-1">
                <div class="text-xs font-bold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">ADMINISTRATOR</div>
                @include('user.admin.admin-sidebar-index')
            </div>
        @elseif(Auth::user()->raw_type === 1)
            <div class="py-1">
                <div class="text-xs font-bold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">KEUANGAN</div>
                @include('user.finance.home-sidebar')
            </div>
        @elseif(Auth::user()->raw_type === 2)
            <div class="py-1">
                <div class="text-xs font-bold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">ABSEN</div>
                @include('user.absen.home-sidebar')
            </div>
        @elseif(Auth::user()->raw_type === 3)
            <div class="py-1">
                <div class="text-xs font-bold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">AKADEMIK</div>
                @include('user.academic.home-sidebar')
            </div>
        @elseif(Auth::user()->raw_type === 4)
            <div class="py-1">
                <div class="text-xs font-bold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">MUSYRIF</div>
                @include('user.musyrif.home-sidebar')
            </div>
        @elseif(Auth::user()->raw_type === 5)
            <div class="py-1">
                <div class="text-xs font-bold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">SUPPORT</div>
                @include('user.support.home-sidebar')
            </div>
        @elseif(Auth::user()->raw_type === 6)
            <div class="py-1">
                <div class="text-xs font-bold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">SITE MANAGER</div>
                @include('user.sitemanager.home-sidebar')
            </div>
        @endif
    @endguest

    <!-- Menu untuk mahasiswa -->
    @auth('mahasiswa')
        <div class="py-1">
            <div class="text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">MAHASISWA</div>
            @include('mahasiswa.sidebar-index')
        </div>
    @endauth

    <!-- Menu untuk dosen -->
    @auth('dosen')
        <div class="py-1">
            <div class="text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">DOSEN</div>
            @include('dosen.home-sidebar')
        </div>
    @endauth

    <!-- Special Admin Menu -->
    @guest
    @else
        @if (Auth::user()->raw_type === 0)
            <div class="py-1 mt-2">
                <div class="text-xs font-semibold uppercase text-gray-500 mt-5 mb-2 ml-3 tracking-wider">PENGATURAN</div>
                <div class="{{ Route::is($prefix . 'system.setting-index', request()->path()) ? 'bg-green-50 border-l-3 border-green-600 font-semibold text-green-700' : '' }}">
                    <a href="{{ route($prefix . 'system.setting-index') }}" class="flex items-center px-4 py-3 rounded-lg text-gray-600 hover:bg-green-50 hover:border-l-3 hover:border-green-600 hover:text-green-700 transition-all duration-200">
                        <i class="fa-solid fa-gear w-5 text-center mr-3"></i>
                        <span>Pengaturan Web</span>
                    </a>
                </div>
            </div>
        @endif
    @endguest
</div>

<style>
    /* Sidebar Container Styles */
    .sidebar-container {
        scrollbar-width: thin;
        scrollbar-color: rgba(156, 163, 175, 0.5) transparent;
    }
    
    .sidebar-container::-webkit-scrollbar {
        width: 4px;
    }
    
    .sidebar-container::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .sidebar-container::-webkit-scrollbar-thumb {
        background-color: rgba(156, 163, 175, 0.5);
        border-radius: 20px;
    }
</style>
