@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">TIM SAYA</p>
            <h1>Employee &amp; Review</h1>
            <p>Lihat data bawahan langsung dan kirimkan performance review ke HC.</p>
        </div>
    </div>

    <section class="card">
        <table class="table">
            <thead><tr><th>Employee</th><th>NIP</th><th>Jabatan</th><th>Review terakhir</th><th>Aksi</th></tr></thead>
            <tbody>
                @foreach ($reports as $employee)
                    @php($review = $employee->reviews->sortByDesc('created_at')->first())
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:9px">
                                <b>{{ $employee->user->name }}</b>
                                <a class="btn secondary" href="{{ route('team.review', $employee) }}">Review</a>
                            </div>
                            <small style="display:block">{{ $employee->department?->name }}</small>
                        </td>
                        <td>{{ $employee->employee_number }}</td>
                        <td>{{ $employee->position?->name }}</td>
                        <td>{{ $review ? ucfirst($review->status) . ' · ' . $review->period : 'Belum ada review' }}</td>
                        <td><a class="btn" href="{{ route('team.employee', $employee) }}">Lihat data</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
