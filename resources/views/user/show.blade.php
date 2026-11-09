@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">User Details</h1>
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-borderless w-auto">
                <tr><th>ID</th><td>{{ $user->id }}</td></tr>
                <tr><th>Name</th><td>{{ $user->name }}</td></tr>
                <tr><th>Email</th><td>{{ $user->email }}</td></tr>
                <tr><th>Role</th><td>{{ ucfirst($user->role) }}</td></tr>
                <tr><th>Status</th><td>{{ $user->status ? 'Active' : 'Inactive' }}</td></tr>
                <tr><th>Created</th><td>{{ $user->created_at->format('M d, Y h:i A') }}</td></tr>
            </table>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection