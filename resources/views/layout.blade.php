<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student App')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg,rgb(52, 56, 73) 0%,rgb(33, 10, 57) 100%);
            min-height: 100vh;
        }

        .content-wrapper {
            min-height: calc(100vh - 120px);
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .card-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border: none;
        }
        .navbar-modern {
            background: rgba(15, 23, 42, 0.95) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(59, 130, 246, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .navbar-scrolled {
            background: rgba(15, 23, 42, 0.98) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.4);
        }

        .logo-container {
            background: #1e40af;
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.4);
            transition: all 0.3s ease;
            border: 2px solid rgba(59, 130, 246, 0.3);
        }

        .logo-container:hover {
            transform: scale(1.05);
            background: #2563eb;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
            border-color: rgba(59, 130, 246, 0.6);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: #ffffff !important;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: #60a5fa !important;
        }

        .nav-link-modern {
            position: relative;
            font-weight: 500;
            color: #cbd5e1 !important;
            padding: 0.75rem 1.25rem !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .nav-link-modern::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .nav-link-modern:hover {
            color: #ffffff !important;
            background: rgba(59, 130, 246, 0.2);
            transform: translateY(-1px);
        }

        .nav-link-modern:hover::after,
        .nav-link-modern.active::after {
            width: 80%;
        }

        .nav-link-modern.active {
            color: #ffffff !important;
            background: rgba(59, 130, 246, 0.3);
            font-weight: 600;
        }

        .navbar-toggler {
            border: 2px solid #3b82f6;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            background: rgba(59, 130, 246, 0.1);
        }

        .navbar-toggler:hover {
            background: rgba(59, 130, 246, 0.3);
            border-color: #60a5fa;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }

        .navbar-collapse {
            background: rgba(15, 23, 42, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 15px;
            margin-top: 1rem;
            padding: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        @media (min-width: 992px) {
            .navbar-collapse {
                background: none;
                backdrop-filter: none;
                border-radius: 0;
                margin-top: 0;
                padding: 0;
                box-shadow: none;
                border: none;
            }
        }

        .navbar-nav .nav-item {
            margin: 0.25rem 0;
        }

    </style>
    @yield('styles')
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-modern" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" style="text-decoration: none;">
                <div class="logo-container me-3">
                    <i class="fas fa-graduation-cap text-white" style="font-size: 1.2rem;"></i>
                </div>
                CRUD LARAVEL
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars" style="color: #60a5fa; font-size: 1.1rem;"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a class="nav-link nav-link-modern {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="fas fa-home me-2" style="font-size: 0.9rem;"></i>
            Home
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-link-modern {{ request()->is('divisions*') ? 'active' : '' }}" href="{{ url('divisions') }}">
            <i class="fas fa-table me-2" style="font-size: 0.9rem;"></i>
            Divisions
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link nav-link-modern {{ request()->is('employees*') ? 'active' : '' }}" href="{{ url('employees') }}">
        <i class="fas fa-info-circle me-2" style="font-size: 0.9rem;"></i>
        Employees
    </a>
</li>


</ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <footer class="text-white py-4 mt-5" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-top: 2px solid rgba(59, 130, 246, 0.2); box-shadow: 0 -10px 30px rgba(0,0,0,0.2);">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <div style="background: #1e40af; width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-right: 0.75rem; border: 1px solid rgba(59, 130, 246, 0.3);">
                <i class="fas fa-graduation-cap text-white" style="font-size: 1rem;"></i>
            </div>
            <span style="color: #ffffff; font-weight: 600;"><strong>STUDENTIAL</strong> · <span style="color: #cbd5e1;">Student Management App</span></span>
        </div>
        <div class="text-md-end small" style="color: #94a3b8;">
            <span>&copy; {{ date('Y') }} STUDENTIAL</span> |
            <span style="color: #60a5fa;">Bintang Raja Gula & Azzam Raja Gooning</span>
        </div>
    </div>
</footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('mainNavbar');
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>
    @yield('scripts')
  </body>
</html>
