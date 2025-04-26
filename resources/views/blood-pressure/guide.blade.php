<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blood Pressure Guide') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Understanding Blood Pressure</h3>
                        <div class="space-x-2">
                            <a href="{{ route('blood-pressure.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-25 transition ease-in-out duration-150">
                                Back to Readings
                            </a>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <p>Blood pressure is typically recorded as two numbers: systolic and diastolic. A reading is written as the systolic number over the diastolic number, such as 120/80 mmHg.</p>
                        
                        <h4>What do the numbers mean?</h4>
                        <ul>
                            <li><strong>Systolic:</strong> The top number measures the pressure in your arteries when your heart beats.</li>
                            <li><strong>Diastolic:</strong> The bottom number measures the pressure in your arteries when your heart rests between beats.</li>
                        </ul>
                        
                        <h4>Blood Pressure Categories</h4>
                        <p>Based on the American Heart Association guidelines:</p>
                        
                        <div class="mt-6 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Category</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Systolic (mmHg)</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Diastolic (mmHg)</th>
                                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">What to Do</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr class="bg-green-50">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Normal</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Less than 120</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Less than 80</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Maintain a healthy lifestyle.</td>
                                    </tr>
                                    <tr class="bg-yellow-50">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Elevated</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">120-129</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Less than 80</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Adopt lifestyle changes, monitor regularly.</td>
                                    </tr>
                                    <tr class="bg-orange-50">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Hypertension Stage 1</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">130-139</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">80-89</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Consult with healthcare provider, lifestyle changes.</td>
                                    </tr>
                                    <tr class="bg-red-50">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Hypertension Stage 2</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">140 or higher</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">90 or higher</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Consult with healthcare provider, medication may be needed.</td>
                                    </tr>
                                    <tr class="bg-red-100">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Hypertensive Crisis</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Higher than 180</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Higher than 120</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Seek emergency medical attention immediately.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <h4 class="mt-8">Tips for Accurate Readings</h4>
                        <ol>
                            <li>Sit with your back straight and supported.</li>
                            <li>Keep your feet flat on the floor.</li>
                            <li>Rest your arm on a flat surface at heart level.</li>
                            <li>Don't talk during the measurement.</li>
                            <li>Empty your bladder before measuring.</li>
                            <li>Avoid caffeine, exercise, and smoking for at least 30 minutes before measurement.</li>
                            <li>Take readings at the same time each day when possible.</li>
                        </ol>
                        
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mt-8">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
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
            </div>
        </div>
    </div>
</x-app-layout>