@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Student / Employee Profiles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Profiles</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div><i class="fas fa-table me-1"></i> Profiles List</div>
            <a href="{{ route('admin.student-employees.create') }}" class="btn btn-primary btn-sm">Add Profile</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name (User Account)</th>
                        <th>Role</th>
                        <th>Student ID</th>
                        <th>Program</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profiles as $profile)
                    <tr>
                        <!-- Dito natin makikita ang power ng Foreign Key relationship! -->
                        <td>{{ $profile->user->name }} <br><small class="text-muted">{{ $profile->user->email }}</small></td>
                        <td><span class="badge bg-secondary">{{ ucfirst($profile->user->role) }}</span></td>
                        <td>{{ $profile->student_id ?? 'N/A' }}</td>
                        <td>{{ $profile->program ?? 'N/A' }}</td>
                        <td>{{ $profile->department->college ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.student-employees.edit', $profile->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.student-employees.destroy', $profile->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this profile?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">No profiles found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            {{ $profiles->links() }}
        </div>
    </div>
</div>
@endsection