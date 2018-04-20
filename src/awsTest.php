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
//$client->putObject([
//    'Bucket' => 'iaptus-docs',
//    'Key' => 'service1/daves_stuff/test.txt',
//    'Body' => fopen(__DIR__ . '/../test.txt', 'r+'),
//]);

//Delete a file
//$client->deleteObject([
//    'Bucket' => 'iaptus-docs',
//    'Key' => 'service1/daves_stuff/test.txt',
//    'Body' => 'cluck',
//]);

//Read a file
$testFile = $client->getObject([
    'Bucket' => 'iaptus-docs',
    'Key' => 'service1/daves_stuff/test.txt',
    //Save directly to file
    //'SaveAs' => '/tmp/my-out-file.txt',
]);
//echo get_class($testFile['Body']);

//The object contained in the body is a GuzzleHttp\Psr7\Stream
//Contents can be read using echo, var_dump will dump the object
echo get_class($testFile['Body']);

////Use command pattern to list objects in a directory
//$params = [
//    'Bucket' => 'iaptus-docs',
//    'Prefix' => 'service1/daves_stuff',
//];
//$command = $client->getCommand('ListObjects', $params);
//var_export($client->execute($command));
