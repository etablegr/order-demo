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

// $options = [
//     'region'            => 'eu-central-1',
//     'apiVersion'        => '2018-11-29',
//     'endpoint'          => '',
//     'credentials'       => new Aws\Credentials\Credentials('key', 'secret');
// ];


// $apiGateway= new ApiGatewayManagementApiClient($options);

$stmt = $pdo->query("SELECT connection_id FROM websocket_connections");

while ($row = $stmt->fetch()) {
    $connection_id = $row['connection_id'];
    var_dump($connection_id);
}