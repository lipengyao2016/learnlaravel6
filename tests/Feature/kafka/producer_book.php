<?php

for($j = 1;$j <= 9;$j++)
{
    $rk = new RdKafka\Producer();
    print_r($rk);
    $rk->setLogLevel(LOG_DEBUG);
    $rk->addBrokers("47.107.246.243");
    $topic = $rk->newTopic("book".$j);
    print_r($topic);
    for ($i = 3; $i < 4; $i++) {
        $sendRet = $topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode(['value' => "book dt $i"]));
        print_r(" sendRet:".$sendRet);
    }
}
