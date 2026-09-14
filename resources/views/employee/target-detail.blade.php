@extends('layouts.app')

@section('content')
    <div x-data="{ showActivityForm: false }" class="target-detail-page">
        <a class="btn secondary target-back-button" href="{{ $target->status === 'employee_declared' ? route('history') : route('plan') }}">← Kembali ke {{ $target->status === 'employee_declared' ? 'Histori kegiatan' : 'Development Program' }}</a>

        <div class="page-head target-detail-head">
            <div>
                <p class="eyebrow">TARGET SMART · {{ $target->gap->competency->name }}</p>
                <h1>{{ $target->statement }}</h1>
                @if ($target->activities->isNotEmpty())
                    <p>{{ $target->activities->sortBy('start_date')->first()->start_date->format('d M Y') }} — {{ $target->activities->sortBy('end_date')->last()->end_date->format('d M Y') }}</p>
                @else
                    <p>Timeline mengikuti aktivitas yang ditambahkan.</p>
                @endif
            </div>
        </div>

        <section class="card target-activity-card">
            <div class="card-title-actions">
                <h2>Daftar aktivitas</h2>
                @if ($target->status === 'active')
                    <button class="btn" type="button" @click="showActivityForm = !showActivityForm">
                        <span x-text="showActivityForm ? 'Tutup form' : '+ Tambah aktivitas'"></span>
                    </button>
                @endif
            </div>

            @forelse ($target->activities as $activity)
                <a class="target-activity-row" href="{{ route('activities.show', $activity) }}">
                    <div class="target-activity-main">
                        <h3>{{ $activity->name }}</h3>
                    </div>
                    <span class="badge {{ $activity->status }}">
                        {{ str_replace('_', ' ', $activity->status) }}
                    </span>
                </a>
            @empty
                <p class="rule-note">Belum ada aktivitas untuk target ini.</p>
            @endforelse

            <div class="target-completion">
                @if ($target->status === 'employee_declared')
                    <span class="badge completed">Target sudah dideklarasikan tercapai</span>
                @elseif ($canComplete)
                    <form method="POST" action="{{ route('targets.complete', $target) }}">
                        @csrf
                        <button class="btn" type="submit">Selesaikan Target SMART</button>
                    </form>
                @else
                    <button class="btn btn-disabled" type="button" disabled>Selesaikan Target SMART</button>
                @endif
            </div>

            @if ($target->status === 'active')
                <div x-cloak x-show="showActivityForm" x-transition class="activity-form-panel">
                    <h2>Tambah aktivitas</h2>
                    <form method="POST" action="{{ route('activities.save') }}" class="form-grid">
                        @csrf
                        <input type="hidden" name="smart_target_id" value="{{ $target->id }}">
                        <label class="field">Nama kegiatan<input name="name" required></label>
                        <label class="field">Kategori<select name="category" required><option value="70% Experiential">Experiential Learning</option><option value="20% Social">Social Learning</option><option value="10% Formal">Formal Learning</option></select></label>
                        <label class="field">Jenis kegiatan<input name="activity_type" placeholder="Project, mentoring, training" required></label>
                        <label class="field">Tanggal mulai<input type="date" name="start_date" required></label>
                        <label class="field">Tanggal akhir<input type="date" name="end_date" required></label>
                        <button class="btn" type="submit">Simpan aktivitas</button>
                    </form>
                </div>
            @endif
        </section>

        @if ($target->status === 'active')
        <section class="card target-activity-card" style="margin-top:18px">
            <h2>Rekomendasi aktivitas</h2>
            <p class="rule-note">Program dari HC yang relevan dengan kompetensi target ini.</p>

            @forelse ($recommendedPrograms as $program)
                @php($registration = $program->registrations->first())
                <div class="target-activity-row">
                    <div class="target-activity-main">
                        <h3>{{ $program->name }}</h3>
                        <p>{{ $program->category_label }} · {{ $program->activity_type }} · {{ $program->start_date->format('d M Y') }} — {{ $program->end_date->format('d M Y') }}</p>
                        @if ($program->description)
                            <small>{{ $program->description }}</small>
                        @endif
                    </div>
                    <div>
                        @if ($registration?->status === 'pending')
                            <span class="badge on_progress">Menunggu persetujuan HC</span>
                        @elseif ($registration?->status === 'rejected')
                            <span class="badge high">Ditolak oleh HC</span>
                        @elseif ($target->status === 'active')
                            <form method="POST" action="{{ route('targets.programs.register', [$target, $program]) }}">
                                @csrf
                                <button class="btn" type="submit">Daftar</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="rule-note">Belum ada rekomendasi program dari HC untuk kompetensi ini.</p>
            @endforelse
        </section>
        @endif
    </div>
@endsection
