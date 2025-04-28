<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4">
                    <h3 class="text-white font-medium">Welcome to Your Blood Pressure Tracker</h3>
                    <p class="text-indigo-100 text-sm mt-1">Monitor, track, and analyze your blood pressure readings over time.</p>
                </div>

                <!-- Quick Stats -->
                @php
                    // Get stats for the dashboard
                    $user = Auth::user();
                    $totalReadings = $user->bloodPressureReadings()->count();
                    $latestReading = $user->bloodPressureReadings()->orderBy('reading_date', 'desc')
                                        ->orderBy('reading_time', 'desc')->first();
                @endphp

                @if($latestReading)
                    @php
                        $category = $latestReading->getCategory();
                    @endphp
                    <!-- Latest Reading Card -->
                    <div class="mb-8 bg-gray-50 rounded-lg p-4 mx-6 mt-6">
                        <div class="flex items-center justify-between">
                            <h4 class="text-base font-semibold text-gray-700">Latest Reading</h4>
                            <span class="text-sm text-gray-500">{{ $latestReading->reading_date->format('M d, Y') }} {{ $latestReading->reading_time ? $latestReading->reading_time->format('H:i') : '' }}</span>
                        </div>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <div class="p-2 rounded-md bg-indigo-50 mr-3">
                                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">Systolic</p>
                                    <p class="text-xl font-bold">{{ $latestReading->systolic }} <span class="text-sm font-normal">mmHg</span></p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-white rounded-lg shadow-sm">
                                <div class="p-2 rounded-md bg-blue-50 mr-3">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500">Diastolic</p>
                                    <p class="text-xl font-bold">{{ $latestReading->diastolic }} <span class="text-sm font-normal">mmHg</span></p>
                                </div>
                            </div>
                            <div class="flex items-center p-3 bg-{{ $category['bgColor'] }} rounded-lg shadow-sm">
                                <div class="p-2 rounded-md bg-white mr-3">
                                    <svg class="w-6 h-6 text-{{ $category['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-{{ $category['textColor'] }}">Status</p>
                                    <p class="text-lg font-bold text-{{ $category['textColor'] }}">{{ $category['name'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Quick Actions Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
                    <a href="{{ route('blood-pressure.create') }}" class="flex flex-col items-center p-6 bg-gradient-to-r from-green-100 to-green-50 rounded-lg shadow-sm hover:shadow-md transition duration-200 hover:from-green-200 hover:to-green-100">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-green-500 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h5 class="mt-4 text-lg font-semibold text-gray-900">Add New Reading</h5>
                        <p class="mt-2 text-center text-sm text-gray-600">Record your latest blood pressure measurement</p>
                    </a>
                    <a href="{{ route('blood-pressure.chart') }}" class="flex flex-col items-center p-6 bg-gradient-to-r from-blue-100 to-blue-50 rounded-lg shadow-sm hover:shadow-md transition duration-200 hover:from-blue-200 hover:to-blue-100">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-500 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <h5 class="mt-4 text-lg font-semibold text-gray-900">View Chart</h5>
                        <p class="mt-2 text-center text-sm text-gray-600">Visualize your blood pressure over time</p>
                    </a>
                    <a href="{{ route('blood-pressure.statistics') }}" class="flex flex-col items-center p-6 bg-gradient-to-r from-purple-100 to-purple-50 rounded-lg shadow-sm hover:shadow-md transition duration-200 hover:from-purple-200 hover:to-purple-100">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-purple-500 text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h5 class="mt-4 text-lg font-semibold text-gray-900">View Statistics</h5>
                        <p class="mt-2 text-center text-sm text-gray-600">Analyze your blood pressure data</p>
                    </a>
                </div>

                <!-- Additional Features -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6 pt-0">
                    <div class="p-4 border border-gray-200 rounded-lg bg-white shadow-sm hover:shadow-md transition duration-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h5 class="text-lg font-semibold text-gray-900">Blood Pressure Guide</h5>
                                <p class="mt-1 text-sm text-gray-600">Learn about blood pressure categories and healthy ranges.</p>
                                <a href="{{ route('blood-pressure.guide') }}" class="mt-2 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                    View Guide
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 border border-gray-200 rounded-lg bg-white shadow-sm hover:shadow-md transition duration-200">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h5 class="text-lg font-semibold text-gray-900">Export Your Data</h5>
                                <p class="mt-1 text-sm text-gray-600">Download your readings as PDF or CSV for your records.</p>
                                <div class="mt-2 space-x-2">
                                    <a href="{{ route('blood-pressure.export.pdf') }}" class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-800">
                                        Export as PDF
                                    </a>
                                    <span class="text-gray-300">|</span>
                                    <a href="{{ route('blood-pressure.export.csv') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800">
                                        Export as CSV
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Health Tips Section -->
                <div class="p-6 pt-0">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-lg font-bold text-gray-900 mb-4">Healthy Blood Pressure Tips</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex p-4 bg-white rounded-lg">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-green-100 text-green-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900">Regular Exercise</h4>
                                    <p class="mt-1 text-sm text-gray-600">Aim for at least 150 minutes of moderate activity per week to help lower blood pressure.</p>
                                </div>
                            </div>
                            
                            <div class="flex p-4 bg-white rounded-lg">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-100 text-blue-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900">Consistent Monitoring</h4>
                                    <p class="mt-1 text-sm text-gray-600">Measure your blood pressure at the same time each day for the most accurate tracking.</p>
                                </div>
                            </div>
                            
                            <div class="flex p-4 bg-white rounded-lg">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-yellow-100 text-yellow-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900">Limit Sodium</h4>
                                    <p class="mt-1 text-sm text-gray-600">Reduce salt intake to help lower blood pressure and improve heart health.</p>
                                </div>
                            </div>
                            
                            <div class="flex p-4 bg-white rounded-lg">
                                <div class="flex-shrink-0 mr-4">
                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-purple-100 text-purple-500">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-base font-semibold text-gray-900">Quality Sleep</h4>
                                    <p class="mt-1 text-sm text-gray-600">Aim for 7-8 hours of sleep per night to support healthy blood pressure levels.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!$latestReading)
                    <div class="mx-6 my-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    You haven't recorded any readings yet. <a href="{{ route('blood-pressure.create') }}" class="font-medium underline text-blue-700 hover:text-blue-600">Add your first reading</a> to get started.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>