@extends('layouts.app')

@section('content')
<h1>Users & Roles</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ optional($user->role)->name }}</td>
            <td>
                @if(auth()->user()->isSuperAdmin() && $user->id !== auth()->user()->id)
                <form method="POST" action="{{ route('users.assignRole', $user->id) }}">
                    @csrf
                    <select name="role_id">
                        @foreach(App\Models\Role::all() as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit">Update</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection