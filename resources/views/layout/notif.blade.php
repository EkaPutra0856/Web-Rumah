@if (Session::has('success'))
    <div id="modalAlert" class="fixed inset-0 flex items-center justify-center z-50 opacity-0 transition-opacity duration-1000" role="alert">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-96">
            <div class="bg-green-500 text-white font-bold px-4 py-2">
                Success
            </div>
            <div class="border-t border-green-400 bg-green-100 px-4 py-3 text-green-700">
                <p>{{ Session::get('success') }}</p>
            </div>
            <div class="bg-gray-200 px-4 py-2 text-right">
                <button onclick="hideModal()" class="bg-green-500 text-white rounded px-4 py-2">Close</button>
            </div>
        </div>
    </div>
@elseif(Session::has('fail'))
    <div id="modalAlert" class="fixed inset-0 flex items-center justify-center z-50 opacity-0 transition-opacity duration-1000" role="alert">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-96">
            <div class="bg-red-500 text-white font-bold px-4 py-2">
                Failed
            </div>
            <div class="border-t border-red-400 bg-red-100 px-4 py-3 text-red-700">
                <p>{{ Session::get('fail') }}</p>
            </div>
            <div class="bg-gray-200 px-4 py-2 text-right">
                <button onclick="hideModal()" class="bg-red-500 text-white rounded px-4 py-2">Close</button>
            </div>
        </div>
    </div>
@endif

<script>
    function hideModal() {
        var modalAlert = document.getElementById('modalAlert');
        modalAlert.style.opacity = '0';
        setTimeout(function() {
            modalAlert.style.display = 'none';
        }, 1000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var modalAlert = document.getElementById('modalAlert');
        if (modalAlert) {
            modalAlert.style.opacity = '1';
            setTimeout(hideModal, 3000);  // Display the alert for 3 seconds before hiding it
        }
    });
</script>
