<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('development_programs')) {
        Schema::create('development_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competency_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('category');
            $table->string('activity_type');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status')->default('active');
            $table->timestamps();
        });
        }

        if (! Schema::hasTable('program_registrations')) {
        Schema::create('program_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('development_program_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('smart_target_id')->constrained()->cascadeOnDelete();
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('pending');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->unique(['development_program_id', 'employee_id', 'smart_target_id'], 'program_registration_unique');
        });
        } else {
            Schema::table('program_registrations', function (Blueprint $table) {
                $table->unique(['development_program_id', 'employee_id', 'smart_target_id'], 'program_registration_unique');
            });
        }

        if (! Schema::hasColumn('development_activities', 'program_registration_id')) {
            Schema::table('development_activities', function (Blueprint $table) {
                $table->foreignId('program_registration_id')->nullable()->unique()->constrained()->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        Schema::table('development_activities', function (Blueprint $table) {
            $table->dropConstrainedForeignId('program_registration_id');
        });
        Schema::dropIfExists('program_registrations');
        Schema::dropIfExists('development_programs');
    }
};
