@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Trashed Contacts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($contacts->isEmpty())
        <div class="alert alert-info">
            No trashed contacts found.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Deleted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->deleted_at->format('d M Y, h:i A') }}</td>
                        <td>
                            <form action="{{ route('contacts.restore', $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                
                                <button class="btn btn-sm btn-success" type="submit">Restore</button>
                            </form>

                            <form action="{{ route('contacts.forceDelete', $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit" 
                                        onclick="return confirm('Are you sure you want to permanently delete this contact?')">
                                    Delete Permanently
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('contacts.index') }}" class="btn btn-secondary mt-3">← Back to Contacts</a>
</div>
@endsection
