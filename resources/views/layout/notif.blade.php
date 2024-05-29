@if (Session::has('success'))

    <div id="alertContainer" class="w-72 fixed right-0 top-[66px] z-50 opacity-0 transition-opacity duration-1000"
        role="alert">
        <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
            Success
        </div>
        <div class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
            <p>{{ Session::get('success') }}</p>
        </div>
    </div>
@elseif(Session::has('fail'))
    <div id="alertContainer" class="w-72 fixed right-0 top-[66px] z-50 opacity-0 transition-opacity duration-1000"
        role="alert">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Failed
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <p>{{ Session::get('fail') }}</p>
        </div>
    </div>
@endif

<script>
    // Fungsi untuk menghilangkan elemen setelah 1 detik
    function hideAlert() {
        var alertContainer = document.getElementById('alertContainer');
        alertContainer.style.opacity = '0';
        setTimeout(function() {
            alertContainer.style.display = 'none';
        }, 1000);
    }

    // Panggil fungsi hideAlert setelah dokumen selesai dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan class 'opacity-100' untuk membuat elemen muncul secara perlahan
        document.getElementById('alertContainer').classList.add('opacity-100');

        // Panggil fungsi hideAlert setelah 1 detik
        setTimeout(hideAlert, 500);
    });
</script>
