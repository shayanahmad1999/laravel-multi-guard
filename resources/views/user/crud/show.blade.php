@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user me-2"></i>
                            User Details
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('user.crud.edit', $user) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('user.crud.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back to List
                            </a>
                            @if (auth('user')->check())
                                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-home me-2"></i>Dashboard
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-borderless">
                                    <tr>
                                        <th class="text-muted" style="width: 150px;">ID:</th>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Name:</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Email:</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Email Verified:</th>
                                        <td>
                                            @if ($user->email_verified_at)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check me-1"></i>Verified
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>Not Verified
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Created At:</th>
                                        <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Updated At:</th>
                                        <td>{{ $user->updated_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-user fa-4x text-success"></i>
                                        </div>
                                        <h5>{{ $user->name }}</h5>
                                        <p class="text-muted">{{ $user->email }}</p>
                                        <div class="mt-3">
                                            <span class="badge bg-success fs-6">Regular User</span>
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
