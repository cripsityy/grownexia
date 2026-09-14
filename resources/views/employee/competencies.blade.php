@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">ASPIRASI &amp; KESENJANGAN KOMPETENSI</p>
            <h1>Career Aspiration &amp; Gap Analysis</h1>
        </div>
    </div>

    <section x-data="{ showAspirationEditor: {{ $employee->careerAspiration ? 'false' : 'true' }} }" class="card">
        <div class="card-title-actions">
            <h2>Posisi tujuan</h2>
            <button class="btn secondary" type="button" @click="showAspirationEditor = !showAspirationEditor">
                <span x-text="showAspirationEditor ? 'Tutup edit' : 'Edit tujuan'"></span>
            </button>
        </div>

        @if ($employee->careerAspiration)
            <div class="career-route">
                {{ $employee->position?->name }} <span>→</span> {{ $employee->careerAspiration->targetPosition->name }}
            </div>
            <div class="row">
                <div>
                    <b>Alasan / aspirasi</b>
                    <small>{{ $employee->careerAspiration->reason ?: 'Belum ada alasan atau aspirasi yang ditambahkan.' }}</small>
                </div>
            </div>
        @else
            <p class="rule-note">Belum ada posisi tujuan. Tetapkan aspirasi karier untuk menghitung Gap Analysis.</p>
        @endif

        <div x-cloak x-show="showAspirationEditor" x-transition class="activity-form-panel">
            <h2>Tetapkan aspirasi</h2>
            <form method="POST" action="{{ route('career.save') }}" class="form-grid">
                @csrf
                <label class="field full">
                    Target posisi
                    <select name="target_position_id" required>
                        @if ($recommendedPositions->isNotEmpty())
                            <optgroup label="Rekomendasi — jenjang departemenmu">
                                @foreach ($recommendedPositions as $position)
                                    <option value="{{ $position->id }}" @selected($employee->careerAspiration?->target_position_id === $position->id)>{{ $position->name }}</option>
                                @endforeach
                            </optgroup>
                        @endif
                        @if ($otherPositions->isNotEmpty())
                            <optgroup label="Posisi lainnya — departemen lain">
                                @foreach ($otherPositions as $position)
                                    <option value="{{ $position->id }}" @selected($employee->careerAspiration?->target_position_id === $position->id)>{{ $position->name }}</option>
                                @endforeach
                            </optgroup>
                        @endif
                    </select>
                </label>
                <label class="field full">
                    Alasan / aspirasi
                    <textarea name="reason" placeholder="Ceritakan alasan dan arah pengembangan kariermu.">{{ $employee->careerAspiration?->reason }}</textarea>
                </label>
                <button class="btn" type="submit">Simpan &amp; hitung gap</button>
            </form>
        </div>
    </section>

    <section class="card" style="margin-top:18px">
        <h2>Gap Analysis</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Group competency</th>
                    <th>Kompetensi gap</th>
                    <th>Untuk</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($gaps as $competency)
                    <tr>
                        <td>{{ $competency->group_name ?: 'Belum dikelompokkan' }}</td>
                        <td><b>{{ $competency->name }}</b></td>
                        <td><span class="badge high">Karier aspirasi</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada kompetensi gap.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
