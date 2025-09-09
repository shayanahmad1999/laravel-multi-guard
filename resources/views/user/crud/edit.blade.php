@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Edit User
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.crud.update', $user) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">New Password (leave blank to keep
                                        current)</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation">
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('user.crud.show', $user) }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Back to Details
                                    </a>
                                    <a href="{{ route('user.crud.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-list me-2"></i>Back to List
                                    </a>
                                    @if (auth('user')->check())
                                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-home me-2"></i>Dashboard
                                        </a>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-2"></i>Update User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
