<!DOCTYPE html>
<html>
<head>
    <title>Gender Ratio Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div>
        <canvas id="genderChart"></canvas>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('genderChart').getContext('2d');
            const genderChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Pria', 'Wanita'],
                    datasets: [{
                        data: @json($genderData),
                        backgroundColor: ['#36A2EB', '#FF6384']
                    }]
                }
            });
        });
    </script>
</body>
</html>
