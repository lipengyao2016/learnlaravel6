<?php

$rk = new RdKafka\Producer();
print_r($rk);
$rk->setLogLevel(LOG_DEBUG);
$rk->addBrokers("47.107.246.243");

$topic = $rk->newTopic("test1");

print_r($topic);

for ($i = 3; $i < 4; $i++) {
    $sendRet = $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode(['value' => "data dt $i"]));
    print_r(" sendRet:".$sendRet);
}
