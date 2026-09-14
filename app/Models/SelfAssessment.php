<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelfAssessment extends Model
{
    protected $guarded = [];

    protected $casts = ['assessment_date' => 'date'];

    public function details()
    {
        return $this->hasMany(SelfAssessmentDetail::class);
    }
}
