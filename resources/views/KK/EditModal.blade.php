@foreach ($kk as $p)
    <div id="editModal{{ $p->id }}"
        class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center">
        <div class="bg-gray-800 rounded-lg w-1/2">
            <form method="POST" action="{{ url('/' . $p->id . '/update-kk') }}" class=" w-5/6 mx-auto my-5"
                onsubmit="return validateEditForm('{{ $p->id }}')">
                @csrf
                <h2 class=" text-center font-semibold text-lg text-white">Edit KK</h2><br>

                <div class="basis-1/2 mb-5">
                    <label for="nokk{{ $p->id }}" class="block mb-2 text-sm font-medium  text-white">No KK</label>
                    <input name="nokk" type="text" id="nokk{{ $p->id }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        oninput="validateKK('{{ $p->id }}')" required
                        value="{{ $p->nokk }}">
                    <span id="error-message-{{ $p->id }}" class="text-red-500 text-sm hidden">Nomor KK tidak kurang dan tidak lebih dari 16 digit</span>
                </div>
                <div class="basis-1/2 mb-5">
                    <label for="namakk{{ $p->id }}" class="block mb-2 text-sm font-medium  text-white">Nama Kepala
                        Keluarga</label>
                    <input name="namakk" type="text" id="namakk{{ $p->id }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        value="{{ $p->namakk }}" required>
                </div>
                <div class="basis-1/2 mb-5">
                    <label for="anggota{{ $p->id }}" class="block mb-2 text-sm font-medium  text-white">Jumlah Anggota
                        Keluarga</label>
                    <input name="anggota" type="number" id="anggota{{ $p->id }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                        value="{{ $p->anggota }}" required>
                </div>
                <div class="basis-1/2 mb-5">
                    <label for="rumah_id{{ $p->id }}" class="block mb-2 text-sm font-medium text-white">ID Rumah</label>
                    <select name="rumah_id" type="text" id="rumah_id{{ $p->id }}"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        <option disabled selected>Select ID Rumah</option>
                        @foreach ($rumah as $rumahItem)
                            <option value="{{ $rumahItem->id }}">{{ $rumahItem->id }}</option>
                        @endforeach
                    </select>
                    <span id="error-message-rumah_id{{ $p->id }}" class="text-red-500 text-sm hidden">Silakan pilih ID Rumah</span>
                </div>

                <div class="flex flex-row gap-3">
                    <button type="submit"
                        class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mb-5">Submit</button>
                    <button type="button" onclick="closeEditModal('{{ $p->id }}')"
                        class="text-blue-600  focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600 mb-5">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endforeach

<script>
    function validateKK(id) {
        const nokk = document.getElementById('nokk' + id).value;
        const errorMessage = document.getElementById('error-message-' + id);

        if (nokk.length !== 16) {
            errorMessage.classList.remove('hidden');
        } else {
            errorMessage.classList.add('hidden');
        }
    }

    function validateEditForm(id) {
        const rumahId = document.getElementById('rumah_id' + id).value;
        const errorMessageRumahId = document.getElementById('error-message-rumah_id' + id);

        let isValid = true;

        if (rumahId === "Select ID Rumah") {
            errorMessageRumahId.classList.remove('hidden');
            isValid = false;
        } else {
            errorMessageRumahId.classList.add('hidden');
        }

        return isValid;
    }
</script>
