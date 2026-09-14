<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmartTarget extends Model
{
    protected $guarded = [];

    protected $casts = ['start_date' => 'date', 'due_date' => 'date'];

    public function gap()
    {
        return $this->belongsTo(GapAnalysis::class, 'gap_analysis_id');
    }

    public function activities()
    {
        return $this->hasMany(DevelopmentActivity::class);
    }

    public function programRegistrations()
    {
        return $this->hasMany(ProgramRegistration::class);
    }
}
