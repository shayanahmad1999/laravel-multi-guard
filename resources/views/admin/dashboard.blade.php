@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-user-shield me-2"></i>Admin Panel
        </a>
        <div class="navbar-nav ms-auto">
            <span class="navbar-text me-3">
                Welcome, {{ Auth::guard('admin')->user()->name }}!
            </span>
            <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-tachometer-alt me-2"></i>Admin Dashboard
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                    <h5>Manage Users</h5>
                                    <p class="text-muted">View and manage user accounts</p>
                                    <a href="{{ route('user.crud.index') }}" class="btn btn-primary">Go to Users</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-shield fa-3x text-warning mb-3"></i>
                                    <h5>Manage Admins</h5>
                                    <p class="text-muted">View and manage admin accounts</p>
                                    <a href="{{ route('admin.crud.index') }}" class="btn btn-warning">Go to Admins</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-pen-fancy fa-3x text-info mb-3"></i>
                                    <h5>Manage Writers</h5>
                                    <p class="text-muted">View and manage writer accounts</p>
                                    <a href="{{ route('writer.crud.index') }}" class="btn btn-info">Go to Writers</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Recent Activity</h5>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Welcome to the admin dashboard! This is where you can manage your application.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
