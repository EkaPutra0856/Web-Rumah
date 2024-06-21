@if (Session::has('success'))
    <div id="modalAlertSuccess" class="fixed inset-0 flex items-center justify-center z-50 opacity-0 transition-opacity duration-1000" role="alert">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-96">
            <div class="bg-green-500 text-white font-bold px-4 py-2">
                Success
            </div>
            <div class="border-t border-green-400 bg-green-100 px-4 py-3 text-green-700">
                <p>{{ Session::get('success') }}</p>
            </div>
            <div class="bg-gray-200 px-4 py-2 text-right">
                <button onclick="hideModal('modalAlertSuccess')" class="bg-green-500 text-white rounded px-4 py-2">Close</button>
            </div>
        </div>
    </div>
@elseif(Session::has('fail') || Session::has('error'))
    <div id="modalAlertError" class="fixed inset-0 flex items-center justify-center z-50 opacity-0 transition-opacity duration-1000" role="alert">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden w-96">
            <div class="bg-red-500 text-white font-bold px-4 py-2">
                Failed
            </div>
            <div class="border-t border-red-400 bg-red-100 px-4 py-3 text-red-700">
                <p>{{ Session::get('fail') }}</p>
            </div>
            <div class="bg-gray-200 px-4 py-2 text-right">
                <button onclick="hideModal('modalAlertError')" class="bg-red-500 text-white rounded px-4 py-2">Close</button>
            </div>
        </div>
    </div>
@endif

<script>
    function hideModal(modalId) {
        var modalAlert = document.getElementById(modalId);
        modalAlert.style.opacity = '0';
        setTimeout(function() {
            modalAlert.style.display = 'none';
        }, 1000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var modalAlertSuccess = document.getElementById('modalAlertSuccess');
        var modalAlertError = document.getElementById('modalAlertError');
        
        if (modalAlertSuccess) {
            modalAlertSuccess.style.opacity = '1';
            setTimeout(function() {
                hideModal('modalAlertSuccess');
            }, 3000); // Display the success alert for 3 seconds before hiding it
        }

        if (modalAlertError) {
            modalAlertError.style.opacity = '1';
            setTimeout(function() {
                hideModal('modalAlertError');
            }, 3000); // Display the error alert for 3 seconds before hiding it
        }
    });
</script>
