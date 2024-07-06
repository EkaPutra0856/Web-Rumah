<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-sans antialiased dark:bg-gray-900 dark:text-white/50">
<header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
    <nav class="z-10 w-full absolute">
        <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
            <div class="flex flex-wrap items-center justify-between py-2 gap-6 md:py-4 md:gap-0 relative">
                <div class="relative z-20 w-full flex justify-between lg:w-max md:px-0">
                    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="System Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Home Monitoring</span>
                    </a>
                </div>
                    <div class="flex ml-auto items-center justify-between w-full md:w-auto">
                        <ul class="flex flex-col font-medium p-2 mt-4 border border-gray-100 rounded-lg md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
                            <li>
                                <a href="/register"
                                class="block py-1 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Sign up</a>
                            </li>
                            <li>
                                <a href="/login"
                                class="block py-1 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Log in Admin</a>
                            </li>
                            <li>
                                <a href="/login-regadmin"
                                class="block py-1 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Log in Ad-Wil</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="space-y-40 mb-40">
	<div class="relative">
        <div aria-hidden="true" class="absolute inset-0 grid grid-cols-2 -space-x-52 opacity-40 dark:opacity-20">
            <div class="blur-[106px] h-56 bg-gradient-to-br from-primary to-purple-400 dark:from-blue-700"></div>
            <div class="blur-[106px] h-32 bg-gradient-to-r from-cyan-400 to-sky-300 dark:to-indigo-600"></div>
        </div>
        <div class="max-w-7xl mx-auto px-6 md:px-12 xl:px-6">
            <div class="relative pt-36 ml-auto">
                <div class="lg:w-2/3 text-center mx-auto">
                    <h1 class="text-gray-900 dark:text-white font-bold text-5xl md:text-6xl xl:text-7xl">Easily Monitor <span class="text-primary dark:text-white">Underprivileged Housing.</span></h1>
                    <p class="mt-8 text-gray-700 dark:text-gray-300">With the HousingMonitor app, you can ensure the safety and well-being of those in need.</p>
                </div>
            </div>
        </div>
        <div class="max-w-7xl my-5 mx-auto px-6 md:px-12 xl:px-6 flex justify-center">
            <button type="button" onclick="openHouseWelcomeChartModal()" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 mr-4 rounded">
                See House Chart
            </button>
        </div>
    </div>
</main>

<div id="houseWelcomeChartModal" class="hidden fixed inset-0 bg-gray-400 bg-opacity-60 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="text-center text-lg font-semibold mb-4">House Distribution Chart</h2>
        <div class="flex justify-center mb-4">
            <canvas id="houseWelcomeChart" width="400" height="400"></canvas>
        </div>
        <div class="flex justify-center gap-4">
            <button onclick="downloadHouseWelcomeChartImage()"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Download Chart</button>
            <button onclick="closeHouseWelcomeChartModal()"
                class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Close</button>
        </div>
    </div>
</div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var myChart = null; // Variabel global untuk menyimpan objek chart
    var sehatPercentage = 0; // Variabel global untuk menyimpan persentase laki-laki
    var tidaklayakPercentage = 0; 

    function showHouseWelcomeChart() {
                openHouseWelcomeChartModal();

                var sehat = {{ $graphtype1 }};
                var tidak_layak = {{ $graphtype2 }};
                var total = sehat + tidak_layak;
    
                sehatPercentage = ((sehat / total) * 100).toFixed(2);
                tidaklayakPercentage = ((tidak_layak / total) * 100).toFixed(2);
    
                if (myChart) {
                    // Hapus chart yang sudah ada jika ada
                    myChart.destroy();
                }
    
                var ctx = document.getElementById('houseWelcomeChart').getContext('2d');
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
    
            function openHouseWelcomeChartModal() {
                document.getElementById('houseWelcomeChartModal').classList.remove('hidden');
            }

            function closeHouseWelcomeChartModal() {
                document.getElementById('houseWelcomeChartModal').classList.add('hidden');
            }

            function downloadHouseWelcomeChartImage() {
                var chartCanvas = document.getElementById('houseWelcomeChart');
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
</script>
</html>

