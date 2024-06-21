<!-- ImportModal.blade.php -->

<div id="importModal" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 flex  justify-center items-center">
    <div class="bg-gray-800 rounded-lg w-1/2">
        <form method="POST" action="/import-adminwilayah" enctype="multipart/form-data"
              class="w-5/6 mx-auto my-5">
            @csrf
            <h2 class="text-center font-semibold text-lg text-white">Import Data</h2><br>

            <div class="mb-5 px-2">
                <label for="import_file" class="block mb-2 text-sm font-medium text-white">Choose File</label>
                <input name="import_file" type="file" id="import_file"
                       class="border text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="flex flex-row gap-3 mt-5">
                <button type="submit"
                        class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 focus:ring-blue-800 mb-5">Import
                </button>
                <button type="button" onclick="closeImportModal()"
                        class="text-blue-600 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center bg-gray-100 hover:bg-gray-300 focus:ring-gray-600 mb-5">Cancel
                </button>
            </div>
        </form>
    </div>
</div>
