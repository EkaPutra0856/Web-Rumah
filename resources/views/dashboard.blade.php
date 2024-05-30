<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
@include('Layout.navbar')
<body class="bg-gray-100">
   
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Welcome to Dashboard</h1>
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <p class="text-lg mb-2">You are logged in as an administrator.</p>
            <p class="text-lg mb-2">Email: {{ $user->email }}</p>
            <p class="text-lg mb-4">Username: {{ $user->name }}</p>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
