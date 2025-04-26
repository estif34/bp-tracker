<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blood Pressure Statistics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Your Statistics</h3>
                        <div class="space-x-2">
                            <a href="{{ route('blood-pressure.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-25 transition ease-in-out duration-150">
                                Back to Readings
                            </a>
                        </div>
                    </div>

                    @if(!$hasData)
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        You don't have any readings yet. <a href="{{ route('blood-pressure.create') }}" class="font-medium underline text-blue-700 hover:text-blue-600">Add your first reading</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Summary Cards -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            <div class="bg-white rounded-lg border border-gray-200 shadow-md p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">General Info</h4>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">Total Readings: <span class="font-medium text-gray-900">{{ $totalReadings }}</span></p>
                                    <p class="text-sm text-gray-600">First Reading: <span class="font-medium text-gray-900">{{ $firstReading }}</span></p>
                                    <p class="text-sm text-gray-600">Latest Reading: <span class="font-medium text-gray-900">{{ $lastReading }}</span></p>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg border border-gray-200 shadow-md p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Last 7 Days</h4>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">Readings: <span class="font-medium text-gray-900">{{ $weeklyStats['count'] }}</span></p>
                                    <p class="text-sm text-gray-600">Avg Systolic: <span class="font-medium text-gray-900">{{ $weeklyStats['avg_systolic'] }}</span></p>
                                    <p class="text-sm text-gray-600">Avg Diastolic: <span class="font-medium text-gray-900">{{ $weeklyStats['avg_diastolic'] }}</span></p>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg border border-gray-200 shadow-md p-6">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Last 30 Days</h4>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-600">Readings: <span class="font-medium text-gray-900">{{ $monthlyStats['count'] }}</span></p>
                                    <p class="text-sm text-gray-600">Avg Systolic: <span class="font-medium text-gray-900">{{ $monthlyStats['avg_systolic'] }}</span></p>
                                    <p class="text-sm text-gray-600">Avg Diastolic: <span class="font-medium text-gray-900">{{ $monthlyStats['avg_diastolic'] }}</span></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Detailed Statistics -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                    <h4 class="font-medium text-gray-900">All-Time Blood Pressure Stats</h4>
                                </div>
                                <div class="p-6">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metric</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Systolic</th>
                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diastolic</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Average</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['avg_systolic'] }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['avg_diastolic'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Minimum</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['min_systolic'] }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['min_diastolic'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Maximum</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['max_systolic'] }}</td>
                                                <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['max_diastolic'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-lg border border-gray-200 shadow-md overflow-hidden">
                                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                    <h4 class="font-medium text-gray-900">Blood Pressure Categories</h4>
                                </div>
                                <div class="p-6">
                                    <div class="space-y-3">
                                        <div>
                                            <div class="flex justify-between mb-1">
                                                <span class="text-sm font-medium text-gray-700">Normal</span>
                                                <span class="text-sm text-gray-500">{{ $categories['normal'] }} readings</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['normal'] / $totalReadings * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="flex justify-between mb-1">
                                                <span class="text-sm font-medium text-gray-700">Elevated</span>
                                                <span class="text-sm text-gray-500">{{ $categories['elevated'] }} readings</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-yellow-400 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['elevated'] / $totalReadings * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="flex justify-between mb-1">
                                                <span class="text-sm font-medium text-gray-700">Hypertension Stage 1</span>
                                                <span class="text-sm text-gray-500">{{ $categories['stage1'] }} readings</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-orange-400 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['stage1'] / $totalReadings * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="flex justify-between mb-1">
                                                <span class="text-sm font-medium text-gray-700">Hypertension Stage 2</span>
                                                <span class="text-sm text-gray-500">{{ $categories['stage2'] }} readings</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-red-500 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['stage2'] / $totalReadings * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <div class="flex justify-between mb-1">
                                                <span class="text-sm font-medium text-gray-700">Hypertensive Crisis</span>
                                                <span class="text-sm text-gray-500">{{ $categories['crisis'] }} readings</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-red-700 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['crisis'] / $totalReadings * 100) : 0 }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>