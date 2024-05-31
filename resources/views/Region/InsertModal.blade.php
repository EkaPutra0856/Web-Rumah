<div id="insertModal" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center">
    <div class="bg-gray-800 rounded-lg w-1/2">
        <form method="POST" action="insert-wilayah" class="w-5/6 mx-auto my-5">
            @csrf
            <h2 class="text-center font-semibold text-lg text-white">Insert Wilayah</h2><br>

            <div class="flex flex-wrap">
                <div class="w-1/2 p-2">
                    <label for="provinsi" class="block mb-2 text-sm font-medium text-white">Provinsi</label>
                    <input name="provinsi" type="text" id="provinsi" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="w-1/2 p-2">
                    <label for="kabupaten_kota" class="block mb-2 text-sm font-medium text-white">Kabupaten/Kota</label>
                    <input name="kabupaten_kota" type="text" id="kabupaten_kota" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>

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
                <div class="w-1/2 p-2">
                    <label for="id" class="block mb-2 text-sm font-medium text-white">ID Wilayah</label>
                    <input name="id" type="text" id="id" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                {{-- <div class="w-1/2 p-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-white">Nama Wilayah</label>
                    <input name="name" type="text" id="name" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div> --}}

                {{-- <div class="w-full p-2">
                    <label for="id" class="block mb-2 text-sm font-medium text-white text-center">ID</label>
                    <input name="id" type="text" id="id" required
                        class="border text-sm rounded-lg block mx-auto w-1/3 p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div> --}}
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
