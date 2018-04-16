<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

$client = new S3Client([
    'endpoint' => $configuration->endpoint,
    'credentials' => [
        'key'    => $configuration->key,
        'secret' => $configuration->secret,
    ],
    'region' => 'your-region',
    'version' => '2006-03-01',
]);

//List buckets
//var_export($client->listBuckets());

$adapter = new AwsS3Adapter($client, 'iaptus-docs');
$filesystem = new Filesystem($adapter);

//$filesystem->write('service1/daves_stuff/test.pdf', 'test.pdf');
//$filesystem->deleteDir('service1/daves_stuff');

var_export($filesystem->listContents());
