<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Inventaris RSUD</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- antisipasi dengan CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @stack('styles')
</head>
<body class="text-gray-500 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-200 bg-opacity-50 z-40 hidden lg:hidden"></div>
        
        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-800 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex flex-col h-full">
                <!-- Logo/Brand -->
                <div class="flex items-center px-6 py-4 gap-2">
                    <img src="{{asset('/logo.png')}}" alt="logo" width="40" height="40" class="bg-white rounded-full px-1"> 
                    <h1 class="font-semibold text-lg text-white">Inventaris RSUD</h1>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-6 overflow-y-auto">
                    <ul class="space-y-2">
                        <!-- Dashboard -->
                        <li>
                            <a href="/dashboard" class="nav-item flex items-center px-4 py-3 rounded-lg transition-all duration-200">
                                <iconify-icon icon="mdi:view-dashboard" class="mr-3"></iconify-icon>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <!-- Staff Management -->
                        @if(auth()->user()->role === 'admin')
                        <li>
                            <a href="/dashboard/staff" class="nav-item flex items-center px-4 py-3 rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                <iconify-icon icon="mdi:account-group" class="mr-3"></iconify-icon>
                                <span>Manajemen Staff</span>
                            </a>
                        </li>
                        @endif

                        <!-- Komputer -->
                        <li>
                            <a href="/dashboard/komputer" class="nav-item flex items-center px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                <iconify-icon icon="mdi:monitor" class="mr-3"></iconify-icon>
                                <span>Komputer</span>
                            </a>
                        </li>

                        <!-- Printer -->
                        <li>
                            <a href="/dashboard/printer" class="nav-item flex items-center px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                <iconify-icon icon="mdi:printer" class="mr-3"></iconify-icon>
                                <span>Printer</span>
                            </a>
                        </li>

                        <!-- UPS -->
                        <li>
                            <a href="/dashboard/ups" class="nav-item flex items-center px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                <iconify-icon icon="mdi:flash" class="mr-3"></iconify-icon>
                                <span>UPS</span>
                            </a>
                        </li>

                        <li>
                            <a href="/dashboard/cctv" class="nav-item flex items-center px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                <iconify-icon icon="mdi:cctv" class="mr-3"></iconify-icon>
                                <span>CCTV</span>
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard/switch" class="nav-item flex items-center px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                <iconify-icon icon="mdi:switch" class="mr-3"></iconify-icon>
                                <span>Switch</span>
                            </a>
                        </li>
                        <li>
                            <a href="/dashboard/perbaikan" class="nav-item flex items-center px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                <iconify-icon icon="mdi:tools" class="mr-3"></iconify-icon>
                                <span>Perbaikan</span>
                            </a>
                        </li>

                        <!-- Laporan (Dropdown) -->
                        <li>
                            <button class="nav-item dropdown-toggle w-full flex items-center justify-between px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200" onclick="toggleDropdown(this)">
                                <div class="flex items-center">
                                    <iconify-icon icon="mdi:file-document-outline" class="mr-3"></iconify-icon>
                                    <span>Laporan</span>
                                </div>
                                <iconify-icon icon="mdi:chevron-down" class="transition-transform duration-200"></iconify-icon>
                            </button>
                            <ul class="dropdown-content mt-2 ml-4 space-y-1 hidden">
                                <li>
                                    <a href="/dashboard/laporan/komputer" class="nav-sub-item flex items-center px-4 py-2 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                        <iconify-icon icon="mdi:monitor" class="mr-3"></iconify-icon>
                                        <span>Komputer</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/dashboard/laporan/printer" class="nav-sub-item flex items-center px-4 py-2 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                        <iconify-icon icon="mdi:printer" class="mr-3"></iconify-icon>
                                        <span>Printer</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/dashboard/laporan/ups" class="nav-sub-item flex items-center px-4 py-2 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                        <iconify-icon icon="mdi:flash" class="mr-3"></iconify-icon>
                                        <span>UPS</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/dashboard/laporan/cctv" class="nav-sub-item flex items-center px-4 py-2 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                        <iconify-icon icon="mdi:cctv" class="mr-3"></iconify-icon>
                                        <span>CCTV</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/dashboard/laporan/switch" class="nav-sub-item flex items-center px-4 py-2 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                        <iconify-icon icon="mdi:switch" class="mr-3"></iconify-icon>
                                        <span>Switch</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/dashboard/laporan/perbaikan" class="nav-sub-item flex items-center px-4 py-2 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                        <iconify-icon icon="mdi:tools" class="mr-3"></iconify-icon>
                                        <span>Perbaikan</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="/dashboard/akun" class="nav-item flex items-center px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200">
                                <iconify-icon icon="mdi:account" class="mr-3"></iconify-icon>
                                <span>Akun</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Logout Button -->
                <div class="px-4 py-4 border-t border-[#262626]">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-3 text-[#A1A1A1] rounded-lg hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200 cursor-pointer">
                            <iconify-icon icon="mdi:logout" class="mr-3"></iconify-icon>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden bg-slate-100 lg:ml-0">
            <!-- Top Header -->
            <header class="px-4 py-2 lg:px-6 ">
                <div class="flex items-center justify-between">
                    <!-- Mobile Menu Button & Title -->
                    <div class="flex items-center">
                        <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-[#262626] hover:text-[#FFFFFF] transition-all duration-200 mr-3 text-center">
                            <iconify-icon icon="mdi:menu"></iconify-icon>
                        </button>
                        
                        <!-- Page Title -->
                        <div class="hidden sm:block">
                            <h2 class="text-xl font-semibold text-gray-500">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm text-gray-500 mt-1">@yield('page-subtitle', 'Selamat datang di sistem inventaris RSUD')</p>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="flex items-center space-x-3">
                        <div class="block text-right">
                            <p class="text-sm font-medium text-gray-500">{{ auth()->user()->name ?? 'None' }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->role === 'admin' ? 'Administrator' : 'Staff' }}</p>
                        </div>
                        <div class="w-10 h-10 bg-[#262626] rounded-full flex items-center justify-center">
                            <iconify-icon icon="mdi:account" class="text-[#A1A1A1]"></iconify-icon>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Page Title -->
                <div class="sm:hidden mt-3">
                    <h2 class="text-lg font-semibold text-gray-500">@yield('page-title', 'Dashboard')</h2>
                    <p class="text-sm text-[#A1A1A1]">@yield('page-subtitle', 'Selamat datang di sistem inventaris RSUD')</p>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-slate-100 p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');

        mobileMenuButton.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });

        // Close sidebar
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            }
        });

        // Dropdown toggle 
        function toggleDropdown(button) {
            const dropdownContent = button.nextElementSibling;
            const chevron = button.querySelector('iconify-icon[icon="mdi:chevron-down"]');
            
            dropdownContent.classList.toggle('hidden');
            
            if (dropdownContent.classList.contains('hidden')) {
                chevron.style.transform = 'rotate(0deg)';
            } else {
                chevron.style.transform = 'rotate(180deg)';
            }
        }

        // active button
        document.addEventListener('DOMContentLoaded', function() {
            const navItems = document.querySelectorAll('.nav-item');
            const currentPath = window.location.pathname;

            navItems.forEach(item => {
                const href = item.getAttribute('href');
                if (item.classList.contains('dropdown-toggle')) {
                    if (currentPath.startsWith('/dashboard/laporan')) {
                        item.classList.add('active');
                    }
                    return;
                }
                if (href === '/dashboard' && currentPath === '/dashboard') {
                    item.classList.add('active');
                }
                else if (href && href !== '/dashboard' && currentPath.startsWith(href)) {
                    item.classList.add('active');
                }
            });
        });
    </script>

    <style>
        .nav-item.active {
            background-color: #262626;
            color: #FFFFFF;
        }
        
        .nav-item:hover,
        .nav-sub-item:hover {
            background-color: #262626;
            color: #FFFFFF;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #121212;
        }

        ::-webkit-scrollbar-thumb {
            background: #262626;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #A1A1A1;
        }
    </style>

    @stack('scripts')
</body>
</html>