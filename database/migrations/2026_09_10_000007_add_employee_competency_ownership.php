<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('competencies', function (Blueprint $table) {
            $table->string('group_name')->nullable()->after('name');
        });
        Schema::create('employee_competencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('competency_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['employee_id', 'competency_id']);
        });
        DB::table('self_assessment_details')->orderBy('id')->each(function ($detail) {
            DB::table('employee_competencies')->insertOrIgnore([
                'employee_id' => DB::table('self_assessments')->where('id', $detail->self_assessment_id)->value('employee_id'),
                'competency_id' => $detail->competency_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_competencies');
        Schema::table('competencies', fn (Blueprint $table) => $table->dropColumn('group_name'));
    }
};
