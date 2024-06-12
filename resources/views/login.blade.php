<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Login Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .background-image {
            background-image: url('https://source.unsplash.com/IXUM4cJynP0');
            background-size: cover;
            background-position: center;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body class="bg-white font-family-karla h-screen flex items-center justify-center background-image">

    <div class="w-full max-w-md p-8 overlay rounded-lg shadow-lg">
        <div class="flex justify-center mb-8">
            <a href="#" class="bg-black text-white font-bold text-xl p-4">Logo</a>
        </div>

        <div class="flex flex-col justify-center px-8">
            <p class="text-center text-3xl mb-6">Welcome back.</p>

            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div id="error-notification" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    @foreach ($errors->all() as $error)
                        <span class="block sm:inline">{{ $error }}</span><br>
                    @endforeach
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('error-notification').classList.add('hidden')">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.36 5.652a.5.5 0 1 0-.707.707L9.293 10l-3.64 3.64a.5.5 0 0 0 .707.707L10 10.707l3.64-3.64a.5.5 0 0 0 0-.707z"/></svg>
                    </span>
                </div>
            @endif

            <form class="flex flex-col" action="{{ url('/login-administrator') }}" method="POST">
                @csrf    
                <div class="flex flex-col pt-4">
                    <label for="email" class="text-lg">Email</label>
                    <input type="email" id="email" name="email" placeholder="your@email.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}">
                </div>
    
                <div class="flex flex-col pt-4">
                    <label for="password" class="text-lg">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mt-1 leading-tight focus:outline-none focus:shadow-outline">
                </div>
    
                <button type="submit" class="bg-black text-white font-bold text-lg hover:bg-gray-700 p-2 mt-8">LOG IN</button>
            </form>
            <div class="text-center pt-12 pb-12">
                <p>Don't have an account? <a href="/register" class="underline font-semibold">Register here.</a></p>
            </div>
        </div>
    </div>

</body>
</html>
