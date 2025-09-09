@extends('layouts.app')

@section('title', 'Admin Details')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-user-shield me-2"></i>
                        Admin Details
                    </h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.crud.edit', $admin) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('admin.crud.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back to List
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tr>
                                    <th class="text-muted" style="width: 150px;">ID:</th>
                                    <td>{{ $admin->id }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Name:</th>
                                    <td>{{ $admin->name }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Email:</th>
                                    <td>{{ $admin->email }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Email Verified:</th>
                                    <td>
                                        @if($admin->email_verified_at)
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
                                    <td>{{ $admin->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th class="text-muted">Updated At:</th>
                                    <td>{{ $admin->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="fas fa-user-shield fa-4x text-primary"></i>
                                    </div>
                                    <h5>{{ $admin->name }}</h5>
                                    <p class="text-muted">{{ $admin->email }}</p>
                                    <div class="mt-3">
                                        <span class="badge bg-primary fs-6">Administrator</span>
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