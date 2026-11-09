@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>

    @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <div class="card mb-4">
        <div class="card-body">
            <h5>Welcome, {{ auth()->user()->name }}!</h5>
            <p class="mb-0">Email: {{ auth()->user()->email }}</p>
        </div>
    </div>
</div>
@endsection