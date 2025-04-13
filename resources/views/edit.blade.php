<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="{{ route('action.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Email:</label>
            <input type="email" name="mail" value="{{ $user->email }}" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="pwd" required>
        </div>
        <div>
            <label>Type:</label>
            <select name="type">
                <option value="user" {{ $user->type == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->type == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button type="submit">Update User</button>
    </form>
    <a href="{{ route('action.index') }}">Back to Admin Menu</a>
</body>
</html>
