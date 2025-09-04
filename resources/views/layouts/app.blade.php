<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📊 Smart Factory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (Bundle sudah include Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="/">📊 Smart Factory</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active fw-bold text-primary' : '' }}" href="{{ url('/') }}">
                            🏠 Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('employees*') ? 'active fw-bold text-primary' : '' }}" href="{{ url('/employees') }}">
                            👥 Employees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('inventories*') ? 'active fw-bold text-primary' : '' }}" href="{{ url('/inventories') }}">
                            📦 Inventories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('productions*') ? 'active fw-bold text-primary' : '' }}" href="{{ url('/productions') }}">
                            ⚙️ Productions
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4" style="padding-top: 70px;">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>


</html>