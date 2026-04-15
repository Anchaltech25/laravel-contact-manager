@extends('layouts.app')

@section('content')
<h2>Edit User</h2>

<form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-row">
        <label>Name</label>
        <input type="text" name="name" value="{{ $user->name }}">
    </div>

    <div class="form-row">
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}">
    </div>

    <div class="form-row">
        <label>Role</label>
        <select name="role_id">
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-row">
        <label>Profile Image</label>
        <input type="file" name="profile_image">
    </div>

    @if($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}" width="80">
    @endif

    <button class="btn btn-primary" type="submit">Update</button>
</form>
@endsection
