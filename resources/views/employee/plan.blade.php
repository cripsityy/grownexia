@extends('layouts.app')

@section('content')
    <div x-data="{ showTargetForm: false }">
        <div class="page-head target-page-head">
            <div>
                <p class="eyebrow">DEVELOPMENT PLAN</p>
                <h1>Development Program</h1>
            </div>

            <button class="btn target-add-button" type="button" @click="showTargetForm = !showTargetForm">
                <span x-text="showTargetForm ? 'Tutup form' : '+ Tambah target'"></span>
            </button>
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
                            Target Kompetensi:
                            <span class="competency-pill">{{ $target->gap->competency->name }}</span>
                        </p>
                        <small>
                            @if ($activitiesByStart->isNotEmpty())
                                {{ $activitiesByStart->first()->start_date->format('d M Y') }} — {{ $activitiesByEnd->last()->end_date->format('d M Y') }} ·
                            @else
                                Timeline mengikuti aktivitas ·
                            @endif
                            {{ $target->activities->count() }} aktivitas
                        </small>
                    </div>

                    <span class="badge {{ $target->status === 'employee_declared' ? 'completed' : 'on_progress' }}">
                        {{ $target->status === 'employee_declared' ? 'Selesai' : 'On progress' }}
                    </span>
                </a>
            @empty
                <div class="card">
                    <p class="rule-note">Belum ada target aktif. Klik Tambah target untuk membuat target pertama.</p>
                </div>
            @endforelse
        </section>

        <section x-cloak x-show="showTargetForm" x-transition class="card activity-form-panel target-form-card">
            <h2>Tambah target</h2>

            <form method="POST" action="{{ route('targets.save') }}" class="form-grid">
                @csrf

                <label class="field full">
                    Kompetensi yang dikembangkan
                    <select name="competency_id" required>
                        @if ($recommendedGaps->isNotEmpty())
                            <optgroup label="Rekomendasi berdasarkan Gap Analysis">
                                @foreach ($recommendedGaps as $gap)
                                    <option value="{{ $gap->competency_id }}">
                                        {{ $gap->competency->name }} · gap {{ $gap->gap }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endif

                        @if ($otherCompetencies->isNotEmpty())
                            <optgroup label="Kompetensi lainnya">
                                @foreach ($otherCompetencies as $competency)
                                    <option value="{{ $competency->id }}">{{ $competency->name }}</option>
                                @endforeach
                            </optgroup>
                        @endif
                    </select>
                </label>

                <label class="field full">
                    Judul target
                    <input name="statement" placeholder="Contoh: Meningkatkan kemampuan leadership" required>
                </label>

                <button class="btn" type="submit">Simpan target</button>
            </form>
        </section>
    </div>
@endsection
