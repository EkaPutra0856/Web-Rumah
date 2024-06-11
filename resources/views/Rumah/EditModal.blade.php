@foreach ($rumah as $p)
<div id="editModal{{ $p->id }}" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 flex justify-center items-center">
    <div class="bg-gray-800 rounded-lg w-1/2">
        <form method="POST" action="{{ url('/' . $p->id . '/update-rumah') }}" class="w-5/6 mx-auto my-5">
            @csrf
            <h2 class="text-center font-semibold text-lg text-white">Edit KK</h2><br>
            <div class="flex flex-wrap">
                
                <div class="w-full md:w-1/2 p-2">
                    <label for="id" class="block mb-2 text-sm font-medium text-white">ID Rumah</label>
                    <input name="id" type="text" id="id" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $p->id }}" >
                </div>

                <div class="w-full md:w-1/2 p-2">
                    <label for="norumah" class="block mb-2 text-sm font-medium text-white">No Rumah</label>
                    <input name="norumah" type="text" id="norumah" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $p->norumah }}" >
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label for="alamat" class="block mb-2 text-sm font-medium text-white">Alamat</label>
                    <input name="alamat" type="text" id="alamat" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $p->alamat }}" >
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label for="luas" class="block mb-2 text-sm font-medium text-white">Luas Rumah (m<sup>2</sup>)</label>
                    <input name="luas" type="text" id="luas" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $p->luas }}" >
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
                    <input name="tahun" type="text" id="tahun" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $p->tahun }}" >
                </div>
                <div class="w-full md:w-1/2 p-2">
                    <label for="renov" class="block mb-2 text-sm font-medium text-white">Tahun Terakhir Renovasi</label>
                    <input name="renov" type="text" id="renov" class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $p->renov }}" >
                </div>
            </div>

            <div id="coordinates-container" class="flex flex-wrap h-20 overflow-hidden overscroll-y-auto overflow-y-scroll">
                <div class="w-1/2 p-2">
                    <label for="latitude1" class="block mb-2 text-sm font-medium text-white">Latitude 1</label>
                    <input name="latitude1" type="text" id="latitude1" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $p->latitude1 }}">
                </div>
                
                <div class="w-1/2 p-2">
                    <label for="longitude1" class="block mb-2 text-sm font-medium text-white">Longitude 1</label>
                    <input name="longitude1" type="text" id="longitude1" required
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" value="{{ $p->longitude1 }}">
                </div>
            </div>

           
            <div class="flex justify-between gap-3 mt-5">
                <button type="submit" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mb-5">Submit</button>
                <button type="button" onclick="closeEditModal('{{ $p->id }}')" class="text-blue-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600 mb-5">Cancel</button>
            </div>
        </form>
    </div>
</div>
@endforeach
