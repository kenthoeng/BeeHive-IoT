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

$stmt = $pdo->query('SELECT * FROM mqtt_sensor_logs ORDER BY created_at DESC');
$logs = $stmt->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sensor and Actuator Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
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
                    <li class="nav-item"><a class="nav-link" href="predictive_analytics.php">Predictive Analytics</a></li>
                    <li class="nav-item"><a class="nav-link" href="data_processing_integration.php">Data Processing</a></li>
                    <li class="nav-item"><a class="nav-link active" href="database_logs.php">Database Logs</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Table Container -->
    <div class="container table-container">
        <h1>Sensor and Actuator Logs</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Temperature (°C)</th>
                    <th>Humidity (%)</th>
                    <th>Weight (kg)</th>
                    <th>Light (lux)</th>
                    <th>Sound (dB)</th>
                    <th>Acceleration (g)</th>
                    <th>Kipas</th>
                    <th>Pemanas</th>
                    <th>Lampu Merah</th>
                    <th>Lampu Hijau</th>
                    <th>Buzzer</th>
                    <th>Servo Angle (°)</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= $log['id'] ?></td>
                    <td><?= htmlspecialchars($log['topic']) ?></td>
                    <td><?= $log['temperature'] ?></td>
                    <td><?= $log['humidity'] ?></td>
                    <td><?= $log['weight'] ?></td>
                    <td><?= $log['light'] ?></td>
                    <td><?= $log['sound'] ?></td>
                    <td><?= $log['acceleration'] ?></td>
                    <td><?= $log['kipas_state'] ? 'ON' : 'OFF' ?></td>
                    <td><?= $log['pemanas_state'] ? 'ON' : 'OFF' ?></td>
                    <td><?= $log['lampu_merah_state'] ? 'ON' : 'OFF' ?></td>
                    <td><?= $log['lampu_hijau_state'] ? 'ON' : 'OFF' ?></td>
                    <td><?= $log['buzzer_state'] ? 'ON' : 'OFF' ?></td>
                    <td><?= $log['servo_angle'] ?>°</td>
                    <td><?= $log['created_at'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
