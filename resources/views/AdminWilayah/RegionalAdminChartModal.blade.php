<div id="RegionalAdminChartModal"
class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 flex justify-center items-center z-50">
<div class="bg-white p-6 rounded-lg w-1/2">
    <h2 class="text-center text-lg font-semibold mb-4">Regional Admin Distribution Chart</h2>
    <div class="flex justify-center mb-4">
        <canvas id="regAdminChart" width="400" height="400"></canvas>
    </div>
    <div class="flex justify-center gap-4">
        <button onclick="downloadChartImage()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Download Chart</button>
        <button onclick="closeChartModal()"
            class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Close</button>
    </div>
</div>
</div>