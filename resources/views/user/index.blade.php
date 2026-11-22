@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Users</h1>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('danger'))  <div class="alert alert-danger">{{ session('danger') }}</div> @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control" placeholder="Search username or email">
                <button class="btn btn-secondary">Search</button>
            </form>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th><th>Username</th><th>Email</th><th>User Type</th><th>Status</th><th width="200">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->user_type) }}</td>
                        <td>
                            <span class="badge bg-{{ $user->status ? 'success' : 'secondary' }}">
                                {{ $user->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">View</a>

                            @if($user->user_type !== 'admin')
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            @else
                                <span class="text-muted small ms-1">Protected</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No users found.</td></tr>
                @endforelse
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
