@foreach ($regions as $p)
    <div id="editModal{{ $p->id }}"
        class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center ">
        <div class="bg-gray-800 rounded-lg w-1/2">
            <form method="POST" action="{{ url('/' . $p->id . '/update-region') }}" class="w-5/6 mx-auto my-5" enctype="multipart/form-data">
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
                    <div class="w-1/2 p-2">
                        <label for="image" class="block mb-2 text-sm font-medium text-white">Foto Kelurahan</label>
                        <input name="image" type="file" id="image" accept=".png,.jpg,.jpeg,.svg" 
                            class="form-control border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        @if ($p->image)
                            <img src="{{ Storage::url($p->image) }}" alt="Current Image" class="w-10 h-10 rounded-full mt-2">
                        @else
                            <img src="{{ asset('image/default_rumah.png') }}" alt="No Image" class="w-10 h-10 rounded-full mt-2">
                        @endif
                    </div>

                </div>



                <div id="coordinates-container-edit"
                    class="flex flex-wrap h-20 overflow-hidden overscroll-y-auto overflow-y-scroll">
                    <div class="w-1/2 p-2">
                        <label for="latitude1" class="block mb-2 text-sm font-medium text-white">Latitude 1</label>
                        <input name="latitude1" type="text" id="latitude1" required
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->latitude1 }}" required>
                    </div>

                    <div class="w-1/2 p-2">
                        <label for="longitude1" class="block mb-2 text-sm font-medium text-white">Longitude 1</label>
                        <input name="longitude1" type="text" id="longitude1"
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->longitude1 }}" required>
                    </div>

                    <div class="w-1/2 p-2">
                        <label for="latitude2" class="block mb-2 text-sm font-medium text-white">Latitude 2</label>
                        <input name="latitude2" type="text" id="latitude2" required
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->latitude1 }}" required>
                    </div>

                    <div class="w-1/2 p-2">
                        <label for="longitude2" class="block mb-2 text-sm font-medium text-white">Longitude 2</label>
                        <input name="longitude2" type="text" id="longitude2" required
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            value="{{ $p->longitude2}}" required>
                        </div>

                    <div class="w-1/2 p-2">
                        <label for="latitude3" class="block mb-2 text-sm font-medium text-white">Latitude 3</label>
                        <input name="latitude3" type="text" id="latitude3" required
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="w-1/2 p-2">
                        <label for="longitude3" class="block mb-2 text-sm font-medium text-white">Longitude 3</label>
                        <input name="longitude3" type="text" id="longitude3" required
                            class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="w-full p-2 text-center">
                    <button type="button" onclick="addCoordinatesFieldEdit()"
                        class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-5">Add Coordinates</button>
                    <button type="button" onclick="removeCoordinatesFieldEdit()"
                        class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-5">Remove Coordinates</button>
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
    let coordinateIndexEdit = 4;

    function addCoordinatesFieldEdit() {
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

        newLatitudeDiv.scrollIntoView({ behavior: 'smooth', block: 'end' });

        coordinateIndexEdit++;
    }

    function removeCoordinatesFieldEdit() {
        const container = document.getElementById('coordinates-container-edit');

        if (coordinateIndexEdit > 4) {
            const latitudeDiv = container.lastElementChild.previousElementSibling;
            const longitudeDiv = container.lastElementChild;

            container.removeChild(latitudeDiv);
            container.removeChild(longitudeDiv);

            coordinateIndexEdit--;
        }
    }
</script>
