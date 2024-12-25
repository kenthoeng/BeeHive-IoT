<?php
// Database Connection
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
$stmt = $pdo->query('SELECT temperature, humidity, weight, light, sound, acceleration FROM mqtt_sensor_logs');
$data = $stmt->fetchAll();

// Hitung rata-rata untuk setiap sensor
$averageData = [];
if (count($data) > 0) {
    $averageData = [
        'Temperature' => array_sum(array_column($data, 'temperature')) / count($data),
        'Humidity' => array_sum(array_column($data, 'humidity')) / count($data),
        'Weight' => array_sum(array_column($data, 'weight')) / count($data),
        'Light' => array_sum(array_column($data, 'light')) / count($data),
        'Sound' => array_sum(array_column($data, 'sound')) / count($data),
        'Acceleration' => array_sum(array_column($data, 'acceleration')) / count($data),
    ];
}

// Hitung validitas data
$totalData = count($data);
$validData = $totalData; // Asumsikan semua data valid
$invalidData = 0; // Inisialisasi data tidak valid
foreach ($data as $row) {
    foreach ($row as $value) {
        if (is_null($value) || $value < 0) {
            $validData--;
            $invalidData++;
            break;
        }
    }
}

// Weatherstack API Integration
$apiKey = '2c582a9eb9372c7193177b7aaf0becee'; // Ganti dengan API key Anda
$location = 'Surabaya'; // Lokasi yang diinginkan
$apiUrl = "http://api.weatherstack.com/current?access_key=$apiKey&query=$location";

// Ambil data dari Weatherstack API
$response = @file_get_contents($apiUrl); // Menghindari error saat API gagal
$weatherData = $response ? json_decode($response, true) : null;

// Cek apakah data berhasil diambil
if ($weatherData && isset($weatherData['current'])) {
    $temperature = $weatherData['current']['temperature'];
    $humidity = $weatherData['current']['humidity'];
    $windSpeed = $weatherData['current']['wind_speed'];
    $weatherDescription = $weatherData['current']['weather_descriptions'][0];
    $weatherIcon = $weatherData['current']['weather_icons'][0];
} else {
    $temperature = null;
    $weatherError = 'Unable to fetch weather data.';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Processing and Integration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        body { background-color: #f8f9fa; }
        .dashboard { margin-top: 20px; }
        .card { box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: none; margin-bottom: 20px; }
        .card-title { font-size: 1.2rem; font-weight: bold; }
        .chart-container { position: relative; height: 300px; }
        .weather-icon { width: 100px; height: 100px; }
        #map { height: 400px; width: 100%; }
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
                    <li class="nav-item"><a class="nav-link" href="predictive_analytics.php">Predictive Analytics</a></li>
                    <li class="nav-item"><a class="nav-link active" href="data_processing_integration.php">Data Processing</a></li>
                    <li class="nav-item"><a class="nav-link" href="database_logs.php">Database Logs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="container dashboard">
        <h1 class="text-center mb-4">Data Processing and Integration</h1>

        <!-- Row for Weather and Map -->
        <div class="row">
            <!-- Weather Card -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Current Weather in <?= htmlspecialchars($location) ?></h5>
                        <?php if ($temperature !== null): ?>
                            <h3><?= htmlspecialchars($weatherDescription) ?></h3>
                            <img src="<?= htmlspecialchars($weatherIcon) ?>" alt="Weather Icon" class="weather-icon mb-3">
                            <p>Temperature: <?= htmlspecialchars($temperature) ?>°C</p>
                            <p>Humidity: <?= htmlspecialchars($humidity) ?>%</p>
                            <p>Wind Speed: <?= htmlspecialchars($windSpeed) ?> km/h</p>
                        <?php else: ?>
                            <p class="text-danger"><?= htmlspecialchars($weatherError) ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Map Card -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Device Location</h5>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Row for Charts -->
        <div class="row mt-4">
            <div class="col-lg-6">
                <!-- Bar Chart -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Average Sensor Data</h5>
                        <div class="chart-container">
                            <canvas id="averageChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <!-- Pie Chart -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Validity</h5>
                        <div class="chart-container">
                            <canvas id="validityChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Bar Chart for Average Data
        const avgLabels = <?= json_encode(array_keys($averageData)) ?>;
        const avgValues = <?= json_encode(array_values($averageData)) ?>;
        const avgCtx = document.getElementById('averageChart').getContext('2d');
        new Chart(avgCtx, {
            type: 'bar',
            data: {
                labels: avgLabels,
                datasets: [{
                    label: 'Average Value',
                    data: avgValues,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true },
                }
            }
        });

        // Pie Chart for Data Validity
        const validityCtx = document.getElementById('validityChart').getContext('2d');
        new Chart(validityCtx, {
            type: 'pie',
            data: {
                labels: ['Valid Data', 'Invalid Data'],
                datasets: [{
                    label: 'Data Validity',
                    data: [<?= $validData ?>, <?= $invalidData ?>],
                    backgroundColor: ['rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)']
                }]
            }
        });

        // Initialize Leaflet Map
        const map = L.map('map').setView([0, 0], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const { latitude, longitude } = position.coords;
                    map.setView([latitude, longitude], 15);
                    L.marker([latitude, longitude]).addTo(map)
                        .bindPopup('You are here!')
                        .openPopup();
                },
                (error) => {
                    console.error('Geolocation error:', error.message);
                    alert('Unable to retrieve your location.');
                }
            );
        } else {
            alert('Geolocation is not supported by your browser.');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
