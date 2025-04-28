<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BloodPressureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Blood Pressure Routes
    Route::get('/blood-pressure/chart', [BloodPressureController::class, 'chart'])->name('blood-pressure.chart');
    Route::get('/blood-pressure/statistics', [BloodPressureController::class, 'statistics'])->name('blood-pressure.statistics');
    Route::get('/blood-pressure/guide', [BloodPressureController::class, 'guide'])->name('blood-pressure.guide');
    Route::get('/blood-pressure/export/pdf', [BloodPressureController::class, 'exportPdf'])->name('blood-pressure.export.pdf');
    Route::get('/blood-pressure/export/csv', [BloodPressureController::class, 'exportCsv'])->name('blood-pressure.export.csv');
    Route::get('/blood-pressure/{bloodPressureReading}/edit', [BloodPressureController::class, 'edit'])->name('blood-pressure.edit');
    Route::put('/blood-pressure/{bloodPressureReading}', [BloodPressureController::class, 'update'])->name('blood-pressure.update');
    Route::delete('/blood-pressure/{bloodPressureReading}', [BloodPressureController::class, 'destroy'])->name('blood-pressure.destroy');
    Route::resource('blood-pressure', BloodPressureController::class);
});

require __DIR__.'/auth.php';