@extends('layouts.app')

@section('content')

<h2>Users</h2>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($users as $user)
            <tr>
                <td>
    @if($user->profile_image)
        <img src="{{ asset('storage/' . $user->profile_image) }}" 
             style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
    @else
        @php
            $colors = ['#ef4444', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'];
            $color = $colors[$user->id % count($colors)];
            $nameParts = explode(' ', $user->name);
            $initials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
        @endphp

        <div style="
            width:40px;
            height:40px;
            border-radius:50%;
            background:{{ $color }};
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:14px;
            font-weight:600;
        ">
            {{ $initials }}
        </div>
    @endif
</td>


                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>

                <td>
                    {{ $user->role->name ?? 'N/A' }}
                </td>

                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn">Edit</a>

                    <form action="{{ route('users.destroy', $user->id) }}" 
                          method="POST" 
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn" onclick="return confirm('Delete user?')">
                            Delete
                        </button>
                    </form>
                    <a href="{{ route('profile', $user->id) }}" class="btn">View Profile</a>    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
@if(method_exists($users, 'links'))
    <div style="margin-top:15px;">
        {{ $users->links() }}
    </div>
@endif

@endsection
