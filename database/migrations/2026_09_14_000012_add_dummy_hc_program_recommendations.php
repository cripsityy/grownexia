<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $programs = [
            [
                'competency' => 'Leadership',
                'name' => 'Leading Cross-Functional Projects',
                'category' => '70% Experiential',
                'activity_type' => 'Project',
                'description' => 'Penugasan memimpin proyek lintas fungsi dengan pendampingan dari atasan.',
                'start_date' => '2026-10-01',
                'end_date' => '2026-12-20',
            ],
            [
                'competency' => 'Leadership',
                'name' => 'Leadership Mentoring Circle',
                'category' => '20% Social',
                'activity_type' => 'Mentoring',
                'description' => 'Sesi mentoring bersama leader untuk membahas praktik kepemimpinan.',
                'start_date' => '2026-10-10',
                'end_date' => '2026-12-10',
            ],
            [
                'competency' => 'Enterprise Governance Maturity',
                'name' => 'Enterprise Governance Fundamentals',
                'category' => '10% Formal',
                'activity_type' => 'Training',
                'description' => 'Pelatihan tata kelola perusahaan dan penerapannya dalam fungsi Human Capital.',
                'start_date' => '2026-11-03',
                'end_date' => '2026-11-05',
            ],
            [
                'competency' => 'Change Management',
                'name' => 'Change Champion Assignment',
                'category' => '70% Experiential',
                'activity_type' => 'Project',
                'description' => 'Penugasan sebagai change champion pada inisiatif transformasi internal.',
                'start_date' => '2026-10-15',
                'end_date' => '2027-01-15',
            ],
        ];

        foreach ($programs as $program) {
            $competencyId = DB::table('competencies')->where('name', $program['competency'])->value('id');
            unset($program['competency']);

            if ($competencyId && ! DB::table('development_programs')->where('name', $program['name'])->exists()) {
                DB::table('development_programs')->insert($program + [
                    'competency_id' => $competencyId,
                    'status' => 'active',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        // Demo recommendations are retained for testing the HC approval flow.
    }
};
