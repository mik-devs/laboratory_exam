@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Profile</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.student-employees.update', $studentEmployee->id) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Select User</label>
                        <select name="user_id" class="form-select" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @selected($studentEmployee->user_id == $user->id)>
                                    {{ $user->name }} ({{ ucfirst($user->role) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Select Department</label>
                        <select name="department_id" class="form-select" required>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" @selected($studentEmployee->department_id == $dept->id)>
                                    {{ $dept->department_id }} - {{ $dept->college }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Student ID</label>
                        <input type="text" name="student_id" class="form-control" value="{{ old('student_id', $studentEmployee->student_id) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Program</label>
                        <input type="text" name="program" class="form-control" value="{{ old('program', $studentEmployee->program) }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('admin.student-employees.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection