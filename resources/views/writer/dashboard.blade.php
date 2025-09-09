@extends('layouts.app')

@section('title', 'Writer Dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-pen-fancy me-2"></i>
                            Writer Dashboard
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <h5>Welcome, {{ Auth::guard('writer')->user()->name }}!</h5>
                            <p class="mb-0">You are logged in as a writer. Here you can manage your content and writings.
                            </p>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-4 mb-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <i class="fas fa-id-card fa-3x text-info mb-3"></i>
                                        <h5>My Details</h5>
                                        <p class="text-muted">View my profile details</p>
                                        <a href="{{ route('writer.crud.show', Auth::guard('writer')->user()) }}"
                                            class="btn btn-info">View Details</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <i class="fas fa-user-edit fa-3x text-primary mb-3"></i>
                                        <h5>My Profile</h5>
                                        <p class="text-muted">Manage your profile information</p>
                                        <a href="{{ route('writer.crud.edit', Auth::guard('writer')->user()) }}"
                                            class="btn btn-primary">Edit Profile</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <i class="fas fa-cog fa-3x text-warning mb-3"></i>
                                        <h5>Account Settings</h5>
                                        <p class="text-muted">Manage account preferences</p>
                                        <a href="#" class="btn btn-warning">Settings</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('writer.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
