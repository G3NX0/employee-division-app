@extends('layout')

@section('title', 'Tambah Division')

@section('styles')
<style>
    .employees-hero { background: linear-gradient(135deg, rgba(30,64,175,.95), rgba(14,116,144,.85)); border-radius: 28px; padding: 2.25rem; box-shadow: 0 25px 45px -20px rgba(15,23,42,.6) }
    .hero-title { color: #fff; font-weight: 800 }
    .card-modern { background: rgba(15,23,42,.82); border-radius: 24px; backdrop-filter: blur(12px) }
    .form-control { background: rgba(15, 23, 42, 0.45); border: 1px solid rgba(148,163,184,.3); color: rgba(248,250,252,.95) }
    .form-control::placeholder { color: rgba(226,232,240,.55) }
    .form-label { color: rgba(248,250,252,.85); font-weight: 600 }
    .form-control.is-invalid { border-color: rgba(239,68,68,.85) }
    .invalid-feedback { color: #fecaca }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="employees-hero mb-5">
        <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
            <div>
                <h1 class="hero-title mb-2">Tambah Division</h1>
                <p class="text-white-50 mb-0">Masukkan nama division lalu simpan.</p>
            </div>
            <div>
                <a href="{{ url('divisions') }}" class="btn btn-outline-light fw-semibold"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-lg mb-4">
            <strong>Periksa input:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-modern border-0 shadow-xl">
        <div class="card-body p-4 p-lg-5">
            <form action="{{ url('divisions/store') }}" method="POST" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Division Name</label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Enter division name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ url('divisions') }}" class="btn btn-outline-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary fw-semibold px-4"><i class="bi bi-check2-circle me-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
