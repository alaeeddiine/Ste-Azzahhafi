<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Ste Azzahhafi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        secondary: {
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="h-full bg-gray-50 font-sans antialiased text-gray-800 flex flex-col md:flex-row">
    <!-- Mobile sidebar overlay -->
    <div class="fixed inset-0 z-20 bg-black bg-opacity-50 md:hidden sidebar-overlay hidden"></div>

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-primary-800 to-primary-900 text-white flex-shrink-0 transform -translate-x-full md:translate-x-0 fixed md:static inset-y-0 left-0 z-30 transition-transform duration-300 ease-in-out">
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="px-6 py-5 border-b border-primary-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-3 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <div>
                            <h1 class="text-xl font-bold tracking-tight">Ste Azzahhafi</h1>
                            <p class="text-xs text-primary-300 mt-1">PANEL ADMINISTRATEUR</p>
                        </div>
                    </div>
                    <button class="md:hidden text-primary-300 hover:text-white sidebar-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-2 py-4 overflow-y-auto">
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-primary-700' : 'hover:bg-primary-700' }}">
                            <i class="fas fa-tachometer-alt w-5 mr-3 text-center {{ request()->routeIs('admin.dashboard') ? 'text-secondary-400' : 'text-primary-300 group-hover:text-secondary-400' }}"></i>
                            <span class="font-medium">Tableau de bord</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.employes') }}"
                           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.employes') ? 'bg-primary-700' : 'hover:bg-primary-700' }}">
                            <i class="fas fa-users w-5 mr-3 text-center {{ request()->routeIs('admin.employes') ? 'text-secondary-400' : 'text-primary-300 group-hover:text-secondary-400' }}"></i>
                            <span class="font-medium">Employés</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.carburant') }}"
                           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.carburant') ? 'bg-primary-700' : 'hover:bg-primary-700' }}">
                            <i class="fas fa-gas-pump w-5 mr-3 text-center {{ request()->routeIs('admin.carburant') ? 'text-secondary-400' : 'text-primary-300 group-hover:text-secondary-400' }}"></i>
                            <span class="font-medium">Carburant</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.stock') }}"
                           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.stock') ? 'bg-primary-700' : 'hover:bg-primary-700' }}">
                            <i class="fas fa-boxes w-5 mr-3 text-center {{ request()->routeIs('admin.stock') ? 'text-secondary-400' : 'text-primary-300 group-hover:text-secondary-400' }}"></i>
                            <span class="font-medium">Stock</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.etat') }}"
                           class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.etat') ? 'bg-primary-700' : 'hover:bg-primary-700' }}">
                            <i class="fas fa-file-alt w-5 mr-3 text-center {{ request()->routeIs('admin.etat') ? 'text-secondary-400' : 'text-primary-300 group-hover:text-secondary-400' }}"></i>
                            <span class="font-medium">États journaliers</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User & Logout Section -->
            <div class="p-4 border-t border-primary-700">
                <div class="flex items-center mb-4 px-3 py-2 rounded-lg hover:bg-primary-700 transition-colors duration-200">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=A+Z&background=f97316&color=fff"
                             class="w-10 h-10 rounded-full"
                             alt="Admin">
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-primary-800"></span>
                    </div>
                    <div class="ml-3">
                        <div class="text-sm font-medium">Azzahhafi</div>
                        <div class="text-xs text-primary-300">Administrateur</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-center px-4 py-2 bg-secondary-500 hover:bg-secondary-600 text-white rounded-lg transition-colors duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Déconnexion
                    </button>
                </form>

                <footer class="text-xs text-primary-300 text-center mt-4 pt-3 border-t border-primary-700">
                    &copy; {{ date('Y') }} Ste Azzahhafi • v1.0.0
                </footer>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 min-w-0 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="sticky top-0 z-10 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <button class="md:hidden text-gray-500 hover:text-primary-600 mr-4 sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1 class="text-xl font-semibold text-gray-900">@yield('title')</h1>
            </div>

            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button class="text-gray-500 hover:text-primary-600 relative">
                        <i class="fas fa-bell text-lg"></i>
                    </button>
                </div>
                <div class="hidden md:flex items-center text-sm text-gray-600 bg-gray-100 px-3 py-1 rounded-full">
                    <i class="far fa-clock mr-2 text-secondary-500"></i>
                    {{ now()->format('d/m/Y H:i') }}
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <section class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <!-- Breadcrumb -->
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-600 transition-colors duration-200 flex items-center">
                    <i class="fas fa-home mr-2 text-primary-500"></i>
                    Tableau de bord
                </a>
                <span class="mx-2 text-gray-400">/</span>
                <span class="text-primary-600 font-medium">@yield('title')</span>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                @yield('content')
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile sidebar toggle
            const sidebar = document.querySelector('aside');
            const sidebarOverlay = document.querySelector('.sidebar-overlay');
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const sidebarClose = document.querySelector('.sidebar-close');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
            });

            sidebarClose.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });

            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });

            // Active link indicator
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('nav a');
            
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('bg-primary-700');
                    const icon = link.querySelector('i');
                    icon.classList.add('text-secondary-400');
                }
            });
        });
    </script>
</body>
</html>