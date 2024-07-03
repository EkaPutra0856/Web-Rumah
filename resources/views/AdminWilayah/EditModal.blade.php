@foreach ($regionAdmin as $p)
<head>
    <style>
        /* Style untuk mengatur posisi tombol mata */
        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
            top: 70%;
            right: 10px; /* jarak dari kanan */
            transform: translateY(-50%);
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
    <div id="editModal{{ $p->id }}"
        class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center ">
        <div class="bg-gray-800 rounded-lg w-1/2">
            <form method="POST" action="{{ url('/' . $p->id . '/update-adminwilayah') }}" class=" w-5/6 mx-auto my-5" enctype="multipart/form-data"
                onsubmit="return validateEditForm({{ $p->id }})">
                @csrf
                <h2 class=" text-center font-semibold text-lg text-white">Edit Admin</h2><br>

                <div class="basis-1/2 mb-5 ">
                    <label for="name{{ $p->id }}" class="block mb-2 text-sm font-medium  text-white">Name</label>
                    <input name="name" type="text" id="name{{ $p->id }}" value="{{ $p->name }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="basis-1/2 mb-5 ">
                    <label for="email{{ $p->id }}" class="block mb-2 text-sm font-medium  text-white">Email</label>
                    <input name="email" type="text" id="email{{ $p->id }}" value="{{ $p->email }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="basis-1/2 mb-3 relative">
                    <label for="password{{ $p->id }}" class="block mb-2 text-sm font-medium text-white">Password</label>
                    <input name="password" type="password" id="password{{ $p->id }}"
                        oninput="validatePassword({{ $p->id }})"required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500 pr-10">
                    <button type="button" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-400 focus:outline-none"
                        onclick="togglePasswordVisibility('{{ $p->id }}')">
                        <i id="password-toggle-icon{{ $p->id }}" class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="mb-2">
                    <span id="error-message-pw{{ $p->id }}" class="text-red-500 text-sm hidden ">Password harus minimal 6 karakter</span>
                </div>
            
                <div class="flex flex-wrap ">
                    <div class="w-1/2 mb-5 pr-2">
                        <label for="notelp{{ $p->id }}" class="block mb-2 text-sm font-medium  text-white">No Telepon</label>
                        <input name="notelp" type="text" id="notelp{{ $p->id }}" value="{{ $p->notelp }}"
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-1/2 mb-5 pl-2">
                        <label for="region_id{{ $p->id }}" class="block mb-2 text-sm font-medium  text-white">Region ID</label>
                        <select name="region_id" type="text" id="region_id{{ $p->id }}"
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                            <option disabled selected>Region ID</option>
                            @foreach ($regions as $p)
                                <option value="{{ $p->id }}">{{ $p->kelurahan_desa }}</option>
                            @endforeach
                        </select>
                        <span id="error-message-region_id{{ $p->id }}" class="text-red-500 text-sm hidden">Silakan pilih Region ID</span>
                    </div>
                </div>
                <div class="basis-1/2 mb-5">
                        <label for="image{{ $p->id }}" class="block mb-2 text-sm font-medium text-white">Image</label>
                        <input name="image" type="file" id="image{{ $p->id }}" accept=".png,.jpg,.jpeg,.svg"
                            class="form-control border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        @if ($p->image)
                            <img src="{{ Storage::url($p->image) }}" alt="Current Image" class="w-10 h-10 rounded-full mt-2">
                        @else
                            <img src="{{ asset('image/default.jpg') }}" alt="No Image" class="w-10 h-10 rounded-full mt-2">
                        @endif
                    </div>
                <div class="flex flex-row gap-4 mt-5">
                    <button type="submit"
                        class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mb-5">Submit</button>
                    <button type="button" onclick="closeEditModal('{{ $p->id }}')"
                        class="text-blue-600  focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600 mb-5">Cancel</button>
                </div>
            </form>
        </div>
    </div>
<script>
    function validatePassword(id) {
        const passwordAdminWil = document.getElementById('password' + id).value;
        const errorMessagePassword = document.getElementById('error-message-pw' + id);

        if (passwordAdminWil.length < 6) {
            errorMessagePassword.classList.remove('hidden');
        } else {
            errorMessagePassword.classList.add('hidden');
        }
    }

    function validateEditForm(id) {
        const regionId = document.getElementById('region_id' + id).value;
        const errorMessageRegionId = document.getElementById('error-message-region_id' + id);

        if (regionId === "Region ID") {
            errorMessageRegionId.classList.remove('hidden');
            return false;
        } else {
            errorMessageRegionId.classList.add('hidden');
        }
    }

    function togglePasswordVisibility(id) {
        const passwordInput = document.getElementById('password' + id);
        const passwordToggleIcon = document.getElementById('password-toggle-icon' + id);

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
@endforeach
