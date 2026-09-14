@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">PERFORMANCE REVIEW</p>
            <h1>Review {{ $employee->user->name }}</h1>
            <p>{{ $employee->position?->name }} · NIP {{ $employee->employee_number }}</p>
        </div>
    </div>

    <section class="card">
        <form method="POST" action="{{ route('team.review.save', $employee) }}" class="form-grid">
            @csrf
            <label class="field">Periode<input name="period" placeholder="Jan — Jun 2026" required></label>
            <label class="field">Nilai keseluruhan (1–5)<input type="number" name="overall_score" min="1" max="5" step="0.1" required></label>
            <label class="field">Pencapaian target (1–5)<input type="number" name="target_achievement" min="1" max="5"></label>
            <label class="field">Kualitas kerja (1–5)<input type="number" name="quality_of_work" min="1" max="5"></label>
            <label class="field">Produktivitas (1–5)<input type="number" name="productivity" min="1" max="5"></label>
            <label class="field">Kolaborasi (1–5)<input type="number" name="collaboration" min="1" max="5"></label>
            <label class="field full">Strength<textarea name="strengths"></textarea></label>
            <label class="field full">Development area<textarea name="development_areas"></textarea></label>
            <label class="field full">Feedback atasan<textarea name="manager_feedback"></textarea></label>
            <button class="btn form-submit-button" type="submit">Kirim review</button>
        </form>
    </section>
@endsection
