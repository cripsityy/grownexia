@extends('layouts.app') @section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">PROGRESS &amp; EVALUASI</p>
            <h1>Monitor perkembangan</h1>
        </div>
    </div>
    <div class="grid two-col">
        @foreach ($activities as $activity)
            <section class="card">
                <div class="row">
                    <div>
                        <span class="badge {{ $activity->status }}">{{ str_replace('_', ' ', $activity->status) }}</span>
                        <h2 style="margin-top:10px">{{ $activity->name }}</h2>
                        <small>{{ $activity->competency->name }} · selesai
                            {{ $activity->end_date->format('d M Y') }}</small>
                    </div>
                    <b>{{ $activity->progress }}%</b>
                </div>
                <div class="meter">
                    <i style="width:{{ $activity->progress }}%">
                    </i>
                </div>
                <form method="POST" action="{{ route('activities.progress', $activity) }}" class="form-grid"
                    style="margin-top:14px">
                    @csrf @method('PATCH')<label class="field">Progress (0—100)<input name="progress" type="number"
                            min="0" max="100" value="{{ $activity->progress }}">
                    </label>
                    <label class="field">Reflection (opsional)<input name="reflection" value="{{ $activity->reflection }}"
                            placeholder="Apa yang dipelajari?">
                    </label>
                    <button class="btn">Update progress</button>
                </form>
            </section>
        @endforeach
    </div>
@endsection
