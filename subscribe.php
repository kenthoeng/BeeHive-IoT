<?php
require('library/phpmqtt.php');

// Koneksi database
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

// MQTT Configuration
$server = 'test.mosquitto.org';  // Broker MQTT
$port = 1883;                   // Port MQTT
$clientId = 'PHPSubscriber-' . rand(); // Unique client ID

$mqtt = new Bluerhinos\phpMQTT($server, $port, $clientId);

if (!$mqtt->connect()) {
    die("Failed to connect to MQTT broker.");
}

// Callback function when a message is received
$mqtt->subscribe(['sensor/status' => ['qos' => 0, 'function' => function ($topic, $message) use ($pdo) {
    echo "Received message on topic: $topic\n";
    echo "Message: $message\n";

    // Decode JSON payload
    $data = json_decode($message, true);
    if (!$data) {
        echo "Invalid JSON payload\n";
        return;
    }

    // Prepare and execute insert statement
    $stmt = $pdo->prepare('INSERT INTO mqtt_sensor_logs 
        (topic, temperature, humidity, weight, light, sound, acceleration, kipas_state, pemanas_state, lampu_merah_state, lampu_hijau_state, buzzer_state, servo_angle) 
        VALUES (:topic, :temperature, :humidity, :weight, :light, :sound, :acceleration, :kipas_state, :pemanas_state, :lampu_merah_state, :lampu_hijau_state, :buzzer_state, :servo_angle)');
    
    $stmt->execute([
        ':topic' => $topic,
        ':temperature' => $data['temperature'],
        ':humidity' => $data['humidity'],
        ':weight' => $data['weight'],
        ':light' => $data['light'],
        ':sound' => $data['sound'],
        ':acceleration' => $data['acceleration'],
        ':kipas_state' => $data['kipas'],
        ':pemanas_state' => $data['pemanas'],
        ':lampu_merah_state' => $data['lampuMerah'],
        ':lampu_hijau_state' => $data['lampuHijau'],
        ':buzzer_state' => $data['buzzer'],
        ':servo_angle' => $data['servo'],
    ]);
    echo "Data inserted successfully\n";
}]]);

// Keep listening to the broker
while ($mqtt->proc()) {
    // This will keep the script running to receive messages
}

$mqtt->close();
