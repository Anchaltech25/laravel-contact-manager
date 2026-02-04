@extends('layouts.app')

@section('content')
<h2>Contacts</h2>

<form method="GET" action="{{ route('contacts.index') }}" style="margin-bottom:12px; display:flex; gap:10px; align-items:center;">
    <input type="text" name="q" placeholder="Search name, email or number" value="{{ request('q') }}">
    <select name="status">
        <option value="">All status</option>
        <option value="active" {{ request('status')=='active' ? 'selected':'' }}>Active</option>
        <option value="inactive" {{ request('status')=='inactive' ? 'selected':'' }}>Inactive</option>
    </select>
    <label>From <input type="date" name="from_date" value="{{ request('from_date') }}"></label>
    <label>To <input type="date" name="to_date" value="{{ request('to_date') }}"></label>
    <button class="btn" type="submit">Filter</button>
</form>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Contact</th>
            <th class="small">Created</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr id="contact-row-{{ $contact->id }}">
            <td>{{ $contact->id }}</td>
            <td>
                <div class="card">
                    <img src="{{ $contact->profile_image_url }}" alt="" class="avatar">
                    <div>
                        <div><a href="{{ route('contacts.show', $contact) }}">{{ $contact->name }}</a></div>
                        <div class="small">
                            @auth
                                Email: {{ $contact->email }}<br>
                                Phone: {{ $contact->number }}
                            @else
                                <em>Login to see email & phone</em>
                            @endauth
                        </div>
                    </div>
                </div>
            </td>
            <td class="small">{{ $contact->created_at->format('Y-m-d') }}</td>
            <td>
                <input type="checkbox" class="toggle-active" data-id="{{ $contact->id }}" {{ $contact->is_active ? 'checked':'' }}>
                <span class="small status-text">{{ $contact->is_active ? 'Active':'Inactive' }}</span>
            </td>
            <td>
                @auth
                    <a class="btn" href="{{ route('contacts.edit', $contact) }}">Edit</a>
                    <form method="POST" action="{{ route('contacts.destroy', $contact) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn" type="submit">Trash</button>
                    </form>
                @endauth
                <a class="btn" href="{{ route('contacts.show', $contact) }}">View</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@endsection

@push('scripts')
<script>
$(function(){
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

    $('.toggle-active').on('change', function(){
        var cb = $(this);
        var id = cb.data('id');
        // optimistic UI: change status text
        var statusText = cb.closest('td').find('.status-text');
        statusText.text(cb.is(':checked') ? 'Active':'Inactive');

        $.post('/contacts/'+id+'/toggle-active', {}, function(resp){
            if(!resp.success){
                alert('Could not update status.');
                // revert
                cb.prop('checked', !cb.is(':checked'));
            }
        }).fail(function(){
            alert('Server error.');
            cb.prop('checked', !cb.is(':checked'));
            statusText.text(cb.is(':checked') ? 'Active':'Inactive');
        });
    });
});
</script>
@endpush
