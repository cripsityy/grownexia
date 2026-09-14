<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $departmentId = DB::table('departments')->where('name', 'Human Capital')->value('id');
        $managerId = DB::table('users')->where('email', 'nadia.manager@growpath.test')->value('id');
        $positions = DB::table('positions')->pluck('id', 'name');
        $competencies = DB::table('competencies')->pluck('id', 'name');

        $employees = [
            [
                'name' => 'Rina Amalia',
                'email' => 'rina.amalia@growpath.test',
                'nip' => 'EMP-2023-0088',
                'position' => 'Staff Human Capital',
                'aspiration' => 'Senior Human Capital Staff',
                'reason' => 'Ingin memperluas kontribusi dalam pengelolaan performance dan governance.',
                'owned' => ['HC Service Management', 'Coaching & Counseling', 'Employee Performance Management'],
            ],
            [
                'name' => 'Dimas Pratama',
                'email' => 'dimas.pratama@growpath.test',
                'nip' => 'EMP-2022-0116',
                'position' => 'Staff Human Capital',
                'aspiration' => 'Senior Human Capital Staff',
                'reason' => 'Ingin menjadi kandidat senior dengan penguasaan governance yang lebih kuat.',
                'owned' => ['HC Service Management', 'Coaching & Counseling'],
            ],
            [
                'name' => 'Salsa Mahendra',
                'email' => 'salsa.mahendra@growpath.test',
                'nip' => 'EMP-2021-0039',
                'position' => 'Senior Human Capital Staff',
                'aspiration' => 'Supervisor Human Capital',
                'reason' => 'Beraspirasi memimpin inisiatif transformasi dan workforce planning.',
                'owned' => ['HC Service Management', 'Employee Performance Management', 'Enterprise Governance Maturity'],
            ],
            [
                'name' => 'Bagas Pradana',
                'email' => 'bagas.pradana@growpath.test',
                'nip' => 'EMP-2020-0064',
                'position' => 'Senior Human Capital Staff',
                'aspiration' => 'Manager Human Capital',
                'reason' => 'Ingin berkembang menjadi business partner strategis di Human Capital.',
                'owned' => ['HC Service Management', 'Employee Performance Management', 'Change Management'],
            ],
        ];

        foreach ($employees as $data) {
            $userId = DB::table('users')->where('email', $data['email'])->value('id');
            if (! $userId) {
                $userId = DB::table('users')->insertGetId([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make('password'),
                    'role' => 'employee',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $employeeId = DB::table('employees')->where('user_id', $userId)->value('id');
            if (! $employeeId) {
                $employeeId = DB::table('employees')->insertGetId([
                    'user_id' => $userId,
                    'employee_number' => $data['nip'],
                    'department_id' => $departmentId,
                    'position_id' => $positions[$data['position']],
                    'manager_id' => $managerId,
                    'joined_at' => '2021-01-15',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            foreach ($data['owned'] as $competency) {
                DB::table('employee_competencies')->insertOrIgnore([
                    'employee_id' => $employeeId,
                    'competency_id' => $competencies[$competency],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::table('career_aspirations')->updateOrInsert(
                ['employee_id' => $employeeId],
                [
                    'target_position_id' => $positions[$data['aspiration']],
                    'reason' => $data['reason'],
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        // Demo data is retained to preserve manager review history.
    }
};
