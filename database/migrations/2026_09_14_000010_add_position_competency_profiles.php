<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $profiles = [
            'Staff Human Capital' => [
                'HC Service Management',
                'Coaching & Counseling',
            ],
            'Senior Human Capital Staff' => [
                'Employee Performance Management',
                'Enterprise Governance Maturity',
            ],
            'Supervisor Human Capital' => [
                'Change Management',
                'Strategic Workforce Planning',
            ],
            'Manager Human Capital' => [
                'Business Partnering',
                'Strategic Value Creation Maturity',
            ],
        ];

        $groups = [
            'Enterprise Governance Maturity' => 'Human Capital',
            'Strategic Workforce Planning' => 'Human Capital',
            'Strategic Value Creation Maturity' => 'Corporate Strategy',
        ];

        foreach ($profiles as $positionName => $competencies) {
            $positionId = DB::table('positions')->where('name', $positionName)->value('id');

            if (! $positionId) {
                continue;
            }

            foreach ($competencies as $competencyName) {
                $competencyId = DB::table('competencies')->where('name', $competencyName)->value('id');

                if (! $competencyId) {
                    $competencyId = DB::table('competencies')->insertGetId([
                        'name' => $competencyName,
                        'group_name' => $groups[$competencyName] ?? 'Human Capital',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('position_competencies')->insertOrIgnore([
                    'position_id' => $positionId,
                    'competency_id' => $competencyId,
                    'required_level' => 1,
                ]);
            }
        }

        DB::table('career_aspirations')->orderBy('id')->each(function ($aspiration) {
            $employeeCompetencies = DB::table('employee_competencies')
                ->where('employee_id', $aspiration->employee_id)
                ->pluck('competency_id');

            DB::table('position_competencies')
                ->where('position_id', $aspiration->target_position_id)
                ->whereNotIn('competency_id', $employeeCompetencies)
                ->orderBy('competency_id')
                ->each(function ($profile) use ($aspiration) {
                    $exists = DB::table('gap_analyses')
                        ->where('employee_id', $aspiration->employee_id)
                        ->where('competency_id', $profile->competency_id)
                        ->exists();

                    if (! $exists) {
                        DB::table('gap_analyses')->insert([
                            'employee_id' => $aspiration->employee_id,
                            'competency_id' => $profile->competency_id,
                            'current_level' => 0,
                            'required_level' => 1,
                            'gap' => 1,
                            'priority' => 'aspirasi',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                });
        });
    }

    public function down(): void
    {
        // Profiles are retained to protect existing career targets and histories.
    }
};
