@extends('layouts.app') @section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">IDP 2026 · EMPLOYEE DASHBOARD</p>
            <h1>Selamat pagi, {{ explode(' ', $employee->user->name)[0] }}! 👋</h1>
            <p>Berikut perkembangan Individual Development Plan kamu.</p>
        </div>
    </div>
    <div class="grid stats">
        <div class="card">
            <p class="stat-label">Target sedang berjalan</p>
            <p class="stat-value">{{ $activeTargetCount }}</p>
        </div>
        <div class="card">
            <p class="stat-label">Kompetensi prioritas</p>
            <p class="stat-value">{{ $gaps->count() }}</p>
        </div>
        <div class="card">
            <p class="stat-label">Aktivitas berjalan</p>
            <p class="stat-value">{{ $ongoingActivities->count() }}</p>
        </div>
        <div class="card">
            <p class="stat-label">Aktivitas selesai</p>
            <p class="stat-value">{{ $activities->where('status', 'completed')->count() }}</p>
        </div>
    </div>
    <div class="grid two-col">
        <section>
            <div class="career-banner">
                <p>CAREER ASPIRATION</p>
                <div class="career-route">{{ $employee->position?->name }} <span>→</span>
                    {{ $employee->careerAspiration?->targetPosition?->name ?? 'Pilih target' }}</div>
            </div>
            <div class="card" style="margin-top:18px">
                <h2>Competency Progress</h2>
                @forelse ($gaps as $competency)
                    <div class="row">
                        <div>
                            <b>{{ $competency->name }}</b>
                            <small>Gap karier aspirasi</small>
                        </div>
                        <span class="badge high">Belum dimiliki</span>
                    </div>
                @empty
                    <p class="rule-note">Belum ada kompetensi yang memiliki gap.</p>
                @endforelse
            </div>
        </section>
        <section class="card">
            <h2>Aktivitas berjalan</h2>
            @forelse($ongoingActivities->take(4) as $activity)
                <a class="row dashboard-activity-row" href="{{ route('activities.show', $activity) }}">
                    <div>
                        <b>{{ $activity->name }}</b>
                        <small>{{ $activity->category_label }} · {{ $activity->competency->name }}</small>
                    </div>
                    <span class="badge on_progress">On progress</span>
                </a>
            @empty<p>Belum ada kegiatan.
                </p>
            @endforelse
        </section>
    </div>
@endsection
