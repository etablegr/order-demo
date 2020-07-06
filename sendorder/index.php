<?php

// Representing an existing php application

use Aws\ApiGatewayManagementApi\ApiGatewayManagementApiClient;

$item     =  $_POST['order_item'];
$quantity =  $_POST['quantity'];

// Replace with host
$host = '';
// Replace with database name
$db = 'websocket_demo';

// Database username
$username='';
// Database password
$password='';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF-8";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn,$username,$password);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$apiGateway= new ApiGatewayManagementApiClient();

$stmt = $pdo->query("SELECT connection_id FROM websocket_connections");

while ($row = $stmt->fetch()) {
    $connection_id = $row['connection_id'];

}