<?php

$rk = new RdKafka\Producer();
print_r($rk);
$rk->addBrokers("47.112.111.193");

$topic = $rk->newTopic("kafkaStorm");

print_r($topic);

//$msgDataStr = '';
//
//$msgData = json_decode($msgDataStr,true);
//
////var_dump($msgData);
//
//$sendRet = $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode($msgData));
//print_r(" sendRet:".json_encode($sendRet));


