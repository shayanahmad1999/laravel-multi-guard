@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">
                                <i class="fas fa-user me-2"></i>
                                My Profile
                            </h4>
                            @if (auth('admin')->check())
                                <a href="{{ route('user.crud.create') }}" class="btn btn-light">
                                    <i class="fas fa-plus me-2"></i>Add New User
                                </a>
                            @else
                                <a href="{{ route('user.crud.edit', Auth::guard('user')->user()) }}" class="btn btn-light">
                                    <i class="fas fa-edit me-2"></i>Edit Profile
                                </a>
                            @endif
                        </div>
                        @if (auth('admin')->check())
                            <a href="{{ URL::previous() }}" class="btn btn-light">
                                <i class="fas fa-chevron-left me-2"></i>Back
                            </a>
                        @else
                            <div class="d-flex gap-2">
                                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-light btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Email Verified</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->email_verified_at)
                                                    <span class="badge bg-success">Verified</span>
                                                @else
                                                    <span class="badge bg-warning">Not Verified</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('user.crud.show', $user) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    @if (auth('admin')->check() || $user->id === auth('user')->id())
                                                        <a href="{{ route('user.crud.edit', $user) }}"
                                                            class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    @endif
                                                    @if (auth('admin')->check())
                                                        <form action="{{ route('user.crud.destroy', $user) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No users found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
