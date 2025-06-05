<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('menu') - {{ $web->school_name }}</title>

    <!-- Stylesheets -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('styles')

    <style>
        :root {
            --primary-color: #0C6E71;
            --accent-color: #FF6B35;
            --sidebar-width: 16rem;
            /* 64 * 0.25rem */
        }

        /* Jika dropdown classes belum ada */
        .dropdown-container {
            @apply relative;
        }

        .dropdown-menu {
            @apply absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 z-50;
        }

        /* Loading state untuk gambar */
        .school-logo {
            @apply h-12 w-auto border border-green-200 shadow object-contain rounded-md p-1 bg-white transition-opacity duration-300;
        }

        .school-logo[src=""] {
            @apply opacity-50;
        }
    </style>
</head>

<body class="bg-gray-50 font-[Poppins]">
    <div class="min-h-screen flex flex-col">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black bg-opacity-60 z-20 hidden lg:hidden transition-opacity duration-300"
            onclick="toggleSidebar()">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-lg z-30 transform transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full overflow-hidden flex flex-col">

            <!-- Sidebar Header -->
            <div class="flex items-center justify-between p-4 bg-white text-gray-800 border-b shadow-sm">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <img src="{{ asset('storage/images/' . $web->school_logo) }}" alt="{{ $web->school_name }} Logo"
                            class="h-12 w-auto border border-green-200 shadow object-contain rounded-md p-1 bg-white">
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold text-lg tracking-tight text-gray-800">{{ $web->school_name }}</span>
                        <span class="text-sm text-[#0C6E71] font-medium">Islamic School</span>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="py-4 overflow-y-auto flex-1 px-3">
                <div class="space-y-1">
                    @include('base.panel.base-panel-sidebar')
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64 transition-all duration-300">
            <!-- Header/Navbar -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Mobile Menu Button -->
                        <div class="flex items-center">
                            <button onclick="toggleSidebar()"
                                class="p-2 rounded-lg text-gray-500 hover:text-[#0C6E71] hover:bg-green-50 transition-colors duration-200 lg:hidden focus:outline-none focus:ring-2 focus:ring-[#0C6E71] focus:ring-offset-2"
                                aria-label="Toggle sidebar">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                        </div>

                        <!-- Header Right Side -->
                        <div class="flex items-center">
                            @include('base.panel.base-panel-header')
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-4 md:p-6">
                <!-- Page Title and Breadcrumbs -->
                <div class="mb-6 bg-white rounded-lg shadow-sm p-4 border-l-4 border-[#0C6E71]">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h1 class="text-2xl font-bold text-gray-800">@yield('submenu')</h1>
                            <p class="text-sm text-gray-500 mt-1">@yield('subdesc')</p>
                        </div>

                        <!-- Breadcrumbs -->
                        <nav class="text-sm bg-gray-50 px-3 py-2 rounded-lg" aria-label="Breadcrumb">
                            <ol class="flex items-center space-x-2">
                                <li>
                                    <a href="@yield('urlmenu')"
                                        class="text-[#FF6B35] hover:text-[#0C6E71] font-medium transition-colors">
                                        @yield('menu')
                                    </a>
                                </li>
                                <li class="text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span>@yield('submenu')</span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Page Content -->
                <div class="mb-6 bg-white rounded-lg shadow-sm p-4 border-l-4 border-[#0C6E71]">
                    @include('sweetalert::alert')
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer>
                @include('base.panel.base-panel-footer')
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Sidebar Management
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (!sidebar || !overlay) return;

            sidebar.classList.toggle('-translate-x-full');

            if (sidebar.classList.contains('-translate-x-full')) {
                overlay.classList.add('hidden');
            } else {
                overlay.classList.remove('hidden');
            }
        }

        // Modal Management
        function handleModal(modalId, action) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

            const body = document.body;

            if (action === 'open') {
                modal.classList.remove('hidden');
                body.style.overflow = 'hidden';
            } else {
                modal.classList.add('hidden');
                body.style.overflow = 'auto';
            }
        }

        function openModal(modalId) {
            handleModal(modalId, 'open');
        }

        function closeModal(modalId) {
            handleModal(modalId, 'close');
        }

        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

            const isHidden = modal.classList.contains('hidden');
            handleModal(modalId, isHidden ? 'open' : 'close');
        }

        // Initialize on DOM load
        document.addEventListener('DOMContentLoaded', function() {
            // Dropdown Management
            document.querySelectorAll('.dropdown-container').forEach(dropdown => {
                const button = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');

                if (button && menu) {
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();

                        // Close other dropdowns
                        document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                            if (otherMenu !== menu && !otherMenu.classList.contains(
                                    'hidden')) {
                                otherMenu.classList.add('hidden');
                            }
                        });

                        // Toggle current dropdown
                        menu.classList.toggle('hidden');
                    });
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
            });

            // Modal event listeners
            const modalSelectors = [
                '[id^="modal"]',
                '[id^="contactModal"]',
                '[id^="viewContact"]',
                '[id^="importModal"]',
                '[id^="deleteModal"]'
            ];

            // Close modal when clicking outside
            document.addEventListener('click', function(event) {
                const modals = document.querySelectorAll(modalSelectors.join(', '));
                modals.forEach(modal => {
                    if (event.target === modal) {
                        handleModal(modal.id, 'close');
                    }
                });
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    const visibleModalSelectors = modalSelectors.map(selector =>
                        `${selector}:not(.hidden)`
                    ).join(', ');

                    const visibleModal = document.querySelector(visibleModalSelectors);
                    if (visibleModal) {
                        handleModal(visibleModal.id, 'close');
                    }
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>

</html>
