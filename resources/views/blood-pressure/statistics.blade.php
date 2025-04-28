<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blood Pressure Statistics') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('blood-pressure.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg class="mr-2 -ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Readings
                </a>
                <a href="{{ route('blood-pressure.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-2 -ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Reading
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(!$hasData)
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="p-6">
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        You don't have any readings yet. <a href="{{ route('blood-pressure.create') }}" class="font-medium underline text-blue-700 hover:text-blue-600">Add your first reading</a>.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Overview Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-4 py-2">
                            <h3 class="text-white font-medium text-sm">Overview</h3>
                        </div>
                        <div class="p-4">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Total Readings</span>
                                    <span class="text-lg font-semibold text-gray-900">{{ $totalReadings }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">First Reading</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $firstReading }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Latest Reading</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $lastReading }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="bg-gradient-to-r from-purple-600 to-pink-500 px-4 py-2">
                            <h3 class="text-white font-medium text-sm">Last 7 Days</h3>
                        </div>
                        <div class="p-4">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Readings</span>
                                    <span class="text-lg font-semibold text-gray-900">{{ $weeklyStats['count'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Avg Systolic</span>
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">{{ $weeklyStats['avg_systolic'] }}</span>
                                        <span class="ml-1 text-xs text-gray-500">mmHg</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Avg Diastolic</span>
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">{{ $weeklyStats['avg_diastolic'] }}</span>
                                        <span class="ml-1 text-xs text-gray-500">mmHg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="bg-gradient-to-r from-blue-600 to-cyan-500 px-4 py-2">
                            <h3 class="text-white font-medium text-sm">Last 30 Days</h3>
                        </div>
                        <div class="p-4">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Readings</span>
                                    <span class="text-lg font-semibold text-gray-900">{{ $monthlyStats['count'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Avg Systolic</span>
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">{{ $monthlyStats['avg_systolic'] }}</span>
                                        <span class="ml-1 text-xs text-gray-500">mmHg</span>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">Avg Diastolic</span>
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">{{ $monthlyStats['avg_diastolic'] }}</span>
                                        <span class="ml-1 text-xs text-gray-500">mmHg</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Statistics -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                            <h4 class="font-medium text-gray-900">All-Time Statistics</h4>
                        </div>
                        <div class="p-4">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metric</th>
                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Systolic</th>
                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diastolic</th>
                                            <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Heart Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Average</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['avg_systolic'] }}</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['avg_diastolic'] }}</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['avg_heart_rate'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Minimum</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['min_systolic'] }}</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['min_diastolic'] }}</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">-</td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">Maximum</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['max_systolic'] }}</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ $allTimeStats['max_diastolic'] }}</td>
                                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-md rounded-lg">
                        <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                            <h4 class="font-medium text-gray-900">Reading Categories</h4>
                        </div>
                        <div class="p-4">
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <div class="flex items-center">
                                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                            <span class="text-sm font-medium text-gray-700">Normal</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $categories['normal'] }} readings</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['normal'] / $totalReadings * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <div class="flex items-center">
                                            <span class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></span>
                                            <span class="text-sm font-medium text-gray-700">Elevated</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $categories['elevated'] }} readings</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-yellow-400 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['elevated'] / $totalReadings * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <div class="flex items-center">
                                            <span class="w-3 h-3 bg-orange-400 rounded-full mr-2"></span>
                                            <span class="text-sm font-medium text-gray-700">Hypertension Stage 1</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $categories['stage1'] }} readings</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-orange-400 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['stage1'] / $totalReadings * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <div class="flex items-center">
                                            <span class="w-3 h-3 bg-red-500 rounded-full mr-2"></span>
                                            <span class="text-sm font-medium text-gray-700">Hypertension Stage 2</span>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $categories['stage2'] }} readings</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-red-500 h-2.5 rounded-full" style="width: {{ $totalReadings > 0 ? ($categories['stage2'] / $totalReadings * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                                
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <div class="flex items-center">
                                            <span class="w-3 h-3 bg-red-700 rounded-full mr-2"></span>
                                            <span class="text-sm font-medium text-gray-700">Hypertensive Crisis</span>
                                        </div>
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

                <!-- Recommendations -->
                <div class="mt-6 bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                        <h4 class="font-medium text-gray-900">Recommendations</h4>
                    </div>
                    <div class="p-4">
                        @php
                            $avgSystolic = $allTimeStats['avg_systolic'];
                            $avgDiastolic = $allTimeStats['avg_diastolic'];
                            
                            $recommendations = [];
                            
                            if ($avgSystolic < 120 && $avgDiastolic < 80) {
                                $recommendations[] = [
                                    'title' => 'Maintain Your Healthy Lifestyle',
                                    'description' => 'Your blood pressure is within the normal range. Continue with your healthy habits.',
                                    'iconColor' => 'text-green-500',
                                    'bgColor' => 'bg-green-50'
                                ];
                            } elseif (($avgSystolic >= 120 && $avgSystolic <= 129) && $avgDiastolic < 80) {
                                $recommendations[] = [
                                    'title' => 'Take Preventive Steps',
                                    'description' => 'Your blood pressure is elevated. Consider increasing exercise and reducing sodium intake.',
                                    'iconColor' => 'text-yellow-500',
                                    'bgColor' => 'bg-yellow-50'
                                ];
                            } elseif (($avgSystolic >= 130 && $avgSystolic <= 139) || ($avgDiastolic >= 80 && $avgDiastolic <= 89)) {
                                $recommendations[] = [
                                    'title' => 'Consult Your Healthcare Provider',
                                    'description' => 'Your blood pressure shows Stage 1 hypertension. Lifestyle changes and possibly medication may be recommended.',
                                    'iconColor' => 'text-orange-500',
                                    'bgColor' => 'bg-orange-50'
                                ];
                            } elseif (($avgSystolic >= 140) || ($avgDiastolic >= 90)) {
                                $recommendations[] = [
                                    'title' => 'Seek Medical Attention',
                                    'description' => 'Your blood pressure indicates Stage 2 hypertension or higher. Please consult with a healthcare professional promptly.',
                                    'iconColor' => 'text-red-500',
                                    'bgColor' => 'bg-red-50'
                                ];
                            }
                            
                            // Always add general recommendations
                            $recommendations[] = [
                                'title' => 'Regular Monitoring',
                                'description' => 'Continue to monitor your blood pressure regularly and at consistent times of day.',
                                'iconColor' => 'text-blue-500',
                                'bgColor' => 'bg-blue-50'
                            ];
                            
                            $recommendations[] = [
                                'title' => 'Healthy Lifestyle',
                                'description' => 'Maintain a balanced diet low in sodium, regular exercise, limited alcohol, and stress management.',
                                'iconColor' => 'text-indigo-500',
                                'bgColor' => 'bg-indigo-50'
                            ];
                        @endphp
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($recommendations as $recommendation)
                                <div class="{{ $recommendation['bgColor'] }} p-4 rounded-lg">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 {{ $recommendation['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h5 class="text-sm font-medium">{{ $recommendation['title'] }}</h5>
                                            <p class="mt-1 text-xs">{{ $recommendation['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4 text-xs text-gray-500">
                            <p><strong>Disclaimer:</strong> These recommendations are based on general guidelines and your average readings. Always consult with a healthcare professional for personalized medical advice.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>