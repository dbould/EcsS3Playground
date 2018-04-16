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

//var_export($client->listBuckets());

//Upload a file
$client->putObject([
    'Bucket' => 'iaptus-docs',
    'Key' => 'service1/daves_stuff/test.txt',
    'Body' => 'mooo',
]);

//Use command pattern to list objects in a directory
$params = [
    'Bucket' => 'iaptus-docs',
    'Key' => 'service1/',
];

$command = $client->getCommand('ListObjects', $params);
var_export($client->execute($command));
