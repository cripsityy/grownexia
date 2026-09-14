@extends('layouts.app')

@section('content')
    <div x-data="{ showPlanEditor: false }" class="activity-detail-page">
        <a class="btn secondary target-back-button" href="{{ route('targets.show', $activity->target) }}">← Kembali ke target</a>

        <div class="page-head activity-detail-head">
            <div>
                <p class="eyebrow">AKTIVITAS</p>
                <div class="activity-title-row">
                    <h1>{{ $activity->name }}</h1>
                    <span class="badge {{ $activity->status }}">{{ str_replace('_', ' ', $activity->status) }}</span>
                </div>
            </div>
        </div>

        <section class="card activity-plan-card">
            <div class="card-title-actions">
                <h2>Rencana aktivitas</h2>
                @if ($activity->status === 'completed')
                    <button class="btn secondary btn-disabled" type="button" disabled>Edit rencana</button>
                @else
                    <button class="btn secondary" type="button" @click="showPlanEditor = !showPlanEditor">
                        <span x-text="showPlanEditor ? 'Tutup edit' : 'Edit rencana'"></span>
                    </button>
                @endif
            </div>

            <div class="row"><div><b>Kategori aktivitas</b><small>{{ $activity->category_label }}</small></div></div>
            <div class="row"><div><b>Target kompetensi</b><small>{{ $activity->target->gap->competency->name }}</small></div></div>
            <div class="row"><div><b>Jenis kegiatan</b><small>{{ $activity->activity_type }}</small></div></div>
            <div class="row"><div><b>Timeline</b><small>{{ $activity->start_date->format('d M Y') }} — {{ $activity->end_date->format('d M Y') }}</small></div></div>

            @if ($activity->status !== 'completed')
            <div x-cloak x-show="showPlanEditor" x-transition class="activity-form-panel">
                <h2>Edit rencana aktivitas</h2>
                <form method="POST" action="{{ route('activities.plan.update', $activity) }}" class="form-grid">
                    @csrf
                    @method('PATCH')
                    <label class="field">Nama kegiatan<input name="name" value="{{ $activity->name }}" required></label>
                    <label class="field">Kategori<select name="category" required><option value="70% Experiential" @selected($activity->category === '70% Experiential')>Experiential Learning</option><option value="20% Social" @selected($activity->category === '20% Social')>Social Learning</option><option value="10% Formal" @selected($activity->category === '10% Formal')>Formal Learning</option></select></label>
                    <label class="field">Jenis kegiatan<input name="activity_type" value="{{ $activity->activity_type }}" required></label>
                    <label class="field">Tanggal mulai<input type="date" name="start_date" value="{{ $activity->start_date->format('Y-m-d') }}" required></label>
                    <label class="field">Tanggal akhir<input type="date" name="end_date" value="{{ $activity->end_date->format('Y-m-d') }}" required></label>
                    <button class="btn" type="submit">Simpan rencana</button>
                </form>
            </div>
            @endif
        </section>

        <section class="card" style="margin-top:18px">
            <h2>Catatan pelaksanaan</h2>
            <form id="activity-update" method="POST" action="{{ route('activities.update', $activity) }}" enctype="multipart/form-data" class="form-grid">
                @csrf
                @method('PATCH')
                <label class="field full">Kegiatan yang dilakukan<textarea name="activity_log" placeholder="Jelaskan aktivitas atau tahapan yang telah dilakukan..." @disabled($activity->status === 'completed')>{{ $activity->activity_log }}</textarea></label>
                <label class="field full">Insight yang didapatkan<textarea name="insight" placeholder="Apa pembelajaran yang didapat dari aktivitas ini?" @disabled($activity->status === 'completed')>{{ $activity->insight }}</textarea></label>
                <label class="field full">
                    {{ $activity->evidence_path ? 'Ganti foto dokumentasi (opsional)' : 'Foto dokumentasi' }}
                    <input type="file" name="evidence" accept="image/*" @disabled($activity->status === 'completed')>
                </label>

                @if ($activity->evidence_path)
                    <div class="evidence-stored full">
                        <img src="{{ route('activities.evidence', $activity) }}" alt="Dokumentasi aktivitas">
                        <div>
                            <b>Dokumentasi tersimpan</b>
                            <small>{{ basename($activity->evidence_path) }}</small>
                            <a href="{{ route('activities.evidence', $activity) }}" target="_blank" rel="noopener">Lihat foto</a>
                        </div>
                    </div>
                @endif
            </form>

            <div class="activity-form-actions">
                @if ($activity->status === 'completed')
                    <button class="btn btn-disabled" type="button" disabled>Update aktivitas</button>
                    <button class="btn btn-disabled" type="button" disabled>Aktivitas selesai</button>
                @else
                    <button class="btn" type="submit" form="activity-update">Update aktivitas</button>
                    @if (empty($completionRequirements))
                        <form method="POST" action="{{ route('activities.complete', $activity) }}">@csrf<button class="btn" type="submit">Selesaikan aktivitas</button></form>
                    @else
                        <button class="btn btn-disabled" type="button" disabled>Selesaikan aktivitas</button>
                    @endif
                @endif
            </div>
        </section>
    </div>
@endsection
