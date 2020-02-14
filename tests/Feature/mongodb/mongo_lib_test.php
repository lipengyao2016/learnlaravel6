<?php


$uri = "mongodb://root:root@47.112.99.100:27891";
$client = new MongoDB\Client($uri);

$collection      = (new MongoDB\Client)->sqdj->colleagues;
$insertOneResult = $collection->insertOne([
    'username' => 'admin',
    'email'    => 'admin@example.com',
    'name'     => 'Admin User',
]);
printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
var_dump($insertOneResult->getInsertedId());


