<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel Multi-Guard') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Instrument Sans', sans-serif;
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .stat-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }

        .stat-card.admin {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .btn-custom {
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }

        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 172, 254, 0.4);
        }

        .hero-section {
            text-align: center;
            color: white;
            padding: 4rem 0;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .stat-number {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1 class="hero-title">
                <i class="fas fa-shield-alt me-3"></i>
                Laravel Multi-Guard System
            </h1>
            <p class="hero-subtitle">Advanced authentication system with separate user and admin management</p>
        </div>

        <!-- Stats Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-4 mb-4">
                <div class="stat-card">
                    <div class="stat-number">{{ $totalUsers }}</div>
                    <div class="stat-label">
                        <i class="fas fa-users me-2"></i>
                        Total Users
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card admin">
                    <div class="stat-number">{{ $totalAdmins }}</div>
                    <div class="stat-label">
                        <i class="fas fa-user-shield me-2"></i>
                        Total Admins
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="stat-card" style="background: linear-gradient(135deg, #9c27b0 0%, #673ab7 100%);">
                    <div class="stat-number">{{ $totalWriters }}</div>
                    <div class="stat-label">
                        <i class="fas fa-pen-fancy me-2"></i>
                        Total Writers
                    </div>
                </div>
            </div>
        </div>

        <!-- Authentication Cards -->
        <div class="row justify-content-center">
            <!-- User Section -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="dashboard-card p-4">
                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-user text-primary" style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="mt-3 mb-1">User Portal</h3>
                        <p class="text-muted">Access your personal account and manage your profile</p>
                    </div>

                    <div class="d-grid gap-3">
                        <a href="{{ route('user.login') }}" class="btn btn-primary-custom btn-custom">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            User Login
                        </a>
                        <a href="{{ route('user.register') }}" class="btn btn-success-custom btn-custom">
                            <i class="fas fa-user-plus me-2"></i>
                            User Register
                        </a>
                    </div>
                </div>
            </div>

            <!-- Admin Section -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="dashboard-card p-4">
                    <div class="text-center mb-4">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-user-shield text-warning" style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="mt-3 mb-1">Admin Portal</h3>
                        <p class="text-muted">Manage the system and oversee all operations</p>
                    </div>

                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.login') }}" class="btn btn-primary-custom btn-custom">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Admin Login
                        </a>
                        <a href="{{ route('admin.register') }}" class="btn btn-success-custom btn-custom">
                            <i class="fas fa-user-plus me-2"></i>
                            Admin Register
                        </a>
                    </div>
                </div>
            </div>

            <!-- Writer Section -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="dashboard-card p-4">
                    <div class="text-center mb-4">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-pen-fancy text-info" style="font-size: 2rem;"></i>
                        </div>
                        <h3 class="mt-3 mb-1">Writer Portal</h3>
                        <p class="text-muted">Create and manage your written content</p>
                    </div>

                    <div class="d-grid gap-3">
                        <a href="{{ route('writer.login') }}" class="btn btn-primary-custom btn-custom">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            Writer Login
                        </a>
                        <a href="{{ route('writer.register') }}" class="btn btn-success-custom btn-custom">
                            <i class="fas fa-pen-nib me-2"></i>
                            Writer Register
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-5 pb-4">
            <p class="text-white opacity-75 mb-0">
                <i class="fas fa-code me-2"></i>
                Built with Laravel & Bootstrap
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
