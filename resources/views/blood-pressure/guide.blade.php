<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blood Pressure Guide') }}
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
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4">
                    <h3 class="text-white font-medium">Understanding Blood Pressure</h3>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none">
                        <p class="text-gray-700">Blood pressure is typically recorded as two numbers: systolic and diastolic. A reading is written as the systolic number over the diastolic number, such as 120/80 mmHg.</p>
                        
                        <div class="my-6 flex flex-col md:flex-row gap-6">
                            <div class="bg-indigo-50 p-4 rounded-lg flex-1">
                                <div class="flex items-center mb-2">
                                    <svg class="h-6 w-6 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6-6"></path>
                                    </svg>
                                    <h4 class="text-lg font-medium text-indigo-900">Systolic</h4>
                                </div>
                                <p class="text-sm text-indigo-900">The top number measures the pressure in your arteries when your heart beats (contracts).</p>
                            </div>
                            
                            <div class="bg-blue-50 p-4 rounded-lg flex-1">
                                <div class="flex items-center mb-2">
                                    <svg class="h-6 w-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                                    </svg>
                                    <h4 class="text-lg font-medium text-blue-900">Diastolic</h4>
                                </div>
                                <p class="text-sm text-blue-900">The bottom number measures the pressure in your arteries when your heart rests between beats.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="font-medium text-gray-900">Blood Pressure Categories</h3>
                </div>
                
                <div class="overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Systolic (mmHg)</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diastolic (mmHg)</th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">What to Do</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-green-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-4 w-4 rounded-full bg-green-500 mr-2"></div>
                                            <span class="font-medium text-gray-900">Normal</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Less than 120</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Less than 80</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Maintain a healthy lifestyle.</td>
                                </tr>
                                <tr class="hover:bg-yellow-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-4 w-4 rounded-full bg-yellow-400 mr-2"></div>
                                            <span class="font-medium text-gray-900">Elevated</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">120-129</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Less than 80</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Adopt lifestyle changes, monitor regularly.</td>
                                </tr>
                                <tr class="hover:bg-orange-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-4 w-4 rounded-full bg-orange-400 mr-2"></div>
                                            <span class="font-medium text-gray-900">Hypertension Stage 1</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">130-139</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">80-89</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Consult with healthcare provider, lifestyle changes.</td>
                                </tr>
                                <tr class="hover:bg-red-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-4 w-4 rounded-full bg-red-500 mr-2"></div>
                                            <span class="font-medium text-gray-900">Hypertension Stage 2</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">140 or higher</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">90 or higher</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Consult with healthcare provider, medication may be needed.</td>
                                </tr>
                                <tr class="hover:bg-red-100">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-4 w-4 rounded-full bg-red-700 mr-2"></div>
                                            <span class="font-medium text-gray-900">Hypertensive Crisis</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Higher than 180</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Higher than 120</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">Seek emergency medical attention immediately.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="font-medium text-gray-900">Tips for Accurate Readings</h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Sit with your back straight and supported.</span>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Keep your feet flat on the floor.</span>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Rest your arm on a flat surface at heart level.</span>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Don't talk during the measurement.</span>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Empty your bladder before measuring.</span>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Avoid caffeine, exercise, and smoking for at least 30 minutes before measurement.</span>
                            </li>
                            <li class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 text-sm text-gray-700">Take readings at the same time each day when possible.</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="font-medium text-gray-900">Factors That Can Affect Readings</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="h-8 w-8 flex-shrink-0 rounded-full bg-red-100 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Stress and Anxiety</h4>
                                    <p class="mt-1 text-xs text-gray-600">Stress and anxiety can cause temporary increases in blood pressure.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="h-8 w-8 flex-shrink-0 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Time of Day</h4>
                                    <p class="mt-1 text-xs text-gray-600">Blood pressure naturally fluctuates throughout the day, typically being highest in the morning.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="h-8 w-8 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Recent Activities</h4>
                                    <p class="mt-1 text-xs text-gray-600">Exercise, caffeine, alcohol, and smoking can all temporarily affect blood pressure readings.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="h-8 w-8 flex-shrink-0 rounded-full bg-purple-100 flex items-center justify-center">
                                    <svg class="h-4 w-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Measurement Technique</h4>
                                    <p class="mt-1 text-xs text-gray-600">Improper cuff size or position can lead to inaccurate readings.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Disclaimer:</strong> This information is for educational purposes only and is not intended to replace professional medical advice. Always consult with a healthcare provider regarding your blood pressure readings and health concerns.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>