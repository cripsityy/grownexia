<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelfAssessmentDetail extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }
}
