@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-user me-2"></i>User Panel
        </a>
        <div class="navbar-nav ms-auto">
            <span class="navbar-text me-3">
                Welcome, {{ Auth::guard('user')->user()->name }}!
            </span>
            <form method="POST" action="{{ route('user.logout') }}" class="d-inline">
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
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-tachometer-alt me-2"></i>User Dashboard
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-user-edit fa-3x text-primary mb-3"></i>
                                    <h5>Profile</h5>
                                    <p class="text-muted">Manage your profile</p>
                                    <a href="{{ route('user.crud.edit', Auth::guard('user')->user()) }}" class="btn btn-primary">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-id-card fa-3x text-warning mb-3"></i>
                                    <h5>My Details</h5>
                                    <p class="text-muted">View my profile details</p>
                                    <a href="{{ route('user.crud.show', Auth::guard('user')->user()) }}" class="btn btn-warning">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <i class="fas fa-cog fa-3x text-info mb-3"></i>
                                    <h5>Account Settings</h5>
                                    <p class="text-muted">Manage account preferences</p>
                                    <a href="#" class="btn btn-info">Settings</a>
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
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Welcome to your dashboard! This is your personal space.
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
 
