<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../bootstrap.php';

use Aws\S3\S3Client;
use Aws\Kms\KmsClient;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use League\Flysystem\Filesystem;

//$kmsClient = new KmsClient([
//    'endpoint' => $configuration->endpoint,
//    'credentials' => [
//        'key'    => $configuration->key,
//        'secret' => $configuration->secret,
//    ],
//    'region' => 'your-region',
//    'version' => '2014-11-01',
//]);
//$kmsClient->createKey();

$client = new S3Client([
    'endpoint' => $configuration->endpoint,
    'credentials' => [
        'key'    => $configuration->key,
        'secret' => $configuration->secret,
    ],
    'region' => 'your-region',
    'version' => '2006-03-01',
]);

//Creates a new bucket
//$client->createBucket([
//    "Bucket" => "daves-bucket",
//]);



//$client->putBucketEncryption([
//    "Bucket" => $configuration->bucket,
//    "ServerSideEncryptionConfiguration" => [
//        "Rules" => [
//            "ApplyServerSideEncryptionByDefault" => [
//                "KMSMasterKeyID" => "AsqbtyyJ6uZFQX33Uo8",
//                "SSEAlgorithm" => "AES256|aws:kms"
//            ],
//        ],
//    ],
//]);

$adapter = new AwsS3Adapter($client, $configuration->bucket);
$filesystem = new Filesystem($adapter);

$folderContent = $filesystem->listContents('daves_stuff');
//Examples below

//Delete a file
//$filesystem->delete('daves_stuff/wtf.jpg');

//Upload new file
//$filesystem->write('daves_stuff/test.txt', fopen('test.txt', 'r'));
//$filesystem->write('daves_stuff/test.txt', fopen('test.txt', 'r'), ['ServerSideEncryption' => 'moooo']);

//See directory content
//var_export($filesystem->listContents('daves_stuff/'));

//Fetch file object
//$myFile = $filesystem->get('daves_stuff/test.txt');

//Read a file
//var_export($myFile->read('daves_stuff/test.txt'));
//$myFile->readStream();
