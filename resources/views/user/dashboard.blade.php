@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if (session('danger')) <div class="alert alert-danger">{{ session('danger') }}</div> @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5>Welcome, {{ auth()->user()->username }}!</h5>
            <p class="mb-0">Email: {{ auth()->user()->email }}</p>
            <a href="{{ route('user.profile.edit') }}" class="btn btn-primary mt-3">My Profile</a>
        </div>
    </div>
</div>
@endsection
