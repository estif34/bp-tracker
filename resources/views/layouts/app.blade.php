<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Custom scrollbar for the sidebar */
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 20px;
        }
        
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- This wrapper div ensures proper flex layout -->
        <div class="flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
            <!-- Sidebar - Fixed position on desktop, absolute on mobile -->
            <div :class="{'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen}"
                 class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 
                       md:translate-x-0 md:static md:h-screen md:w-64">
            
                <!-- Sidebar header -->
                <div class="h-16 bg-gradient-to-r from-indigo-600 to-blue-500 flex items-center justify-center px-4">
                    <div class="flex items-center space-x-2 text-white">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        <span class="text-xl font-bold">BP Tracker</span>
                    </div>
                </div>
                
                <!-- User profile -->
                <div class="flex items-center px-4 py-5 border-b border-gray-100">
                    <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                        <span class="text-lg font-bold text-indigo-600">{{ Auth::user()->name[0] }}</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                
                <!-- Sidebar navigation -->
                <div class="py-4 sidebar-scroll overflow-y-auto" style="height: calc(100vh - 170px);">
                    <nav class="px-4 space-y-1">
                        <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Main
                        </p>
                        
                        <a href="{{ route('dashboard') }}" 
                           class="{{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} 
                                  flex items-center px-3 py-2.5 text-sm font-medium rounded-lg group transition-colors duration-200">
                            <svg class="{{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} 
                                       mr-3 h-5 w-5 flex-shrink-0 transition-colors duration-200" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Dashboard
                        </a>
                        
                        <p class="mt-4 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Blood Pressure
                        </p>
                        
                        <a href="{{ route('blood-pressure.index') }}" 
                           class="{{ request()->routeIs('blood-pressure.index') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} 
                                  flex items-center px-3 py-2.5 text-sm font-medium rounded-lg group transition-colors duration-200">
                            <svg class="{{ request()->routeIs('blood-pressure.index') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} 
                                       mr-3 h-5 w-5 flex-shrink-0 transition-colors duration-200" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Readings
                        </a>
                        
                        <a href="{{ route('blood-pressure.create') }}" 
                           class="{{ request()->routeIs('blood-pressure.create') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} 
                                  flex items-center px-3 py-2.5 text-sm font-medium rounded-lg group transition-colors duration-200">
                            <svg class="{{ request()->routeIs('blood-pressure.create') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} 
                                       mr-3 h-5 w-5 flex-shrink-0 transition-colors duration-200" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add New Reading
                        </a>
                        
                        <a href="{{ route('blood-pressure.chart') }}" 
                           class="{{ request()->routeIs('blood-pressure.chart') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} 
                                  flex items-center px-3 py-2.5 text-sm font-medium rounded-lg group transition-colors duration-200">
                            <svg class="{{ request()->routeIs('blood-pressure.chart') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} 
                                       mr-3 h-5 w-5 flex-shrink-0 transition-colors duration-200" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                            Chart
                        </a>
                        
                        <a href="{{ route('blood-pressure.statistics') }}" 
                           class="{{ request()->routeIs('blood-pressure.statistics') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} 
                                  flex items-center px-3 py-2.5 text-sm font-medium rounded-lg group transition-colors duration-200">
                            <svg class="{{ request()->routeIs('blood-pressure.statistics') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} 
                                       mr-3 h-5 w-5 flex-shrink-0 transition-colors duration-200" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Statistics
                        </a>
                        
                        <p class="mt-4 px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            Resources
                        </p>
                        
                        <a href="{{ route('blood-pressure.guide') }}" 
                           class="{{ request()->routeIs('blood-pressure.guide') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} 
                                  flex items-center px-3 py-2.5 text-sm font-medium rounded-lg group transition-colors duration-200">
                            <svg class="{{ request()->routeIs('blood-pressure.guide') ? 'text-indigo-600' : 'text-gray-400 group-hover:text-gray-500' }} 
                                       mr-3 h-5 w-5 flex-shrink-0 transition-colors duration-200" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Guide
                        </a>
                    </nav>
                </div>
                
                <!-- Sidebar footer -->
                <div class="absolute bottom-0 w-full border-t border-gray-100 bg-white">
                    <form method="POST" action="{{ route('logout') }}" class="p-4">
                        @csrf
                        <button type="submit" class="flex w-full items-center px-3 py-2 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 group transition-colors duration-200">
                            <svg class="mr-3 h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Sign out
                        </button>
                    </form>
                    
                    <div class="px-4 py-2 bg-gray-50 text-xs text-center text-gray-500">
                        <p>Blood Pressure Tracker v1.0</p>
                        <p>&copy; {{ date('Y') }} Your Name</p>
                    </div>
                </div>
            </div>

            <!-- Mobile sidebar backdrop -->
            <div x-show="sidebarOpen" 
                 @click="sidebarOpen = false" 
                 class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 md:hidden"
                 x-cloak></div>
            
            <!-- Main content area -->
            <div class="flex flex-col flex-1 w-full overflow-hidden">
                <!-- Mobile header -->
                <div class="md:hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-4 py-3 flex items-center justify-between">
                        <button @click="sidebarOpen = true" class="text-white focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        
                        <div class="flex items-center space-x-2 text-white">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span class="text-lg font-bold">BP Tracker</span>
                        </div>
                        
                        <div class="relative" x-data="{ profileOpen: false }">
                            <button @click="profileOpen = !profileOpen" class="flex items-center focus:outline-none">
                                <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-indigo-600">{{ Auth::user()->name[0] }}</span>
                                </div>
                            </button>
                            
                            <div x-show="profileOpen" 
                                 @click.away="profileOpen = false"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50"
                                 x-cloak>
                                <div class="py-2 px-4 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Page header -->
                @if (isset($header))
                    <header class="bg-white shadow-sm">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif
                
                <!-- Main content -->
                <main class="flex-1 overflow-y-auto">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>