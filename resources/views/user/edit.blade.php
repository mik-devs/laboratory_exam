@extends('layouts.side-nav')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit User</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @include('user.form', ['user' => $user])
            </form>
        </div>
    </div>
</div>
@endsection