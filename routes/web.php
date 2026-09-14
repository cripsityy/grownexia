<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GrowPathController;
use Illuminate\Support\Facades\Route;
Route::middleware('guest')->group(function () { Route::get('/login', [AuthController::class, 'create'])->name('login'); Route::post('/login', [AuthController::class, 'store'])->name('login.store'); });
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/', [GrowPathController::class, 'dashboard'])->name('dashboard');
    Route::get('/career', [GrowPathController::class, 'career'])->name('career'); Route::post('/career', [GrowPathController::class, 'saveCareer'])->name('career.save');
    Route::get('/competencies', [GrowPathController::class, 'competencies'])->name('competencies');
    Route::get('/development-plan', [GrowPathController::class, 'plan'])->name('plan'); Route::post('/targets', [GrowPathController::class, 'saveTarget'])->name('targets.save'); Route::get('/targets/{target}', [GrowPathController::class, 'targetDetail'])->name('targets.show'); Route::post('/targets/{target}/complete', [GrowPathController::class, 'completeTarget'])->name('targets.complete');
    Route::get('/history', [GrowPathController::class, 'history'])->name('history');
    Route::get('/team', [GrowPathController::class, 'team'])->name('team');
    Route::get('/team/{employee}', [GrowPathController::class, 'teamEmployee'])->name('team.employee');
    Route::get('/team/{employee}/review', [GrowPathController::class, 'teamReview'])->name('team.review');
    Route::post('/team/{employee}/review', [GrowPathController::class, 'saveTeamReview'])->name('team.review.save');
    Route::get('/activities', [GrowPathController::class, 'activities'])->name('activities'); Route::post('/activities', [GrowPathController::class, 'saveActivity'])->name('activities.save'); Route::get('/activities/{activity}/evidence', [GrowPathController::class, 'showEvidence'])->name('activities.evidence'); Route::get('/activities/{activity}', [GrowPathController::class, 'activityDetail'])->name('activities.show'); Route::patch('/activities/{activity}', [GrowPathController::class, 'updateActivity'])->name('activities.update'); Route::patch('/activities/{activity}/plan', [GrowPathController::class, 'updateActivityPlan'])->name('activities.plan.update'); Route::post('/activities/{activity}/complete', [GrowPathController::class, 'completeActivity'])->name('activities.complete');
    Route::get('/progress', [GrowPathController::class, 'progress'])->name('progress');
    Route::get('/hc', [GrowPathController::class, 'hcDashboard'])->name('hc.dashboard'); Route::get('/hc/performance-reviews', [GrowPathController::class, 'reviews'])->name('hc.reviews'); Route::post('/hc/performance-reviews/{review}/publish', [GrowPathController::class, 'publishReview'])->name('hc.reviews.publish');
    Route::get('/hc/development-programs', [GrowPathController::class, 'hcPrograms'])->name('hc.programs');
    Route::post('/hc/development-programs', [GrowPathController::class, 'saveHcProgram'])->name('hc.programs.save');
    Route::post('/hc/program-registrations/{registration}/review', [GrowPathController::class, 'reviewProgramRegistration'])->name('hc.program-registrations.review');
    Route::post('/targets/{target}/programs/{program}/register', [GrowPathController::class, 'registerProgram'])->name('targets.programs.register');
});
