<?php

require 'vendor/autoload.php';

$hosts = [
    'localhost:9200' // ip和端口
];

$client = Elasticsearch\ClientBuilder::create()
    ->setHosts($hosts)
    ->build();

$params = [
    'index' => 'test',
    'type' => 'test',
    'id' => '5' // http://192.168.247.140:9200/test/test/5
];


$response = $client->get($params);
var_dump($response);
