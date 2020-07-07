<?php

require(__DIR__.'/vendor/autoload.php');

return [
    'aws'=>[
        'region'            => 'eu-central-1',
        'apiVersion'        => '2018-11-29',
        'endpoint'          => 'https://535j71sx0h.execute-api.eu-central-1.amazonaws.com',
        'credentials'       => new Aws\Credentials\Credentials(getenv('AWS_KEY'), getenv('AWS_SECRET'))
    ],
    'database'=>[
        'host'     => getenv('DB_HOST'),
        'user'     => getenv('DB_USER'),
        'password' => getenv('DB_PASSWORD'),
        'name' => getenv('DB_NAME')
    ]
];