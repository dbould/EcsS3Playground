<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use Aws\S3\S3Client;

$client = new S3Client([
    'endpoint' => $configuration->endpoint,
    'credentials' => [
        'key'    => $configuration->key,
        'secret' => $configuration->secret,
    ],
    'region' => 'your-region',
    'version' => '2006-03-01',
]);

var_dump($client->listBuckets());
