<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        $managerId = DB::table('users')->where('email', 'nadia.manager@growpath.test')->value('id');

        if (! $managerId) {
            $managerId = DB::table('users')->insertGetId([
                'name' => 'Nadia Putri',
                'email' => 'nadia.manager@growpath.test',
                'password' => Hash::make('password'),
                'role' => 'employee',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $departmentId = DB::table('departments')->where('name', 'Human Capital')->value('id');
        $positionId = DB::table('positions')->where('name', 'Senior Human Capital Staff')->value('id');

        if (! DB::table('employees')->where('user_id', $managerId)->exists()) {
            DB::table('employees')->insert([
                'user_id' => $managerId,
                'employee_number' => 'EMP-2020-0001',
                'department_id' => $departmentId,
                'position_id' => $positionId,
                'joined_at' => '2020-01-15',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('employees')
            ->where('employee_number', 'EMP-2024-0142')
            ->update(['manager_id' => $managerId, 'updated_at' => now()]);
    }

    public function down(): void
    {
        // Demo account is retained to avoid leaving employees without a manager.
    }
};
