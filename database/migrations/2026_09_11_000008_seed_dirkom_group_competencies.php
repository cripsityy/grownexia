<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $groups = [
            'Human Capital' => ['Coaching & Counseling', 'HC Service Management', 'Employee Performance Management'],
            'Corporate Strategy' => ['Business & Industry Acumen', 'Change Management', 'Business Process Management', 'Business Strategy', 'Business Planning', 'Market Intelligence'],
            'Network' => ['Network Management', 'Network Planning & Strategy', 'Network Architecture & Infrastructure', 'Network Automation'],
            'Data Business Group' => ['Data Engineering', 'Data Analytics', 'Data Visualization', 'Machine Learning'],
            'Project Management' => ['Program & Project Management', 'Quality Control Management', 'Quality Assurance Management'],
            'Risk' => ['Risk Assessment', 'Risk Monitoring & Control', 'Risk Strategy Planning & Governance'],
            'Legal' => ['Legal Advisory', 'Legal Settlement', 'Contract Management'],
            'Finance' => ['Financial Planning & Analysis', 'Financial Budgeting', 'Asset & Valuation Management'],
        ];

        foreach ($groups as $group => $competencies) {
            foreach ($competencies as $name) {
                $id = DB::table('competencies')->where('name', $name)->value('id');
                if ($id) {
                    DB::table('competencies')->where('id', $id)->update(['group_name' => $group]);
                } else {
                    $id = DB::table('competencies')->insertGetId(['name' => $name, 'group_name' => $group, 'created_at' => now(), 'updated_at' => now()]);
                }

                if ($group === 'Human Capital') {
                    DB::table('employees')
                        ->join('departments', 'employees.department_id', '=', 'departments.id')
                        ->where('departments.name', 'Human Capital')
                        ->select('employees.id')
                        ->orderBy('employees.id')
                        ->each(fn ($employee) => DB::table('employee_competencies')->insertOrIgnore([
                            'employee_id' => $employee->id,
                            'competency_id' => $id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]));
                }
            }
        }

        DB::table('competencies')
            ->whereIn('name', ['Leadership', 'Communication', 'Problem Solving', 'Analytical Thinking', 'Collaboration'])
            ->update(['group_name' => 'Human Capital']);
    }

    public function down(): void
    {
        // Source data is retained to preserve the imported competency catalogue.
    }
};
