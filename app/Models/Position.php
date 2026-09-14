<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded = [];

    public function competencies()
    {
        return $this->belongsToMany(Competency::class, 'position_competencies')->withPivot('required_level');
    }
}
