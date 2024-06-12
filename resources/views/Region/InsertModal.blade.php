<div id="insertModal" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center">
    <div class="bg-gray-800 rounded-lg w-1/2 ">
        <form method="POST" action="insert-wilayah" class="w-5/6 mx-auto my-5 ">
            @csrf
            <h2 class="text-center font-semibold text-lg text-white">Insert Wilayah</h2><br>

            <div class="flex flex-wrap">
                <div class="w-1/2 p-2">
                    <label for="kecamatan" class="block mb-2 text-sm font-medium text-white">Kecamatan</label>
                    <input name="kecamatan" type="text" id="kecamatan" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="w-1/2 p-2">
                    <label for="kelurahan_desa" class="block mb-2 text-sm font-medium text-white">Kelurahan/Desa</label>
                    <input name="kelurahan_desa" type="text" id="kelurahan_desa" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="w-1/2 p-2">
                    <label for="kode_pos" class="block mb-2 text-sm font-medium text-white">Kode Pos</label>
                    <input name="kode_pos" type="text" id="kode_pos" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div id="coordinates-container"
                class="flex flex-wrap h-20 overflow-hidden overscroll-y-auto overflow-y-scroll">
                <div class="w-1/2 p-2">
                    <label for="latitude1" class="block mb-2 text-sm font-medium text-white">Latitude 1</label>
                    <input name="latitude1" type="text" id="latitude1" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="w-1/2 p-2">
                    <label for="longitude1" class="block mb-2 text-sm font-medium text-white">Longitude 1</label>
                    <input name="longitude1" type="text" id="longitude1" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="w-1/2 p-2">
                    <label for="latitude2" class="block mb-2 text-sm font-medium text-white">Latitude 2</label>
                    <input name="latitude2" type="text" id="latitude2" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="w-1/2 p-2">
                    <label for="longitude2" class="block mb-2 text-sm font-medium text-white">Longitude 2</label>
                    <input name="longitude2" type="text" id="longitude2" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
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

            <div id="coordinate-warning" class="w-full p-2 text-center text-red-500 hidden">
                Minimal 3 pairs of coordinates are required.
            </div>

            <div class="w-full p-2 text-center">
                <button type="button" onclick="addCoordinatesField()"
                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-5">Add
                    Coordinates</button>
                <button type="button" onclick="removeCoordinatesField()"
                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-5">Remove
                    Coordinates</button>
            </div>



            <div class="flex flex-row gap-3 mt-5">
                <button type="submit"
                    class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mb-5">Submit</button>
                <button type="button" onclick="closeInsertModal()"
                    class="text-blue-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600 mb-5">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    let coordinateIndex = 4;

    function addCoordinatesField() {
        const container = document.getElementById('coordinates-container');
        const warning = document.getElementById('coordinate-warning');
        const children = container.children;


        if (children.length >= 6) {
            warning.classList.add('hidden');
        }

        const newLatitudeDiv = document.createElement('div');
        newLatitudeDiv.className = 'w-1/2 p-2';
        newLatitudeDiv.innerHTML = `
            <label for="latitude${coordinateIndex}" class="block mb-2 text-sm font-medium text-white">Latitude ${coordinateIndex}</label>
            <input name="latitude${coordinateIndex}" type="text" id="latitude${coordinateIndex}" required
                class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
        `;

        const newLongitudeDiv = document.createElement('div');
        newLongitudeDiv.className = 'w-1/2 p-2';
        newLongitudeDiv.innerHTML = `
            <label for="longitude${coordinateIndex}" class="block mb-2 text-sm font-medium text-white">Longitude ${coordinateIndex}</label>
            <input name="longitude${coordinateIndex}" type="text" id="longitude${coordinateIndex}" required
                class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
        `;

        container.appendChild(newLatitudeDiv);
        container.appendChild(newLongitudeDiv);

        coordinateIndex++;

        newLongitudeDiv.scrollIntoView({
            behavior: 'smooth',
            block: 'end',
            inline: 'nearest'
        });
    }

    function removeCoordinatesField() {
        const container = document.getElementById('coordinates-container');
        const warning = document.getElementById('coordinate-warning');
        const children = container.children;

        if (children.length > 6) {
            container.removeChild(children[children.length - 1]);
            container.removeChild(children[children.length - 1]);
            warning.classList.add('hidden');
            coordinateIndex--;
        } else {
            warning.classList.remove('hidden');
        }
    }
</script>
