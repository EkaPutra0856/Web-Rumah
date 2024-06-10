@foreach ($regionAdmin as $p)
    <div id="editModal{{ $p->id }}"
        class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 justify-center items-center ">
        <div class="bg-gray-800 rounded-lg w-1/2">
            <form method="POST" action="{{ url('/' . $p->id . '/update-adminwilayah') }}" class=" w-5/6 mx-auto my-5">
                @csrf
                <h2 class=" text-center font-semibold text-lg text-white">Edit Admin</h2><br>

                <div class=" basis-1/2 mb-5 px-2">
                    <label for="name" class="block mb-2 text-sm font-medium  text-white">Name</label>
                    <input name="name" type="text" id="name" value="{{ $p->name }}"
                        class="border ext-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class=" basis-1/2 mb-5 px-2">
                    <label for="email" class="block mb-2 text-sm font-medium  text-white">Email</label>
                    <input name="email" type="text" id="email" value="{{ $p->email }}"
                        class="border ext-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
                </div>




                <div class="flex flex-wrap ">
                    <div class="w-1/2 mb-5 px-2">
                        <label for="notelp" class="block mb-2 text-sm font-medium  text-white">No Telepon</label>
                        <input name="notelp" type="text" id="notelp" value="{{ $p->notelp }}"
                            class="border ext-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">

                    </div>
                    <div class="w-1/2 mb-5 px-2">
                        <label for="region_id" class="block mb-2 text-sm font-medium  text-white">Region ID</label>
                        <select name="region_id" type="text" id="region_id"
                        class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500" >
                    <option disabled selected>select id region</option>
                    @foreach ($regions as $p)
                    <option value="{{$p->id}}">{{$p->kecamatan}}</option>
                    @endforeach
                    </select>
                    </div>
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
