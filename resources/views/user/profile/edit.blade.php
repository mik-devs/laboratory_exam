@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">My Profile</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">My Profile</li>
    </ol>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('user.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">User Type</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user->user_type) }}" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">New Password <small class="text-muted">(optional)</small></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>

                @if ($profile)
                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">First Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $profile->name) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $profile->lastname) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middlename" class="form-control" value="{{ old('middlename', $profile->middlename) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Student ID</label>
                            <input type="text" name="student_id" class="form-control" value="{{ old('student_id', $profile->student_id) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Department</label>
                            <input type="text" class="form-control"
                                   value="{{ $profile->department->college ?? 'N/A' }}" readonly>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">
                        No student/employee profile is linked to your account yet. Please contact the administrator.
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
