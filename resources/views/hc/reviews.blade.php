@extends('layouts.app') @section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">PERFORMANCE REVIEW</p>
            <h1>Review &amp; Publish</h1>
            <p>Employee hanya dapat melihat hasil yang sudah dipublikasikan.</p>
        </div>
    </div>
    <section class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Periode</th>
                    <th>Score</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>
                            <b>{{ $review->employee->user->name }}</b>
                            <small style="display:block;color:#64748b">{{ $review->employee->position->name }}</small>
                        </td>
                        <td>{{ $review->period }}</td>
                        <td>{{ $review->overall_score }}/5</td>
                        <td>
                            <span
                                class="badge {{ $review->status === 'published' ? 'completed' : 'medium' }}">{{ ucfirst($review->status) }}</span>
                        </td>
                        <td>
                            @if ($review->status !== 'published')
                                <form method="POST" action="{{ route('hc.reviews.publish', $review) }}">
                                    @csrf<button class="btn">Publish</button>
                                </form>
                            @else
                                <span style="color:#16815b;font-size:12px">Published
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
