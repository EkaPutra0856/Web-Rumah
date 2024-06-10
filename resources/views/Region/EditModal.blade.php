@foreach ($regions as $p)
    <div id="editModal{{ $p->id }}"
        class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center ">
        <div class="bg-gray-800 rounded-lg w-1/2">
            <form method="POST" action="{{ url('/' . $p->id . '/update-region') }}" class="w-5/6 mx-auto my-5">
                @csrf
                <h2 class="text-center font-semibold text-lg text-white">Edit Wilayah</h2><br>

                <div class="flex flex-wrap">
                    <div class="w-1/2 p-2">
                        <label for="kecamatan" class="block mb-2 text-sm font-medium text-white">Kecamatan</label>
                        <input name="kecamatan" type="text" id="kecamatan"
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->kecamatan }}" required>
                    </div>

                    <div class="w-1/2 p-2">
                        <label for="kelurahan_desa"
                            class="block mb-2 text-sm font-medium text-white">Kelurahan/Desa</label>
                        <input name="kelurahan_desa" type="text" id="kelurahan_desa"
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->kelurahan_desa }}" required>
                    </div>

                    <div class="w-1/2 p-2">
                        <label for="kode_pos" class="block mb-2 text-sm font-medium text-white">Kode Pos</label>
                        <input name="kode_pos" type="text" id="kode_pos"
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->kode_pos }}" required>
                    </div>


                </div>



                <div id="coordinates-container-edit"
                    class="flex flex-wrap h-20 overflow-hidden overscroll-y-auto overflow-y-scroll">
                    <div class="w-1/2 p-2">
                        <label for="latitude1" class="block mb-2 text-sm font-medium text-white">Latitude 1</label>
                        <input name="latitude1" type="text" id="latitude1" required
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->latitude }}" required>
                    </div>

                    <div class="w-1/2 p-2">
                        <label for="longitude1" class="block mb-2 text-sm font-medium text-white">Longitude 1</label>
                        <input name="longitude1" type="text" id="longitude1"
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->longitude1 }}" required>


                    </div>
                </div>

                <div class="w-full p-2 text-center">
                    <button type="button" onclick="addCoordinatesField()"
                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-5">Add
                        Coordinates</button>
                </div>

                <div class="flex flex-row gap-3 mt-5">
                    <button type="submit"
                        class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Submit</button>
                    <button type="button" onclick="closeEditModal('{{ $p->id }}')"
                        class="text-blue-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
<script>
    let coordinateIndexEdit = 2;

    function addCoordinatesField() {
        const container = document.getElementById('coordinates-container-edit');

        const newLatitudeDiv = document.createElement('div');
        newLatitudeDiv.className = 'w-1/2 p-2';
        newLatitudeDiv.innerHTML = `
        <label for="latitude${coordinateIndexEdit}" class="block mb-2 text-sm font-medium text-white">Latitude ${coordinateIndexEdit}</label>
        <input name="latitude${coordinateIndexEdit}" type="text" id="latitude${coordinateIndexEdit}" required
            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
    `;

        const newLongitudeDiv = document.createElement('div');
        newLongitudeDiv.className = 'w-1/2 p-2';
        newLongitudeDiv.innerHTML = `
        <label for="longitude${coordinateIndexEdit}" class="block mb-2 text-sm font-medium text-white">Longitude ${coordinateIndexEdit}</label>
        <input name="longitude${coordinateIndexEdit}" type="text" id="longitude${coordinateIndexEdit}" required
            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
    `;

        container.appendChild(newLatitudeDiv);
        container.appendChild(newLongitudeDiv);

        coordinateIndexEdit++;
    }
</script>
