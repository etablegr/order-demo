<?php

// Representing an existing php application
require(__DIR__.'/vendor/autoload.php');
$config=require(__DIR__.'/config.php');

use Aws\ApiGatewayManagementApi\ApiGatewayManagementApiClient;

$item     =  $_POST['order_item'];
$quantity =  $_POST['quantity'];

// Replace with host
$dsn = "mysql:host={$config['database']['host']};dbname={$config['database']['name']}";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn,$config['database']['user'],$config['database']['password']);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$apiGateway = new ApiGatewayManagementApiClient($config['aws']);

$stmt = $pdo->query("SELECT connection_id FROM websocket_connections");

while ($row = $stmt->fetch()) {
    $connection_id = $row['connection_id'];
    echo "Sending to ${connection_id}".PHP_EOL;
    try {
        $apiGateway->postToConnection([
            'ConnectionId' => $connection_id,
            'Data' => "$quantity X $item"
        ]);
    } catch (Exception $e) {
       echo "Error: ${connection_id}".PHP_EOL;
       error_log($e->getMessage());
       $stmt = $pdo->prepare('DELETE FROM websocket_connections where connection_id = ?');
       $stmt->execute([$connection_id]);
    }
}