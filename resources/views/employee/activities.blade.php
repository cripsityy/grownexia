@extends('layouts.app') @section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">DEVELOPMENT PROGRAM</p>
            <h1>Semua Aktivitas</h1>
            <p>Setiap aktivitas wajib terhubung pada satu Target SMART.</p>
        </div>
        <a class="btn" href="{{ route('plan') }}">Lihat target</a>
    </div>
    <section class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Aktivitas</th>
                    <th>Target SMART</th>
                    <th>Kategori</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $activity)
                    <tr>
                        <td>
                            <a href="{{ route('activities.show', $activity) }}">
                                <b>{{ $activity->name }}</b>
                            </a>
                            <small style="display:block">{{ $activity->competency->name }}</small>
                        </td>
                        <td>{{ Str::limit($activity->target?->statement, 45) }}</td>
                        <td>{{ $activity->category_label }}</td>
                        <td>
                            <span class="badge {{ $activity->status }}">{{ str_replace('_', ' ', $activity->status) }}</span>
                        </td>
                    </tr>
                @empty<tr>
                        <td colspan="4">Belum ada aktivitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
