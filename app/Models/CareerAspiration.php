<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerAspiration extends Model
{
    protected $guarded = [];

    protected $casts = ['target_date' => 'date'];

    public function targetPosition()
    {
        return $this->belongsTo(Position::class, 'target_position_id');
    }
}
