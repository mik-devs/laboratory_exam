@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Department</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.departments.index') }}">Departments</a></li>
        <li class="breadcrumb-item active">Edit Department</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.departments.update', $department->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="department_id" class="form-label">Department Code</label>
                    <input type="text" name="department_id" id="department_id" class="form-control @error('department_id') is-invalid @enderror" value="{{ old('department_id', $department->department_id) }}" required>
                    @error('department_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="college" class="form-label">College</label>
                    <input type="text" name="college" id="college" class="form-control @error('college') is-invalid @enderror" value="{{ old('college', $department->college) }}" required>
                    @error('college')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $department->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Department</button>
                <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection