<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IoT System Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard {
            margin-top: 50px;
        }
        .card {
            margin-bottom: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
        footer {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            margin-top: 50px;
        }
        footer a {
            color: #ffdd00;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container dashboard">
        <h1>IoT System Dashboard</h1>
        <div class="row">
            <!-- Time Series Data -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Time Series Data</h5>
                        <p class="card-text">Visualize changes over time for temperature, humidity, and more.</p>
                        <a href="time_series.php" class="btn btn-primary">View Time Series</a>
                    </div>
                </div>
            </div>

            <!-- Pattern and Trend Data -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Pattern and Trend Data</h5>
                        <p class="card-text">Analyze patterns and trends in IoT data over specific periods.</p>
                        <a href="patterns_and_trends.php" class="btn btn-primary">View Patterns and Trends</a>
                    </div>
                </div>
            </div>

            <!-- Predictive Analytics -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Predictive Analytics</h5>
                        <p class="card-text">Explore future predictions using historical IoT data.</p>
                        <a href="predictive_analytics.php" class="btn btn-primary">View Predictive Analytics</a>
                    </div>
                </div>
            </div>

            <!-- Data Processing and Integration -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Data Processing and Integration</h5>
                        <p class="card-text">Learn about data processing and integration techniques.</p>
                        <a href="data_processing_integration.php" class="btn btn-primary">View Data Processing</a>
                    </div>
                </div>
            </div>

            <!-- Database Logs -->
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Database Logs</h5>
                        <p class="card-text">View raw logs of all sensor and actuator data stored in the database.</p>
                        <a href="database_logs.php" class="btn btn-success">View Database Logs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p><strong>IoT Dashboard</strong> - A project for monitoring and analyzing sensor and actuator data for BeeHive.</p>
            <p>Developed by <strong>Muhammad Ilham Nur Z</strong> - 2042221136.</p>
            <p>Institut Teknologi Sepuluh Nopember - Department of Instrumentation Engineering - IoT Course.</p>
            <p>© 2024 Institut Teknologi Sepuluh Nopember. All rights reserved.</p>
            <p>Contact us at: <a href="2042221136@student.its.ac.id">2042221136@student.its.ac.id</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
