<x-app-layout>
    <x-slot name="title">Individual Development Plan</x-slot>
    <div x-data="{ modal: false, modalTitle: '', toast: false, showModal(title) { this.modalTitle = title;
            this.modal = true }, save() { this.modal = false;
            this.toast = true;
            setTimeout(() => this.toast = false, 2600) } }" class="idp-page">
        <div class="idp-toast" x-show="toast" x-transition x-cloak>
            <span>✓</span> Perubahan rencana pengembangan berhasil disimpan.
        </div>
        <section class="idp-hero">
            <div class="idp-orbit idp-orbit-one">
            </div>
            <div class="idp-orbit idp-orbit-two">
            </div>
            <div class="idp-hero-copy">
                <p class="idp-eyebrow">GROWNEXIA · PEOPLE DEVELOPMENT</p>
                <h1>Individual Development Plan</h1>
                <p>Rancang perjalanan pengembangan yang terarah untuk mencapai potensi terbaikmu.</p>
            </div>
            <div class="idp-hero-actions">
                <span class="idp-year">IDP 2026</span>
                <button class="idp-outline-button" @click="showModal('Bagikan IDP')">Bagikan IDP</button>
            </div>
        </section>
        <section class="idp-summary" aria-label="Ringkasan IDP">
            <div>
                <span>Periode</span>
                <strong>Jan — Des 2026</strong>
            </div>
            <div>
                <span>Status</span>
                <strong class="idp-status">
                    <i>
                    </i> Dalam progres</strong>
            </div>
            <div>
                <span>Progress rencana</span>
                <strong>42%</strong>
                <b class="idp-progress">
                    <i style="width: 42%">
                    </i>
                </b>
            </div>
            <button class="idp-primary-button" @click="showModal('Perbarui IDP')">Perbarui IDP <span>→</span>
            </button>
        </section>
        <div class="idp-flow-heading">
            <div>
                <p class="idp-eyebrow">ALUR PENGEMBANGAN</p>
                <h2>Rencana yang bertumbuh bersama Anda</h2>
            </div>
            <p>Ikuti setiap tahapan untuk menyusun rencana pengembangan yang relevan dengan peran dan aspirasi karier.
            </p>
        </div>
        <section class="idp-flow" aria-label="Tahapan Individual Development Plan">
            <div class="idp-rail" aria-hidden="true">
                <span>
                </span>
            </div>
            <article class="idp-step is-done">
                <div class="idp-number">01</div>
                <div class="idp-step-body">
                    <div class="idp-step-title">
                        <div>
                            <p>TAHAP PERTAMA</p>
                            <h3>Individual Considerations</h3>
                        </div>
                        <span class="idp-complete">Selesai ✓</span>
                    </div>
                    <p class="idp-description">Kenali kondisi saat ini melalui asesmen kompetensi, aspirasi karier, dan
                        hasil performance review.</p>
                    <div class="idp-chips">
                        <button @click="showModal('Hasil Asesmen Kompetensi')">Hasil Asesmen Kompetensi</button>
                        <button @click="showModal('Karier Aspirasi')">Karier Aspirasi</button>
                        <button @click="showModal('Performance Review')">Performance Review</button>
                    </div>
                </div>
                <aside class="idp-document">
                    <span>Dokumen pendukung</span>
                    <button @click="showModal('Hasil Asesmen Kompetensi')">Hasil Asesmen Kompetensi</button>
                    <button @click="showModal('Karier Aspirasi')">Karier Aspirasi</button>
                </aside>
            </article>
            <article class="idp-step is-current">
                <div class="idp-number">02</div>
                <div class="idp-step-body">
                    <div class="idp-step-title">
                        <div>
                            <p>TAHAP AKTIF</p>
                            <h3>Individual Learning &amp; Development Plan</h3>
                        </div>
                        <span class="idp-current">Sedang dikerjakan</span>
                    </div>
                    <p class="idp-description">Tentukan kesenjangan kompetensi lalu terjemahkan menjadi sasaran
                        pengembangan yang konkret.</p>
                    <div class="idp-plan-row">
                        <button @click="showModal('Self Assessment')">Self Assessment</button>
                        <span>›</span>
                        <button @click="showModal('Gap Analysis')">Gap Analysis</button>
                        <span>›</span>
                        <div class="idp-smart">
                            <b>Target SMART</b>
                            <small>S: Specific &nbsp; M: Measurable &nbsp; A: Achievable<br>R: Relevant &nbsp; T:
                                Time-Bound</small>
                        </div>
                    </div>
                </div>
                <aside class="idp-document">
                    <span>Dokumen pendukung</span>
                    <button @click="showModal('Standar Kompetensi')">Standar Kompetensi Seluruh Posisi</button>
                    <button @click="showModal('Directory Kompetensi')">Directory Kompetensi</button>
                </aside>
            </article>
            <article class="idp-step">
                <div class="idp-number">03</div>
                <div class="idp-step-body">
                    <div class="idp-step-title">
                        <div>
                            <p>TAHAP BERIKUTNYA</p>
                            <h3>Pemilihan Metode Pengembangan</h3>
                        </div>
                    </div>
                    <p class="idp-description">Pilih pengalaman belajar yang memberi dampak terbesar bagi sasaran
                        pengembangan Anda.</p>
                    <div class="idp-chips idp-learning">
                        <button @click="showModal('70% Experiential Learning')">70% Experiential Learning</button>
                        <button @click="showModal('20% Social Learning')">20% Social Learning</button>
                        <button @click="showModal('10% Formal Learning')">10% Formal Learning</button>
                    </div>
                </div>
                <aside class="idp-document">
                    <span>Dokumen pendukung</span>
                    <button @click="showModal('Katalog Pelatihan dan Sertifikasi')">Katalog Pelatihan dan
                        Sertifikasi</button>
                </aside>
            </article>
            <article class="idp-step">
                <div class="idp-number">04</div>
                <div class="idp-step-body">
                    <div class="idp-step-title">
                        <div>
                            <p>TAHAP TERAKHIR</p>
                            <h3>Monitoring &amp; Evaluation</h3>
                        </div>
                    </div>
                    <p class="idp-description">Pantau kemajuan secara berkala dan sesuaikan langkah pengembangan jika
                        diperlukan.</p>
                    <div class="idp-chips">
                        <button @click="showModal('Review Progress')">Review Progress</button>
                        <button @click="showModal('Pengukuran Kompetensi')">Pengukuran Kompetensi</button>
                        <button @click="showModal('Rekomendasi Pengembangan Lanjutan')">Rekomendasi Pengembangan
                            Lanjutan</button>
                    </div>
                </div>
                <aside class="idp-document">
                    <span>Dokumen pendukung</span>
                    <button @click="showModal('Matriks Rencana Pengembangan')">Matriks Rencana Pengembangan</button>
                </aside>
            </article>
        </section>
        <section class="idp-matrix">
            <div class="idp-matrix-head">
                <div>
                    <p>OUTPUT IDP</p>
                    <h2>Matriks Rencana Pengembangan</h2>
                </div>
                <button @click="showModal('Tambah rencana pengembangan')">+ Tambah rencana</button>
            </div>
            <div class="idp-table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Kompetensi</th>
                            <th>Gap</th>
                            <th>Target SMART</th>
                            <th>Aktivitas Pengembangan</th>
                            <th>Timeline</th>
                            <th>Indikator Keberhasilan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Strategic Thinking</td>
                            <td>
                                <span class="idp-gap">Level 2 → 3</span>
                            </td>
                            <td>Menyusun analisis strategis untuk 1 inisiatif unit kerja.</td>
                            <td>Project assignment &amp; coaching mingguan.</td>
                            <td>Q2 2026</td>
                            <td>
                                <span class="idp-badge">Dalam progres</span>
                            </td>
                        </tr>
                        <tr>
                            <td>Stakeholder Management</td>
                            <td>
                                <span class="idp-gap">Level 2 → 3</span>
                            </td>
                            <td>Memimpin 2 forum koordinasi lintas fungsi.</td>
                            <td>Mentoring dan peer learning.</td>
                            <td>Q3 2026</td>
                            <td>
                                <span class="idp-badge idp-badge-muted">Belum dimulai</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="idp-modal-backdrop" x-show="modal" x-transition.opacity x-cloak @click.self="modal = false">
            <section class="idp-modal" role="dialog" aria-modal="true" :aria-label="modalTitle">
                <button class="idp-close" @click="modal = false" aria-label="Tutup">×</button>
                <div class="idp-modal-icon">✦</div>
                <p class="idp-eyebrow">INDIVIDUAL DEVELOPMENT PLAN</p>
                <h2 x-text="modalTitle">
                </h2>
                <p>Lengkapi informasi pada tahapan ini agar rencana pengembangan Anda tetap terukur dan relevan.</p>
                <div class="idp-modal-actions">
                    <button class="idp-cancel" @click="modal = false">Nanti saja</button>
                    <button class="idp-primary-button" @click="save()">Simpan perubahan</button>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>

