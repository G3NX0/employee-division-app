@extends('layout')

@section('title', 'Employee Data')

@section('styles')
<style>
    .text-white-75 { color: rgba(226, 232, 240, 0.82) !important; }
    .text-white-25 { color: rgba(226, 232, 240, 0.25) !important; }

    .alert-modern {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(59, 130, 246, 0.12));
        border-radius: 16px;
        padding: 1rem 1.25rem;
    }

    .employees-hero {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.92), rgba(165, 180, 252, 0.85));
        border-radius: 28px;
        padding: 3rem clamp(1.5rem, 3vw, 3rem);
        box-shadow: 0 25px 45px -20px rgba(15, 23, 42, 0.6);
        position: relative;
    }

    .employees-hero .hero-tag {
        color: rgba(255, 255, 255, 0.75);
        letter-spacing: 0.18rem;
    }

    .hero-title {
        font-size: clamp(2rem, 3vw, 2.8rem);
        line-height: 1.2;
    }

    .hero-text {
        max-width: 520px;
    }

    .hero-btn {
        border-radius: 14px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hero-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -15px rgba(15, 23, 42, 0.6);
    }

    .hero-glow,
    .hero-gradient {
        position: absolute;
        inset: 0;
        pointer-events: none;
        border-radius: inherit;
    }

    .hero-gradient {
        background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.25), transparent 55%);
        opacity: 0.6;
    }

    .hero-glow {
        background: radial-gradient(circle at 20% 120%, rgba(59, 130, 246, 0.35), transparent 70%);
        mix-blend-mode: screen;
    }

    .stat-card {
        background: rgba(15, 23, 42, 0.28);
        border-radius: 24px;
        padding: 2rem;
        backdrop-filter: blur(16px);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08);
    }

    .search-control .search-input {
        border-radius: 16px;
        border: 1px solid rgba(148, 163, 184, 0.3);
        background: rgba(15, 23, 42, 0.45);
        overflow: hidden;
    }

    .search-control .form-control {
        color: rgba(248, 250, 252, 0.95);
        border: none;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        box-shadow: none !important;
    }

    .search-control .form-control::placeholder {
        color: rgba(226, 232, 240, 0.55);
    }

    .search-control .input-group-text {
        border: none;
    }

    .support-text {
        background: rgba(15, 23, 42, 0.45);
        border-radius: 30px;
        padding: 0.75rem 1rem;
    }

    .card-modern {
        background: rgba(15, 23, 42, 0.82);
        border-radius: 24px;
        backdrop-filter: blur(12px);
    }

    /* Light card variant for clear readability on list items */
    .card-modern-light {
        background: #ffffff;
        border-radius: 24px;
    }

    .shadow-xl {
        box-shadow: 0 18px 45px -20px rgba(15, 23, 42, 0.85) !important;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(147, 197, 253, 0.85));
    }

    /* List item styles */
    .list-modern .list-group-item {
        background: #ffffff;
        color: #0f172a;
        border: 0;
        border-bottom: 1px solid rgba(2, 6, 23, 0.06);
        padding: 1rem 1.25rem;
    }
    .list-modern .list-group-item:last-child { border-bottom: 0; }
    .list-modern .list-group-item:hover { background: #f8fafc; }

    .table-modern thead {
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.95), rgba(14, 116, 144, 0.85));
        color: #fff;
        letter-spacing: 0.05em;
    }

    .table-modern tbody {
        background: rgba(15, 23, 42, 0.55);
    }

    .table-modern tbody tr {
        transition: background 0.25s ease, transform 0.25s ease;
    }

    .table-modern tbody tr:hover {
        background: rgba(59, 130, 246, 0.1);
        transform: translateX(4px);
    }

    .index-badge {
        background: rgba(59, 130, 246, 0.15);
        color: rgba(96, 165, 250, 0.95);
        font-weight: 600;
        font-size: 0.85rem;
        padding: 0.45rem 0.9rem;
    }

    .avatar-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(96, 165, 250, 0.2), rgba(59, 130, 246, 0.35));
        color: rgba(248, 250, 252, 0.94);
        font-weight: 700;
        font-size: 1.1rem;
        border: 1px solid rgba(148, 163, 184, 0.2);
        flex: 0 0 auto;
    }

    .name-wrapper { display: flex; align-items: center; gap: .75rem; min-width: 0; }
    .employee-name { color: #0b1324; font-weight: 600; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .employee-meta { color: #64748b; font-size: .875rem; }

    /* Dark header to match original theme */
    .card-header-dark {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        color: #e2e8f0;
        border-top-left-radius: 24px;
        border-top-right-radius: 24px;
        border-bottom: 1px solid rgba(59, 130, 246, 0.18);
    }

    @media (max-width: 576px) {
        .avatar-placeholder { display: none; }
    }

    .action-btn {
        border-radius: 12px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 25px -18px rgba(15, 23, 42, 0.7);
    }

    .empty-state {
        background: rgba(15, 23, 42, 0.55);
    }

    .no-results-row {
        background: rgba(15, 23, 42, 0.38);
    }

    .alert-modern.fade-out {
        animation: fadeOut 0.45s ease forwards;
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateY(-6px);
        }
    }

    @media (max-width: 576px) {
        .employees-hero {
            padding: 2.25rem 1.5rem;
        }

        .search-control .input-group {
            font-size: 0.95rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-lg alert-modern mb-4 d-flex align-items-center gap-3">
            <span class="badge rounded-pill bg-success-subtle text-success fw-semibold px-3 py-2">
                <i class="bi bi-check2-circle me-1"></i> Success
            </span>
            <span class="fw-medium text-white-75">{{ session('success') }}</span>
        </div>
    @endif

    @php
        $totalEmployees = $employees->count();
        $latestUpdate = optional($employees->sortByDesc('updated_at')->first())->updated_at;
    @endphp

    <div class="employees-hero position-relative overflow-hidden mb-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-8">
                <span class="hero-tag text-uppercase fw-semibold small">Team Directory</span>
                <h1 class="hero-title text-white fw-bold mb-3">
                    Manage your people with confidence.
                </h1>
                <p class="hero-text text-white-50 mb-4">
                    Keep every employee detail organized, accessible, and ready for action in a single beautiful view.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ url('employees/create') }}" class="btn btn-lg btn-light fw-semibold px-4 py-2 shadow-sm hero-btn">
                        <i class="bi bi-plus-circle-dotted me-2"></i>
                        Add Employee
                    </a>
                    <a href="#employee-table" class="btn btn-lg btn-outline-light fw-semibold px-4 py-2 hero-btn">
                        <i class="bi bi-people-fill me-2"></i>
                        View Directory
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="stat-card text-white text-center text-lg-start">
                    <p class="text-uppercase small text-white-50 mb-2">Total Employees</p>
                    <h2 class="display-4 fw-bold mb-2">{{ $totalEmployees }}</h2>
                    @if($latestUpdate)
                        <span class="text-white-50 d-block">Last updated {{ $latestUpdate->diffForHumans() }}</span>
                    @else
                        <span class="text-white-50 d-block">No updates yet</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="hero-glow"></div>
        <div class="hero-gradient"></div>
    </div>

    <div class="d-flex flex-column flex-xl-row align-items-start align-items-xl-center justify-content-between gap-3 mb-4">
        <div class="search-control w-100 w-xl-50">
            <label for="employeeSearch" class="form-label text-white-50 small text-uppercase mb-2">Quick Search</label>
            <div class="input-group input-group-lg search-input shadow-sm">
                <span class="input-group-text bg-transparent border-end-0 text-white-50">
                    <i class="bi bi-search"></i>
                </span>
                <input
                    type="text"
                    id="employeeSearch"
                    class="form-control border-start-0 bg-transparent text-white"
                    placeholder="Start typing a name to filter the directory..."
                >
            </div>
        </div>
        <div class="text-white-50 small d-flex align-items-center gap-2 support-text">
            <i class="bi bi-lightning-charge-fill text-warning"></i>
            <span>Live filter updates instantly as you type.</span>
        </div>
    </div>

    <div class="card card-modern-light border-0 shadow-xl" id="employee-list-card">
        <div class="card-header card-header-dark border-0 px-4 pt-4 pb-3">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                <div>
                    <h5 class="fw-bold text-white mb-1">Employee Directory</h5>
                    <p class="text-white-50 mb-0">A complete list of your team members, ready for quick actions.</p>
                </div>
                <span class="badge rounded-pill bg-gradient-primary text-white px-3 py-2 shadow-sm fw-semibold">
                    <i class="bi bi-people me-2"></i> {{ $totalEmployees }} active members
                </span>
            </div>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush list-modern" id="employee-list">
                @forelse($employees as $employee)
                    <li class="list-group-item employee-item" data-name="{{ strtolower($employee->name) }}">
                        <div class="d-flex align-items-start align-items-md-center justify-content-between gap-3 flex-column flex-md-row">
                            <div class="d-flex align-items-start gap-3">
                                <span class="badge rounded-pill index-badge">#{{ $loop->iteration }}</span>
                                <div>
                                    <p class="employee-name mb-1">{{ $employee->name }}</p>
                                    @if($employee->updated_at)
                                        <div class="employee-meta">Updated {{ $employee->updated_at->diffForHumans() }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-flex justify-content-start justify-content-md-end gap-2 flex-wrap">
                                <a href="{{ url('employees/' . $employee->id) }}" class="btn btn-sm btn-outline-primary fw-semibold px-3 shadow-sm action-btn">
                                    <i class="bi bi-person-badge me-1"></i> Detail
                                </a>
                                <a href="{{ url('employees/' . $employee->id . '/edit') }}" class="btn btn-sm btn-outline-warning text-warning-emphasis fw-semibold px-3 shadow-sm action-btn">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger text-danger fw-semibold px-3 shadow-sm action-btn">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-center py-5">
                        <div class="d-flex flex-column align-items-center gap-2 text-muted">
                            <i class="bi bi-people" style="font-size: 2.5rem;"></i>
                            <span class="fw-semibold">No employees found yet.</span>
                            <p class="mb-0">Start building your team by adding the first employee.</p>
                            <a href="{{ url('employees/create') }}" class="btn btn-primary mt-3">
                                <i class="bi bi-plus-circle me-2"></i> Add Employee
                            </a>
                        </div>
                    </li>
                @endforelse
                @if($employees->count())
                    <li id="no-results-item" class="list-group-item text-center py-5 d-none">
                        <div class="d-flex flex-column align-items-center gap-2 text-muted">
                            <i class="bi bi-search-heart" style="font-size: 2.25rem;"></i>
                            <span class="fw-semibold">No matches found</span>
                            <p class="mb-0">Try a different spelling or clear the search box.</p>
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
        const searchInput = document.getElementById('employeeSearch');
        const listItems = Array.from(document.querySelectorAll('#employee-list .employee-item'));
        const noResultsItem = document.getElementById('no-results-item');
        const alertModern = document.querySelector('.alert-modern');

        if (alertModern) {
            setTimeout(() => {
                alertModern.classList.add('fade-out');
                alertModern.addEventListener('animationend', () => alertModern.remove(), { once: true });
            }, 3500);
        }

        if (!searchInput || !listItems.length) {
            return;
        }

        searchInput.addEventListener('input', function () {
            const query = this.value.trim().toLowerCase();
            let visibleCount = 0;

            listItems.forEach((item) => {
                const name = item.dataset.name ?? '';
                const isMatch = name.includes(query);
                item.classList.toggle('d-none', !isMatch);
                if (isMatch) visibleCount++;
            });

            if (noResultsItem) noResultsItem.classList.toggle('d-none', visibleCount !== 0);
        });
    });
</script>
@endsection
