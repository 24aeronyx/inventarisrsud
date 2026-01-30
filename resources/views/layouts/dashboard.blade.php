<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Inventaris RSUD</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    @stack('styles')
</head>

<body class="font-sans bg-slate-100">

@php
    $menus = config('menu', []);
    $currentPath = request()->path();
@endphp

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar Overlay Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-200 bg-opacity-50 z-40 hidden lg:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-slate-800 transform -translate-x-full transition-transform duration-300
               lg:translate-x-0 lg:static">

        <div class="flex flex-col h-full">

            <!-- Logo -->
            <div class="flex items-center px-6 py-4 gap-2">
                <img src="{{ asset('/logo.png') }}" class="bg-white rounded-full px-1 w-10 h-10">
                <h1 class="text-white font-semibold text-lg">Inventaris RSUD</h1>
            </div>

            <!-- NAV -->
            <nav class="flex-1 px-4 py-6 overflow-y-auto">
                <ul class="space-y-2">

                    @foreach ($menus as $menu)

                        {{-- ROLE FILTER --}}
                        @if(isset($menu['role']) && auth()->user()->role !== $menu['role'])
                            @continue
                        @endif

                        {{-- DROPDOWN --}}
                        @if(isset($menu['children']))
                            @php
                                $dropdownActive = collect($menu['children'])
                                    ->pluck('url')
                                    ->contains(fn($url) => request()->is(ltrim($url,'/').'*'));
                            @endphp

                            <li>
                                <button
                                    class="nav-item w-full flex items-center justify-between px-4 py-3 rounded-lg transition-all
                                           {{ $dropdownActive ? 'active' : '' }}"
                                    onclick="toggleDropdown(this)">
                                    <div class="flex items-center">
                                        <iconify-icon icon="{{ $menu['icon'] }}" class="mr-3 text-current"></iconify-icon>
                                        <span>{{ $menu['label'] }}</span>
                                    </div>
                                    <iconify-icon icon="mdi:chevron-down"></iconify-icon>
                                </button>

                                <ul class="dropdown-content mt-2 ml-4 space-y-1 {{ $dropdownActive ? '' : 'hidden' }}">
                                    @foreach ($menu['children'] as $child)
                                        <li>
                                            <a href="{{ $child['url'] }}"
                                               class="nav-sub-item flex items-center px-4 py-2 rounded-lg transition-all
                                                      {{ request()->is(ltrim($child['url'],'/').'*') ? 'active' : '' }}">
                                                <iconify-icon icon="{{ $child['icon'] }}" class="mr-3 text-current"></iconify-icon>
                                                <span>{{ $child['label'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                        {{-- MENU BIASA --}}
                        @else
                            @php
                                $isActive = false;
                                if ($menu['url'] === '/dashboard') {
                                    $isActive = request()->is('dashboard');
                                } else {
                                    $isActive = request()->is(ltrim($menu['url'],'/').'*');
                                }
                            @endphp

                            <li>
                                <a href="{{ $menu['url'] }}"
                                   class="nav-item flex items-center px-4 py-3 rounded-lg transition-all
                                          {{ $isActive ? 'active' : '' }}">
                                    <iconify-icon icon="{{ $menu['icon'] }}" class="mr-3 text-current"></iconify-icon>
                                    <span>{{ $menu['label'] }}</span>
                                </a>
                            </li>
                        @endif

                    @endforeach
                </ul>
            </nav>

            <!-- Logout -->
            <div class="px-4 py-4 border-t border-slate-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="nav-item w-full flex items-center px-4 py-3 rounded-lg transition-all">
                        <iconify-icon icon="mdi:logout" class="mr-3"></iconify-icon>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 overflow-y-auto bg-slate-100 p-6">
        @yield('content')
    </main>
</div>

<!-- JS -->
<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const button = document.getElementById('mobile-menu-button');

    function toggleDropdown(btn) {
        const menu = btn.nextElementSibling;
        menu.classList.toggle('hidden');
    }
</script>

<!-- STYLE -->
<style>
    .nav-item,
    .nav-sub-item {
        color: #FFFFFF; /* normal */
    }

    .nav-item:hover,
    .nav-sub-item:hover,
    .nav-item.active,
    .nav-sub-item.active {
        background-color: #F1F5F9; /* slate-100 */
        color: #1E293B;            /* slate-800 */
    }

    ::-webkit-scrollbar {
        width: 6px;
    }
    ::-webkit-scrollbar-track {
        background: #1E293B;
    }
    ::-webkit-scrollbar-thumb {
        background: #334155;
        border-radius: 4px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #64748B;
    }
</style>

@stack('scripts')
</body>
</html>
