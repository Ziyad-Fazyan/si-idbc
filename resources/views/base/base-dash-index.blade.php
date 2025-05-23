<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('menu') - {{ $web->school_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 font-[Poppins]">
    <div class="min-h-screen flex flex-col">
        <!-- Sidebar overlay for mobile -->
        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black bg-opacity-60 z-20 hidden lg:hidden transition-opacity duration-300"
            onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-white border-r border-gray-200 shadow-lg z-30 transform transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full overflow-hidden flex flex-col">
            <!-- Sidebar Header -->
            <div class="flex items-center justify-between p-4 bg-white text-gray-800 border-b shadow-sm">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <img src="{{ asset('storage/images/' . $web->school_logo) }}" alt="Al-Wafa' Logo"
                            class="h-12 w-auto border border-green-200 shadow object-contain rounded-md p-1 bg-white">
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold text-lg tracking-tight text-gray-800">{{ $web->school_name }}</span>
                        <span class="text-sm text-green-600 font-medium">Islamic School</span>
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <div class="py-4 overflow-y-auto flex-1 px-3">
                <div class="space-y-1">
                    @include('base.panel.base-panel-sidebar')
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64 transition-all duration-300">
            <!-- Navbar -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <!-- Left side - Mobile menu button -->
                        <div class="flex items-center">
                            <button onclick="toggleSidebar()"
                                class="p-2 rounded-lg text-gray-500 hover:text-green-600 hover:bg-green-50 transition-colors duration-200 lg:hidden focus:outline-none">
                                <i class="fas fa-bars text-xl"></i>
                            </button>
                        </div>

                        <!-- Right side navbar items -->
                        <div class="flex items-center">
                            @include('base.panel.base-panel-header')
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="p-4 md:p-6 transition-opacity duration-300 opacity-100">
                <!-- Page Title and Breadcrumbs -->
                <div class="mb-6 bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-600">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h1 class="text-2xl font-bold text-gray-800">@yield('submenu')</h1>
                            <p class="text-sm text-gray-500 mt-1">@yield('subdesc')</p>
                        </div>

                        <!-- Breadcrumbs -->
                        <nav class="text-sm bg-gray-50 px-3 py-2 rounded-lg">
                            <ol class="flex items-center space-x-2">
                                <li><a href="@yield('urlmenu')"
                                        class="text-green-600 hover:text-green-800 font-medium">@yield('menu')</a>
                                </li>
                                <li class="text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mx-1" fill="currentColor" viewBox="0 0 20 20">
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
                <div
                    class="bg-white rounded-lg shadow-md p-4 md:p-6 border border-gray-100 transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
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

    <script>
        // Sidebar toggle functionality
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            // Toggle sidebar
            sidebar.classList.toggle('-translate-x-full');

            // Handle overlay
            if (sidebar.classList.contains('-translate-x-full')) {
                overlay.classList.add('hidden');
            } else {
                overlay.classList.remove('hidden');
            }
        }

        // Dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown toggles
            document.querySelectorAll('.dropdown-container').forEach(dropdown => {
                const button = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');

                if (button && menu) {
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();

                        // Close all other dropdowns
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
        });

        // Fungsi untuk mengelola modal
        function handleModal(modalId, action) {
            const modal = document.getElementById(modalId);
            if (!modal) return;

            if (action === 'open') {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Event listener untuk menutup modal saat mengklik di luar
        document.addEventListener('click', function(event) {
            const modals = document.querySelectorAll(
                '[id^="modal"], [id^="contactModal"], [id^="viewContact"], [id^="importModal"], [id^="deleteModal"]'
            );
            modals.forEach(modal => {
                if (event.target === modal) {
                    handleModal(modal.id, 'close');
                }
            });
        });

        // Event listener untuk tombol Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const visibleModal = document.querySelector(
                    '[id^="modal"]:not(.hidden), [id^="contactModal"]:not(.hidden), [id^="viewContact"]:not(.hidden), [id^="importModal"]:not(.hidden), [id^="deleteModal"]:not(.hidden)'
                );
                if (visibleModal) {
                    handleModal(visibleModal.id, 'close');
                }
            }
        });

        // Fungsi untuk membuka modal
        function openModal(modalId) {
            handleModal(modalId, 'open');
        }

        // Fungsi untuk menutup modal
        function closeModal(modalId) {
            handleModal(modalId, 'close');
        }

        // Fungsi toggle modal (untuk kompatibilitas)
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal.classList.contains('hidden')) {
                handleModal(modalId, 'open');
            } else {
                handleModal(modalId, 'close');
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    @stack('scripts')
</body>

</html>
