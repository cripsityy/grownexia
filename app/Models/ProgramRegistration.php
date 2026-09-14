<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramRegistration extends Model
{
    protected $guarded = [];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function program()
    {
        return $this->belongsTo(DevelopmentProgram::class, 'development_program_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function target()
    {
        return $this->belongsTo(SmartTarget::class, 'smart_target_id');
    }
}