{{-- CSS sengaja dirender langsung: x-app-layout adalah Blade component, sehingga @push
     yang ditulis setelah component selesai tidak tersedia ketika layout dirender. --}}
<style>
    .idp-page {
        --blue: #c92535;
        --blue-2: #e15561;
        --ink: #1c2231;
        --muted: #69738a;
        --line: #e4e6eb;
        max-width: 1280px;
        margin: 0 auto;
        padding: 20px 4px 46px;
        color: var(--ink)
    }

    .idp-hero {
        min-height: 178px;
        position: relative;
        isolation: isolate;
        overflow: hidden;
        border-radius: 18px;
        background: linear-gradient(115deg, #b51829, #cf2c3b 60%, #e0505d);
        padding: 32px 38px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        gap: 20px;
        align-items: flex-start;
        box-shadow: 0 16px 35px #a5162430
    }

    .idp-orbit {
        position: absolute;
        border: 1px solid #fff4;
        border-radius: 50%;
        z-index: -1
    }

    .idp-orbit-one {
        width: 410px;
        height: 410px;
        left: -140px;
        top: -245px
    }

    .idp-orbit-two {
        width: 560px;
        height: 330px;
        right: -230px;
        bottom: -235px;
        transform: rotate(-22deg)
    }

    .idp-eyebrow {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .13em;
        margin: 0 0 7px;
        color: inherit
    }

    .idp-hero h1,
    .idp-hero h2,
    .idp-flow-heading h2,
    .idp-matrix h2 {
        margin: 0;
        font-weight: 800;
        letter-spacing: -.035em
    }

    .idp-hero h1 {
        font-size: 30px
    }

    .idp-hero-copy>p:not(.idp-eyebrow) {
        margin: 7px 0 0;
        max-width: 535px;
        font-size: 13px;
        line-height: 1.55;
        color: #fff0f1
    }

    .idp-hero-actions {
        display: flex;
        align-items: center;
        gap: 11px
    }

    .idp-year {
        border: 1px solid #ffffff73;
        padding: 8px 11px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700
    }

    .idp-outline-button,
    .idp-primary-button {
        border: 0;
        cursor: pointer;
        font: inherit;
        font-weight: 700;
        border-radius: 8px;
        transition: .2s
    }

    .idp-outline-button {
        background: #fff;
        color: var(--blue);
        padding: 9px 13px;
        font-size: 11px
    }

    .idp-outline-button:hover {
        background: #fff0f1
    }

    .idp-summary {
        position: relative;
        margin: -21px 24px 0;
        background: #fff;
        border: 1px solid #e9ecf3;
        border-radius: 13px;
        box-shadow: 0 9px 24px #253b7114;
        padding: 16px 20px;
        display: grid;
        grid-template-columns: 1fr 1fr 1.6fr auto;
        align-items: center;
        gap: 17px
    }

    .idp-summary div {
        font-size: 11px;
        border-right: 1px solid #e6e9f0;
        padding-right: 15px
    }

    .idp-summary div:nth-child(3) {
        border: 0
    }

    .idp-summary span {
        display: block;
        color: var(--muted);
        margin-bottom: 4px
    }

    .idp-summary strong {
        font-size: 12px
    }

    .idp-status {
        color: #248857
    }

    .idp-status i {
        display: inline-block;
        width: 7px;
        height: 7px;
        background: #37bd7c;
        border-radius: 50%;
        margin-right: 4px
    }

    .idp-progress {
        display: block;
        margin-top: 7px;
        height: 5px;
        background: #e8ecf5;
        border-radius: 8px;
        overflow: hidden
    }

    .idp-progress i {
        display: block;
        height: 100%;
        background: var(--blue-2);
        border-radius: inherit
    }

    .idp-primary-button {
        background: var(--blue);
        color: #fff;
        padding: 10px 14px;
        font-size: 11px;
        white-space: nowrap
    }

    .idp-primary-button:hover {
        background: #a41928
    }

    .idp-primary-button span {
        font-size: 15px;
        margin-left: 7px
    }

    .idp-flow-heading {
        display: flex;
        justify-content: space-between;
        gap: 28px;
        align-items: end;
        margin: 40px 4px 17px
    }

    .idp-flow-heading .idp-eyebrow,
    .idp-matrix .idp-eyebrow {
        color: #c92535
    }

    .idp-flow-heading h2,
    .idp-matrix h2 {
        font-size: 20px
    }

    .idp-flow-heading>p {
        max-width: 415px;
        margin: 0;
        color: var(--muted);
        font-size: 11px;
        line-height: 1.55
    }

    .idp-flow {
        position: relative;
        display: grid;
        gap: 12px
    }

    .idp-rail {
        position: absolute;
        left: 29px;
        top: 34px;
        bottom: 35px;
        width: 2px;
        background: #f1dce0
    }

    .idp-rail span {
        display: block;
        width: 100%;
        height: 34%;
        background: var(--blue)
    }

    .idp-step {
        position: relative;
        display: grid;
        grid-template-columns: 58px minmax(0, 1fr) 248px;
        gap: 15px;
        align-items: stretch;
        border: 1px solid var(--line);
        border-radius: 13px;
        background: #fff;
        padding: 16px;
        box-shadow: 0 4px 13px #24386708
    }

    .idp-step.is-current {
        border-color: #efb6bd;
        box-shadow: 0 9px 20px #c9253512
    }

    .idp-number {
        z-index: 1;
        width: 27px;
        height: 27px;
        margin: 3px auto 0;
        border-radius: 50%;
        background: #f6f0f1;
        color: #8a6c72;
        display: grid;
        place-items: center;
        font-size: 9px;
        font-weight: 800;
        border: 3px solid #fff
    }

    .is-done .idp-number,
    .is-current .idp-number {
        background: var(--blue);
        color: #fff
    }

    .idp-step-title {
        display: flex;
        gap: 10px;
        align-items: start;
        justify-content: space-between
    }

    .idp-step-title p {
        color: #c66c76;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .11em;
        margin: 0 0 3px
    }

    .idp-step-title h3 {
        margin: 0;
        font-size: 14px;
        font-weight: 800;
        letter-spacing: -.015em
    }

    .idp-complete,
    .idp-current {
        font-size: 9px;
        font-weight: 700;
        padding: 4px 7px;
        border-radius: 20px;
        white-space: nowrap
    }

    .idp-complete {
        background: #e9f8f0;
        color: #278159
    }

    .idp-current {
        background: #fff0f1;
        color: #bd2938
    }

    .idp-description {
        font-size: 11px;
        line-height: 1.45;
        color: var(--muted);
        margin: 5px 0 10px
    }

    .idp-chips,
    .idp-plan-row {
        display: flex;
        gap: 7px;
        align-items: center;
        flex-wrap: wrap
    }

    .idp-chips button,
    .idp-plan-row button,
    .idp-document button {
        font: inherit;
        cursor: pointer;
        border: 0;
        transition: .2s
    }

    .idp-chips button,
    .idp-plan-row>button {
        border-radius: 6px;
        background: #fff0f1;
        color: #bd2938;
        padding: 6px 12px;
        font-size: 9px;
        font-weight: 700
    }

    .idp-chips button:hover,
    .idp-plan-row>button:hover {
        background: #ffe0e3
    }

    .idp-learning button:first-child {
        background: #fff0f1
    }

    .idp-learning button:nth-child(2) {
        background: #f1edff;
        color: #6a4fa8
    }

    .idp-learning button:nth-child(3) {
        background: #e8f7f1;
        color: #257d5c
    }

    .idp-plan-row>span {
        color: var(--blue);
        font-size: 20px;
        line-height: 1
    }

    .idp-smart {
        padding: 6px 10px;
        border-radius: 7px;
        color: #fff;
        background: linear-gradient(130deg, #df5360, #bd1f31);
        font-size: 8px;
        line-height: 1.4
    }

    .idp-smart b {
        display: block;
        font-size: 9px
    }

    .idp-document {
        border-left: 1px solid #e5e8ef;
        padding-left: 14px;
        display: flex;
        flex-direction: column;
        gap: 6px;
        justify-content: center
    }

    .idp-document>span {
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: .07em;
        font-weight: 800;
        color: #99a2b5
    }

    .idp-document button {
        text-align: left;
        font-size: 9px;
        color: #bd2938;
        font-weight: 650;
        line-height: 1.25
    }

    .idp-document button:hover {
        text-decoration: underline
    }

    .idp-matrix {
        margin-top: 20px;
        border: 1px solid var(--line);
        border-radius: 13px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 13px #24386708
    }

    .idp-matrix-head {
        background: linear-gradient(110deg, #bc1d2e, #dc4653);
        padding: 17px 21px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px
    }

    .idp-matrix-head .idp-eyebrow {
        color: #ffd9dd;
        margin-bottom: 2px
    }

    .idp-matrix h2 {
        font-size: 17px
    }

    .idp-matrix-head button {
        background: #fff;
        border: 0;
        color: #bd2938;
        font-weight: 700;
        font-size: 10px;
        border-radius: 7px;
        padding: 8px 10px;
        cursor: pointer
    }

    .idp-table-wrap {
        overflow: auto
    }

    .idp-matrix table {
        border-collapse: collapse;
        width: 100%;
        min-width: 780px;
        font-size: 10px
    }

    .idp-matrix th {
        color: #66718b;
        text-align: left;
        background: #f8f9fc;
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: .045em
    }

    .idp-matrix th,
    .idp-matrix td {
        padding: 12px 14px;
        border-bottom: 1px solid #e9ecf2;
        vertical-align: top;
        line-height: 1.38
    }

    .idp-matrix td:first-child {
        font-weight: 750;
        color: #80303a
    }

    .idp-gap {
        background: #fff2e8;
        color: #b9612c;
        border-radius: 20px;
        padding: 4px 7px;
        font-size: 9px;
        font-weight: 700
    }

    .idp-badge {
        display: inline-block;
        background: #e9f8f0;
        color: #278159;
        padding: 4px 7px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700
    }

    .idp-badge-muted {
        background: #eef1f6;
        color: #718096
    }

    .idp-toast {
        position: fixed;
        right: 23px;
        bottom: 23px;
        z-index: 60;
        background: #1e8760;
        color: #fff;
        padding: 12px 16px;
        border-radius: 9px;
        font-size: 12px;
        box-shadow: 0 12px 25px #102d2135
    }

    .idp-toast span {
        margin-right: 7px
    }

    .idp-modal-backdrop {
        position: fixed;
        inset: 0;
        z-index: 50;
        background: #34101688;
        display: grid;
        place-items: center;
        padding: 16px
    }

    .idp-modal {
        position: relative;
        width: min(420px, 100%);
        background: #fff;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 18px 50px #34101655
    }

    .idp-close {
        position: absolute;
        right: 13px;
        top: 9px;
        border: 0;
        background: transparent;
        font-size: 25px;
        color: #8290aa;
        cursor: pointer
    }

    .idp-modal-icon {
        width: 37px;
        height: 37px;
        display: grid;
        place-items: center;
        background: #fff0f1;
        color: var(--blue);
        border-radius: 10px;
        font-size: 18px;
        margin-bottom: 15px
    }

    .idp-modal .idp-eyebrow {
        color: #bd2938
    }

    .idp-modal h2 {
        font-size: 20px;
        margin: 0 0 8px;
        letter-spacing: -.03em
    }

    .idp-modal>p:not(.idp-eyebrow) {
        font-size: 12px;
        line-height: 1.55;
        color: var(--muted);
        margin: 0
    }

    .idp-modal-actions {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px
    }

    .idp-cancel {
        border: 0;
        background: #edf0f6;
        border-radius: 8px;
        padding: 10px 13px;
        color: #62708b;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer
    }

    @media (max-width:900px) {
        .idp-step {
            grid-template-columns: 48px minmax(0, 1fr)
        }

        .idp-document {
            grid-column: 2;
            border-left: 0;
            border-top: 1px solid #e5e8ef;
            padding: 10px 0 0;
            display: flex;
            flex-direction: row;
            align-items: center;
            flex-wrap: wrap
        }

        .idp-document>span {
            width: 100%
        }

        .idp-rail {
            left: 24px
        }

        .idp-summary {
            margin-left: 12px;
            margin-right: 12px;
            grid-template-columns: 1fr 1fr
        }

        .idp-summary div:nth-child(2) {
            border: 0
        }

        .idp-summary .idp-primary-button {
            grid-column: span 2
        }

        .idp-hero {
            padding: 27px
        }
    }

    @media (max-width:580px) {
        .idp-page {
            padding-top: 4px
        }

        .idp-hero {
            min-height: auto;
            display: block;
            padding: 25px 20px;
            border-radius: 15px
        }

        .idp-hero h1 {
            font-size: 24px
        }

        .idp-hero-actions {
            margin-top: 17px
        }

        .idp-summary {
            margin: 12px 0 0;
            padding: 14px;
            gap: 13px
        }

        .idp-summary div {
            border: 0;
            padding: 0
        }

        .idp-flow-heading {
            display: block;
            margin-top: 30px
        }

        .idp-flow-heading>p {
            margin-top: 9px
        }

        .idp-step {
            padding: 13px 10px;
            gap: 8px;
            border-radius: 10px
        }

        .idp-number {
            margin-top: 2px
        }

        .idp-step-title {
            display: block
        }

        .idp-complete,
        .idp-current {
            display: inline-block;
            margin-top: 6px
        }

        .idp-description {
            font-size: 10px
        }

        .idp-document {
            font-size: 9px
        }

        .idp-plan-row {
            align-items: start
        }

        .idp-smart {
            width: 100%
        }

        .idp-matrix-head {
            padding: 15px
        }

        .idp-matrix h2 {
            font-size: 15px
        }

        .idp-matrix-head button {
            padding: 7px;
            font-size: 9px
        }

        .idp-rail {
            left: 18px
        }
    }
</style>
