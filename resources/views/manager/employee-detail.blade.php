@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">DATA KARYAWAN</p>
            <h1>{{ $employee->user->name }}</h1>
            <p>NIP {{ $employee->employee_number }} · {{ $employee->position?->name }} · {{ $employee->department?->name }}</p>
        </div>
        <a class="btn" href="{{ route('team.review', $employee) }}">Review karyawan</a>
    </div>

    <section class="card" style="margin-bottom:18px">
        <h2>Career aspiration</h2>
        @if ($employee->careerAspiration)
            <div class="career-route">{{ $employee->position?->name }} <span>→</span> {{ $employee->careerAspiration->targetPosition->name }}</div>
            <div class="row"><div><b>Alasan / aspirasi</b><small>{{ $employee->careerAspiration->reason ?: 'Belum ada alasan yang ditambahkan.' }}</small></div></div>
        @else
            <p class="rule-note">Karyawan belum menetapkan career aspiration.</p>
        @endif
    </section>

    <div class="grid two-col">
        <section class="card">
            <h2>Kompetensi yang dimiliki</h2>
            @forelse ($employee->competencies as $competency)
                <div class="row"><div><b>{{ $competency->name }}</b><small>{{ $competency->group_name ?: 'Belum dikelompokkan' }}</small></div></div>
            @empty
                <p class="rule-note">Belum ada data kompetensi dari HC.</p>
            @endforelse
        </section>
        <section class="card">
            <h2>Gap kompetensi</h2>
            @forelse ($aspirationGaps as $competency)
                <div class="row"><div><b>{{ $competency->name }}</b><small>{{ $competency->group_name ?: 'Belum dikelompokkan' }}</small></div><span class="badge high">Karier aspirasi</span></div>
            @empty
                <p class="rule-note">Seluruh requirement career aspiration sudah dimiliki karyawan.</p>
            @endforelse
        </section>
    </div>

    <section class="card" style="margin-top:18px">
        <h2>Program yang sedang berjalan</h2>
        @forelse ($employee->targets->where('status', 'active') as $target)
            <div class="row">
                <div>
                    <b>{{ $target->statement }}</b>
                    <small>{{ $target->gap->competency->name }} · {{ $target->activities->reject(fn ($activity) => $activity->status === 'completed')->count() }} aktivitas berjalan</small>
                </div>
                <span class="badge on_progress">On progress</span>
            </div>
        @empty
            <p class="rule-note">Tidak ada program yang sedang berjalan.</p>
        @endforelse
    </section>

    <section class="card" style="margin-top:18px">
        <h2>Program yang sudah selesai</h2>
        @forelse ($employee->targets->where('status', 'employee_declared') as $target)
            <div class="row">
                <div><b>{{ $target->statement }}</b><small>{{ $target->gap->competency->name }} · {{ $target->activities->count() }} aktivitas</small></div>
                <span class="badge completed">Selesai</span>
            </div>
        @empty
            <p class="rule-note">Belum ada program yang selesai.</p>
        @endforelse
    </section>

    <section class="card" style="margin-top:18px">
        <h2>Performance review karyawan</h2>
        <table class="table">
            <thead><tr><th>Periode</th><th>Nilai</th><th>Status</th><th>Feedback</th></tr></thead>
            <tbody>
                @forelse ($employee->reviews->sortByDesc('created_at') as $review)
                    <tr>
                        <td>{{ $review->period }}</td>
                        <td>{{ $review->overall_score }}/5</td>
                        <td><span class="badge {{ $review->status === 'published' ? 'completed' : 'medium' }}">{{ ucfirst($review->status) }}</span></td>
                        <td>{{ $review->manager_feedback ?: '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">Belum ada performance review.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
