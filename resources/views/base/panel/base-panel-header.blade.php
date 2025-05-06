<nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Right side navigation items -->
            <div class="flex items-center">
                @php
                    $notif = App\Models\Notification::latest()->paginate(6);

                    if (Auth::check()) {
                        if (Auth::user()->raw_type == '0') {
                            $ticket = App\Models\TicketSupport::latest()->paginate(6);
                        } else {
                            $ticket = App\Models\TicketSupport::latest()
                                ->where('dept_id', Auth::user()->raw_type)
                                ->paginate(6);
                        }
                    } elseif (Auth::guard('mahasiswa')->check()) {
                        $ticket = App\Models\TicketSupport::latest()
                            ->where('users_id', Auth::guard('mahasiswa')->user()->id)
                            ->paginate(6);
                    } else {
                        $ticket = collect();
                    }
                @endphp

                <div class="flex flex-wrap items-center space-x-1 sm:space-x-3">
                    <!-- Ticket dropdown (except for dosen) -->
                    @if(!Auth::guard('dosen')->check())
                        <div class="relative dropdown-container">
                            <button type="button" class="dropdown-toggle flex items-center text-gray-500 hover:text-amber-600 focus:outline-none p-2 rounded-lg hover:bg-amber-50 transition-all duration-200 relative">
                                <i class="fa-solid fa-ticket text-lg"></i>
                                @if($ticket->count() > 0)
                                    <span class="absolute -top-1 -right-1 bg-amber-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                                        {{ $ticket->count() }}
                                    </span>
                                @endif
                            </button>
                            <div class="dropdown-menu absolute right-0 mt-2 w-72 sm:w-80 rounded-lg shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-50 hidden">
                                <div class="py-1">
                                    <div class="px-4 py-3 border-b bg-gradient-to-r from-amber-50 to-white">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-800">Support Tickets</p>
                                            @if($ticket->count() > 0)
                                                <span class="text-xs text-amber-600 font-medium bg-amber-100 px-2 py-1 rounded-full">{{ $ticket->count() }} {{ $ticket->count() > 1 ? 'tickets' : 'ticket' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="max-h-64 overflow-y-auto thin-scrollbar">
                                        @if($ticket->count() > 0)
                                            @foreach($ticket as $item)
                                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-amber-50 border-b border-gray-100 last:border-0 transition-colors duration-150">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 bg-amber-500 text-white p-2 rounded-full shadow-sm">
                                                            <i class="fa-solid fa-ticket text-xs"></i>
                                                        </div>
                                                        <div class="ml-3 w-0 flex-1">
                                                            <p class="font-medium text-gray-900 truncate">{{ '#' . $item->code }}</p>
                                                            <p class="text-xs text-gray-500 mt-1 truncate">{{ $item->subject }}</p>
                                                            <p class="text-xs text-amber-500 mt-1">{{ $item->created_at->diffForHumans() }}</p>
                                                        </div>
                                                        <div class="ml-2 flex-shrink-0">
                                                            @if($item->status == 'open')
                                                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Open</span>
                                                            @else
                                                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Closed</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <div class="px-4 py-6 text-center">
                                                <div class="mx-auto h-12 w-12 text-gray-400">
                                                    <i class="fa-regular fa-ticket text-2xl"></i>
                                                </div>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900">No tickets</h3>
                                                <p class="mt-1 text-xs text-gray-500">You don't have any support tickets yet.</p>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="px-4 py-2 bg-gray-50 border-t">
                                        <a href="#" class="text-sm text-center block text-amber-600 hover:text-amber-800 font-medium hover:underline">Create New Ticket</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Notifications dropdown -->
                    <div class="relative dropdown-container">
                        <button type="button" class="dropdown-toggle flex items-center text-gray-500 hover:text-green-600 focus:outline-none p-2 rounded-lg hover:bg-green-50 transition-all duration-200 relative">
                            <i class="fa-solid fa-bell text-lg"></i>
                            @if($notif->count() > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center animate-pulse">
                                    {{ $notif->count() }}
                                </span>
                            @endif
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-72 sm:w-80 rounded-lg shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-50 hidden">
                            <div class="py-1">
                                <div class="px-4 py-3 border-b bg-gradient-to-r from-green-50 to-white">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-800">Notifications</p>
                                        <span class="text-xs text-green-600 font-medium bg-green-100 px-2 py-1 rounded-full">{{ $notif->count() }} new</span>
                                    </div>
                                </div>
                                <div class="max-h-64 overflow-y-auto thin-scrollbar">
                                    @if($notif->count() > 0)
                                        @foreach($notif as $item)
                                            <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-green-50 border-b border-gray-100 last:border-0 transition-colors duration-150">
                                                <div class="flex items-start">
                                                    <div class="flex-shrink-0 bg-green-500 text-white p-2 rounded-full shadow-sm">
                                                        <i class="fa-solid fa-bell text-xs"></i>
                                                    </div>
                                                    <div class="ml-3 w-0 flex-1">
                                                        <p class="font-medium text-gray-900 truncate">{{ $item->name }}</p>
                                                        <p class="text-xs text-gray-500 mt-1">{!! substr($item->desc, 0, 60) !!}...</p>
                                                        <p class="text-xs text-green-600 mt-1 font-medium">{{ $item->created_at->diffForHumans() }}</p>
                                                    </div>
                                                    <div class="ml-2 flex-shrink-0">
                                                        <button class="text-gray-400 hover:text-gray-500">
                                                            <i class="fa-regular fa-bookmark text-xs"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <div class="px-4 py-6 text-center">
                                            <div class="mx-auto h-12 w-12 text-gray-400">
                                                <i class="fa-regular fa-bell-slash text-2xl"></i>
                                            </div>
                                            <h3 class="mt-2 text-sm font-medium text-gray-900">No notifications</h3>
                                            <p class="mt-1 text-xs text-gray-500">You don't have any notifications yet.</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="px-4 py-2 bg-gray-50 border-t">
                                    <a href="#" class="text-sm text-center block text-green-600 hover:text-green-800 font-medium hover:underline">View All Notifications</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User profile dropdown -->
                    <div class="relative dropdown-container ml-1">
                        <button type="button" class="dropdown-toggle flex items-center focus:outline-none hover:bg-gray-100 p-1 rounded-full transition-all duration-200">
                            <div class="flex items-center space-x-2">
                                <div class="text-right hidden md:block">
                                    @auth('dosen')
                                        <p class="text-sm font-medium text-gray-700 truncate max-w-[120px]">{{ Auth::guard('dosen')->user()->dsn_name }}</p>
                                        <p class="text-xs text-gray-500">{{ Auth::guard('dosen')->user()->dsn_stat }}</p>
                                    @else
                                        @auth('mahasiswa')
                                            <p class="text-sm font-medium text-gray-700 truncate max-w-[120px]">{{ Auth::guard('mahasiswa')->user()->mhs_name }}</p>
                                            <p class="text-xs text-gray-500">{{ Auth::guard('mahasiswa')->user()->mhs_stat }}</p>
                                        @else
                                            @auth
                                                <p class="text-sm font-medium text-gray-700 truncate max-w-[120px]">{{ Auth::user()->name }}</p>
                                                <p class="text-xs text-gray-500">{{ Auth::user()->type }}</p>
                                            @endauth
                                        @endauth
                                    @endauth
                                </div>
                                <div class="h-8 w-8 rounded-full overflow-hidden border-2 border-gray-200 shadow-sm hover:border-green-500 transition-colors">
                                    @auth('mahasiswa')
                                        <img class="h-full w-full object-cover" src="{{ asset('storage/images/' . Auth::guard('mahasiswa')->user()->mhs_image) }}" alt="Profile" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('mahasiswa')->user()->mhs_name) }}&background=random'">
                                    @else
                                        @auth('dosen')
                                            <img class="h-full w-full object-cover" src="{{ asset('storage/images/' . Auth::guard('dosen')->user()->dsn_image) }}" alt="Profile" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('dosen')->user()->dsn_name) }}&background=random'">
                                        @else
                                            @auth
                                                <img class="h-full w-full object-cover" src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="Profile" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random'">
                                            @endauth
                                        @endauth
                                    @endauth
                                </div>
                                <i class="fa-solid fa-chevron-down text-xs text-gray-400 hover:text-green-600 transition-colors ml-1"></i>
                            </div>
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 sm:w-56 rounded-lg shadow-xl bg-white ring-1 ring-black ring-opacity-5 z-50 hidden">
                            <div class="py-1">
                                <div class="px-4 py-3 border-b bg-gray-50">
                                    @auth('mahasiswa')
                                        <p class="text-xs text-gray-500">Logged in as</p>
                                        <p class="text-sm font-medium text-gray-700 truncate">{{ Auth::guard('mahasiswa')->user()->mhs_nim }}</p>
                                    @else
                                        @auth('dosen')
                                            <p class="text-xs text-gray-500">Logged in as</p>
                                            <p class="text-sm font-medium text-gray-700 truncate">{{ Auth::guard('dosen')->user()->dsn_nidn }}</p>
                                        @else
                                            @auth
                                                <p class="text-xs text-gray-500">Logged in as</p>
                                                <p class="text-sm font-medium text-gray-700 truncate">{{ Auth::user()->user }}</p>
                                            @endauth
                                        @endauth
                                    @endauth
                                </div>
                                
                                @auth
                                    <a href="{{ route($prefix . 'home-profile') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                        <i class="fa-regular fa-user mr-3 text-gray-400"></i> My Profile
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                        <i class="fa-regular fa-gear mr-3 text-gray-400"></i> Settings
                                    </a>
                                    <div class="border-t"></div>
                                    <a href="{{ route($prefix . 'auth-signout-post') }}" class="flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                        <i class="fa-regular fa-right-from-bracket mr-3"></i> Logout
                                    </a>
                                @endauth

                                @auth('mahasiswa')
                                    <a href="{{ route('mahasiswa.home-profile') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                        <i class="fa-regular fa-user mr-3 text-gray-400"></i> My Profile
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                        <i class="fa-regular fa-gear mr-3 text-gray-400"></i> Settings
                                    </a>
                                    <div class="border-t"></div>
                                    <a href="{{ route('mahasiswa.auth-signout-post') }}" class="flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                        <i class="fa-regular fa-right-from-bracket mr-3"></i> Logout
                                    </a>
                                @endauth

                                @auth('dosen')
                                    <a href="{{ route('dosen.home-profile') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                        <i class="fa-regular fa-user mr-3 text-gray-400"></i> My Profile
                                    </a>
                                    <a href="#" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                        <i class="fa-regular fa-gear mr-3 text-gray-400"></i> Settings
                                    </a>
                                    <div class="border-t"></div>
                                    <a href="{{ route('dosen.auth-signout-post') }}" class="flex items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                        <i class="fa-regular fa-right-from-bracket mr-3"></i> Logout
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Custom scrollbar for dropdowns */
    .thin-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .thin-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    .thin-scrollbar::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    .thin-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
    
    /* Dropdown menu styles */
    .dropdown-menu.show {
        display: block;
        animation: fadeIn 0.2s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Active button state */
    .dropdown-toggle.active {
        background-color: #f3f4f6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple toggle functionality for dropdowns
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Get dropdown menu
                const container = this.closest('.dropdown-container');
                const menu = container.querySelector('.dropdown-menu');
                
                // Close all other dropdowns first
                document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                    if (otherMenu !== menu && otherMenu.classList.contains('show')) {
                        otherMenu.classList.remove('show');
                        const otherToggle = otherMenu.closest('.dropdown-container').querySelector('.dropdown-toggle');
                        otherToggle.classList.remove('active');
                    }
                });
                
                // Toggle current dropdown
                menu.classList.toggle('show');
                this.classList.toggle('active');
            });
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-menu')) {
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                    const toggle = menu.closest('.dropdown-container').querySelector('.dropdown-toggle');
                    toggle.classList.remove('active');
                });
            }
        });
        
        // Close dropdowns with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                    const toggle = menu.closest('.dropdown-container').querySelector('.dropdown-toggle');
                    toggle.classList.remove('active');
                });
            }
        });
        
        // Prevent dropdown menu clicks from closing the dropdown (except for links)
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                if (!e.target.closest('a')) {
                    e.stopPropagation();
                }
            });
        });
    });
</script>