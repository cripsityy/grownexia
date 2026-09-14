@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">PROFIL SAYA</p>
            <h1>Profil &amp; Performance Review</h1>
        </div>
    </div>

    <div class="grid two-col">
        <section class="card">
            <h2>Profil saya</h2>

            <div class="row">
                <div>
                    <b>{{ $employee->user->name }}</b>
                    <small>NIP: {{ $employee->employee_number }}</small>
                </div>
            </div>

            <div class="row">
                <div>
                    <b>{{ $employee->department?->name ?? 'Human Capital' }}</b>
                    <small>{{ $employee->position?->name }}</small>
                </div>
            </div>

            <div class="row">
                <div>
                    <b>Atasan</b>
                    <small>Nadia Putri</small>
                </div>
            </div>
        </section>

        <section class="card">
            <h2>Performance Review</h2>

            @if ($review)
                <p class="stat-value">
                    {{ $review->overall_score }} <small>/ 5</small>
                </p>

                <div class="row">
                    <div>
                        <b>Strength</b>
                        <small>{{ $review->strengths }}</small>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <b>Development area</b>
                        <small>{{ $review->development_areas }}</small>
                    </div>
                </div>

                <p class="rule-note">“{{ $review->manager_feedback }}”</p>
            @else
                <p class="rule-note">Belum ada Performance Review yang dipublikasikan oleh HC.</p>
            @endif
        </section>
    </div>

    <section class="card" style="margin-top:18px">
        <h2>Kompetensi yang dimiliki</h2>

        @if ($employee->competencies->isNotEmpty())
            <table class="table">
                <thead>
                    <tr>
                        <th>Group competency</th>
                        <th>Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employee->competencies as $competency)
                        <tr>
                            <td>{{ $competency->group_name ?: 'Belum dikelompokkan' }}</td>
                            <td>{{ $competency->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="rule-note">Belum ada data kompetensi dari HC.</p>
        @endif
    </section>
@endsection
