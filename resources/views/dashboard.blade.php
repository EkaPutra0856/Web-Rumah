<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to Dashboard</h1>
    <p>You are logged in as an administrator.</p>
    <p>Email: {{ $user->email }}</p>
    <p>Username: {{ $user->name }}</p>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
