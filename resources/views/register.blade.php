<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Register Template</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        body {
            background-color: #000; /* Set background to black */
            color: #fff; /* Set text color to white */
        }

        .background-image {
            background-image: url('/image/background_gelap_pemweb.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px; /* Add padding to the body to prevent content from touching screen edges */
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.8); /* Dark overlay color */
            max-height: 90vh; /* Set maximum height */
            width: fit-content; /* Adjust width to content */
            padding: 20px; /* Add some padding for aesthetics */
            overflow-y: hidden; /* Prevent vertical scrolling */
            display: flex;
            flex-direction: column; /* Make sure children are arranged vertically */
            justify-content: center; /* Center children vertically */
        }

        .dark-navy {
            background-color: #000033; /* Dark navy background */
            color: white;
        }

        .dark-navy input {
            background-color: #001a33; /* Darker input background */
            color: white;
        }

        .dark-navy label,
        .dark-navy p,
        .dark-navy a {
            color: white;
        }

        .error-notification {
            background-color: rgba(255, 0, 0, 0.2);
            border-color: rgba(255, 0, 0, 0.4);
            color: white;
        }

        .error-notification svg {
            fill: white;
        }
        
    </style>
</head>
<body class="font-family-karla h-screen flex items-center justify-center background-image">
<div class="scroll">
    <div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 p-8 overlay rounded-lg shadow-lg ">
        <div class="flex justify-center mb-8">
            <a href="#" class="bg-white text-black font-bold text-xl p-4" alt="Logo">Logo</a>
        </div>

        <div class="flex flex-col justify-center px-8 md:px-16">
            <p class="text-center text-3xl mb-6">Create your account!</p>
            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div id="error-notification" class="error-notification border rounded relative mb-6" role="alert">
                    @foreach ($errors->all() as $error)
                        <span class="block sm:inline">{{ $error }}</span><br>
                    @endforeach
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="document.getElementById('error-notification').classList.add('hidden')">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a.5.5 0 0 0-.707 0L10 9.293 6.36 5.652a.5.5 0 1 0-.707.707L9.293 10l-3.64 3.64a.5.5 0 0 0 .707.707L10 10.707l3.64-3.64a.5.5 0 0 0 0-.707z"/></svg>
                    </span>
                </div>
            @endif

            <form class="flex flex-col" action="{{ url('/register-administrator') }}" method="POST">
                @csrf    
                <div class="flex flex-col pt-4">
                    <label for="name" class="text-lg">Name</label>
                    <input type="text" id="name" name="name" placeholder="John Smith" class="shadow appearance-none border rounded w-full py-2 px-3 dark-navy mt-1 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}" />
                </div>

                <div class="flex flex-col pt-4">
                    <label for="email" class="text-lg">Email</label>
                    <input type="email" id="email" name="email" placeholder="your@email.com" class="shadow appearance-none border rounded w-full py-2 px-3 dark-navy mt-1 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}" />
                </div>

                <div class="flex flex-col pt-4">
                    <label for="notelp" class="text-lg">Phone Number</label>
                    <input type="notelp" id="notelp" name="notelp" placeholder="08xxxxxxxxxx" class="shadow appearance-none border rounded w-full py-2 px-3 dark-navy mt-1 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('notelp') }}" />
                </div>

                <div class="flex flex-col pt-4">
                    <label for="password" class="text-lg">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 dark-navy mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                </div>

                <div class="flex flex-col pt-4">
                    <label for="c_password" class="text-lg">Confirm Password</label>
                    <input type="password" id="c_password" name="c_password" placeholder="Password" class="shadow appearance-none border rounded w-full py-2 px-3 dark-navy mt-1 leading-tight focus:outline-none focus:shadow-outline" />
                </div>

                <button type="submit" class="bg-white text-black font-bold text-lg hover:bg-gray-700 p-2 mt-8">REGISTER</button>
            </form>
            <div class="text-center pt-12 pb-12">
                <p>Already have an account? <a href="/login" class="underline font-semibold">Log in here.</a></p>
            </div>
        </div>
    </div>
    </div>

    <script>
        function validateForm(event) {
            // Ambil nilai dari form
            const c_password = document.getElementById('c_password').value;

            // Validasi confirm password
            if (c_password === "") {
                showError("Confirm password harus diisi!");
                event.preventDefault();
                return false;
            }

            return true;
        }

        function showError(message) {
            const errorNotification = document.getElementById('error-notification');
            const errorMessage = document.getElementById('error-message');
            errorMessage.innerText = message;
            errorNotification.classList.remove('hidden');
        }
    </script>

</body>
</html>
