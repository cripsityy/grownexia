<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevelopmentActivity extends Model
{
    protected $guarded = [];

    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function target()
    {
        return $this->belongsTo(SmartTarget::class, 'smart_target_id');
    }

    public function programRegistration()
    {
        return $this->belongsTo(ProgramRegistration::class);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            '70% Experiential' => 'Experiential Learning',
            '20% Social' => 'Social Learning',
            '10% Formal' => 'Formal Learning',
            default => $this->category,
        };
    }
}
