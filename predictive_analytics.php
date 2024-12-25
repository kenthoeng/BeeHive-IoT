<?php
$dsn = 'mysql:host=localhost;dbname=mqtt_logs;charset=utf8';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Ambil data sensor dari database
$stmt = $pdo->query('SELECT created_at, temperature, humidity, weight, light, sound, acceleration FROM mqtt_sensor_logs ORDER BY created_at DESC LIMIT 100');
$sensorData = $stmt->fetchAll();

// Fungsi untuk menghitung Moving Average
function movingAverage($data, $windowSize) {
    $result = [];
    $dataCount = count($data);

    for ($i = 0; $i < $dataCount - $windowSize + 1; $i++) {
        $window = array_slice($data, $i, $windowSize);
        $result[] = array_sum($window) / $windowSize;
    }

    return $result;
}

// Ambil data historis untuk setiap sensor
$temperatureData = array_column($sensorData, 'temperature');
$humidityData = array_column($sensorData, 'humidity');
$weightData = array_column($sensorData, 'weight');
$lightData = array_column($sensorData, 'light');
$soundData = array_column($sensorData, 'sound');
$accelerationData = array_column($sensorData, 'acceleration');

// Tentukan ukuran window untuk Moving Average (misalnya 5 data terakhir)
$windowSize = 5;

// Hitung prediksi menggunakan Moving Average
$predictedTemperature = movingAverage($temperatureData, $windowSize);
$predictedHumidity = movingAverage($humidityData, $windowSize);
$predictedWeight = movingAverage($weightData, $windowSize);
$predictedLight = movingAverage($lightData, $windowSize);
$predictedSound = movingAverage($soundData, $windowSize);
$predictedAcceleration = movingAverage($accelerationData, $windowSize);

// Gabungkan data historis dan prediksi untuk chart
$combinedData = array_map(null, $sensorData, $predictedTemperature, $predictedHumidity, $predictedWeight, $predictedLight, $predictedSound, $predictedAcceleration);

// Format timestamp untuk chart labels
$labels = array_column($sensorData, 'created_at');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Predictive Analytics Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard {
            margin-top: 20px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .chart-container {
            position: relative;
            height: 300px;
            cursor: pointer;
        }
        .chart-container canvas {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">IoT Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="time_series.php">Time Series</a></li>
                    <li class="nav-item"><a class="nav-link" href="patterns_and_trends.php">Patterns & Trends</a></li>
                    <li class="nav-item"><a class="nav-link active" href="predictive_analytics.php">Predictive Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="data_processing_integration.php">Data Processing</a></li>
                    <li class="nav-item"><a class="nav-link" href="database_logs.php">Database Logs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="container dashboard">
        <h1 class="text-center mb-4">Predictive Analytics - Sensor Data</h1>

        <!-- Grafik Sensor -->
        <div class="row">
            <?php
            $charts = [
                'Temperature (°C)' => 'temperature',
                'Humidity (%)' => 'humidity',
                'Weight (kg)' => 'weight',
                'Light Intensity (lux)' => 'light',
                'Sound Level (dB)' => 'sound',
                'Acceleration (g)' => 'acceleration',
            ];

            foreach ($charts as $title => $field) {
                echo "
                <div class='col-md-6'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <div class='chart-container' data-chart='$field'>
                                <canvas id='{$field}Chart'></canvas>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chartModalLabel">Enlarged Chart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="modalChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        const labels = <?= json_encode(array_reverse($labels)) ?>;
        const combinedDataForCharts = {
            temperature: <?= json_encode(array_reverse($temperatureData)) ?>,
            humidity: <?= json_encode(array_reverse($humidityData)) ?>,
            weight: <?= json_encode(array_reverse($weightData)) ?>,
            light: <?= json_encode(array_reverse($lightData)) ?>,
            sound: <?= json_encode(array_reverse($soundData)) ?>,
            acceleration: <?= json_encode(array_reverse($accelerationData)) ?>,
            predictedTemperature: <?= json_encode(array_reverse($predictedTemperature)) ?>,
            predictedHumidity: <?= json_encode(array_reverse($predictedHumidity)) ?>,
            predictedWeight: <?= json_encode(array_reverse($predictedWeight)) ?>,
            predictedLight: <?= json_encode(array_reverse($predictedLight)) ?>,
            predictedSound: <?= json_encode(array_reverse($predictedSound)) ?>,
            predictedAcceleration: <?= json_encode(array_reverse($predictedAcceleration)) ?>,
        };

        const sensorFields = ['temperature', 'humidity', 'weight', 'light', 'sound', 'acceleration'];
        const chartInstances = {};

        sensorFields.forEach(field => {
            chartInstances[field] = new Chart(document.getElementById(field + 'Chart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Historical ' + field.charAt(0).toUpperCase() + field.slice(1),
                            data: combinedDataForCharts[field],
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: true
                        },
                        {
                            label: 'Predicted ' + field.charAt(0).toUpperCase() + field.slice(1),
                            data: combinedDataForCharts['predicted' + field.charAt(0).toUpperCase() + field.slice(1)],
                            borderColor: 'rgba(153, 102, 255, 1)',
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' }
                    },
                    scales: {
                        x: { title: { display: true, text: 'Time' }},
                        y: { title: { display: true, text: field.charAt(0).toUpperCase() + field.slice(1) }}
                    }
                }
            });
        });

        // Modal Chart
        const modalChart = new Chart(document.getElementById('modalChart'), {
            type: 'line',
            data: {},
            options: {}
        });

        // Fungsi untuk memperbesar grafik
        document.querySelectorAll('.chart-container').forEach(container => {
            container.addEventListener('click', () => {
                const chartId = container.getAttribute('data-chart');
                const chartInstance = chartInstances[chartId];

                modalChart.data = JSON.parse(JSON.stringify(chartInstance.data));
                modalChart.options = JSON.parse(JSON.stringify(chartInstance.options));
                modalChart.update();

                document.getElementById('chartModalLabel').textContent = chartInstance.data.datasets[0].label;
                const modal = new bootstrap.Modal(document.getElementById('chartModal'));
                modal.show();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
