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

// Ambil data terbaru dari database (20 data terakhir untuk grafik)
$stmt = $pdo->query('SELECT * FROM mqtt_sensor_logs ORDER BY created_at DESC LIMIT 20');
$logs = $stmt->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Time Series Dashboard</title>
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
            height: 200px;
            cursor: pointer;
        }
        .status-card {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .status-item {
            text-align: center;
            margin: 10px;
        }
        .status-label {
            font-weight: bold;
        }
        .status-value {
            font-size: 1.5rem;
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
                    <li class="nav-item"><a class="nav-link active" href="time_series.php">Time Series</a></li>
                    <li class="nav-item"><a class="nav-link" href="patterns_and_trends.php">Patterns & Trends</a></li>
                    <li class="nav-item"><a class="nav-link" href="predictive_analytics.php">Predictive Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="data_processing_integration.php">Data Processing</a></li>
                    <li class="nav-item"><a class="nav-link" href="database_logs.php">Database Logs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard -->
    <div class="container dashboard">
        <h1 class="text-center">Time Series Data</h1>

        <!-- Grafik -->
        <div class="row">
            <?php 
            $charts = [
                'Temperature (°C)' => ['temperature', 'rgb(255, 99, 132)', 'rgba(255, 99, 132, 0.2)'],
                'Humidity (%)' => ['humidity', 'rgb(54, 162, 235)', 'rgba(54, 162, 235, 0.2)'],
                'Weight (kg)' => ['weight', 'rgb(75, 192, 192)', 'rgba(75, 192, 192, 0.2)'],
                'Light Intensity (lux)' => ['light', 'rgb(255, 205, 86)', 'rgba(255, 205, 86, 0.2)'],
                'Sound Level (dB)' => ['sound', 'rgb(153, 102, 255)', 'rgba(153, 102, 255, 0.2)'],
                'Acceleration (g)' => ['acceleration', 'rgb(255, 159, 64)', 'rgba(255, 159, 64, 0.2)'],
            ];
            foreach ($charts as $title => $data) {
                echo "
                <div class='col-md-6'>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <div class='chart-container' data-bs-toggle='modal' data-bs-target='#chartModal' data-chart='{$data[0]}Chart'>
                                <canvas id='{$data[0]}Chart'></canvas>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>

        <!-- Status Aktuator -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="status-card">
                    <?php 
                    $actuators = [
                        'Kipas' => 'kipas_state',
                        'Pemanas' => 'pemanas_state',
                        'Lampu Merah' => 'lampu_merah_state',
                        'Lampu Hijau' => 'lampu_hijau_state',
                        'Buzzer' => 'buzzer_state',
                        'Servo Angle' => 'servo_angle',
                    ];

                    if (!empty($logs)) {
                        $latestLog = $logs[0]; // Ambil data terbaru
                        foreach ($actuators as $label => $field) {
                            $value = isset($latestLog[$field]) ? $latestLog[$field] : null;

                            // Tambahkan logika untuk servo_angle dengan perlakuan khusus
                            if ($field === 'servo_angle') {
                                $displayValue = $value !== null ? "{$value}°" : 'N/A';
                            } else {
                                $displayValue = $value == 1 ? 'ON' : 'OFF';
                            }

                            echo "
                            <div class='status-item'>
                                <span class='status-label'>$label</span>
                                <span class='status-value'>$displayValue</span>
                            </div>";
                        }
                    } else {
                        echo "<p class='text-center'>No data available for actuators.</p>";
                    }
                    ?>
                </div>
            </div>
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
        const labels = <?= json_encode(array_column($logs, 'created_at')) ?>;
        const chartInstances = {};
        <?php foreach ($charts as $key => $data): ?>
        const <?= $data[0] ?>Data = <?= json_encode(array_column($logs, $data[0])) ?>;

        chartInstances['<?= $data[0] ?>Chart'] = new Chart(document.getElementById('<?= $data[0] ?>Chart'), {
            type: 'line',
            data: {
                labels: labels.reverse(),
                datasets: [{
                    label: '<?= $key ?>',
                    data: <?= $data[0] ?>Data.reverse(),
                    borderColor: '<?= $data[1] ?>',
                    backgroundColor: '<?= $data[2] ?>',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    x: { title: { display: true, text: 'Time' }},
                    y: { title: { display: true, text: '<?= $key ?>' }}
                }
            }
        });
        <?php endforeach; ?>

        // Modal Chart
        const modalChart = new Chart(document.getElementById('modalChart'), {
            type: 'line',
            data: {},
            options: {}
        });

        document.querySelectorAll('.chart-container').forEach(container => {
            container.addEventListener('click', (event) => {
                const chartId = container.getAttribute('data-chart');
                const chartInstance = chartInstances[chartId];

                modalChart.data = JSON.parse(JSON.stringify(chartInstance.data));
                modalChart.options = JSON.parse(JSON.stringify(chartInstance.options));
                modalChart.update();

                document.getElementById('chartModalLabel').textContent = chartInstance.data.datasets[0].label;
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
