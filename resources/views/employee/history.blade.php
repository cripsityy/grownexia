@extends('layouts.app')

@section('content')
    <div class="page-head target-page-head">
        <div>
            <p class="eyebrow">DEVELOPMENT PLAN</p>
            <h1>Histori kegiatan</h1>
        </div>
    </div>

    <section class="target-program-list">
        @forelse ($targets as $target)
            @php
                $activitiesByStart = $target->activities->sortBy('start_date');
                $activitiesByEnd = $target->activities->sortBy('end_date');
            @endphp
            <a class="target-program-card" href="{{ route('targets.show', $target) }}">
                <div class="target-program-main">
                    <h2>{{ $target->statement }}</h2>
                    <p>
                        Target kompetensi:
                        <span class="competency-pill">{{ $target->gap->competency->name }}</span>
                    </p>
                    <small>
                        @if ($activitiesByStart->isNotEmpty())
                            {{ $activitiesByStart->first()->start_date->format('d M Y') }} — {{ $activitiesByEnd->last()->end_date->format('d M Y') }} ·
                        @endif
                        {{ $target->activities->count() }} aktivitas selesai
                    </small>
                </div>
                <span class="badge completed">Selesai</span>
            </a>
        @empty
            <div class="card">
                <p class="rule-note">Belum ada target yang selesai.</p>
            </div>
        @endforelse
    </section>
@endsection
