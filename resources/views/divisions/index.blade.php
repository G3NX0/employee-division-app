@extends('layout')

@section('title', 'Division Data')

@section('styles')
<style>
    .text-white-50 { color: rgba(226,232,240,0.5) !important; }
    .employees-hero { background: linear-gradient(135deg, rgba(30,64,175,.95), rgba(14,116,144,.85)); border-radius: 28px; padding: 2.25rem; box-shadow: 0 25px 45px -20px rgba(15,23,42,.6); }
    .hero-title { color: #fff; font-weight: 800; }
    .hero-btn { border-radius: 14px }

    .card-modern-light { background: #ffffff; border-radius: 24px; }
    .card-header-dark { background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #e2e8f0; border-top-left-radius: 24px; border-top-right-radius: 24px; border-bottom: 1px solid rgba(59,130,246,.18) }

    .list-modern .list-group-item { background: #fff; color: #0f172a; border: 0; border-bottom: 1px solid rgba(2,6,23,.06); padding: 1rem 1.25rem }
    .list-modern .list-group-item:last-child { border-bottom: 0 }
    .list-modern .list-group-item:hover { background: #f8fafc }

    .index-badge { background: rgba(59, 130, 246, 0.12); color: rgba(30, 64, 175, 0.95); font-weight: 600; font-size: .85rem; padding: .45rem .9rem }

    .search-input { border-radius: 16px; border: 1px solid rgba(148,163,184,.3); overflow: hidden; background: rgba(255,255,255,1) }
    .search-input .form-control { border: none }
</style>
@endsection

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="employees-hero mb-5">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between gap-3">
            <div>
                <h1 class="hero-title mb-2">Division Directory</h1>
                <p class="text-white-50 mb-0">Manage and organize divisions easily.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ url('divisions/create') }}" class="btn btn-light hero-btn fw-semibold">
                    <i class="bi bi-plus-circle me-2"></i> Add Division
                </a>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center justify-content-between gap-3 mb-4">
        <div class="w-100 w-xl-50">
            <div class="input-group input-group-lg search-input shadow-sm">
                <span class="input-group-text bg-transparent border-end-0 text-muted">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="divisionSearch" class="form-control border-start-0" placeholder="Type to filter divisions...">
            </div>
        </div>
    </div>

    <div class="card card-modern-light border-0 shadow-xl">
        <div class="card-header card-header-dark border-0 px-4 pt-4 pb-3">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="fw-bold text-white mb-0">Divisions</h5>
                <span class="badge rounded-pill bg-gradient-primary text-white px-3 py-2 fw-semibold">
                    <i class="bi bi-grid me-2"></i> {{ $divisions->count() }} total
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush list-modern" id="division-list">
                @forelse($divisions as $division)
                    <li class="list-group-item division-item" data-name="{{ strtolower($division->name) }}">
                        <div class="d-flex align-items-start align-items-md-center justify-content-between gap-3 flex-column flex-md-row">
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge rounded-pill index-badge">#{{ $loop->iteration }}</span>
                                <div>
                                    <p class="mb-1 fw-semibold">{{ $division->name }}</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start justify-content-md-end gap-2 flex-wrap">
                                <a href="{{ url('divisions/' . $division->id . '/edit') }}" class="btn btn-sm btn-outline-warning text-warning-emphasis fw-semibold px-3 shadow-sm">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <a href="{{ url('divisions/'.$division->id.'/delete') }}" class="btn btn-sm btn-outline-danger text-danger fw-semibold px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this data?')">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </a>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-center py-5 text-muted">
                        <div class="d-flex flex-column align-items-center gap-2">
                            <i class="bi bi-grid" style="font-size: 2.25rem"></i>
                            <span class="fw-semibold">No divisions yet.</span>
                            <a href="{{ url('divisions/create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-circle me-2"></i>Add Division</a>
                        </div>
                    </li>
                @endforelse
                @if($divisions->count())
                    <li id="no-division-results" class="list-group-item text-center py-5 d-none text-muted">
                        <div class="d-flex flex-column align-items-center gap-2">
                            <i class="bi bi-search-heart" style="font-size: 2rem"></i>
                            <span class="fw-semibold">No matches found</span>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('divisionSearch');
        const items = Array.from(document.querySelectorAll('#division-list .division-item'));
        const emptyRow = document.getElementById('no-division-results');
        if (!input || !items.length) return;
        input.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();
            let visible = 0;
            items.forEach((li) => {
                const isMatch = (li.dataset.name ?? '').includes(q);
                li.classList.toggle('d-none', !isMatch);
                if (isMatch) visible++;
            });
            if (emptyRow) emptyRow.classList.toggle('d-none', visible !== 0);
        });
    });
</script>
@endsection
