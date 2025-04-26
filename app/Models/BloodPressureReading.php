<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodPressureReading extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'reading_date',
        'reading_time',
        'systolic',
        'diastolic',
        'heart_rate',
        'note'
    ];
    
    protected $casts = [
        'reading_date' => 'date',
        'reading_time' => 'datetime:H:i',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getCategory()
    {
        if ($this->systolic < 120 && $this->diastolic < 80) {
            return [
                'name' => 'Normal',
                'color' => 'green-500',
                'textColor' => 'green-700',
                'bgColor' => 'green-100'
            ];
        } elseif (($this->systolic >= 120 && $this->systolic <= 129) && $this->diastolic < 80) {
            return [
                'name' => 'Elevated',
                'color' => 'yellow-400',
                'textColor' => 'yellow-700',
                'bgColor' => 'yellow-100'
            ];
        } elseif (($this->systolic >= 130 && $this->systolic <= 139) || ($this->diastolic >= 80 && $this->diastolic <= 89)) {
            return [
                'name' => 'Hypertension Stage 1',
                'color' => 'orange-400',
                'textColor' => 'orange-700', 
                'bgColor' => 'orange-100'
            ];
        } elseif (($this->systolic >= 140 && $this->systolic <= 179) || ($this->diastolic >= 90 && $this->diastolic <= 119)) {
            return [
                'name' => 'Hypertension Stage 2',
                'color' => 'red-500',
                'textColor' => 'red-700',
                'bgColor' => 'red-100'
            ];
        } else {
            return [
                'name' => 'Hypertensive Crisis',
                'color' => 'red-700',
                'textColor' => 'red-900',
                'bgColor' => 'red-200'
            ];
        }
    }
}