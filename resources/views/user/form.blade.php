@csrf
@if (isset($user)) @method('PUT') @endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Password @isset($user) <small class="text-muted">(leave blank to keep current)</small> @endisset</label>
    <input type="password" name="password" class="form-control" {{ isset($user) ? '' : 'required' }}>
</div>

<div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" {{ isset($user) ? '' : 'required' }}>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Role</label>
        <select name="role" class="form-select" required>
            @foreach (['user' => 'User', 'admin' => 'Admin'] as $value => $label)
                <option value="{{ $value }}" @selected(old('role', $user->role ?? 'user') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="1" @selected((string) old('status', $user->status ?? 1) === '1')>Active</option>
            <option value="0" @selected((string) old('status', $user->status ?? 1) === '0')>Inactive</option>
        </select>
    </div>
</div>

<button class="btn btn-primary">Save</button>
<a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>