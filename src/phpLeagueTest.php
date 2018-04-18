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

$adapter = new AwsS3Adapter($client, $configuration->bucket);
$filesystem = new Filesystem($adapter);

$folderContent = $filesystem->listContents('service1/daves_stuff/');

//Examples below

//Delete a file
//$filesystem->delete('service1/daves_stuff/test.txt');

//Upload new file
//$filesystem->write('service1/daves_stuff/test.txt', fopen('test.txt', 'r'));

//See directory content
//var_export($filesystem->listContents('service1/daves_stuff/'));

//Fetch file object
//$myFile = $filesystem->get('service1/daves_stuff/test.txt');

//Read a file
//var_export($myFile->read('service1/daves_stuff/test.txt'));
