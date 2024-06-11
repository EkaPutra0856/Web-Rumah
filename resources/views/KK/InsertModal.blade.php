<div id="insertModal" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center ">
    <div class="bg-gray-800 rounded-lg w-1/2">
        <form method="POST" action="insert-kk" class="w-5/6 mx-auto my-5">
            @csrf
            <h2 class="text-center font-semibold text-lg text-white">Insert KK</h2><br>

            <div class="basis-1/2 mb-5">
                <label for="nokk" class="block mb-2 text-sm font-medium text-white">NO KK</label>
                <input name="nokk" type="number" id="nokk"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="basis-1/2 mb-5">
                <label for="namakk" class="block mb-2 text-sm font-medium text-white">Nama Kepala Keluarga</label>
                <input name="namakk" type="text" id="namakk"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="basis-1/2 mb-5">
                <label for="anggota" class="block mb-2 text-sm font-medium text-white">Jumlah Anggota Keluarga</label>
                <input name="anggota" type="number" id="anggota"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="basis-1/2 mb-5">
                <label for="rumah_id" class="block mb-2 text-sm font-medium text-white">ID Rumah</label>
             
            <select name="rumah_id" type="text" id="rumah_id"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" >
                    <option disabled selected>select id rumah</option>
                    @foreach ($rumah as $p)
                    <option value="{{$p->id}}">{{$p->id}}</option>
                    @endforeach
                    </select>
                </div>
            <!-- Hidden input for admin_wilayahs_id -->
            <input type="hidden" name="admin_wilayahs_id" value="{{ Auth::guard('regadmin')->user()->admin_wilayahs_id }}">

            <div class="flex flex-row gap-3">
                <button type="submit"
                    class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mb-5">Submit</button>
                <button type="button" onclick="closeInsertModal()"
                    class="text-blue-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600 mb-5">Cancel</button>
            </div>
        </form>
    </div>
</div>
