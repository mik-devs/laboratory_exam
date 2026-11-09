@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Add User</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @include('user.form')
            </form>
        </div>
    </div>
</div>
@endsection