<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blood Pressure Chart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Blood Pressure Scatter Plot</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('blood-pressure.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-25 transition ease-in-out duration-150">
                                Back to List
                            </a>
                            <a href="{{ route('blood-pressure.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-800 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Add New Reading
                            </a>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm text-gray-600">This chart plots your systolic (x-axis) and diastolic (y-axis) readings. The colored regions represent different blood pressure categories based on medical guidelines.</p>
                    </div>

                    @if(count($readings) > 0)
                        <div class="bg-white p-4 rounded-lg shadow-sm" style="height: 600px; min-height: 400px;">
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
                    @else
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
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(count($readings) > 0)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@2.0.0"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('bpScatterChart').getContext('2d');
            
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
            const chart = new Chart(ctx, {
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