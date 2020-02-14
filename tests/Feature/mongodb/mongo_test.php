<?php

$manager = new MongoDB\Driver\Manager('mongodb://root:root@47.112.99.100:27891');
$bulk = new MongoDB\Driver\BulkWrite; //默认是有序的，串行执行

$bulk->insert(['user_id'=>1,'name'=>"李刚","position"=>"test engineer","age"=>20]);
$bulk->insert(['user_id'=>2,'name'=>"侯伟","position"=>"web engineer","age"=>20]);
$bulk->insert(['user_id'=>3,'name'=>"陈发","position"=>"php engineer","age"=>20]);
$status = $manager->executeBulkWrite('sqdj.colleagues', $bulk); //执行写入 location数据库下的colleagues集合
