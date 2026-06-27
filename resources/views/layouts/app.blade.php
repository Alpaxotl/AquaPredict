<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - AquaPredict</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Sidebar transition */
        #sidebar {
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            width: 16rem; /* 256px = w-64 */
        }
        #sidebar.collapsed {
            width: 4.5rem; /* 72px - icon-only */
        }

        /* Hide text labels when collapsed */
        #sidebar.collapsed .sidebar-label,
        #sidebar.collapsed .sidebar-brand-text,
        #sidebar.collapsed .sidebar-user-info,
        #sidebar.collapsed .sidebar-logout-text {
            display: none;
        }

        /* Center icons when collapsed */
        #sidebar.collapsed .nav-link {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        /* Tooltip on hover when collapsed */
        #sidebar.collapsed .nav-link {
            position: relative;
        }
        #sidebar.collapsed .nav-link:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: calc(100% + 12px);
            top: 50%;
            transform: translateY(-50%);
            background: #22d3c5;
            color: #03101a;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            white-space: nowrap;
            z-index: 100;
            pointer-events: none;
        }
        #sidebar.collapsed .sidebar-footer {
            padding: 0.75rem 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }
        #sidebar.collapsed .sidebar-logout-btn {
            width: 38px;
            height: 38px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Toggle button */
        #sidebarToggle {
            transition: transform 0.3s ease;
        }
    </style>
