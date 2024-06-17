<div id="insertModal" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center">
    <div class="bg-gray-800 rounded-lg w-1/2">
        <form method="POST" action="insert-administrator" class="w-5/6 mx-auto my-5">
            @csrf
            <h2 class="text-center font-semibold text-lg text-white">Insert Administrator</h2><br>

            <div class="basis-1/2 mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-white">Name</label>
                <input name="name" type="text" id="name"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="basis-1/2 mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-white">Email</label>
                <input name="email" type="text" id="email"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="basis-1/2 mb-5">
                <label for="gender" class="block mb-2 text-sm font-medium text-white">Gender</label>
                <select name="gender" id="gender" required class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="" disabled selected>Pilih Gender</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
            
            <div class="basis-1/2 mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
                <input name="password" type="password" id="password"
                    class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div class="flex flex-wrap">
                <div class="w-1/2 mb-5 px-2">
                    <label for="notelp" class="block mb-2 text-sm font-medium text-white">No Telepon</label>
                    <input name="notelp" type="text" id="notelp"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                
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
