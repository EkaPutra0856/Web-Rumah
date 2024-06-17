<!DOCTYPE html>
<html class="">

<head>
    <title>DATABASE PROJECT</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white dark:bg-gray-900 astro-FLTEP2YP">
    @include('Layout.navbar')
    <div class="sm:flex sm:justify-center sm:items-center ">
        <div class="w-full">
            <div class="w-full flex flex-col justify-center items-center">
                <h1 class="text-center text-xl font-bold my-3 text-white ">@yield('Title')</h1>
                <div
                    class="mb-20 flex flex-col w-11/12 rounded-xl items-center place-content-center bg-gray-800/50 bg-gradient-to-bl from-gray-700/50 via-transparent">
                    <div class="w-11/12 overflow-x-scroll overscroll-x-auto">
                        <table class="table-auto w-full border-collapse mt-1 overscroll-x-auto">
                            @yield('table')
                        </table>
                    </div>
                    <div class="w-11/12">
                        <button onclick="openInsertModal()"
                            class="my-3 px-5 py-2.5 rounded-md place-self-start  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2">
                            Insert
                        </button>
                        <form action="/logout" method="POST" class='flex flex-row justify-center items-center'>
                            @csrf
                            <button type="submit"
                                class="relative flex h-11 w-full items-center justify-center px-6 before:absolute before:inset-0 before:rounded-full before:border before:border-transparent before:bg-primary/10 before:bg-gradient-to-b before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 dark:before:border-gray-700 dark:before:bg-gray-800 sm:w-max">
                                <span
                                    class="relative text-base font-semibold text-primary dark:text-white">LOGOUT</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @yield('Insert Modal')
            @yield('Edit Modal')
            @yield('Import Modal')
            @yield('Gender Chart Modal')
            @include('Layout.delete')
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var myChart = null; // Variabel global untuk menyimpan objek chart
        var malePercentage = 0; // Variabel global untuk menyimpan persentase laki-laki
        var femalePercentage = 0; // Variabel global untuk menyimpan persentase perempuan

        function showGenderChart() {
            var maleCount = {{ $maleCount }};
            var femaleCount = {{ $femaleCount }};
            var total = maleCount + femaleCount;

            malePercentage = ((maleCount / total) * 100).toFixed(2);
            femalePercentage = ((femaleCount / total) * 100).toFixed(2);

            if (myChart) {
                // Hapus chart yang sudah ada jika ada
                myChart.destroy();
            }

            var ctx = document.getElementById('genderChart').getContext('2d');
            myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Male', 'Female'],
                    datasets: [{
                        label: 'Gender Distribution',
                        data: [maleCount, femaleCount],
                      
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

                                    if (tooltipItem.label === 'Male') {
                                        label += ' (' + malePercentage + '%)';
                                    } else if (tooltipItem.label === 'Female') {
                                        label += ' (' + femalePercentage + '%)';
                                    }

                                    return label;
                                }
                            }
                        }
                    }
                }
            });

            openGenderChartModal();
        }

        function openGenderChartModal() {
            document.getElementById('genderChartModal').classList.remove('hidden');
        }

        function closeGenderChartModal() {
            document.getElementById('genderChartModal').classList.add('hidden');
        }

        function downloadChartImage() {
            var chartCanvas = document.getElementById('genderChart');
            var link = document.createElement('a');
            link.href = chartCanvas.toDataURL('image/png');
            link.download = 'gender_chart.png';

            var ctx = chartCanvas.getContext('2d');
            ctx.font = 'bold 14px Arial';
            ctx.fillStyle = '#000';
            ctx.textAlign = 'center';

            var malePercentageText = malePercentage.toString() + '%';
            var femalePercentageText = femalePercentage.toString() + '%';

            ctx.fillText('Male: ' + malePercentageText, chartCanvas.width / 2, 20);
            ctx.fillText('Female: ' + femalePercentageText, chartCanvas.width / 2, 40);

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
