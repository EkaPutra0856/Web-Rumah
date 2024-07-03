<!DOCTYPE html>
<html class="">

<head>
    <title>DATABASE PROJECT</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-white dark:bg-gray-900 astro-FLTEP2YP">
    @include('Layout.navbarAdmin')
    <div class="sm:flex sm:justify-center sm:items-center ">
        <div class="w-full">
            <div class="w-full flex flex-col justify-center items-center">
                <h1 class="text-center text-xl font-bold my-3 text-white ">@yield('Title')</h1>
                <div
                    class=" mb-20 flex flex-col w-11/12 rounded-xl items-center place-content-center bg-gray-800/50 bg-gradient-to-bl from-gray-700/50 via-transparent">
                    <div class="w-11/12 overflow-x-scroll overscroll-x-auto">
                        <table class="table-auto w-full border-collapse mt-1 overscroll-x-auto">
                            @yield('table')
                        </table>
                    </div>
                    <div class="w-11/12">
                        <button onclick="openInsertModal()"
                            class="my-3 px-5 py-2.5 rounded-md place-self-start  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2"
                            data-toggle="modal" data-target="#myModal">Insert</button>
                        <form action="/logout" method="POST" class='flex flex-row justify-center items-center'>
                            @csrf
                            <button type="submit"
                                class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:border before:border-transparent before:bg-primary/10 before:bg-gradient-to-b before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 dark:before:border-gray-700 dark:before:bg-gray-800 sm:w-max">
                                <span
                                    class="relative text-base font-semibold text-primary dark:text-white">LOGOUT</span></button>
                        </form>
                    </div>
                </div>
            </div>
            @yield('Insert Modal')
            @yield('Edit Modal')
            @yield('Import Modal KK')

            @yield('Family Member Chart Modal')
            @yield('House Chart Modal')
            @yield('Import Modal Rumah')

            @include('Layout.delete')

        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var myChart = null; // Variabel global untuk menyimpan objek chart
            var upperTenPercentage = 0; // Variabel global untuk menyimpan persentase laki-laki
            var lowerTenPercentage = 0; // Variabel global untuk menyimpan persentase perempuan
    
            function showChart() {
                openChartModal();

                var upperTen = {{ $graphtype1 }};
                var lowerTen = {{ $graphtype2 }};
                var total = upperTen + lowerTen;
    
                upperTenPercentage = ((upperTen / total) * 100).toFixed(2);
                lowerTenPercentage = ((lowerTen / total) * 100).toFixed(2);
    
                if (myChart) {
                    // Hapus chart yang sudah ada jika ada
                    myChart.destroy();
                }
    
                var ctx = document.getElementById('familyChart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Anggota Keluarga > 10', 'Anggota Keluarga ≤ 10'],
                        datasets: [{
                            label: 'Family Members Distribution',
                            data: [upperTen, lowerTen],
                          
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        var label = tooltipItem.label || '';
    
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += tooltipItem.raw.toLocaleString();
    
                                        if (tooltipItem.label === 'Anggota > 10') {
                                            label += ' (' + upperTenPercentage + '%)';
                                        } else if (tooltipItem.label === 'Anggota ≤ 10') {
                                            label += ' (' + lowerTenPercentage + '%)';
                                        }
    
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });                
            }

            function showHouseChart() {
                openHouseChartModal();

                var sehat = {{ $graphtype1 }};
                var tidak_layak = {{ $graphtype2 }};
                var total = sehat + tidak_layak;
    
                sehatPercentage = ((sehat / total) * 100).toFixed(2);
                tidaklayakPercentage = ((tidak_layak / total) * 100).toFixed(2);
    
                if (myChart) {
                    // Hapus chart yang sudah ada jika ada
                    myChart.destroy();
                }
    
                var ctx = document.getElementById('houseChart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Rumah Sehat', 'Rumah Tidak Layak'],
                        datasets: [{
                            label: 'House Status Distribution',
                            data: [sehat, tidak_layak],
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        var label = tooltipItem.label || '';
    
                                        if (label) {
                                            label += ': ';
                                        }
                                        label += tooltipItem.raw.toLocaleString();
    
                                        if (tooltipItem.label === 'Rumah Sehat') {
                                            label += ' (' + sehatPercentage + '%)';
                                        } else if (tooltipItem.label === 'Rumah Tidak Layak') {
                                            label += ' (' + tidaklayakPercentage + '%)';
                                        }
    
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });                
            }
    
            function openChartModal() {
                document.getElementById('familyMemberChartModal').classList.remove('hidden');
            }
            
            function openHouseChartModal() {
                document.getElementById('houseChartModal').classList.remove('hidden');
            }

            function closeChartModal() {
                document.getElementById('familyMemberChartModal').classList.add('hidden');
            }
            
            function closeHouseChartModal() {
                document.getElementById('houseChartModal').classList.add('hidden');
            }

            function downloadChartImage() {
                var chartCanvas = document.getElementById('familyChart');
                var link = document.createElement('a');
                link.href = chartCanvas.toDataURL('image/png');
                link.download = 'family_chart.png';
    
                var ctx = chartCanvas.getContext('2d');
                ctx.font = 'bold 14px Arial';
                ctx.fillStyle = '#000';
                ctx.textAlign = 'center';
    
                var upperTenPercentageText = upperTenPercentage.toString() + '%';
                var lowerTenPercentageText = lowerTenPercentage.toString() + '%';
    
                ctx.fillText('Anggota Keluarga > 10: ' + upperTenPercentageText, chartCanvas.width / 2, 20);
                ctx.fillText('Anggota Keluarga ≤ 10: ' + lowerTenPercentageText, chartCanvas.width / 2, 40);
    
                console.log(link.href); // Debug: Periksa URL yang dihasilkan sebelum diunduh
                link.click();
            }
    
            function downloadHouseChartImage() {
                var chartCanvas = document.getElementById('houseChart');
                var link = document.createElement('a');
                link.href = chartCanvas.toDataURL('image/png');
                link.download = 'house_chart.png';
    
                var ctx = chartCanvas.getContext('2d');
                ctx.font = 'bold 14px Arial';
                ctx.fillStyle = '#000';
                ctx.textAlign = 'center';
    
                var sehatPercentageText = sehatPercentage.toString() + '%';
                var tidaklayakPercentageText = tidaklayakPercentage.toString() + '%';
    
                ctx.fillText('Rumah Sehat: ' + sehatPercentageText, chartCanvas.width / 2, 20);
                ctx.fillText('Rumah Tidak Layak: ' + tidaklayakPercentageText, chartCanvas.width / 2, 40);
    
                console.log(link.href); // Debug: Periksa URL yang dihasilkan sebelum diunduh
                link.click();
            }
    
    
            function openInsertModal() {
                var insertModal = document.getElementById('insertModal');
                insertModal.classList.remove('hidden');
                insertModal.classList.add('flex');
            }
    
            function closeInsertModal() {
                var insertModal = document.getElementById('insertModal');
                insertModal.classList.add('hidden');
                insertModal.classList.remove('flex');
            }
    
            function openEditModal(x) {
                let id = "editModal"
                let result = id.concat(x)
                document.getElementById(result).classList.add('flex');
                document.getElementById(result).classList.remove('hidden');
            }
    
            function closeEditModal(x) {
                let id = "editModal"
                let result = id.concat(x)
                document.getElementById(result).classList.add('hidden');
                document.getElementById(result).classList.remove('flex');
            }
    
            function openDeleteModal(link) {
                document.getElementById('deleteModal').classList.add('flex');
                document.getElementById('deleteModal').classList.remove('hidden');
                var deleteButton = document.getElementById('delete-button');
                deleteButton.action = link;
            }
    
            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.remove('flex');
                document.getElementById('deleteModal').classList.add('hidden');
            }
    
            function openImportModal() {
                var importModal = document.getElementById('importModal');
                if (importModal) {
                    importModal.classList.remove('hidden');
                } else {
                    console.error('Element with ID "importModal" not found.');
                }
            }
    
            function closeImportModal() {
                var importModal = document.getElementById('importModal');
                if (importModal) {
                    importModal.classList.add('hidden');
                } else {
                    console.error('Element with ID "importModal" not found.');
                }
            }
    
            window.addEventListener('click', function(event) {
                var insertModal = document.getElementById('insertModal');
                var deleteModal = document.getElementById('deleteModal');
                var editModalPrefix = "editModal";
    
                if (event.target === insertModal) {
                    closeInsertModal();
                }
    
                if (event.target === deleteModal) {
                    closeDeleteModal();
                }
    
                if (event.target.id.startsWith(editModalPrefix)) {
                    var idNumber = event.target.id.substring(editModalPrefix.length);
                    closeEditModal(idNumber);
                }
            });
        </script>
</body>

</html>