</head>
<body class="bg-obsidian min-h-screen flex text-gray-200">

    <!-- Sidebar -->
    <aside id="sidebar" class="bg-slate-card border-r border-gold/10 flex flex-col justify-between shrink-0 relative">

        <!-- Toggle Button (fixed to sidebar edge) -->
        <button id="sidebarToggle" onclick="toggleSidebar()"
            title="Buka/Tutup Sidebar"
            class="absolute -right-3 top-20 z-50 w-6 h-6 bg-gold text-obsidian rounded-full flex items-center justify-center shadow-lg hover:bg-gold-hover transition-all">
            <svg id="toggleIcon" xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <div class="flex-grow overflow-hidden">
            <!-- Brand -->
            <div class="p-4 border-b border-gold/10 flex items-center space-x-3 min-h-[68px]">
                <a href="{{ route('dashboard') }}" class="text-gold text-2xl font-serif-heading font-bold shrink-0" title="AquaPredict">
                    &#9732;
                </a>
                <div class="sidebar-brand-text overflow-hidden">
                    <a href="{{ route('dashboard') }}" class="text-gold text-base font-serif-heading font-semibold tracking-widest block leading-tight whitespace-nowrap">
                        AQUAPREDICT
                    </a>
                    <span class="text-[10px] text-gray-500 block tracking-wider uppercase whitespace-nowrap">Budidaya Air Tawar</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3 space-y-1">
                <a href="{{ route('dashboard') }}"
                    data-tooltip="Dashboard"
                    class="nav-link flex items-center space-x-3 px-3 py-3 rounded-lg text-sm transition-all
                        {{ request()->routeIs('dashboard') ? 'bg-gold text-obsidian font-semibold shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gold/5' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap">Dashboard</span>
                </a>

                <a href="{{ route('ponds.index') }}"
                    data-tooltip="Kelola Kolam"
                    class="nav-link flex items-center space-x-3 px-3 py-3 rounded-lg text-sm transition-all
                        {{ request()->routeIs('ponds.index') ? 'bg-gold text-obsidian font-semibold shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gold/5' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap">Kelola Kolam</span>
                </a>

                <a href="{{ route('water-logs.index') }}"
                    data-tooltip="Log Kualitas Air"
                    class="nav-link flex items-center space-x-3 px-3 py-3 rounded-lg text-sm transition-all
                        {{ request()->routeIs('water-logs.index') ? 'bg-gold text-obsidian font-semibold shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gold/5' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap">Log Kualitas Air</span>
                </a>

                <a href="{{ route('analyzer') }}"
                    data-tooltip="Analisis Kelayakan"
                    class="nav-link flex items-center space-x-3 px-3 py-3 rounded-lg text-sm transition-all
                        {{ request()->routeIs('analyzer') ? 'bg-gold text-obsidian font-semibold shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gold/5' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap">Analisis Kelayakan</span>
                </a>

                <a href="{{ route('consultation') }}"
                    data-tooltip="Konsultasi Budidaya"
                    class="nav-link flex items-center space-x-3 px-3 py-3 rounded-lg text-sm transition-all
                        {{ request()->routeIs('consultation') ? 'bg-gold text-obsidian font-semibold shadow-lg' : 'text-gray-400 hover:text-white hover:bg-gold/5' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="sidebar-label whitespace-nowrap">Panduan Budidaya</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer & Logout -->
        <div class="sidebar-footer p-3 border-t border-gold/10 bg-obsidian/30">
            <div class="sidebar-user-info flex items-center space-x-2 mb-3 px-1 overflow-hidden">
                <div class="w-8 h-8 rounded-full bg-gold/10 border border-gold/20 flex items-center justify-center text-gold font-bold text-xs shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-semibold text-white truncate leading-tight">{{ Auth::user()->name }}</p>
                    <span class="text-[10px] uppercase font-mono-data px-1.5 py-0.5 rounded {{ Auth::user()->role === 'admin' ? 'bg-gold/10 text-gold border border-gold/20' : 'bg-gray-800 text-gray-400' }}">
                        {{ Auth::user()->role }}
                    </span>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    title="Keluar"
                    class="sidebar-logout-btn w-full text-center text-xs text-rose-400 hover:text-rose-300 bg-rose-500/5 hover:bg-rose-500/10 border border-rose-500/20 py-2 rounded-lg transition-all font-medium flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="sidebar-logout-text">Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div id="mainContent" class="flex-grow flex flex-col min-h-screen overflow-y-auto">
        <!-- Top Navbar -->
        <header class="h-16 border-b border-gold/10 bg-slate-card/40 flex items-center justify-between px-8 sticky top-0 z-30 backdrop-blur-md">
            <h2 class="text-lg font-serif-heading font-medium tracking-wide text-white">
                @yield('header_title')
            </h2>
            <div class="flex items-center space-x-3 text-xs text-gray-500">
                <span>Sistem Monitoring Kualitas Air</span>
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
            </div>
        </header>

        <!-- Dynamic Page Content -->
        <main class="p-6 lg:p-8 flex-grow">
            <!-- Global Flash Messages -->
            @if(session('success'))
                <div id="flash-success" class="mb-6 bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 px-5 py-4 rounded-xl text-sm flex items-center justify-between shadow-lg">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-400/60 hover:text-emerald-300 ml-4">&#x2715;</button>
                </div>
            @endif
            @if(session('error'))
                <div id="flash-error" class="mb-6 bg-rose-500/15 border border-rose-500/30 text-rose-400 px-5 py-4 rounded-xl text-sm flex items-center justify-between shadow-lg">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-rose-400/60 hover:text-rose-300 ml-4">&#x2715;</button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const icon = document.getElementById('toggleIcon');
            const isCollapsed = sidebar.classList.toggle('collapsed');

            // Rotate icon
            icon.style.transform = isCollapsed ? 'rotate(180deg)' : 'rotate(0deg)';

            // Persist preference
            localStorage.setItem('sidebar_collapsed', isCollapsed ? '1' : '0');
        }

        // Restore preference on load
        document.addEventListener('DOMContentLoaded', function () {
            const collapsed = localStorage.getItem('sidebar_collapsed');
            if (collapsed === '1') {
                document.getElementById('sidebar').classList.add('collapsed');
                document.getElementById('toggleIcon').style.transform = 'rotate(180deg)';
            }
        });
    </script>
</body>
</html>
