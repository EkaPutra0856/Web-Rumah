<head>
    <style>
        /* Style untuk mengatur posisi tombol mata */
        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
            top: 50%;
            right: 10px; /* jarak dari kanan */
            transform: translateY(-50%);
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<div id="insertModal" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center">
    <div class="bg-gray-800 rounded-lg w-1/2">
        <form method="POST" action="insert-adminwilayah" class="w-5/6 mx-auto my-5" onsubmit="return validateInsertForm()">
            @csrf
            <h2 class="text-center font-semibold text-lg text-white">Insert Admin Wilayah</h2><br>

            <div class="basis-1/2 mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                <input name="name" type="text" id="name" required
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="basis-1/2 mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                <input name="email" type="text" id="email" required
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="basis-1/2 mb-3 relative">
                <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                <input name="password" type="password" id="password" required
                    oninput="validateNewPassword()"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500 pr-10">
                <button type="button" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 focus:outline-none"
                    onclick="toggleNewPasswordVisibility()">
                    <i id="password-toggle-icon" class="fas fa-eye"></i>
                </button>
            </div>
            <div class="mb-2">
                <span id="error-message-pw" class="text-red-500 text-sm hidden">Password harus minimal 6 karakter</span>
            </div>
            
            <div class="flex flex-wrap">
                <div class="w-1/2 mb-5 pr-2">
                    <label for="notelp" class="block mb-2 text-sm font-medium text-white">No Telepon</label>
                    <input name="notelp" type="text" id="notelp" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-1/2 mb-5 pl-2">
                    <label for="region_id" class="block mb-2 text-sm font-medium text-white">ID Wilayah</label>
                    <select name="region_id" type="text" id="region_id" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" >
                        <option disabled selected>Region ID</option>
                        @foreach ($regions as $p)
                        <option value="{{$p->id}}">{{$p->kelurahan_desa}}</option>
                        @endforeach
                    </select>
                    <span id="error-message-region_id" class="text-red-500 text-sm hidden">Silakan pilih Region ID</span>
                </div>
            </div>

            <div class="flex flex-row gap-4 mt-5">
                <button type="submit"
                    class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mb-5">Submit</button>
                <button type="button" onclick="closeInsertModal()"
                    class="text-blue-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600 mb-5">Cancel</button>
            </div>
        </form>
    </div>
</div>
</body>
<script>
    function validateNewPassword() {
        const passwordAdminWil = document.getElementById('password').value;
        const errorMessagePassword = document.getElementById('error-message-pw');

        if (passwordAdminWil.length < 6) {
            errorMessagePassword.classList.remove('hidden');
        } else {
            errorMessagePassword.classList.add('hidden');
        }
    }

    function validateInsertForm() {
        const regionId = document.getElementById('region_id').value;
        const errorMessageRegionId = document.getElementById('error-message-region_id');

        if (regionId === "Region ID") {
            errorMessageRegionId.classList.remove('hidden');
            return false;
        } else {
            errorMessageRegionId.classList.add('hidden');
        }
    }

    function toggleNewPasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const passwordToggleIcon = document.getElementById('password-toggle-icon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordToggleIcon.classList.remove('fa-eye');
            passwordToggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passwordToggleIcon.classList.remove('fa-eye-slash');
            passwordToggleIcon.classList.add('fa-eye');
        }
    }
</script>
