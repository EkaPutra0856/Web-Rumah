<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
@include('Layout.navbar')

<body class="bg-white dark:bg-gray-900 astro-FLTEP2YP">

    <div class="container mx-auto p-4">

        <div class="lg:w-2/3 text-center mx-auto">
            <h1 class="text-gray-900 dark:text-white font-bold text-5xl md:text-6xl xl:text-5xl mt-20">Welcome to
                Dashboard
            </h1>
        </div>

        <div class="hidden py-8 mt-16 border-y border-gray-100 dark:border-gray-800 sm:flex justify-center">
            <div class="text-center">
                <h6 class="text-center font-semibold text-gray-700 dark:text-white">Halo {{ $user->name }}</h6>
                <p class="mt-2 text-gray-500">You are logged in as an administrator with email
                    {{ $user->email }}</p>
            </div>
        </div>

        <div class="mt-16 flex flex-wrap justify-center gap-y-4 gap-x-6">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:border before:border-transparent before:bg-primary/10 before:bg-gradient-to-b before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 dark:before:border-gray-700 dark:before:bg-gray-800 sm:w-max">
                    <span class="relative text-base font-semibold text-primary dark:text-white">Logout</span>
                </button>
            </form>
        </div>

    </div>
</body>

</html>
