<div class="form-row">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $contact->name ?? '') }}" required>
    @error('name')<div class="small" style="color:red">{{ $message }}</div>@enderror
</div>

<div class="form-row">
    <label>Email</label>
    <input type="email" name="email" value="{{ old('email', $contact->email ?? '') }}" required>
    @error('email')<div class="small" style="color:red">{{ $message }}</div>@enderror
</div>

<div class="form-row">
    <label>Number</label>
    <input type="text" name="number" value="{{ old('number', $contact->number ?? '') }}" required>
    @error('number')<div class="small" style="color:red">{{ $message }}</div>@enderror
</div>

<div class="form-row">
    <label>Bio</label>
    <textarea name="bio">{{ old('bio', $contact->bio ?? '') }}</textarea>
</div>

<div class="form-row">
    <label>User (One user per contact)</label>
    <select name="user_id" required>
        <option value="">Select user</option>
        @foreach(\App\Models\User::all() as $user)
            <option value="{{ $user->id }}" {{ (old('user_id', $contact->user_id ?? '') == $user->id) ? 'selected':'' }}>
                {{ $user->email }}
            </option>
        @endforeach
    </select>
    @error('user_id')<div class="small" style="color:red">{{ $message }}</div>@enderror
</div>

<div class="form-row">
    <label>Profile Image</label>
    <input type="file" name="profile_image">
    @if(!empty($contact->profile_image_url))
        <img src="{{ $contact->profile_image_url }}" alt="" style="width:64px;height:64px;border-radius:50%;display:block;margin-top:8px;">
    @endif
</div>

<div class="form-row">
    <label>Is Active</label>
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $contact->is_active ?? true) ? 'checked':'' }}>
</div>
