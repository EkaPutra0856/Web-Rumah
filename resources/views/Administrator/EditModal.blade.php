@foreach ($admin as $p)
    <div id="editModal{{ $p->id }}" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center">
        <div class="bg-gray-800 rounded-lg w-1/2">
            <form method="POST" action="{{ url('/' . $p->id . '/update-administrator') }}" class="w-5/6 mx-auto my-5" enctype="multipart/form-data" onsubmit="return validateFormEdit('{{ $p->id }}')">
                @csrf
                <h2 class="text-center font-semibold text-lg text-white">Edit Admin</h2><br>

                <div class="basis-1/2 mb-5 px-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                    <input name="name" type="text" id="name" value="{{ $p->name }}" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="basis-1/2 mb-5 px-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                    <input name="email" type="text" id="email" value="{{ $p->email }}" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="basis-1/2 mb-5 px-2">
                    <label for="gender" class="block mb-2 text-sm font-medium text-white">Gender</label>
                    <select name="gender" id="gender" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        <option value="" disabled {{ !$p->gender ? 'selected' : '' }}>Select Gender</option>
                        <option value="Pria" {{ $p->gender == 'Pria' ? 'selected' : '' }}>Pria</option>
                        <option value="Wanita" {{ $p->gender == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                    </select>
                    <span id="error-message-status{{ $p->id }}" class="text-red-500 text-sm hidden">Silakan pilih Gender</span>
                </div>

                <div class="flex flex-wrap">
                    <div class="basis-1/3 mb-5 px-2">
                        <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                        <input name="password" type="password" id="password{{ $p->id }}" oninput="validatePassword('{{ $p->id }}')" required
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        <span id="error-message-password{{ $p->id }}" class="text-red-500 text-sm hidden">Password harus lebih dari atau sama dengan 6 karakter</span>
                    </div>
                    <div class="w-1/3 mb-5 px-2">
                        <label for="notelp" class="block mb-2 text-sm font-medium text-white">No Telepon</label>
                        <input name="notelp" type="text" id="notelp" value="{{ $p->notelp }}" required
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-1/3 mb-5 px-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-white">Image</label>
                        <input name="image" type="file" id="image"
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        @if ($p->image)
                            <img src="{{ Storage::url($p->image) }}" alt="Current Image" class="w-10 h-10 rounded-full mt-2">
                        @else
                            <img src="{{ asset('images/default.png') }}" alt="No Image" class="w-10 h-10 rounded-full mt-2">
                        @endif
                    </div>
                </div>
                
                <div class="flex flex-row gap-3">
                    <button type="submit"
                        class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mb-5">Submit</button>
                    <button type="button" onclick="closeEditModal('{{ $p->id }}')"
                        class="text-blue-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600 mb-5">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endforeach

<script>
    function validatePassword(id) {
        const password = document.getElementById(`password${id}`).value;
        const errorMessagePassword = document.getElementById(`error-message-password${id}`);

        if (password.length < 6) {
            errorMessagePassword.classList.remove('hidden');
        } else {
            errorMessagePassword.classList.add('hidden');
        }
    }

    function validateFormEdit(id) {
        const password = document.getElementById(`password${id}`).value;
        const errorMessagePassword = document.getElementById(`error-message-password${id}`);

        if (password.length < 6) {
            errorMessagePassword.classList.remove('hidden');
            return false;
        } else {
            errorMessagePassword.classList.add('hidden');
        }

        return true;
    }

    function closeEditModal(id) {
        document.getElementById(`editModal${id}`).classList.add('hidden');
    }
</script>
