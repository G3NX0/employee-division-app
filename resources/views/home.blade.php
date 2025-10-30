@extends('layout')

@section('title', 'Home Page')

@section('content')
<div class="container py-5">
    <div class="p-5 rounded-4 shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border: 1px solid rgba(59,130,246,.2)">
        <div class="row align-items-center g-4">
            <div class="col-lg-8 text-white">
                <h1 class="fw-bold mb-3">Welcome to CRUD Laravel</h1>
                <p class="text-white-50 mb-4">Manage your data seamlessly with a clean, modern interface.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ url('employees') }}" class="btn btn-light btn-lg fw-semibold">
                        <i class="bi bi-people-fill me-2"></i> Employees
                    </a>
                    <a href="{{ url('divisions') }}" class="btn btn-outline-light btn-lg fw-semibold">
                        <i class="bi bi-grid me-2"></i> Divisions
                    </a>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end text-white-50">
                <div class="border rounded-4 p-3" style="border-color: rgba(59,130,246,.3) !important;">
                    <div class="small">Tip</div>
                    <div>Use the navigation to explore and manage your data.</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

