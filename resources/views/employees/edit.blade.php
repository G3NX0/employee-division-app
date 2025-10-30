@extends('layout')

@section('title', 'Edit Karyawan')

@section('styles')
<style>
    .text-white-75 { color: rgba(226,232,240,0.82) !important; }
    .text-white-50 { color: rgba(226,232,240,0.5) !important; }

    .employees-hero {
        background: linear-gradient(135deg, rgba(59,130,246,0.92), rgba(147,197,253,0.85));
        border-radius: 28px;
        padding: 2.5rem clamp(1.25rem, 3vw, 2.5rem);
        box-shadow: 0 25px 45px -20px rgba(15, 23, 42, 0.6);
        position: relative;
        overflow: hidden;
    }
    .employees-hero .hero-tag { letter-spacing: .18rem; color: rgba(255,255,255,.75) }
    .hero-title { font-size: clamp(1.8rem, 3vw, 2.6rem); line-height: 1.2 }
    .hero-btn { border-radius: 14px }

    .card-modern { background: rgba(15,23,42,0.82); border-radius: 24px; backdrop-filter: blur(12px) }
    .shadow-xl { box-shadow: 0 18px 45px -20px rgba(15,23,42,.85) !important }

    .form-control, .form-select, textarea.form-control {
        background: rgba(15, 23, 42, 0.45);
        border: 1px solid rgba(148, 163, 184, 0.3);
        color: rgba(248, 250, 252, 0.95);
    }
    .form-control::placeholder { color: rgba(226,232,240,0.55) }
    .form-label { color: rgba(248,250,252,0.85); font-weight: 600 }

    .form-control.is-invalid,
    .form-select.is-invalid,
    textarea.form-control.is-invalid {
        border-color: rgba(239,68,68,0.85) !important;
        box-shadow: 0 0 0 .2rem rgba(239,68,68,0.15);
    }
    .invalid-feedback { color: #fecaca }

    .alert-modern {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.18), rgba(248, 113, 113, 0.12));
        border: 1px solid rgba(239, 68, 68, 0.25);
        border-radius: 16px;
    }

    .required::after { content: ' *'; color: #fca5a5; font-weight: 700 }
</style>
@endsection

@section('content')
<div class="container py-5">
    <div class="employees-hero mb-5">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
            <div>
                <span class="hero-tag text-uppercase small fw-semibold">Edit Employee</span>
                <h1 class="hero-title text-white fw-bold mb-2">Edit Data Karyawan</h1>
                <p class="text-white-75 mb-0">Perbarui detail karyawan, lalu simpan perubahan Anda.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('employees') }}" class="btn btn-outline-light hero-btn fw-semibold">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-modern text-white shadow-lg p-3 mb-4" role="alert">
            <div class="fw-semibold mb-2"><i class="bi bi-exclamation-triangle me-2"></i>Periksa input Anda:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-modern border-0 shadow-xl">
        <div class="card-body p-4 p-lg-5">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label required">Nama Lengkap
                            <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip" title="Nama resmi sesuai identitas."></i>
                        </label>
                        <input type="text" id="name" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Contoh: Budi Santoso" value="{{ old('name', $employee->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nis" class="form-label required">NIS
                            <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip" title="Nomor Induk Siswa (6–12 digit) dan unik."></i>
                        </label>
                        <input type="text" id="nis" name="nis" class="form-control form-control-lg @error('nis') is-invalid @enderror" placeholder="Masukkan NIS (6–12 digit)" value="{{ old('nis', $employee->nis) }}" required>
                        @error('nis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="birth_place" class="form-label required">Tempat Lahir
                            <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip" title="Kota/kabupaten tempat lahir."></i>
                        </label>
                        <input type="text" id="birth_place" name="birth_place" class="form-control form-control-lg @error('birth_place') is-invalid @enderror" placeholder="Contoh: Jakarta" value="{{ old('birth_place', $employee->birth_place) }}" required>
                        @error('birth_place')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="birth_date" class="form-label required">Tanggal Lahir
                            <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip" title="Gunakan pemilih tanggal (format: YYYY-MM-DD)"></i>
                        </label>
                        <input type="date" id="birth_date" name="birth_date" class="form-control form-control-lg @error('birth_date') is-invalid @enderror" value="{{ old('birth_date', optional($employee->birth_date)->format('Y-m-d')) }}" required>
                        @error('birth_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="age" class="form-label required">Umur
                            <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip" title="Terhitung otomatis dari tanggal lahir. Bisa disesuaikan jika perlu."></i>
                        </label>
                        <input type="number" id="age" name="age" class="form-control form-control-lg @error('age') is-invalid @enderror" placeholder="Masukkan umur (tahun)" value="{{ old('age', $employee->age) }}" min="0" max="150" required>
                        @error('age')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-white-50">Akan terisi otomatis dari tanggal lahir.</div>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">Alamat
                            <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip" title="Detail alamat domisili (opsional)."></i>
                        </label>
                        <textarea id="address" name="address" class="form-control form-control-lg @error('address') is-invalid @enderror" rows="3" placeholder="Contoh: Jl. Merdeka No. 10, Bandung, Jawa Barat">{{ old('address', $employee->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label for="photo" class="form-label">Foto (opsional)
                            <i class="bi bi-info-circle ms-1" data-bs-toggle="tooltip" title="Unggah foto baru untuk mengganti foto sebelumnya (JPG/PNG, maks 2MB)"></i>
                        </label>
                        <input type="file" id="photo" name="photo" accept="image/*" class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-2 mt-4">
                    <a href="{{ url('employees') }}" class="btn btn-outline-secondary px-4 py-2">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary fw-semibold px-4 py-2">
                        <i class="bi bi-save me-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const birthDate = document.getElementById('birth_date');
        const ageInput = document.getElementById('age');

        function calculateAge(dateStr) {
            const today = new Date();
            const dob = new Date(dateStr);
            if (isNaN(dob.getTime())) return '';
            let age = today.getFullYear() - dob.getFullYear();
            const m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) age--;
            return age < 0 ? '' : age;
        }

        const initial = calculateAge(birthDate?.value);
        if (initial !== '' && !ageInput.value) {
            ageInput.value = initial;
        }

        birthDate?.addEventListener('change', function () {
            const age = calculateAge(this.value);
            if (age !== '') ageInput.value = age;
        });

        // Init Bootstrap tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        [...tooltipTriggerList].forEach(el => new bootstrap.Tooltip(el));
    });
</script>
@endsection
