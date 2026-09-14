<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GapAnalysis extends Model
{
    protected $guarded = [];

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
