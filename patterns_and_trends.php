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

// Ambil data terbaru dari database
$stmt = $pdo->query('SELECT * FROM mqtt_sensor_logs ORDER BY created_at DESC LIMIT 20');
$logs = $stmt->fetchAll();

// Ambil rentang waktu data
$startDate = !empty($logs) ? end($logs)['created_at'] : null;
$endDate = !empty($logs) ? $logs[0]['created_at'] : null;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Patterns and Trends</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard {
            margin-top: 20px;
        }
        .chart-container {
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
        }
        .chart-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .stats-card {
            margin: 20px auto;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .details-container {
            margin: 20px auto;
            padding: 15px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            text-align: center;
        }
        .details-container h4 {
            font-weight: bold;
            margin-bottom: 10px;
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
                    <li class="nav-item"><a class="nav-link active" href="patterns_and_trends.php">Patterns & Trends</a></li>
                    <li class="nav-item"><a class="nav-link" href="predictive_analytics.php">Predictive Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="data_processing_integration.php">Data Processing</a></li>
                    <li class="nav-item"><a class="nav-link" href="database_logs.php">Database Logs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="container dashboard">
        <h1 class="text-center">Patterns and Trends Data</h1>

        <?php if (!empty($logs)): ?>
        <!-- Rentang Waktu -->
        <div class="details-container">
            <h4>Data Collected From:</h4>
            <p>
                <strong><?= $startDate ?></strong> to <strong><?= $endDate ?></strong>
            </p>
        </div>

        <!-- Grafik -->
        <div class="chart-container">
            <h2 class="chart-title">Parameter Trends</h2>
            <canvas id="trendChart"></canvas>
        </div>

        <!-- Statistik -->
        <div class="row">
            <?php
            function calculateStats($data, $column) {
                $values = array_column($data, $column);
                return [
                    'average' => !empty($values) ? array_sum($values) / count($values) : 0,
                    'min' => !empty($values) ? min($values) : 0,
                    'max' => !empty($values) ? max($values) : 0
                ];
            }

            $stats = [
                'Temperature (°C)' => calculateStats($logs, 'temperature'),
                'Humidity (%)' => calculateStats($logs, 'humidity'),
                'Weight (kg)' => calculateStats($logs, 'weight'),
                'Light (lux)' => calculateStats($logs, 'light'),
                'Sound (dB)' => calculateStats($logs, 'sound'),
                'Acceleration (g)' => calculateStats($logs, 'acceleration'),
            ];

            foreach ($stats as $title => $stat) {
                echo "
                <div class='col-md-4'>
                    <div class='stats-card'>
                        <h5>$title</h5>
                        <p>Average: " . number_format($stat['average'], 2) . "</p>
                        <p>Minimum: " . number_format($stat['min'], 2) . "</p>
                        <p>Maximum: " . number_format($stat['max'], 2) . "</p>
                    </div>
                </div>";
            }
            ?>
        </div>
        <?php else: ?>
        <div class="details-container">
            <h4>No Data Available</h4>
            <p>Please ensure the database is populated with data.</p>
        </div>
        <?php endif; ?>
    </div>

    <script>
        <?php if (!empty($logs)): ?>
        // Data preparation
        const labels = <?= json_encode(array_column($logs, 'created_at')) ?>;
        const temperatureData = <?= json_encode(array_column($logs, 'temperature')) ?>;
        const humidityData = <?= json_encode(array_column($logs, 'humidity')) ?>;
        const weightData = <?= json_encode(array_column($logs, 'weight')) ?>;
        const lightData = <?= json_encode(array_column($logs, 'light')) ?>;
        const soundData = <?= json_encode(array_column($logs, 'sound')) ?>;
        const accelerationData = <?= json_encode(array_column($logs, 'acceleration')) ?>;

        const data = {
            labels: labels.reverse(),
            datasets: [
                {
                    label: 'Temperature (°C)',
                    data: temperatureData.reverse(),
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                },
                {
                    label: 'Humidity (%)',
                    data: humidityData.reverse(),
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                },
                {
                    label: 'Weight (kg)',
                    data: weightData.reverse(),
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                },
                {
                    label: 'Light (lux)',
                    data: lightData.reverse(),
                    borderColor: 'rgb(255, 205, 86)',
                    backgroundColor: 'rgba(255, 205, 86, 0.2)',
                    fill: true
                },
                {
                    label: 'Sound (dB)',
                    data: soundData.reverse(),
                    borderColor: 'rgb(153, 102, 255)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    fill: true
                },
                {
                    label: 'Acceleration (g)',
                    data: accelerationData.reverse(),
                    borderColor: 'rgb(255, 159, 64)',
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    fill: true
                }
            ]
        };

        // Chart configuration
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    x: { title: { display: true, text: 'Time' }},
                    y: { title: { display: true, text: 'Values' }}
                }
            }
        };

        // Render chart
        new Chart(document.getElementById('trendChart'), config);
        <?php endif; ?>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
