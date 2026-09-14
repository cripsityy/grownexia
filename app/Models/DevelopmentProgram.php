<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevelopmentProgram extends Model
{
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }

    public function registrations()
    {
        return $this->hasMany(ProgramRegistration::class);
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
