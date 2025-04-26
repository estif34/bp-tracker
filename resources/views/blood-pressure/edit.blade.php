<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Blood Pressure Reading') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('blood-pressure.update', $bloodPressureReading) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="reading_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input id="reading_date" type="date" 
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('reading_date') border-red-500 @enderror" 
                                   name="reading_date" value="{{ old('reading_date', $bloodPressureReading->reading_date->format('Y-m-d')) }}" required>
                            @error('reading_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="reading_time" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                            <input id="reading_time" type="time" 
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('reading_time') border-red-500 @enderror" 
                                   name="reading_time" value="{{ old('reading_time', $bloodPressureReading->reading_time ? $bloodPressureReading->reading_time->format('H:i') : '') }}">
                            @error('reading_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="systolic" class="block text-sm font-medium text-gray-700 mb-1">Systolic (mmHg)</label>
                            <input id="systolic" type="number" 
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('systolic') border-red-500 @enderror" 
                                   name="systolic" value="{{ old('systolic', $bloodPressureReading->systolic) }}" required min="50" max="250">
                            @error('systolic')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="diastolic" class="block text-sm font-medium text-gray-700 mb-1">Diastolic (mmHg)</label>
                            <input id="diastolic" type="number" 
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('diastolic') border-red-500 @enderror" 
                                   name="diastolic" value="{{ old('diastolic', $bloodPressureReading->diastolic) }}" required min="30" max="150">
                            @error('diastolic')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="heart_rate" class="block text-sm font-medium text-gray-700 mb-1">Heart Rate (bpm)</label>
                            <input id="heart_rate" type="number" 
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('heart_rate') border-red-500 @enderror" 
                                   name="heart_rate" value="{{ old('heart_rate', $bloodPressureReading->heart_rate) }}" min="30" max="220">
                            @error('heart_rate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="note" class="block text-sm font-medium text-gray-700 mb-1">Note</label>
                            <textarea id="note" name="note" rows="3" 
                                     class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md @error('note') border-red-500 @enderror">{{ old('note', $bloodPressureReading->note) }}</textarea>
                            @error('note')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center mt-6 space-x-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Update Reading
                            </button>
                            <a href="{{ route('blood-pressure.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>