@extends('layouts.app')

@section('title', 'Writer Details')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-pen-fancy me-2"></i>
                            Writer Details
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('writer.crud.edit', $writer) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('writer.crud.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back to List
                            </a>
                            @if (auth('writer')->check())
                                <a href="{{ route('writer.dashboard') }}" class="btn btn-outline-secondary">
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
                                        <td>{{ $writer->id }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Name:</th>
                                        <td>{{ $writer->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Email:</th>
                                        <td>{{ $writer->email }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Email Verified:</th>
                                        <td>
                                            @if ($writer->email_verified_at)
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
                                        <td>{{ $writer->created_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Updated At:</th>
                                        <td>{{ $writer->updated_at->format('Y-m-d H:i:s') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-pen-fancy fa-4x text-info"></i>
                                        </div>
                                        <h5>{{ $writer->name }}</h5>
                                        <p class="text-muted">{{ $writer->email }}</p>
                                        <div class="mt-3">
                                            <span class="badge bg-info fs-6">Content Writer</span>
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
