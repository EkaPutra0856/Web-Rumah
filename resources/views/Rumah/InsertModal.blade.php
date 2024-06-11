<div id="insertModal" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center">
    <div class="bg-gray-800 rounded-lg w-1/2">
        <form method="POST" action="insert-rumah" class="w-5/6 mx-auto my-5">
            @csrf
            <h2 class="text-center font-semibold text-lg text-white">Insert Rumah</h2><br>
            <div class="flex flex-wrap">

                
                <div class="w-full md:w-1/2 p-2">
                    <label for="norumah" class="block mb-2 text-sm font-medium text-white">No Rumah</label>
                    <input name="norumah" type="number" id="norumah" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-white">Alamat</label>
                    <input name="alamat" type="text" id="alamat" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label for="luas" class="block mb-2 text-sm font-medium text-white">Luas Rumah (m<sup>2</sup>)</label>
                    <input name="luas" type="number" id="luas" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label for="status" class="block mb-2 text-sm font-medium text-white">Status Rumah</label>
                    <select name="status" type="text" id="status" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                        <option disabled selected ></option>
                        <option value="Sehat" >Sehat</option>
                    <option value="tidak layak">tidak layak</option>
                    </select>
                
                </div>




                <div class="w-full md:w-1/2 p-2">
                    <label for="tahun" class="block mb-2 text-sm font-medium text-white">Tahun Dibangun</label>
                    <input name="tahun" type="number" id="tahun" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label for="renov" class="block mb-2 text-sm font-medium text-white">Tahun Terakhir Renovasi</label>
                    <input name="renov" type="number" id="renov" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <div id="coordinates-container" class="flex flex-wrap h-20 overflow-hidden overscroll-y-auto overflow-y-scroll">
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
            </div>

            <div class="w-full p-2 text-center">
                <button type="button" onclick="addCoordinatesField()"
                    class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mb-5">Add Coordinates</button>
            </div>


            <div class="flex justify-between p-2">
                <button type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Submit</button>
                <button type="button" onclick="closeInsertModal()" class="text-blue-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    let coordinateIndex = 2;

    function addCoordinatesField() {
        const container = document.getElementById('coordinates-container');

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
    }
</script>
