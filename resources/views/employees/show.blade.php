@extends('layout')

@section('title', 'Detail Karyawan')

@section('styles')
<style>
    .text-white-75 { color: rgba(226,232,240,0.82) !important; }
    .employees-hero { background: linear-gradient(135deg, rgba(37,99,235,.92), rgba(165,180,252,.85)); border-radius: 28px; padding: 2.5rem; box-shadow: 0 25px 45px -20px rgba(15,23,42,.6) }
    .card-modern { background: rgba(15,23,42,.82); border-radius: 24px; backdrop-filter: blur(12px) }
    .shadow-xl { box-shadow: 0 18px 45px -20px rgba(15,23,42,.85) !important }
    .detail-label { color: #94a3b8; font-weight: 600; font-size: .875rem }
    .detail-value { color: #e2e8f0; font-weight: 600 }
    .photo-box { background: rgba(15,23,42,.55); border: 1px solid rgba(148,163,184,.2); border-radius: 16px; padding: 1rem }
    .photo-img { max-width: 100%; border-radius: 12px }
    .muted { color: rgba(226,232,240,.65) }
    .muted-2 { color: rgba(226,232,240,.5) }
    .badge-soft { background: rgba(59,130,246,.15); color: rgba(147,197,253,1); border-radius: 999px; padding: .25rem .5rem; font-weight: 600 }
    .hero-btn { border-radius: 14px }
    .meta { color: rgba(226,232,240,.6) }
    img { display:block }
    .grid-2 { display:grid; grid-template-columns: 1fr; gap: 1rem }
    @media(min-width: 992px){ .grid-2 { grid-template-columns: 1.1fr .9fr } }
    .kv { display:grid; grid-template-columns: 180px 1fr; gap: .25rem 1rem }
    .kv + .kv { margin-top: .75rem }
    .pill { display:inline-flex; align-items:center; gap:.35rem }
    .pill i{ opacity:.9 }
    .divider{ height:1px; background: rgba(148,163,184,.2); margin:1rem 0 }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="employees-hero mb-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <span class="text-white-75 text-uppercase small fw-semibold">Employee Detail</span>
            <h1 class="text-white fw-bold mb-1">{{ $employee->name }}</h1>
            <div class="meta">ID #{{ $employee->id }} • Dibuat {{ $employee->created_at?->diffForHumans() }}</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ url('employees') }}" class="btn btn-outline-light hero-btn fw-semibold">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </a>
            <a href="{{ url('employees/' . $employee->id . '/edit') }}" class="btn btn-light hero-btn fw-semibold">
                <i class="bi bi-pencil me-2"></i> Edit
            </a>
        </div>
    </div>

    <div class="grid-2">
        <div class="card card-modern border-0 shadow-xl">
            <div class="card-body p-4 p-lg-5">
                <div class="kv"><div class="detail-label">Nama</div><div class="detail-value">{{ $employee->name }}</div></div>
                <div class="kv"><div class="detail-label">NIS</div><div class="detail-value">{{ $employee->nis ?? '-' }}</div></div>
                <div class="kv"><div class="detail-label">Tempat Lahir</div><div class="detail-value">{{ $employee->birth_place ?? '-' }}</div></div>
                <div class="kv"><div class="detail-label">Tanggal Lahir</div><div class="detail-value">{{ optional($employee->birth_date)->format('d M Y') ?? '-' }}</div></div>
                <div class="kv"><div class="detail-label">Umur</div><div class="detail-value">{{ $employee->age !== null ? $employee->age . ' tahun' : '-' }}</div></div>
                <div class="kv"><div class="detail-label">Alamat</div><div class="detail-value">{{ $employee->address ?? '-' }}</div></div>

                <div class="divider"></div>
                <div class="kv"><div class="detail-label">Terakhir Diperbarui</div><div class="detail-value">{{ $employee->updated_at?->diffForHumans() }}</div></div>
            </div>
        </div>

        <div class="card card-modern border-0 shadow-xl">
            <div class="card-body p-4 p-lg-5">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="text-white fw-bold mb-0">Foto Karyawan</h5>
                    @if($employee->photo)
                        <span class="badge-soft pill"><i class="bi bi-clock-fill"></i> Diunggah {{ $employee->photo_uploaded_at?->diffForHumans() }}</span>
                    @endif
                </div>
                <div class="photo-box">
                    @if($employee->photo)
                        <img class="photo-img" src="{{ asset('storage/' . $employee->photo) }}" alt="Foto {{ $employee->name }}">
                        <div class="mt-2 muted-2 small">Path: <code>{{ $employee->photo }}</code></div>
                        @if($employee->photo_uploaded_at)
                            <div class="muted small">Waktu upload: {{ $employee->photo_uploaded_at->format('d M Y, H:i') }}</div>
                        @endif
                    @else
                        <div class="muted">Belum ada foto yang diunggah.</div>
                        <div class="mt-2"><a href="{{ url('employees/' . $employee->id . '/edit') }}" class="btn btn-sm btn-outline-light"><i class="bi bi-upload me-1"></i> Unggah Foto</a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

