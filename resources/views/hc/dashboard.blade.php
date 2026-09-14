@extends('layouts.app') @section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">HUMAN CAPITAL</p>
            <h1>HC Dashboard</h1>
            <p>Monitoring perkembangan IDP, performance review, dan kompetensi pegawai.</p>
        </div>
        <a class="btn" href="{{ route('hc.reviews') }}">Kelola review</a>
    </div>
    <div class="grid stats">
        <div class="card">
            <p class="stat-label">Total employee</p>
            <p class="stat-value">{{ $employees->count() }}</p>
        </div>
        <div class="card">
            <p class="stat-label">Performance Review</p>
            <p class="stat-value">{{ $reviews->where('status', 'published')->count() }}</p>
            <span class="stat-note">Sudah dipublikasikan</span>
        </div>
        <div class="card">
            <p class="stat-label">High competency gaps</p>
            <p class="stat-value">{{ $highGaps->count() }}</p>
            <span class="stat-note">Perlu perhatian</span>
        </div>
        <div class="card">
            <p class="stat-label">IDP aktif</p>
            <p class="stat-value">{{ $employees->count() }}</p>
            <span class="stat-note">Periode 2026</span>
        </div>
    </div>
    <div class="grid two-col">
        <section class="card" id="employees">
            <h2>Employee</h2>
            @foreach ($employees as $employee)
                <div class="row">
                    <div>
                        <b>{{ $employee->user->name }}</b>
                        <small>{{ $employee->position?->name }} · {{ $employee->employee_number }}</small>
                    </div>
                    <span class="badge on_progress">IDP aktif</span>
                </div>
            @endforeach
        </section>
        <section class="card" id="gaps">
            <h2>High Priority Gap</h2>
            @forelse($highGaps as $gap)
                <div class="row">
                    <div>
                        <b>{{ $gap->competency->name }}</b>
                        <small>{{ $gap->employee->user->name }} · level {{ $gap->current_level }} →
                            {{ $gap->required_level }}</small>
                    </div>
                    <span class="badge high">Gap {{ $gap->gap }}</span>
                </div>
            @empty<p>Tidak ada high gap.
                </p>
            @endforelse
        </section>
    </div>
@endsection
