@extends('layouts.app')

@section('content')
    <div class="page-head">
        <div>
            <p class="eyebrow">HUMAN CAPITAL</p>
            <h1>Development Program</h1>
            <p>Tambahkan program dan tinjau pendaftaran pegawai.</p>
        </div>
    </div>

    <section class="card">
        <h2>Tambah program</h2>
        <form method="POST" action="{{ route('hc.programs.save') }}" class="form-grid">
            @csrf
            <label class="field">Nama program<input name="name" required></label>
            <label class="field">Kompetensi<select name="competency_id" required>@foreach ($competencies as $competency)<option value="{{ $competency->id }}">{{ $competency->name }}</option>@endforeach</select></label>
            <label class="field">Kategori<select name="category" required><option value="20% Social">Social Learning</option><option value="10% Formal">Formal Learning</option></select></label>
            <label class="field">Jenis kegiatan<input name="activity_type" placeholder="Training, project, mentoring" required></label>
            <label class="field">Tanggal mulai<input type="date" name="start_date" required></label>
            <label class="field">Tanggal akhir<input type="date" name="end_date" required></label>
            <label class="field full">Deskripsi<textarea name="description"></textarea></label>
            <button class="btn" type="submit">Simpan program</button>
        </form>
    </section>

    <section class="card" style="margin-top:18px">
        <h2>Pendaftaran menunggu persetujuan</h2>
        <table class="table">
            <thead><tr><th>Pegawai</th><th>Program</th><th>Target</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse ($registrations as $registration)
                    <tr>
                        <td>{{ $registration->employee->user->name }}</td>
                        <td>{{ $registration->program->name }}<small style="display:block">{{ $registration->program->competency->name }}</small></td>
                        <td>{{ $registration->target->statement }}</td>
                        <td style="display:flex;gap:8px">
                            <form method="POST" action="{{ route('hc.program-registrations.review', $registration) }}">@csrf<input type="hidden" name="decision" value="approved"><button class="btn" type="submit">Setujui</button></form>
                            <form method="POST" action="{{ route('hc.program-registrations.review', $registration) }}">@csrf<input type="hidden" name="decision" value="rejected"><button class="btn secondary" type="submit">Tolak</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Tidak ada pendaftaran yang menunggu persetujuan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <section class="card" style="margin-top:18px">
        <h2>Program aktif</h2>
        @forelse ($programs as $program)
            <div class="row"><div><b>{{ $program->name }}</b><small>{{ $program->competency->name }} · {{ $program->category_label }}</small></div><span class="badge on_progress">Aktif</span></div>
        @empty
            <p class="rule-note">Belum ada program yang ditambahkan.</p>
        @endforelse
    </section>
@endsection
