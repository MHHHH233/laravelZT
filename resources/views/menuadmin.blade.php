<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN | MENU ADMIN</title>
</head>
<body>
    <h1>ADMIN | MENU ADMIN</h1>
    @if(Session('l')== null)
        <script>
            window.location.assign('action');
        </script>
    @else
        Bienvenue <p>{{ Session('l') }}</p> vous etes {{ Session('t') }}
        <br>
        <a href="{{route('logout')}}">Logout</a>
        
        <h2>User Management</h2>
        @if(session('msg'))
            <p>{{ session('msg') }}</p>
        @endif
        
        <a href="{{ route('action.create') }}">Add New User</a>
        <table border="1">
            <tr>
                <th>Email</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->email }}</td>
                <td>{{ $user->type }}</td>
                <td>
                    <a href="{{ route('action.edit', $user->id) }}">Edit</a>
                    <form action="{{ route('action.destroy', $user->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    @endif
</body>
</html>