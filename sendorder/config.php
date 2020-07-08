<?php

require(__DIR__.'/vendor/autoload.php');

return [
    'aws'=>[
        'region'            => 'eu-central-1',
        'version'           => '2018-11-29',
        'endpoint'          => getenv('AWS_WEBSOCKET_MANAGEMENT_ENDPOINT'),
        'credentials'       => new Aws\Credentials\Credentials(getenv('AWS_KEY'), getenv('AWS_SECRET'))
    ],
    'database'=>[
        'host'     => getenv('DB_HOST'),
        'user'     => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'name' => getenv('DB_NAME')
    ]
];
