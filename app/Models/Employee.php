<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    protected $casts = ['joined_at' => 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function careerAspiration()
    {
        return $this->hasOne(CareerAspiration::class);
    }

    public function gaps()
    {
        return $this->hasMany(GapAnalysis::class);
    }

    public function activities()
    {
        return $this->hasMany(DevelopmentActivity::class);
    }

    public function assessments()
    {
        return $this->hasMany(SelfAssessment::class);
    }

    public function reviews()
    {
        return $this->hasMany(PerformanceReview::class);
    }

    public function competencies()
    {
        return $this->belongsToMany(Competency::class, 'employee_competencies')->withTimestamps();
    }

    public function missingAspirationCompetencies()
    {
        $targetPosition = $this->careerAspiration?->targetPosition;

        if (! $targetPosition) {
            return collect();
        }

        return $targetPosition->competencies()
            ->whereNotIn('competencies.id', $this->competencies()->pluck('competencies.id'))
            ->get();
    }

    public function targets()
    {
        return $this->hasMany(SmartTarget::class);
    }
}
