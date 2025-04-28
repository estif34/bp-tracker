<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blood Pressure Chart') }}
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
            
            @if(count($readings) > 0)
                <!-- Chart Type Selector -->
                <div class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex" aria-label="Tabs">
                            <button id="trend-chart-btn" class="bg-white inline-flex items-center px-4 py-2 border-b-2 border-indigo-500 font-medium text-sm text-indigo-600 focus:outline-none" aria-current="page">
                                <svg class="mr-2 -ml-0.5 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                </svg>
                                Trend Over Time
                            </button>
                            <button id="scatter-chart-btn" class="bg-white inline-flex items-center px-4 py-2 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none">
                                <svg class="mr-2 -ml-0.5 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                </svg>
                                Scatter Plot
                            </button>
                        </nav>
                    </div>
                </div>
            
                <!-- Trend Line Chart -->
                <div id="trend-chart-container" class="bg-white overflow-hidden shadow-md rounded-lg mb-6">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4">
                        <h3 class="text-white font-medium">Blood Pressure Trends Over Time</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-4">
                            <p class="text-sm text-gray-600">This chart shows your blood pressure and heart rate trends over time. The upper line (red) represents systolic pressure, the middle line (blue) represents diastolic pressure, and the lower line (green) represents heart rate.</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm" style="height: 500px; min-height: 400px;">
                            <canvas id="bpTrendChart"></canvas>
                        </div>

                        <div class="mt-4 flex flex-wrap justify-center gap-4">
                            <div class="flex items-center">
                                <span class="w-4 h-4 bg-red-500 rounded-full mr-2"></span>
                                <span class="text-sm text-gray-700">Systolic</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-4 h-4 bg-blue-500 rounded-full mr-2"></span>
                                <span class="text-sm text-gray-700">Diastolic</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-4 h-4 bg-green-500 rounded-full mr-2"></span>
                                <span class="text-sm text-gray-700">Heart Rate</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Scatter Plot Chart -->
                <div id="scatter-chart-container" class="bg-white overflow-hidden shadow-md rounded-lg mb-6 hidden">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4">
                        <h3 class="text-white font-medium">Blood Pressure Scatter Plot</h3>
                    </div>
                    
                    <div class="p-6">
                        <div class="mb-4">
                            <p class="text-sm text-gray-600">This chart plots your systolic (x-axis) and diastolic (y-axis) readings. The colored regions represent different blood pressure categories based on medical guidelines.</p>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm" style="height: 500px; min-height: 400px;">
                            <canvas id="bpScatterChart"></canvas>
                        </div>

                        <div class="mt-6 grid grid-cols-1 md:grid-cols-5 gap-2">
                            <div class="p-2 rounded bg-green-100 text-center">
                                <span class="text-xs font-semibold text-green-800">Normal</span>
                                <p class="text-xs text-green-700">Below 120/80</p>
                            </div>
                            <div class="p-2 rounded bg-yellow-100 text-center">
                                <span class="text-xs font-semibold text-yellow-800">Elevated</span>
                                <p class="text-xs text-yellow-700">120-129/Below 80</p>
                            </div>
                            <div class="p-2 rounded bg-orange-100 text-center">
                                <span class="text-xs font-semibold text-orange-800">Stage 1</span>
                                <p class="text-xs text-orange-700">130-139/80-89</p>
                            </div>
                            <div class="p-2 rounded bg-red-100 text-center">
                                <span class="text-xs font-semibold text-red-800">Stage 2</span>
                                <p class="text-xs text-red-700">140+/90+</p>
                            </div>
                            <div class="p-2 rounded bg-red-200 text-center">
                                <span class="text-xs font-semibold text-red-900">Crisis</span>
                                <p class="text-xs text-red-800">180+/120+</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Chart Understanding Section -->
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">Understanding Your Charts</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex">
                                <div class="h-10 w-10 flex-shrink-0 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Trend Chart</h4>
                                    <p class="text-sm text-gray-600">The trend chart helps visualize changes in your blood pressure and heart rate over time. This can help identify patterns related to lifestyle changes, medication adjustments, or other factors.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="h-10 w-10 flex-shrink-0 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Scatter Plot</h4>
                                    <p class="text-sm text-gray-600">The scatter plot shows the relationship between your systolic and diastolic readings, and where they fall within standard blood pressure categories. This helps you understand your overall blood pressure health status.</p>
                                </div>
                            </div>
                            
                            <div class="flex">
                                <div class="h-10 w-10 flex-shrink-0 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <svg class="h-5 w-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h4 class="text-sm font-medium text-gray-900">Hover for Details</h4>
                                    <p class="text-sm text-gray-600">Hover over any point on either chart to see the exact date and blood pressure values for that reading.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-md rounded-lg">
                    <div class="bg-gradient-to-r from-indigo-600 to-blue-500 px-6 py-4">
                        <h3 class="text-white font-medium">Blood Pressure Charts</h3>
                    </div>
                    
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
            @endif
        </div>
    </div>

    @if(count($readings) > 0)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@2.0.0"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching functionality
            const trendChartBtn = document.getElementById('trend-chart-btn');
            const scatterChartBtn = document.getElementById('scatter-chart-btn');
            const trendChartContainer = document.getElementById('trend-chart-container');
            const scatterChartContainer = document.getElementById('scatter-chart-container');
            
            trendChartBtn.addEventListener('click', function() {
                // Show trend chart, hide scatter chart
                trendChartContainer.classList.remove('hidden');
                scatterChartContainer.classList.add('hidden');
                
                // Update active tab
                trendChartBtn.classList.add('border-indigo-500', 'text-indigo-600');
                trendChartBtn.classList.remove('border-transparent', 'text-gray-500');
                scatterChartBtn.classList.add('border-transparent', 'text-gray-500');
                scatterChartBtn.classList.remove('border-indigo-500', 'text-indigo-600');
            });
            
            scatterChartBtn.addEventListener('click', function() {
                // Show scatter chart, hide trend chart
                trendChartContainer.classList.add('hidden');
                scatterChartContainer.classList.remove('hidden');
                
                // Update active tab
                scatterChartBtn.classList.add('border-indigo-500', 'text-indigo-600');
                scatterChartBtn.classList.remove('border-transparent', 'text-gray-500');
                trendChartBtn.classList.add('border-transparent', 'text-gray-500');
                trendChartBtn.classList.remove('border-indigo-500', 'text-indigo-600');
            });
            
            // Create Trend Line Chart
            const trendCtx = document.getElementById('bpTrendChart').getContext('2d');
            
            // Parse dates and prepare data for trend chart
            @php
                // Sort readings by date for the trend chart
                $sortedReadings = $readings->sortBy('reading_date');
                $trendDates = $sortedReadings->pluck('reading_date')->map(function($date) {
                    return $date->format('Y-m-d');
                })->toArray();
                $trendSystolic = $sortedReadings->pluck('systolic')->toArray();
                $trendDiastolic = $sortedReadings->pluck('diastolic')->toArray();
                $trendHeartRate = $sortedReadings->pluck('heart_rate')->toArray();
            @endphp
            
            const trendDates = @json($trendDates);
            const trendSystolic = @json($trendSystolic);
            const trendDiastolic = @json($trendDiastolic);
            const trendHeartRate = @json($trendHeartRate);
            
            const trendChart = new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: trendDates,
                    datasets: [
                        {
                            label: 'Systolic',
                            data: trendSystolic,
                            borderColor: 'rgba(239, 68, 68, 1)',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: 'Diastolic',
                            data: trendDiastolic,
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: 'Heart Rate',
                            data: trendHeartRate,
                            borderColor: 'rgba(16, 185, 129, 1)',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.1,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    return 'Date: ' + context[0].label;
                                }
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        annotation: {
                            annotations: {
                                // Systolic threshold lines
                                normalSystolic: {
                                    type: 'line',
                                    yMin: 120,
                                    yMax: 120,
                                    borderColor: 'rgba(74, 222, 128, 0.5)',
                                    borderWidth: 2,
                                    borderDash: [6, 6],
                                    label: {
                                        content: 'Normal Systolic',
                                        enabled: true,
                                        position: 'start',
                                        backgroundColor: 'rgba(74, 222, 128, 0.8)'
                                    }
                                },
                                hypertensionSystolic: {
                                    type: 'line',
                                    yMin: 140,
                                    yMax: 140,
                                    borderColor: 'rgba(239, 68, 68, 0.5)',
                                    borderWidth: 2,
                                    borderDash: [6, 6],
                                    label: {
                                        content: 'Hypertension Systolic',
                                        enabled: true,
                                        position: 'start',
                                        backgroundColor: 'rgba(239, 68, 68, 0.8)'
                                    }
                                },
                                // Diastolic threshold lines
                                normalDiastolic: {
                                    type: 'line',
                                    yMin: 80,
                                    yMax: 80,
                                    borderColor: 'rgba(74, 222, 128, 0.5)',
                                    borderWidth: 2,
                                    borderDash: [6, 6],
                                    label: {
                                        content: 'Normal Diastolic',
                                        enabled: true,
                                        position: 'end',
                                        backgroundColor: 'rgba(74, 222, 128, 0.8)'
                                    }
                                },
                                hypertensionDiastolic: {
                                    type: 'line',
                                    yMin: 90,
                                    yMax: 90,
                                    borderColor: 'rgba(239, 68, 68, 0.5)',
                                    borderWidth: 2,
                                    borderDash: [6, 6],
                                    label: {
                                        content: 'Hypertension Diastolic',
                                        enabled: true,
                                        position: 'end',
                                        backgroundColor: 'rgba(239, 68, 68, 0.8)'
                                    }
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            min: 40,
                            max: 200,
                            title: {
                                display: true,
                                text: 'Value (mmHg / bpm)',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                }
                            }
                        }
                    }
                }
            });
            
            // Create Scatter Plot
            const scatterCtx = document.getElementById('bpScatterChart').getContext('2d');
            
            // Prepare data for scatter plot
            const scatterData = [];
            
            @foreach($readings as $reading)
                scatterData.push({
                    x: {{ $reading->systolic }},
                    y: {{ $reading->diastolic }},
                    date: '{{ $reading->reading_date->format('M d, Y') }}',
                    time: '{{ $reading->reading_time ? $reading->reading_time->format('H:i') : 'N/A' }}'
                });
            @endforeach
            
            // Create chart with background zones
            const scatterChart = new Chart(scatterCtx, {
                type: 'scatter',
                data: {
                    datasets: [{
                        label: 'BP Readings',
                        data: scatterData,
                        backgroundColor: function(context) {
                            const index = context.dataIndex;
                            const value = context.dataset.data[index];
                            
                            // Define color based on BP category
                            if (value.x >= 180 || value.y >= 120) {
                                return 'rgba(185, 28, 28, 1)'; // Crisis - red-700
                            } else if (value.x >= 140 || value.y >= 90) {
                                return 'rgba(239, 68, 68, 1)';  // Stage 2 - red-500
                            } else if ((value.x >= 130 && value.x <= 139) || (value.y >= 80 && value.y <= 89)) {
                                return 'rgba(251, 146, 60, 1)'; // Stage 1 - orange-400
                            } else if ((value.x >= 120 && value.x <= 129) && value.y < 80) {
                                return 'rgba(250, 204, 21, 1)'; // Elevated - yellow-400
                            } else {
                                return 'rgba(74, 222, 128, 1)'; // Normal - green-400
                            }
                        },
                        borderColor: 'rgba(0, 0, 0, 0.2)',
                        borderWidth: 1,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            type: 'linear',
                            position: 'bottom',
                            min: 80,
                            max: 200,
                            title: {
                                display: true,
                                text: 'Systolic (mmHg)',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        y: {
                            min: 40,
                            max: 130,
                            title: {
                                display: true,
                                text: 'Diastolic (mmHg)',
                                font: {
                                    weight: 'bold',
                                    size: 14
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const point = context.raw;
                                    return `Date: ${point.date}${point.time !== 'N/A' ? ' ' + point.time : ''} - ${point.x}/${point.y} mmHg`;
                                }
                            }
                        },
                        annotation: {
                            annotations: {
                                // Normal Zone (green)
                                normalZone: {
                                    type: 'box',
                                    xMin: 80,
                                    xMax: 120,
                                    yMin: 40,
                                    yMax: 80,
                                    backgroundColor: 'rgba(74, 222, 128, 0.1)',
                                    borderColor: 'rgba(74, 222, 128, 0.3)',
                                    borderWidth: 1
                                },
                                // Elevated Zone (yellow)
                                elevatedZone: {
                                    type: 'box',
                                    xMin: 120,
                                    xMax: 130,
                                    yMin: 40,
                                    yMax: 80,
                                    backgroundColor: 'rgba(250, 204, 21, 0.1)',
                                    borderColor: 'rgba(250, 204, 21, 0.3)',
                                    borderWidth: 1
                                },
                                // Stage 1 Zone (orange)
                                stage1Zone: {
                                    type: 'box',
                                    xMin: 130,
                                    xMax: 140,
                                    yMin: 80,
                                    yMax: 90,
                                    backgroundColor: 'rgba(251, 146, 60, 0.1)',
                                    borderColor: 'rgba(251, 146, 60, 0.3)',
                                    borderWidth: 1
                                },
                                // Additional Stage 1 Zone (orange - horizontal)
                                stage1HorizontalZone: {
                                    type: 'box',
                                    xMin: 130,
                                    xMax: 140,
                                    yMin: 40,
                                    yMax: 80,
                                    backgroundColor: 'rgba(251, 146, 60, 0.1)',
                                    borderColor: 'rgba(251, 146, 60, 0.3)',
                                    borderWidth: 1
                                },
                                // Additional Stage 1 Zone (orange - vertical)
                                stage1VerticalZone: {
                                    type: 'box',
                                    xMin: 80,
                                    xMax: 130,
                                    yMin: 80,
                                    yMax: 90,
                                    backgroundColor: 'rgba(251, 146, 60, 0.1)',
                                    borderColor: 'rgba(251, 146, 60, 0.3)',
                                    borderWidth: 1
                                },
                                // Stage 2 Zone (red)
                                stage2Zone: {
                                    type: 'box',
                                    xMin: 140,
                                    xMax: 180,
                                    yMin: 90,
                                    yMax: 120,
                                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                    borderColor: 'rgba(239, 68, 68, 0.3)',
                                    borderWidth: 1
                                },
                                // Additional Stage 2 Zone (red - horizontal)
                                stage2HorizontalZone: {
                                    type: 'box',
                                    xMin: 140,
                                    xMax: 180,
                                    yMin: 40,
                                    yMax: 90,
                                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                    borderColor: 'rgba(239, 68, 68, 0.3)',
                                    borderWidth: 1
                                },
                                // Additional Stage 2 Zone (red - vertical)
                                stage2VerticalZone: {
                                    type: 'box',
                                    xMin: 80,
                                    xMax: 140,
                                    yMin: 90,
                                    yMax: 120,
                                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                    borderColor: 'rgba(239, 68, 68, 0.3)',
                                    borderWidth: 1
                                },
                                // Crisis Zone (dark red)
                                crisisHorizontalZone: {
                                    type: 'box',
                                    xMin: 180,
                                    xMax: 200,
                                    yMin: 40,
                                    yMax: 120,
                                    backgroundColor: 'rgba(185, 28, 28, 0.1)',
                                    borderColor: 'rgba(185, 28, 28, 0.3)',
                                    borderWidth: 1
                                },
                                crisisVerticalZone: {
                                    type: 'box',
                                    xMin: 80,
                                    xMax: 180,
                                    yMin: 120,
                                    yMax: 130,
                                    backgroundColor: 'rgba(185, 28, 28, 0.1)',
                                    borderColor: 'rgba(185, 28, 28, 0.3)',
                                    borderWidth: 1
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endif
</x-app-layout>