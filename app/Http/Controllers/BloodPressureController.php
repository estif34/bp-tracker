<?php

namespace App\Http\Controllers;

use App\Models\BloodPressureReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BloodPressureController extends Controller
{
    
    public function index()
    {
        $readings = Auth::user()->bloodPressureReadings()
                              ->orderBy('reading_date', 'desc')
                              ->orderBy('reading_time', 'desc')
                              ->paginate(10);
        
        return view('blood-pressure.index', compact('readings'));
    }
    
    public function create()
    {
        return view('blood-pressure.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reading_date' => 'required|date',
            'reading_time' => 'nullable',
            'systolic' => 'required|integer|min:50|max:250',
            'diastolic' => 'required|integer|min:30|max:150',
            'heart_rate' => 'nullable|integer|min:30|max:220',
            'note' => 'nullable|string|max:255',
        ]);
        
        $validated['user_id'] = Auth::id();
        
        BloodPressureReading::create($validated);
        
        return redirect()->route('blood-pressure.index')
                         ->with('success', 'Blood pressure reading added successfully.');
    }
    
    public function edit(BloodPressureReading $bloodPressureReading)
    {
        $this->authorize('update', $bloodPressureReading);
        return view('blood-pressure.edit', compact('bloodPressureReading'));
    }
    
    public function update(Request $request, BloodPressureReading $bloodPressureReading)
    {
        $this->authorize('update', $bloodPressureReading);
        
        $validated = $request->validate([
            'reading_date' => 'required|date',
            'reading_time' => 'nullable',
            'systolic' => 'required|integer|min:50|max:250',
            'diastolic' => 'required|integer|min:30|max:150',
            'heart_rate' => 'nullable|integer|min:30|max:220',
            'note' => 'nullable|string|max:255',
        ]);
        
        $bloodPressureReading->update($validated);
        
        return redirect()->route('blood-pressure.index')
                         ->with('success', 'Blood pressure reading updated successfully.');
    }
    
    public function destroy(BloodPressureReading $bloodPressureReading)
    {
        $this->authorize('delete', $bloodPressureReading);
        
        $bloodPressureReading->delete();
        
        return redirect()->route('blood-pressure.index')
                         ->with('success', 'Blood pressure reading deleted successfully.');
    }
    
    public function chart()
    {
        $readings = Auth::user()->bloodPressureReadings()
                              ->orderBy('reading_date')
                              ->get();
        
        $dates = $readings->pluck('reading_date')->map(function($date) {
            return $date->format('Y-m-d');
        })->toArray();
        
        $systolic = $readings->pluck('systolic')->toArray();
        $diastolic = $readings->pluck('diastolic')->toArray();
        $heartRate = $readings->pluck('heart_rate')->toArray();
        
        return view('blood-pressure.chart', compact('readings'));
    }
    
    public function statistics()
    {
        $user = Auth::user();
        
        // Get all readings
        $readings = $user->bloodPressureReadings;
        
        if ($readings->isEmpty()) {
            return view('blood-pressure.statistics', ['hasData' => false]);
        }
        
        // Last 7 days readings
        $lastWeekReadings = $user->bloodPressureReadings()
            ->where('reading_date', '>=', now()->subDays(7))
            ->get();
        
        // Last 30 days readings
        $lastMonthReadings = $user->bloodPressureReadings()
            ->where('reading_date', '>=', now()->subDays(30))
            ->get();
        
        // All time readings
        $allTimeReadings = $readings;
        
        // Calculate statistics
        $weeklyStats = $this->calculateStats($lastWeekReadings);
        $monthlyStats = $this->calculateStats($lastMonthReadings);
        $allTimeStats = $this->calculateStats($allTimeReadings);
        
        // Blood pressure categories count
        $categories = [
            'normal' => 0,
            'elevated' => 0,
            'stage1' => 0,
            'stage2' => 0,
            'crisis' => 0,
        ];
        
        foreach ($readings as $reading) {
            $category = $this->getBPCategory($reading->systolic, $reading->diastolic);
            $categories[$category]++;
        }
        
        return view('blood-pressure.statistics', [
            'hasData' => true,
            'weeklyStats' => $weeklyStats,
            'monthlyStats' => $monthlyStats,
            'allTimeStats' => $allTimeStats,
            'categories' => $categories,
            'totalReadings' => $readings->count(),
            'firstReading' => $readings->sortBy('reading_date')->first()->reading_date->format('M d, Y'),
            'lastReading' => $readings->sortByDesc('reading_date')->first()->reading_date->format('M d, Y'),
        ]);
    }
    
    private function calculateStats($readings)
    {
        if ($readings->isEmpty()) {
            return [
                'count' => 0,
                'avg_systolic' => 0,
                'avg_diastolic' => 0,
                'min_systolic' => 0,
                'max_systolic' => 0,
                'min_diastolic' => 0,
                'max_diastolic' => 0,
                'avg_heart_rate' => 0,
            ];
        }
        
        return [
            'count' => $readings->count(),
            'avg_systolic' => round($readings->avg('systolic')),
            'avg_diastolic' => round($readings->avg('diastolic')),
            'min_systolic' => $readings->min('systolic'),
            'max_systolic' => $readings->max('systolic'),
            'min_diastolic' => $readings->min('diastolic'),
            'max_diastolic' => $readings->max('diastolic'),
            'avg_heart_rate' => round($readings->avg('heart_rate')),
        ];
    }
    
    private function getBPCategory($systolic, $diastolic)
    {
        if ($systolic < 120 && $diastolic < 80) {
            return 'normal';
        } elseif (($systolic >= 120 && $systolic <= 129) && $diastolic < 80) {
            return 'elevated';
        } elseif (($systolic >= 130 && $systolic <= 139) || ($diastolic >= 80 && $diastolic <= 89)) {
            return 'stage1';
        } elseif (($systolic >= 140 && $systolic <= 179) || ($diastolic >= 90 && $diastolic <= 119)) {
            return 'stage2';
        } else {
            return 'crisis';
        }
    }
    
    public function guide()
    {
        return view('blood-pressure.guide');
    }
    
    public function exportPdf()
    {
        $readings = Auth::user()->bloodPressureReadings()->orderBy('reading_date', 'desc')->get();
        $user = Auth::user();
        
        $pdf = PDF::loadView('blood-pressure.pdf', compact('readings', 'user'));
        
        return $pdf->download('blood-pressure-readings.pdf');
    }
    
    public function exportCsv()
    {
        $readings = Auth::user()->bloodPressureReadings()->orderBy('reading_date', 'desc')->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="blood-pressure-readings.csv"',
        ];
        
        $callback = function() use ($readings) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, ['Date', 'Time', 'Systolic', 'Diastolic', 'Heart Rate', 'Notes']);
            
            foreach ($readings as $reading) {
                fputcsv($file, [
                    $reading->reading_date->format('Y-m-d'),
                    $reading->reading_time ? $reading->reading_time->format('H:i') : '',
                    $reading->systolic,
                    $reading->diastolic,
                    $reading->heart_rate ?? '',
                    $reading->note ?? '',
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}