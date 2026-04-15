@extends('layouts.app')

@section('content')
<h2>My Profile</h2>

<div style="max-width:400px;">

    <!-- PROFILE IMAGE -->
    @if($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}" 
             width="100" style="border-radius:50%; margin-bottom:10px;">
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- NAME -->
        <h2>Profile</h2>

@if($user->profile_image)
    <img src="{{ asset('storage/' . $user->profile_image) }}" width="100">
@endif

<div class="form-row">
    <label>Name</label>
    <input type="text" value="{{ $user->name }}" id="nameField" readonly>
</div>
<div class="form-row">
    <label>Email</label>
    <input type="email" name="email" value="{{ $user->email }}" id="emailField" readonly>
</div>


<div class="form-row">
    <label>Role</label>
    <input type="text" id="roleField" value="{{ $user->role->name ?? 'N/A' }}" readonly>
</div>

        <!-- HIDDEN ROLE ID -->
        <input type="hidden" name="role_id" value="{{ $user->role_id }}" id="roleField">

         <!-- NAME (READONLY INITIALLY) -->

        <!-- IMAGE (HIDDEN INITIALLY) -->
        <div class="form-row" id="imageField" style="display:none;">
            <label>Change Image</label>
            <input type="file" name="profile_image">
        </div>

        <!-- BUTTONS -->
        <div style="margin-top:15px;">
            <button type="button" class="btn" onclick="enableEdit()" id="editBtn">
                Edit Profile
            </button>

            <button type="submit" class="btn btn-primary" id="updateBtn" style="display:none;">
                Update
            </button>
        </div>
    </form>

    <div style="margin-bottom:15px;">
    @if(auth()->user()->role_id == 1)
        <a href="{{ route('users.index') }}" class="btn">
            ← Back to Users
        </a>
    @else
        <a href="{{ route('contacts.index') }}" class="btn">
            ← Back
        </a>
    @endif
</div>


</div>

<!-- SIMPLE JS -->
<script>
   function enableEdit() {
    // Enable name field
    document.getElementById('nameField').removeAttribute('readonly');

    // Enable email field (IMPORTANT)
    document.getElementById('emailField').removeAttribute('readonly');

    // Show image upload field
    document.getElementById('imageField').style.display = 'block';

    // Show update button
    document.getElementById('updateBtn').style.display = 'inline-block';

    // Hide edit button
    document.getElementById('editBtn').style.display = 'none';
}


</script>

@endsection
